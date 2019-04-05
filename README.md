# Instalation:

* homestead (EMP + redis)
* composer install
* npm install (run on windows if on dev env)
* npm install -g laravel-echo-server (on server)
* laravel-echo-server init (or edit the config file) See: https://github.com/tlaverdure/laravel-echo-server

# Put the server up

* homestead (EMP + redis)
* php artisan queue:work
* laravel-echo-server start

TODO - Include a process management to keep the queue and laravel echo up.



