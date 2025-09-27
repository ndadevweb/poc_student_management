# Initialization FRONTEND


## No React Project at this time

> To create a new ReactJS project, create a frontend folder and use this command

docker run --rm -it -u "$(id -u)":"$(id -g)" -e NPM_CONFIG_CACHE=/tmp/.npm -v "$PWD/frontend:/app" -w /app node:22-alpine sh

> Then install ReactJS

yes | npm create vite@latest . -- --template react
npm install
npm install eslint prettier --save-dev
exit

> Delete node_modules folder

rm -rf frontend/node_modules

> Open package.json in the frontendfolder/ and replace

"dev": "vite ", BY "dev": "vite --host 0.0.0.0",

> And now you can build with docker-compose

docker-compose up OR docker-compose up -d

> You should be to access to the react page from your browser


## React Project exists

> You just use this command to access the react page from your browser

docker-compose up OR docker-compose up -d


# Initialization BACKEND


## No ApiPlatform project at this time

> Check if the php configuration is ok to use Symfony and ApiPlatform

symfony check:requirements

> Install Symfony (without --webapp option) remove public/ folder before this command

symfony new my_project_directory --version="7.3.x" --directory=. --no-git

> Install ApiPlatform

composer require api

> Install some Development packages

composer require --dev symfony/profiler-pack
composer require --dev maker

> Install Lexik (https://github.com/lexik/LexikJWTAuthenticationBundle)

composer require lexik/jwt-authentication-bundle

> After Lexik is installed

php bin/console lexik:jwt:generate-keypair

> To use Refresh JWT (https://github.com/markitosgv/JWTRefreshTokenBundle)

composer require doctrine/orm doctrine/doctrine-bundle gesdinet/jwt-refresh-token-bundle

> Install package to communicate with Mercuce Service

composer require symfony/mercure-bundle





> To send email with MailPit add this value to DSN variable in Symfony .env / .env.local file (lahmailpit is the service name in docker-compose file)


MAILER_DSN=smtp://lahmailpit:1025?encryption=null&verify_peer=0




## Environment TEST

> Create a database test if it does not exist

php bin/console doctrine:database:create --env=test

> If you do not use migrations use this

php bin/console doctrine:schema:create --env=test

> But if you prefer use migrations use this

php bin/console doctrine:migrations:migrate --env=test --no-interaction




# DOCKER

> To see memory, cpu consomation

docker stats