/*
The grader can use the line node CreateDB.js to create your mysql database.
The database has a table USER(ID, EMAIL, LAST_CHECK_IN, LAST_EMAIL_SENT, NOTIFY_LIST, MESSAGE).
LAST_CHECK_IN, LAST_EMAIL_SENT are Unix timestamps which are initially 0.
*/

var mysql = require('mysql')
    // set-up and connect
var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'password'
        // could also add a database property
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
connection.query('CREATE TABLE IF NOT EXISTS USER(ID INTEGER AUTO_INCREMENTING, EMAIL TEXT, LAST_CHECK_IN TIMESTAMP, LAST_EMAIL_SENT TIMESTAMP, NOTIFY_LIST TEXT, MESSAGE TEXT)',
    function(error, results, fields) {
        if (error) throw error;
    }
);
/* close the connection.
   makes sure all queries terminate before closing connection
 */
connection.end(function(err) {});