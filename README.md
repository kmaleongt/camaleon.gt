<p align="center">
    <h2>e-Shop Camaleón GT</h2>
</p>



## Topics
1. [Introduction](#introduction)
2. [Documentation](#documentation)
3. [Requirements](#requirements)
4. [Installation & Configuration](#installation-and-configuration)
5. [License](#license)
6. [Security Vulnerabilities](#security-vulnerabilities)
7. [Miscellaneous](#miscellaneous)

### Introduction

[e-Shop Camaleón GT](https://camaleon.gt) is a hand tailored E-Commerce framework built on some of the hottest opensource technologies
such as [Laravel](https://laravel.com) (a [PHP](https://secure.php.net/) framework) and [Vue.js](https://vuejs.org)
a progressive Javascript framework.

**e-Shop Camaleón GT can help you to cut down your time, cost, and workforce for building online stores or migrating from physical stores
to the ever demanding online world. Your business -- whether small or huge -- can benefit. And it's very simple to set it up.**


# Visit our live [Demo](https://demo.camaleon.gt)

It packs in lots of features that will allow your E-Commerce business to scale in no time:

* Multiple Channels, Locale, Currencies.
* Built-in Access Control Layer.
* Beautiful and Responsive Storefront.
* Descriptive and Simple Admin Panel.
* Admin Dashboard.
* Custom Attributes.
* Built on Modular Approach.
* Support for Multiple Store Themes.
* Multistore Inventory System.
* Orders Management System.
* Customer Cart, Wishlist, Product Reviews.
* Simple, Configurable, Group, Bundle, Downloadable and Virtual Products.
* Price rules (Discount) inbuilt.
* Theme (Velocity).
* CMS Pages.
* Many more.

**For Developers**:
Take advantage of two of the hottest frameworks used in this project -- Laravel and Vue.js -- both of which have been used **in e-Shop Camaleón GT**.

### Documentation

#### e-Shop Camaleón GT Documentation [https://devdocs.bagisto.com](https://devdocs.bagisto.com)

### Requirements

* **OS**: Ubuntu 20.04 LTS or higher / Windows 10 or Higher (Laragon / WampServer / XAMPP).
* **SERVER**: Apache 2 or NGINX.
* **RAM**: 3 GB or higher.
* **PHP**: 7.4.0 or higher.
* **Processor**: Clock Cycle 1 Ghz or higher.
* **For MySQL users**: 8.0 or higher.
* **For MariaDB users**: 10.2.7 or Higher.
* **Node**: 8.11.3 LTS or higher.
* **Composer**: 1.9.5 or higher.

### Installation and Configuration

**1. You can install e-Shop Camaleón GT by using the GUI installer.**

##### a. Download zip from the link below:

```bash
git clone https://github.com/corporation-camaleon/camaleon.gt.git

cd camaleon.gt/

```

##### b. Navigate to the project folder and run the project in your browser:

~~~
http(s)://localhost/camaleon.gt/public
~~~

or

~~~
http(s)://camaleon.gt/
~~~

**2. Or you can install e-Shop Camaleón GT from your console.**

##### Execute these commands below, in order

~~~
1. php artisan bagisto:install
~~~

**To execute e-Shop Camaleón GT**:

##### On server:

Warning: Before going into production mode we recommend you uninstall developer dependencies.
In order to do that, run the command below:

> composer install --no-dev

~~~
Open the specified entry point in your hosts file in your browser or make an entry in hosts file if not done.
~~~

##### On local:

~~~
php artisan serve
~~~


**How to log in as admin:**

> *http(s)://camaleon.gt/admin/login*

~~~
email:admin@camaleon.gt
password:admin123
~~~

**How to log in as customer:**

*You can directly register as customer and then login.*

> *http(s)://camaleon.gt/customer/register*


### License
e-Shop Camaleón GT is a truly opensource E-Commerce framework which will always be free under the [MIT License](https://github.com/corporation-camaleon/camaleon.gt/blob/master/LICENSE).

### Security Vulnerabilities
Please don't disclose security vulnerabilities publicly. If you find any security vulnerability in e-Shop Camaleón GT then please email us: mailto:support@camaleon.gt.



