voltaire
========

This is a website intended to be used by debate clubs at any level.

To install, install Php5, MySQL server, and Apache.  On Windows this can be done using Wamp Server. 

For Macs, apparently everything but MySQL comes with MAC so all you have to do is turn them on and install MySQL. The fellow at http://jason.pureconcepts.net/2012/10/install-apache-php-mysql-mac-os-x/ reports how to do this for Macs;  note that he is using 'vi' as a text editor; if you haven't used vi before, perhaps you should use a different text editor.

Once you've got PHP, MySQL, and Apache, then you have to install the packages, configure your database, and build the database.  This can be done as follows using the command line:

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

Php should output some html to the terminal and should not report any errors.  You should also be able to see the tables.  Also, open http://localhost in Firefox.  If that isn't working, but the php command is, then you haven't set up Apache to work with PHP.

===
Links
===

Subject | Link | Remark
| ------------- | ----------- | ----------- |
WAMP Server | http://www.wampserver.com/en/ | the easiest way to install php, mysql, and apache. Just copy this code into the wamp folder and you should be able to see it by navigating to http://localhost
Git Markdown | https://help.github.com/articles/github-flavored-markdown/ | How to this file while keeping the formatting
Propel ORM | http://propelorm.org/ | Object-Relational Mapping Documentation; in other words, how we manage the database using PHP
Composer | https://getcomposer.org/doc/00-intro.md | Dependency Management for PHP. Its how we manage php libraries.
