## HPCFront 



## Official Documentation



### Contributing To HPCFront

Clone the repository:
  
    git clone git@github.com:jairoserrano/HPCFront.git

Change to the project folder and execute composer:

    composer install

In addition, clear the cache files:

    php artisan cache:clear

After that you should go to public folder and make sure to have [node.js](http://nodejs.org/) and [Bower](http://bower.io/#install-bower) installed, after that execute

    bower install

### LDAP Ath Configuration

If you going to use LDAP authentication you should follow the next steps:

Open app/config/app.php and add:

    Ymo\L4OpenLdap\L4OpenLdapServiceProvider

Open ```app/config/auth.php`` and change the authentication driver to ```ldap```.

Run ```php artisan config:publish ymo/l4-openldap``` and adjust the config file for your LDAP settings.

It can be found in ```app/config/packages/ymo/l4-openldap```.

### License

The HPCFront software licensed under the [AGPL v3](http://www.gnu.org/licenses/agpl-3.0.html).

The Laravel Software licenced under the [MIT license](http://opensource.org/licenses/MIT)

## Build on Laravel PHP Framework
