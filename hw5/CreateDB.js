/*
The grader can use the line node CreateDB.js to create your mysql database.
The database has a table USER(ID, EMAIL, LAST_CHECK_IN, LAST_EMAIL_SENT, NOTIFY_LIST, MESSAGE).
*/
var path = require('path'); // for directory paths
var config = require(path.join(__dirname, 'config'));
var mysql = require('mysql');
// set-up and connect
var connection = mysql.createConnection({
    host: 'localhost',
    user: config.sql_user,
    password: config.sql_password,
});
connection.connect();
connection.query('CREATE DATABASE IF NOT EXISTS hw5_mn',
    function(error, results, fields) {
        if (error) throw error;
    }
);
connection.query('USE hw5_mn', function(error, results, fields) {
    if (error) throw error;
});
connection.query('DROP TABLE IF EXISTS USER', function(error, results, fields) {
    if (error) throw error;
});
connection.query('CREATE TABLE user(id INT(10) NOT NULL AUTO_INCREMENT, email VARCHAR(100), last_check_in DATETIME, last_email_sent DATETIME, notify_list TEXT, message TEXT, UNIQUE(email), PRIMARY KEY(id))',
    function(error, results, fields) {
        if (error) throw error;
    }
);
/* close the connection.
   makes sure all queries terminate before closing connection
 */
connection.end(function(err) {});