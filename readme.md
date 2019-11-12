### Deploy with docker-compose

* cd to project's folder
* ```cp .env.example .env```
* ```cp laravel-echo-server-example.json laravel-echo-server.json```
* ```docker-compose up -d```
* ```docker exec -it example-php-fpm /bin/bash```
* ```composer install```
* ```php artisan key:generate```
* ```php artisan storage:link```
* update .env with PayPal and Stripe keys
* update public/.well-known/apple-developer-merchantid-domail-assosiation (see [Stripe documentation](https://stripe.com/docs/stripe-js/elements/payment-request-button#verifying-your-domain-with-apple-pay) for details)
