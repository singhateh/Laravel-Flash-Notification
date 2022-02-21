<!-- [![Issues](https://img.shields.io/github/issues/singhateh/Laravel-Flash-Notification)](https://github.com/singhateh/Laravel-Flash-Notification/issues) -->
[![Latest Version](https://img.shields.io/github/release/singhateh/Laravel-Flash-Notification.svg?style=flat-square)](https://github.com/singhateh/Laravel-Flash-Notification/releases)
[![Latest Version](https://img.shields.io/github/license/singhateh/Laravel-Flash-Notification.svg?style=flat-square)](https://github.com/singhateh/Laravel-Flash-Notification/license)
[![Stars](https://img.shields.io/github/stars/singhateh/Laravel-Flash-Notification)](https://github.com/singhateh/Laravel-Flash-Notification/stargazers)
[![Total Downloads](https://img.shields.io/packagist/dt/singhateh/Laravel-Flash-Notification.svg?style=flat-square)](https://packagist.org/packages/jambasangsang/flash)

# Flash Notification 
Flash Notification Laravel Framework Toast Styling

## Installation

Firstly, Pull the package through Composer from packagist.

Run `composer require jambasangsang/flash`

### This section required only for Laravel < 5.6
And then include the service provider within `config/app.php`.

```php
'providers' => [
    \Jambasangsang\Flash\FlashNotificationServiceProvider::class,
];
```

And, for convenience, add a facade alias to this same file at the bottom:

```php
'aliases' => [
    'LaravelFlash' => Jambasangsang\Flash\Facades\LaravelFlash::class,
];
```

## Usage

Within your controllers, before you perform a redirection...

```php
public function store(Request $request)
{
    LaravelFlash::withSuccess('Your Record has been saved successfully!');

    return Redirect::route('destination');
}
```

You may also use:

- `LaravelFlash::withInfo('You have pay your bills this week!')`
- `LaravelFlash::withSuccess('Your Record has been saved successfully!')`
- `LaravelFlash::withWarning('You have an security issue try to fix that!')`
- `LaravelFlash::withError('Your Record was not saved Fail!')`


This will set a few keys in the session:

- 'flash_notification.title' - The message title you're flashing
- 'flash_notification.message' - The message you're flashing
- 'flash_notification.level' - A string that represents the type of notification (good for applying CSS/Bootstrap class names)

Alternatively you may reference the `flash()` helper function, instead of the facade. Here's an example:

```php
/**
 * Destroy the user's session (logout).
 *
 * @return Response
 */
public function destroy()
{
    Auth::logout();

    flash()->success('Logout successfull','You have been logged out.');

    return home();
}
```

You can even chain them to flash multiple messages at once.

```php
/**
 * Destroy the user's session (logout).
 *
 * @return Response
 */
public function destroy()
{
    Auth::logout();

    flash()->success('Logout successfull','You have been logged out.')
    ->warning('Close Browser','You should close this Browser window now');

    return home();
}
```

With this messages flashed to the session, you may now display it in your view(s). 

```html
@include('flash-toastr::message')
```

This will include the message.blade.php in to your view.

If you need to modify the flash message partials, you can run:

```bash
php artisan vendor:publish --tag=flash-views
```

The message view will now be located in the `resources/views/vendor/flash-toastr/` directory.

### JavaScript Options for toastr.js
You can pass an array of options, which will be used to setup toastr.js

```php
{{ Config::set('flash-toastr.options', ['progressBar' => false,'positionClass' => 'toast-top-left']) }}
```

You can also publish the config file:

```bash
php artisan vendor:publish --tag=flash-config
```
To publish both, config and views you can run:

```bash
php artisan vendor:publish --tag=flash
```

See [Toastr Documentation](http://codeseven.github.io/toastr/demo.html) for all available options
