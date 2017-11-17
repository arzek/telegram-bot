Telegram bot Laravel + [telegram-bot-sdk](https://github.com/irazasyed/telegram-bot-sdk) + Vue
===========================================

## Installl


- git clone
- composer install
- set variable SENTRY_DSN, TELEGRAM_BOT_TOKEN, SSL_API 
- php artisan serve 
- lt --port 8000  ( use [localtunnel](https://localtunnel.github.io/www/) ( npm install -g localtunnel ))
- set variable APP_URL
- php artisan telegram:uninstall-webhook
- php artisan telegram:install-webhook