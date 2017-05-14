/*
Your Config.js file should also have three configurable properties: 
check_in_frequency, which controls how frequently users need to check in, measured in milliseconds
notify_delay, which determines the minimum time in milliseconds after a failed check-in before a user's Let-Know List is emailed,
email_job_frequency, which controls how often the callback to send out a batch of emails is called.
*/

var config = {
    "foo": "foo",
    "goo": "goo"
};
module.exports = config;