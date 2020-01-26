# ConRemider
* Contest Reminder is a web application that send mails( as remider) to subscribers about upcoming coding contests on codeforce and codechef.
* It is hosted at http://conreminder.almafiesta.com/
* Used php as backend language and Mysql for storing data, it uses "simple html dom" a php framework for scraping data.

# Setup
* It uses cron- a time-based job scheduler in Unix-like OS.
* Scraper is runinng ones in a day to scrap data about upcoming coding events on codeforce nad codechef.
* Mailer is running every hour and sending mails to users for the events that are going to start in 1min to 60 min OR 1h 24 hr,
thus two mails for a event one withing 1 hour and one within a day.
