voltaire
========

This is a website intended to be used by debate clubs at any level.

To install, install Php5, MySQL server, and Apache.  On Windows this can be done using Wamp Server.

Then you have to install the packages, configure your database, and build the database.  This can be done as follows using the command line:

```
php composer.phar install
mysql -u root -p
(enter password here)
create database debateclub;
exit;
propel sql:insert
```

To verify the installation worked:

```
php index.php
mysql -u root -A debateclub -p
show tables;
exit;
```

Php should output some html to the terminal and should not report any errors.  You should also be able to see the tables.

===
Links
===

WAMP Server | http://www.wampserver.com/en/ | the easiest way to install php, mysql, and apache. Just copy this code into the wamp folder and you should be able to see it by navigating to http://localhost
---|---|---
Git Markdown | https://help.github.com/articles/github-flavored-markdown/ | How to Edit README.md
---|---|---
Propel ORM | http://propelorm.org/ | Object-Relational Mapping Documentation; in other words, how we manage the database using PHP
---|---|---
Composer | https://getcomposer.org/doc/00-intro.md | Dependency Management for PHP. Its how we manage php libraries.
---|---|---
