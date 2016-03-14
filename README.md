# Laravel Leadboard

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This package offers to reward entities with points and to create a ranking based on these points.

It is possible to reward, penalize, multiply, redeem and reset points and entities can be blacklisted/whitelisted which makes it possible to prevent certain entities to receive points.

Each entity will receive a rank based on its points which could be used to display a listing of the users with the most points or something like that.

## Install

Via Composer

``` bash
$ composer require draperstudio/laravel-leadboard
```

And then include the service provider within `app/config/app.php`.

``` php
'providers' => [
    'DraperStudio\Leaderboard\LeaderboardServiceProvider'
];
```

At last you need to publish the migration and run the migration:

```bash
php artisan vendor:publish && php artisan migrate
```

## Usage

``` php
$user = App\User::find(1);

$events = [
    'CompletedProfile'      => 10,
    'SocialLoginFacebook'   => 5,
    'SocialLoginTwitter'    => 5,
    'SocialLoginGoogleplus' => 5,
];

// User filled out address, phone, email, etc.
if($user->completedProfile()) {
    $user->reward($events['CompletedProfile']);
}

// User added his Facebook profile
if($user->hasSocialProfile('facebook')) {
    $user->reward($events['SocialLoginFacebook']);
}

// User removed his Facebook profile
if($user->removedSocialProfile('facebook')) {
    $user->penalize($events['SocialLoginFacebook']);
}

// User purchased a premium package
$plan = App\Plan::findByTitle('Premium');

if($user->purchased($plan)) {
    $user->reward($plan->points);
}

// User wants to purchase something
$product = App\Product::find(1);

try {
    if($user->redeem($product->price)) {
        event(new ProductWasPurchased($product, $user));
    }
} catch(\DraperStudio\Leaderboard\Exceptions\InsufficientFundsException $e) {
    // Not enough points
    dd($e);
}
```

## Functions

#### Reward the given amount of points.
``` php
$user->reward(10);
```

### Remove the given amount of points.
``` php
$user->penalize(5);
```

### Multiply all points by the given factor.
``` php
$user->multiply(2);
```

### Redeem the given amount of points.
``` php
$user->redeem(15);
```

### Reset all points to zero.
``` php
$user->reset();
```

### Blacklist the user. <sub><sup>This will disable all functions except for blacklist/whitelist.</sub></sup>
``` php
$user->blacklist();
```

### Whitelist the user.
``` php
$user->whitelist();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hello@draperstudio.tech instead of using the issue tracker.

## Credits

- [DraperStudio][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/DraperStudio/laravel-leadboard.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/DraperStudio/Laravel-Leadboard/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/DraperStudio/laravel-leadboard.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/DraperStudio/laravel-leadboard.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/DraperStudio/laravel-leadboard.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/DraperStudio/laravel-leadboard
[link-travis]: https://travis-ci.org/DraperStudio/Laravel-Leadboard
[link-scrutinizer]: https://scrutinizer-ci.com/g/DraperStudio/laravel-leadboard/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/DraperStudio/laravel-leadboard
[link-downloads]: https://packagist.org/packages/DraperStudio/laravel-leadboard
[link-author]: https://github.com/DraperStudio
[link-contributors]: ../../contributors
