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
//const nodemailer = require('nodemailer');
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
    //res.render('checkin');
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
            if (typeof stripe_result.status === 'undefined') {
                if (typeof stripe_result.message === 'undefined') {
                    /*res.render('message', {
                        'message': req.body.amount +
                            "charge did not do through!<br />" +
                            stripe_result.credit_message
                    });*/
                    res.render('checkin');
                }
            } else if (stripe_result.status == 'succeeded') {
                res.render('checkin');
                /*
                res.render('checkin', {
                    'checkin': req.body.amount +
                        "charged"
                });
                */
            }
        }
    );
});

app.listen(3000, function() {
    console.log('Server up!')
});

/*setInterval(function emailJob() {
    // create reusable transporter object using the default SMTP transport
    var transporter = nodemailer.createTransport({
        service: 'gmail',
        auth: {
            user: 'mikeyng93@gmail.com',
            pass: 'yourpass'
        }
    });

    // setup email data with unicode symbols
    var mailOptions = {
        from: '"Fred Foo 👻" <foo@blurdybloop.com>', // sender address
        to: 'bar@blurdybloop.com, baz@blurdybloop.com', // list of receivers
        subject: 'Hello ✔', // Subject line
        text: 'Hello world ?', // plain text body
        html: '<b>Hello world ?</b>' // html body
    };

    // send mail with defined transport object
    transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
            return console.log(error);
        }
        console.log('Message %s sent: %s', info.messageId, info.response);
    });
}, config.email_job_frequency);*/