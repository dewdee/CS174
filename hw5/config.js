/*
Your Config.js file should also have three configurable properties: 
check_in_frequency, which controls how frequently users need to check in, measured in milliseconds
notify_delay, which determines the minimum time in milliseconds after a failed check-in before a user's Let-Know List is emailed,
email_job_frequency, which controls how often the callback to send out a batch of emails is called.
*/

var config = {
    "check_in_frequency": 60000,
    "notify_delay": 60000,
    "email_job_frequency": 10000,
    "SECRET_KEY": "sk_test_kUModSZHTxes6aCJlQjA8jTV",
    "PUBLISHABLE_KEY": "pk_test_LXsVjQmkeQlbv5lSfZPHbYSi",
    "CHARGE_URL": "https://api.stripe.com/v1/charges",
    "CHARGE_CURRENCY": "usd",
    "CHARGE_DESCRIPTION": "Not-Dead-Yet service charge",
    "CHARGE_USERAGENT": "CreditCardTester",
    "TIMEOUT": 20,
    "email_user": "mikenagooyen@gmail.com",
    "email_password": "mngg04wer1",
    "email_service": "gmail"
};
module.exports = config;