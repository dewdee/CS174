/*
Client-side Javascript is used to validate form data for both the landing page and check-in page before forms 
(for example, perform sanity checks on the credit card number) are submitted.
*/
var express = require('express');

var path = require('path'); // for directory paths
var config = require(path.join(__dirname, 'config'));

var app = express();

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
    res.render('index');
});
app.get('/charge', function(req, res) {
    res.render('checkin');
});

app.listen(3000, function() {
    console.log('Server up!')
});

setInterval(function() {
    console.log("Hi there, I'm the cool background task!\n");
}, config.email_job_frequency);