<p align="center"><img src="https://raw.githubusercontent.com/kbkyzd/shiraishi/master/public/shiraishi-orgx600.png"></p>

<p align="center">Shiraishi, Another school project.</p>
<p align="center">
<a href="https://styleci.io/repos/110443572"><img src="https://styleci.io/repos/110443572/shield" alt="Style CI Status" title="Style CI Status"></a>
<a href="https://travis-ci.org/kbkyzd/shiraishi"><img src="https://img.shields.io/travis/kbkyzd/shiraishi.svg?style=flat-square" alt="Build Status" title="Build Status"></a>
<a href="https://coveralls.io/github/kbkyzd/shiraishi?branch=master"><img src="https://img.shields.io/coveralls/github/kbkyzd/shiraishi/master.svg?style=flat-square" alt="Test Coverage" title="Test Coverage"></a>
</p>

## Dependencies
* PHP >7.1
* MariaDB 10.2 (Any DB [supported](https://laravel.com/docs/5.5/database) by Eloquent works)
* Laravel 5.5 [Requirements](https://laravel.com/docs/5.5#installation)
* [Composer](https://getcomposer.org/)
* [Yarn](https://yarnpkg.com/en/)
* Redis

## Bootstrapping a local environment
You will need a *nix environment (WSL works pretty well) as [horizon](https://laravel.com/docs/5.5/horizon) requires ext-pcntl (unix only PHP extension).

* `git clone https://github.com/kbkyzd/shiraishi` - Clone the repo
* `composer install` - Install PHP dependencies
* `yarn` - Install frontend assets
* `yarn run dev` - Compile frontend assets
* `cp .env.example .env` - Init .env file
    - You'll need to fill in your secrets here like your DB credentials; most of the names are pretty self explantory.
    - Laravel supports many different drivers for different tasks, you can use something like the below example if you can't be bothered to set up things like redis or run a full RDBMS, but keep in mind broadcasting requires redis (so notifications won't work -- though in general it's fairly tricky to set that up to begin with)

```
BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=sqlite
SESSION_LIFETIME=120
QUEUE_DRIVER=sync
```

* `php artisan key:generate` - Generate Laravel secret
* `php artisan jwt:secret -f` - Generate JWT secret
* `php artisan migrate --seed` - Migrate and Seed the DB
* `php artisan serve` - Finally, boot up the dev server (it should tell you to visit localhost:8000)

### Notifications/Real-time eventing
* [laravel-echo-server](https://github.com/tlaverdure/laravel-echo-server) (Socket.io Server, just do `npm install -g`/`yarn global add laravel-echo-server`)
* Either horizon (`QUEUE_DRIVER=redis`) or `QUEUE_DRIVER=sync`

From here, you can choose to whether to set up the socket.io server to receive notifications. My recommendation is just to read the report and look at the files that implement the features.