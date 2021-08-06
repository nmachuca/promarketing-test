## About Promarketing-Test

This is an API developed with the purpose of job process selection. The description of the challenge is in the PDF file in the root directory.

## Dependencies

<ul>
    <li>"livewire/livewire": "^2.5"</li>
    <li>"owenvoke/blade-fontawesome": "^1.9"</li>
    <li>"spatie/laravel-medialibrary": "^9.0.0"</li>
    <li>"spatie/laravel-permission": "^4.2"</li>
</ul>

## API Documentation

This API documentation is provided [here](https://documenter.getpostman.com/view/15703135/TzskD2zM)

## Local environment

In order to set up locally is recommended to have docker and docker compose. This project was made using the sail Laravel utility.
With these requirements out of the way you need to execute:

<ol>
    <li>Clone repository</li>
    <li><code>cd localpath/promarketing-test/</code></li>
    <li><code>docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/opt -w /opt laravelsail/php80-composer:latest composer install --ignore-platform-reqs</code></li>
    <li><code>cp .env.example .env</code></li>
    <li>set env variables DB_PASSWORD, ADMIN_USER_NAME, ADMIN_USER_EMAIL, ADMIN_USER_PASSWORD</li>
    <li><code>./vendor/bin/sail artisan key:generate</code></li>
    <li><code>./vendor/bin/sail up -d</code></li>
    <li><code>./vendor/bin/sail composer update</code></li>
    <li><code>./vendor/bin/sail artisan key:generate</code></li>
    <li><code>./vendor/bin/sail npm install</code></li>
    <li><code>./vendor/bin/sail npm run dev</code></li>
    <li><code>./vendor/bin/sail artisan migrate --seed</code></li>
</ol>
