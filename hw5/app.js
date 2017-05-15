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
var nodemailer = require('nodemailer');
var request = require('request');

var path = require('path'); // for directory paths
var config = require(path.join(__dirname, 'config'));

//Setup mysql connection
var mysql = require('mysql');
var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'password',
    database: 'hw5_mn'
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
                connection.query(sql, function(error, results, fields) {
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
    connection.query(sql, function(error, results, fields) {
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
    //res.render('checkin', { 'email': email, 'lastcheckin': lastcheckin, 'message': "" });
    console.log(email + " checked in");
});
/*
emailJob uses queries to check for all user whose last_check_in, LAST_EMAIL_SENT are both 0, and 
    send them an initial Check-In Email. 
emailJob gets all users such that last_check_in < last_email_sent AND (current time - last_email_sent) > notify_delay and 
    send each person on in their NOTIFY_LIST column the appropriate Notify Let-Know List Email.
emailJob gets all users such that last_email_sent < last_check_in and (current time - last_email_sent) > check_in_frequency and 
    send these users the appropriate Check-In Email.
*/
function emailJob(from) {
    var current_time = new Date().toLocaleString();
    var transporter = nodemailer.createTransport({
        service: 'gmail',
        auth: {
            user: config.email_user,
            pass: config.email_password
        }
    });
    var initialSQL = mysql.format('SELECT * FROM user WHERE last_check_in = 0 AND last_email_sent = 0');
    connection.query(initialSQL, function(error, results, fields) {
        if (error) throw error;
        if (result) {
            //send email
        }
        var mailOptions = {
            from: '"Fred Foo 👻" <foo@blurdybloop.com>', // sender address
            to: 'bar@blurdybloop.com, baz@blurdybloop.com', // list of receivers
            subject: 'Hello ✔', // Subject line
            text: 'Hello world ?', // plain text body
            html: '<b>Hello world ?</b>' // html body
        };
    });

    var notifySQL = mysql.format('SELECT * FROM user WHERE last_check_in < last_email_sent AND (? - last_email_sent) > ?)', [current_time, config.notify_delay]);
    connection.query(notifySQL, function(error, results, fields) {
        if (error) throw error;
        if (result) {
            //send email
        }
        var mailOptions = {
            from: '"Fred Foo 👻" <foo@blurdybloop.com>', // sender address
            to: 'bar@blurdybloop.com, baz@blurdybloop.com', // list of receivers
            subject: 'Hello ✔', // Subject line
            text: 'Hello world ?', // plain text body
            html: '<b>Hello world ?</b>' // html body
        };
    });

    var checkinSQL = mysql.format('SELECT * FROM user WHERE last_email_sent < last_check_in AND (? - last_email_sent) > ?)', [current_time, config.check_in_frequency]);
    connection.query(checkinSQL, function(error, results, fields) {
        if (error) throw error;
        if (result) {
            //send email
        }
        var mailOptions = {
            from: '"Fred Foo 👻" <foo@blurdybloop.com>', // sender address
            to: 'bar@blurdybloop.com, baz@blurdybloop.com', // list of receivers
            subject: 'Hello ✔', // Subject line
            text: 'Hello world ?', // plain text body
            html: '<b>Hello world ?</b>' // html body
        };
    });

    /*    // create reusable transporter object using the default SMTP transport
        var transporter = nodemailer.createTransport({
            service: 'gmail',
            auth: {
                user: 'mikeyng93@gmail.com',
                pass: 'yourpass'
            }
        });

        // setup email data with unicode symbols
        var mailOptions = {
            from: from, // sender address
            to: to, // list of receivers
            subject: 'Check-In Email', // Subject line
            text: 'Hello world ?', // plain text body
            html: '<b>Hello world ?</b>' // html body
        };

        // send mail with defined transport object
        transporter.sendMail(mailOptions, function(error, info) {
            if (error) {
                return console.log(error);
            }
            console.log('Message %s sent: %s', info.messageId, info.response);
        });*/
}

//Callback function to get last check in
function getLastCheckIn(email, callback) {
    sql = mysql.format('SELECT email, message, notify_list, last_check_in FROM user WHERE email = ?', [email]);
    var query = connection.query(sql);
    query.on('result', function(row) {
        callback(null, row);
    });
}

setInterval(function() {
    //emailJob();
}, config.email_job_frequency);

app.listen(3000, function() {
    console.log('Server up!')
});