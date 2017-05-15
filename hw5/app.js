/*
For this homework you are going to create an application Not-Dead-Yet, using Node.js and Express.js, and if you want, Angular.js. 
The intent is to allow user's to send their loved ones a message, if they die. 
It's a paid service which periodically sends an email message to customer with a link in it. 
The customer has a certain time to click on the link. If they don't click on the link within the time period, 
emails are sent to a list of people notifying them that the customer has not checked-in.

Client-side Javascript is used to validate form data for both the landing page and check-in page before forms 
(for example, perform sanity checks on the credit card number) are submitted.
*/
var body_parser = require('body-parser'); //to handle posted data
var express = require('express');
var request = require('request');

var path = require('path'); // for directory paths
var config = require(path.join(__dirname, 'config'));
var emailJob = require(path.join(__dirname, 'emailJob'));

//Setup mysql connection
var mysql = require('mysql');
var connection = mysql.createConnection({
    host: 'localhost',
    user: config.sql_user,
    password: config.sql_password,
    database: config.sql_db
});
connection.connect();

var app = express();
app.use(body_parser.urlencoded({ extended: true }));

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

// create logger
var logger = function(req, res, next) {
    req.logger_name = "Super Logger";
    console.log(req.socket.remoteAddress + ": " + req.method);
    next();
}
app.use(logger);

//routes

app.get('/', function(req, res) {
    res.render('index', { 'PUBLISHABLE_KEY': config.PUBLISHABLE_KEY });
});
app.post('/charge', function(req, res) {
    /*here we use the request module to make a stripe request using
      the token we received from our form*/
    request.post({
            url: config.CHARGE_URL,
            form: {
                //swipe charges in cents * 100 to convert to dollars
                //since our price is fixed, we just multiply 5 * 100
                "amount": 5 * 100,
                "currency": config.CHARGE_CURRENCY,
                "source": req.body.credit_token,
                "description": config.CHARGE_DESCRIPTION
            },
            auth: {
                'user': config.SECRET_KEY,
                'pass': ''
            }
        },
        function(err, http_response, body) {
            stripe_result = JSON.parse(body);
            //If charge fails, refresh landing page
            if (typeof stripe_result.status === 'undefined') {
                if (typeof stripe_result.message === 'undefined') {
                    console.log("Charge did not go through");
                    res.render('index');
                }
            } else if (stripe_result.status == 'succeeded') {
                //Add our new user's information to database and send that to render
                //LAST_CHECK_IN, LAST_EMAIL_SENT initially 0
                var email = req.body.email;
                var sql = mysql.format('INSERT INTO user VALUES(null, ?, 0, 0, "", "")', [email]);
                connection.query(sql, function(error, results) {
                    if (error) throw error;
                });

                //render the page view with user information
                res.render('checkin', { 'email': email, 'lastcheckin': "0", 'message': "", 'update': "" });
                console.log(email + " paid $5");

            }
        }
    );
});
app.get('/checkin*', function(req, res) {
    var email = req.query.email;
    var message = "";

    var lastcheckin;
    getLastCheckIn(email, function(error, results) {
        if (error) throw error;
        message = results.message;
        lastcheckin = results.last_check_in.toLocaleString();
        notifylist = JSON.parse(results.notify_list);
        var update = "Checked-in!";
        res.render('checkin', { 'email': email, 'emailList': notifylist, 'lastcheckin': lastcheckin, 'message': message, 'update': "" });
    });
});
app.post('/checkin', function(req, res) {
    var email = req.body.email;
    var message = req.body.message;
    var emailList = JSON.stringify(req.body.emailList);
    var timestamp = new Date().toLocaleString();

    var sql = mysql.format('UPDATE user SET last_check_in = ?, message = ?, notify_list = ? WHERE email = ?', [timestamp, message, emailList, email]);
    connection.query(sql, function(error, results) {
        if (error) throw error;
    });

    //render checkin page again with new information
    var lastcheckin;
    getLastCheckIn(email, function(error, results) {
        if (error) throw error;
        email = results.email;
        message = results.message;
        lastcheckin = results.last_check_in.toLocaleString();
        notifylist = JSON.parse(results.notify_list);
        var update = "Checked-in!";
        res.render('checkin', { 'email': email, 'emailList': notifylist, 'lastcheckin': lastcheckin, 'message': message, 'update': update });
    });
    console.log(email + " checked in");
});

//Callback function to get last check in
function getLastCheckIn(email, callback) {
    sql = mysql.format('SELECT email, message, notify_list, last_check_in FROM user WHERE email = ?', [email]);
    var query = connection.query(sql);
    query.on('result', function(error, row) {
        if (error) throw error;
        callback(null, row);
    });
}

setInterval(function() {
    emailJob.emailJob();
}, config.email_job_frequency);

app.listen(3000, function() {
    console.log('Server up!')
});