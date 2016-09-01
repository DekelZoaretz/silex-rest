# api

Rest api. Base on silex framework

## installation
* **Install** [virtual box](https://www.virtualbox.org/)
* **Install** [vagrant](https://www.vagrantup.com/)
* Add api box into vagrant

* ```
        vagrant box add api $api_BOX_PATH$
    ```

* Go to api local folder
* Starting the virtual matchine

* ```
        vagrant up
    ```

* Adding this line into hosts file (C:\Windows\System32\drivers\etc\hosts)

* ```
        192.168.33.10 dev.api.co.il
    ```

## APi server installation
* go to path in server: /var/www/html/api and run this commands:

* ```
         composer install 
         vendor/bin/phinx migrate
         sh scripts/seeds
    ```


## Unit testing
* ```
         vendor/bin/phpunit
    ```


## credentials 
* DB
    * **username:**  `root`
    * **password:** `root`
    * **ip:** `192.168.33.10`
* SSH
    * **username:**  `vagrant`
    * **password:** `vagrant`
    * **ip:** `192.168.33.10`

