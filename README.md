# Laravel system file explorer, can view & edit files online.

-   This is an Amila Laravel CMS Plugin
-   Laravel system file explorer, can view & edit files online.

## Install it via the backend

-   Go to the CMS settings page -> Plugin -> search for remote image
-   Find alexstack/laravel-cms-plugin-system-file
-   Click the Install button

## What the plugin do for us?

-   Laravel system file explorer
-   Can view & edit files online.
-   Store file edit history in case make a mistake

## Install it via command line manually

```php
composer require alexstack/laravel-cms-plugin-system-file

php artisan migrate --path=./vendor/alexstack/laravel-cms-plugin-system-file/src/database/migrations

php artisan vendor:publish --force --tag=Amila\\LaravelCms\\Plugins\\SystemFile\\LaravelCmsPluginServiceProvider

php artisan laravelcms --action=clear

```

## How to use it?

-   It's enabled after install by default. You can see a System File tab when you edit a page.
-   You don't need to do anything after install

## How to change the settings?

-   You can change the settings by edit plugin.system-file

```json

```

## Improve this plugin & documents

-   You are very welcome to improve this plugin and how to use documents

## License

-   This Amila Laravel CMS plugin is an open-source software licensed under the MIT license.
