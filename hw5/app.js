/*
Write a short Express app.js that listen to 8888. On the route /*foo*, it should output a validating HTML 5 page which is the result of interpolating, 
the value of the config.foo coming from an exported object from the module in config.js. On all other routes, it should output the value of config.goo.

Your project should use a middleware function to console.log the ip address of any request coming into your app.
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

// can add different routes
app.get('/*foo*', function(req, res) {
    res.render('index', { 'value': config.foo });
});
// route for everything else
app.get('/*', function(req, res) {
    res.render('index', { 'value': config.goo });
});
app.get('/checkin', function(req, res) {
    res.render('index');
});

app.listen(3000, function() {
    console.log('Server up!')
});