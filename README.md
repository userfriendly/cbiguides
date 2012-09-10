Sykes CBI Guides website
========================

The Sykes CBI Guides website is for company-internal use to create
competency-based interview guides. This document describes how to
install and maintain it.

This website was written using the Symfony2 PHP framework. For a
detailled documentation of that framework please see the main
[Symfony website][1]


1) Prerequisites
----------------

### Required

To run this website your web space will require the following software:

Apache 2.2 or higher

PHP 5.3.3 or higher

MySQL 5.5 or higher

### Recommended

To be able to follow the installation instructions in this document we
recommend that you have Git installed and have access to your web space
via Secure Shell (SSH).

While it is also possible to upload a copy of the codebase via FTP, it is
more complicated to install and, more importantly, maintain the website that
way than using the procedure described here.

It is also possible to substitute another web server (e.g. Microsoft IIS) for
Apache, but again, we do not recommend that as this website makes use of an
.htaccess file.


2) Installing the website
-------------------------

### Get the code

Log on to your server using SSH and clone the code repository:

    git clone git://github.com/userfriendly/cbiguides.git

This will create a directory `cbiguides`, containing a subfolder `web`. It is that
`web` folder that your web server needs to point to in the VirtualHost definition.

### Configuration

Copy the `app/config/parameters.yml.dist` file to `app/config/parameters.yml` and
edit that new file to contain your database host, database user, database password
and database name.

Also change the value of the `secret` variable. This variable is used for protection
against cross-site request forgery (CSRF) in forms.

### Install the vendor libraries

The repository contains a copy of the dependency manager composer, used to
install the vendor libraries. From the project root `cbiguides`, run it as
follows:

    php composer.phar install

This will pull all required vendor libraries into the `vendor` subfolder.

### Setting up permissions

Make sure that the cache and logs folders are writable by the web server.
For example, on Linux one of the two following methods should work. These
examples assume that your web server is running under a user account called
`www-data` (change `www-data` to the correct user if this is different on
your machine).

1. Using ACL on a system that supports chmod +a

    sudo chmod +a "www-data allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs

    sudo chmod +a "\`whoami\` allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs

2. Using ACL on a system that does not support chmod +a

    sudo setfacl -R -m u:www-data:rwx -m u:\`whoami\`:rwx app/cache app/logs

    sudo setfacl -dR -m u:www-data:rwx -m u:\`whoami\`:rwx app/cache app/logs

Note: if you are reading this file in plaintext format, remove the backslashes
from these commands, as they are only used to escape the \` backticks.

### Install public assets to web directory

    php app/console assets:install web --symlink

Note: if your server runs Windows instead of Linux, leave off the `--symlink`
parameter.

### Create the database tables

Symfony offers a simple command to create the required database tables. From
the project root `cbiguides`, run it as follows:

    php app/console doctrine:schema:update --force

### Create users

The codebase includes a command to quickly create users. Here are a few examples:

    php app/console sykes:user:create chuck chuckspassword

    php app/console sykes:user:create chuck chuckspassword --role=ROLE_ADMIN

    php app/console sykes:user:create chuck chuckspassword --role=ROLE_SUPER_ADMIN


3) Maintenance
--------------

### Update the codebase

In order to update the codebase, simply run `git pull` from the project root:

    git pull

This will connect to Github and update the main codebase.

### Update the vendor libraries

In order to update the vendor libraries, run composer again with the `update`
parameter:

    php composer.phar update

### Update composer

If your copy of composer.phar is outdated, get an up-to-date version from the
[composer website][2] and replace your copy with it.




[1]:  http://symfony.com/
[2]:  http://getcomposer.org/download/
