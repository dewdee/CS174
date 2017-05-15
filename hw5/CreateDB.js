/*
The grader can use the line node CreateDB.js to create your mysql database.
The database has a table USER(ID, EMAIL, LAST_CHECK_IN, LAST_EMAIL_SENT, NOTIFY_LIST, MESSAGE).
*/

var mysql = require('mysql');
// set-up and connect
var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'password'
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
connection.query('CREATE TABLE user(id INT(10) NOT NULL AUTO_INCREMENT, email TEXT, last_check_in TIMESTAMP, last_email_sent TIMESTAMP, notify_list TEXT, message TEXT, PRIMARY KEY(id))',
    function(error, results, fields) {
        if (error) throw error;
    }
);
/* close the connection.
   makes sure all queries terminate before closing connection
 */
connection.end(function(err) {});