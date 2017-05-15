/*
emailJob uses queries to check for all user whose last_check_in, LAST_EMAIL_SENT are both 0, and 
    send them an initial Check-In Email. 
emailJob gets all users such that last_check_in < last_email_sent AND (current time - last_email_sent) > notify_delay and 
    send each person on in their NOTIFY_LIST column the appropriate Notify Let-Know List Email.
emailJob gets all users such that last_email_sent < last_check_in and (current time - last_email_sent) > check_in_frequency and 
    send these users the appropriate Check-In Email.
*/
var path = require('path'); // for directory paths
var config = require(path.join(__dirname, 'config'));
var nodemailer = require('nodemailer');
var mysql = require('mysql');
var connection = mysql.createConnection({
    host: 'localhost',
    user: config.sql_user,
    password: config.sql_password,
    database: config.sql_db
});
connection.connect();

var emailJob = {
    "emailJob": function() {
        console.log("Interval");
        var from = config.email_user;
        var current_time = new Date().toLocaleString();
        var transporter = nodemailer.createTransport({
            service: config.email_service,
            auth: {
                user: config.email_user,
                pass: config.email_password
            }
        });
        var initialSQL = mysql.format('SELECT email FROM user WHERE last_check_in = 0 AND last_email_sent = 0');
        connection.query(initialSQL, function(error, results) {
            if (error) throw error;
            if (results) {
                if (results.length > 0) {
                    for (var i = 0; i < results.length; i++) {
                        var recipient = results[i].email;
                        var emailString = 'Not-Dead-Yet...Time to Check-in!\n\nDear ' + recipient + ':\n\nPlease click the link below or copy it into your browser to check-in \nwith us and update your notify list.\n\nlocalhost:3000/checkin?email=' + recipient + '\n\nBest regards,\nNot-Dead-Yet Team';
                        var mailOptions = {
                            from: from, // sender address
                            to: recipient, // list of receivers
                            subject: 'Check-In Email', // Subject line
                            text: emailString
                        };
                        transporter.sendMail(mailOptions, function(error, info) {
                            if (error) {
                                return console.log(error);
                            }
                            console.log('Inital Message Sent. From: %s To: %s', from, recipient);
                        });
                        var sql = mysql.format('UPDATE user SET last_email_sent = ? WHERE email = ?', [current_time, recipient]);
                        connection.query(sql, function(error, results) {
                            if (error) throw error;
                        });
                    }
                }
            }
        });

        var notifySQL = mysql.format('SELECT email, notify_list FROM user WHERE last_check_in < last_email_sent AND (? - last_email_sent) > ?', [current_time, config.notify_delay]);
        connection.query(notifySQL, function(error, results) {
            if (error) throw error;
            if (results) {
                if (results.length > 0) {
                    for (var i = 0; i < results.length; i++) {
                        var deceased = results[i].email;
                        var emailString = 'Dear ' + recipient + ':\n\n' + deceased + 'has not checked-in with us during their\ncheck-in period. We are sending you the message below that was\nrequested to be sent by ' + deceased + 'if this happened.\n\n...Message that ' + deceased + ' left...\n\nBest regards,\nNot-Dead-Yet Team';
                        var mailOptions = {
                            from: from, // sender address
                            to: recipient, // list of receivers
                            subject: 'Notify Email', // Subject line
                            text: emailString
                        };
                        transporter.sendMail(mailOptions, function(error, info) {
                            if (error) {
                                return console.log(error);
                            }
                            console.log('Notification Message Sent. Id: %s Res: %s', info.messageId, info.response);
                        });
                    }
                }
            }
        });

        var checkinSQL = mysql.format('SELECT email FROM user WHERE (last_email_sent < last_check_in) AND (? - last_email_sent) > ?', [current_time, config.check_in_frequency]);
        connection.query(checkinSQL, function(error, results) {
            if (error) throw error;
            if (results) {
                if (results.length > 0) {
                    for (var i = 0; i < results.length; i++) {
                        var recipient = results[i].email;
                        var emailString = 'Not-Dead-Yet...Time to Check-in!\n\nDear' + recipient + ':\n\nPlease click the link below or copy it into your browser to check-in \nwith us and update your notify list.\n\nlocalhost:3000/checkin?email=' + recipient + '\n\nBest regards,\nNot-Dead-Yet Team';
                        var mailOptions = {
                            from: from, // sender address
                            to: recipient, // list of receivers
                            subject: 'Check-In Email', // Subject line
                            text: emailString
                        };
                        transporter.sendMail(mailOptions, function(error, info) {
                            if (error) {
                                return console.log(error);
                            }
                            console.log('Checkin Message Sent. From: %s To: %s', from, recipient);
                        });
                        var sql = mysql.format('UPDATE user SET last_email_sent = ? WHERE email = ?', [current_time, recipient]);
                        connection.query(sql, function(error, results) {
                            if (error) throw error;
                        });
                    }
                }
            }
        });
    }

}
module.exports = emailJob;