# Sahan traders


## How to setup

- Set up docker and start docker
- Check out from repo
- run following command

```
./vendor/bin/sail up

```
or add it to env

https://laravel.com/docs/10.x/sail#configuring-a-shell-alias



composer installs

```
sail composer require laravel/sanctum

```

must run 

```
sail yarn dev 
```

for ui changes reload


if port already in use
```
sudo kill `sudo lsof -t -i:3306`
```
