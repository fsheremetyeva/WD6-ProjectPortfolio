# iMerch shopping cart

## Local Installation Instructions

This web application depends upon a "LAMP" stack for running. Or more specifically, a
 web server with [PHP](https://php.net/) support as well as a [MySQL](https://mysql.com/) / [MariaDB](https://mariadb.org/) database server.

 If running on macOS, [Vagrant](https://www.vagrantup.com/) and [Virtual Box](https://www.virtualbox.org/) provide an easy and compatible Apache / MySQL / PHP stack. The application also makes use of [Laravel Homestead](https://laravel.com/docs/5.2/homestead) - pre-packaged Vagrant Box. Step by Step Installation Instructions of all software is available at
 [Academind Youtube Channel](https://youtu.be/YuvHbC3aBaA).

 Setting up this web application can be done by:

 1. Copying the entire contents of the `shopping-cart` folder of the Git repository to your folder including Homestead files. The directory must be the path or virtual host expected by your HTTP server.

 2. Edit `Homestead.yaml` file to map out to `shopping-cart/public` folder and edit the path you are using. Ex.

   `folders:
       - map: ~/Desktop/WD6-ProjectPortfolio/Team Development/
         to: /home/vagrant/code

   sites:
       - map: shopping-cart.local
         to: /home/vagrant/code/shopping-cart/public`



3. Edit `/etc/hosts` on your local machine
   Ex. `192.168.10.10    shopping-cart.local`

4. To connect to the database edit `.env` file contents. Or keep homestead defaults while developing locally Ex.

   `DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=homestead
   DB_USERNAME=homestead
   DB_PASSWORD=secret`

5. Using [SequelPro](https://www.sequelpro.com/) or any other SQL database administration software to connect to your Homestead Virtual Box.
