# Sahan traders


## How to setup

- Set up docker and start docker
- Check out from repo (checkout `main` branch for dev and checkout `prod` branch for production changes)


## run this very first time (soon after checkout) - only one time

Note: https://laravel.com/docs/11.x/sail#installing-composer-dependencies-for-existing-projects
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

## change env settings

- replace .env file config based on relevant environment


### Dev Env

```
./vendor/bin/sail up
```
or add it to env

https://laravel.com/docs/11.x/sail#configuring-a-shell-alias


install node modules

```
sail yarn install 
```

run this command separate cmd line to dev mode watch js files

```
sail yarn dev 
```


### Prod env

```
./vendor/bin/sail -f docker-compose-prod.yml up
```
or add it to env

https://laravel.com/docs/11.x/sail#configuring-a-shell-alias


https://www.itsolutionstuff.com/post/laravel-9-resize-image-before-upload-exampleexample.html

run this command separate cmd line to build js and css files

```
sail yarn build 
```



### Common for all env , Initial

refresh DB and add default data to tables

``
sail artisan migrate:refresh --seed
``

### Run every time

update table changes

``
sail artisan migrate
``

Update default data

``
sail artisan db:seed --force
``



## Additional (If need)

if port already in use
```
sudo kill `sudo lsof -t -i:3306`
```



# sample UI sites

https://demo74.leotheme.com/prestashop/at_autozpro_demo/en/home-3.html

https://demo74.leotheme.com/prestashop/at_autozpro_demo/en/home-1.html


### For development

create component

```
sail artisan make:component Molecules/ProductDisplayRight

```

Country codes

```
https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/index.json
```


stripe

```
https://www.youtube.com/watch?v=J13Xe939Bh8

```


# stripe

```
docker run --rm -it stripe/stripe-cli:latest listen --api-key rk_test_51MgDCzAOnE9oXiC8RvJdoEBUzselznUZs5QFXOHCjRoaxoxAyTIYL6YMSzaooU1vIj8cgqVQuo3OjhQKbCz3Rr1L00NLIG5tjg --forward-to http://localhost:80/api/webhook/stripe 

```


## Stripe Use this to check reponses

https://docs.stripe.com/stripe-cli#install

## setup stripe cli via homebrew
```
 brew install stripe/stripe-cli/stripe
 ```

- login to stripe
```
stripe login
```
