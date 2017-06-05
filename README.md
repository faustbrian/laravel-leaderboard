# Laravel Leadboard

I would appreciate you taking the time to look at my [Patreon](https://www.patreon.com/faustbrian) and considering to support me if I'm saving you some time with my work.

This package offers to reward entities with points and to create a ranking based on these points.

It is possible to reward, penalize, multiply, redeem and reset points and entities can be blacklisted/whitelisted which makes it possible to prevent certain entities to receive points.

Each entity will receive a rank based on its points which could be used to display a listing of the users with the most points or something like that.

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require faustbrian/laravel-leadboard
```

At last you need to publish the migration and run the migration:

```bash
php artisan vendor:publish --provider="BrianFaust\Leaderboard\LeaderboardServiceProvider" && php artisan migrate
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
} catch(\BrianFaust\Leaderboard\Exceptions\InsufficientFundsException $e) {
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

## Testing

``` bash
$ phpunit
```

## Security

If you discover a security vulnerability within this package, please send an e-mail to Brian Faust at hello@brianfaust.de. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://brianfaust.de)
