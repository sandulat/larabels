<p align="center"><img src="https://coltorapps.com/images/larabels.png" width="80%"></p>
<p align="center">
🌍 Larabels - Laravel localization labels dashboard 🌏
</p>
<p align="center">
<img src="https://img.shields.io/packagist/vpre/sandulat/larabels.svg">
<img src="https://img.shields.io/github/license/sandulat/larabels.svg">
<a href="https://twitter.com/intent/follow?screen_name=sandulat">
  <img src="https://img.shields.io/twitter/follow/sandulat.svg?style=social">
</a>
<p>

## About
Larabels is an editor for your Laravel localization files.

The main purpose of this package is to allow non-technical
people commit label updates directly to the repository in development environments. 
It automatically parses all languages by folders from `resources/lang` and all localization files from each language.

Larabels is built to work exclusively with Git. 
As you've might seen in the screenshot above, we've got 3 buttons fixed to the bottom of screen:

`Save` - all labels from all languages will be exported to `resources/lang`.

`Reset` - all the changes exported to `resources/lang` are reverted to original state.

`Commit & Push` - all the changes are commited and pushed to `origin HEAD`.

Note: you (or the server) must have passwordless push access to the repository.

## Installation

```shell
composer require sandulat/larabels
php artisan larabels:install
```
The last command will publish Larabel's service provider, config and public front-end assets.

Note: to re-publish the front-end assets when updating the package use: `php artisan larabels:publish`

## Authorization
By default Larabels will be accessible by anyone in a local environment only. However it provides a customizable gate that
limits access in production environments. See the `gate()` method inside the published `LarabelsServiceProvider`:

```php
/**
 * Register the Larabels gate.
 *
 * This gate determines who can access Larabels in non-local environments.
 *
 * @return void
 */
protected function gate()
{
    Gate::define('viewLarabels', function ($user) {
        return in_array($user->email, [
            //
        ]);
    });
}
```

## Configuration
Larabels works without any additional configuration, however it provides a config (`config/larabels.php`) with these options:

|Option|Default Value|Description|
|------|-------------|-----------|
|`enabled`|`env('LARABELS_ENABLED', true)`|This option may be used to disable Larabels direct route access. Note: Larabels views will ignore this option so you can include them in your project.|
|`middleware`|`[\Sandulat\Larabels\Http\Middleware\Authorize::class]`|These middlewares will be assigned to every Larabels route. Note that in any case Larabels routes implicitly belong to the "web" middleware.|
|`whitelist`|`[]`|This value determines which localization files should be included in the dashboard. Files will be loaded from `/resources/lang/{locale}`. Use file names without extension: `auth`, `pagination`, `validation`, `passwords`, etc. Leave empty to load all files.|
|`path`|`/larabels`|This value determines the base route path where the dashboard will be  accessible from.|

## Customization
If you would like to include the Larabels editor view directly into your personal dashboard, set the environment option `LARABELS_ENABLED` to `false` to disable direct access to the Larabels route. Now add `@include('larabels::app')` wherever you'd like.

Larabels is splitted into partials so you can easily cutomize the look. Inside the path `resources/views` create the folder `vendor/larabels`.

Now you can override the default Larabels views:
- `components/card.blade.php`
- `partials/action_buttons.blade.php`
- `partials/container.blade.php`
- `partials/label.blade.php`
- `partials/locale_button.blade.php`

## Credits

Created by [Stratulat Alexandru](https://twitter.com/sandulat).

<a href="https://coltorapps.com/">
  <img src="https://coltorapps.com/images/logo_transparent.png" width="150px">
</a>
