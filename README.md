<!-- [![Issues](https://img.shields.io/github/issues/singhateh/Laravel-Flash-Notification)](https://github.com/singhateh/Laravel-Flash-Notification/issues) -->
[![Latest Version](https://img.shields.io/github/release/singhateh/Laravel-Flash-Notification.svg?style=flat-square)](https://github.com/singhateh/Laravel-Flash-Notification/releases)
[![Latest Version](https://img.shields.io/github/license/singhateh/Laravel-Flash-Notification.svg?style=flat-square)](https://github.com/singhateh/Laravel-Flash-Notification/license)
[![Stars](https://img.shields.io/github/stars/singhateh/Laravel-Flash-Notification)](https://github.com/singhateh/Laravel-Flash-Notification/stargazers)
[![Total Downloads](https://img.shields.io/packagist/dt/singhateh/Laravel-Flash-Notification.svg?style=flat-square)](https://packagist.org/packages/jambasangsang/flash)

# Flash Notification 
Flash Notification Laravel Framework Toast Styling

<p align="center">
    <img src="screenshot.gif" alt="Laravel Flash Notification" width="600px">
</p>


## Installation

Firstly, You can install the package using composer.

Run `composer require jambasangsang/flash`


### Then you can add the service provider to `config/app.php`. 
In Laravel versions 5.6 and beyond, this step can be skipped if package auto-discovery is enabled.

```php
'providers' => [
    Jambasangsang\Flash\FlashNotificationServiceProvider::class,
];
```

### Publish the configuration file:
 
```sh
$ php artisan vendor:publish --provider='Jambasangsang\Flash\FlashNotificationServiceProvider' --tag="flash-config"
```

### If not found run the below command:

```sh
$ php artisan vendor:publish 
```

And select `Jambasangsang\Flash\FlashNotificationServiceProvider`

## Usage

#### 1. If your application is using jQuery do not include [@jQuery], Otherwise Add the below code in your main view template:

CSS
`@flashStyle`, 

JS
`@jQuery`, 
`@flashScript`,
`@flashRender`


Example:

```blade

<!-- layouts/app.blade.php -->

<!doctype html>
<html>
    <head>
        
        @flashStyle
    </head>

    <body>
        
    @jQuery
    @flashScript
    @flashRender

    </body>
</html>

```

#### 2. Within your controllers, before you perform a redirection...

Example:

```php

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LevelStoreRequest;
use App\Models\Level;
use Illuminate\Http\RedirectResponse;
use App\Jambasangsang\Services\Levels\LevelService;
use Jambasangsang\Flash\Facades\LaravelFlash;

class LevelController extends Controller
{

    public function store(LevelStoreRequest $request, LevelService $levelService): RedirectResponse
    {
       
       try{
            $levelService->storeLevelData(new Level(), $request);

            LaravelFlash::withSuccess("Level added successfully!");

       }catch{

            LaravelFlash::withError("Woops!! an error check your input and try again!");
       }
        
        return redirect()->route('levels.index');
    }
}

```

You may also use other options below:

- `LaravelFlash::withInfo('You have pay your bills this week!')`
- `LaravelFlash::withSuccess('Your Record has been saved successfully!')`
- `LaravelFlash::withWarning('You have an security issue try to fix that!')`
- `LaravelFlash::withError('Your Record was not saved Fail!')`


### configuration:

##### to customize your flash notification.

```php
// config/flash.php
<?php

return [

    'options' => [
        'message'       => 'Default Message Here', //String
        'messageTextColor'   => '#ffff', //String
        'position'        => 'top-right', //String
        'customClass'     => '', //String
        'width'       => 'auto', //String Ex. 190px etc.
        'showCloseButton'         => true, //Boolean
        'closeButtonText'       => 'Close', //String
        'alertScreenReader'      => true, //Boolean
        'duration'       => 5000,
        'onClose'        => 'el', // Write your custom function here
        'closeButtonTextColor'      => '#FFFF',
    ],
];


```

## Credits

- [Alagie Singhateh](https://github.com/singhateh)
- [All Contributors](../../contributors)

## License

MIT
