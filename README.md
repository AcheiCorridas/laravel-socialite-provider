# AcheiCorridas

```bash
composer require acheicorridas/socialite-provider
```

[comment]: <> (## Installation & Basic Usage)

[comment]: <> (Please see the [Base Installation Guide]&#40;https://socialiteproviders.com/usage/&#41;, then follow the provider specific instructions below.)

### Add configuration to `config/services.php`

```php
'acheicorridas' => [    
  'issuer' => env('ACHEICORRIDAS_OPENID_ISSUER'),  
  'client_id' => env('ACHEICORRIDAS_CLIENT_ID'),  
  'client_secret' => env('ACHEICORRIDAS_CLIENT_SECRET'),  
  'redirect' => env('ACHEICORRIDAS_REDIRECT_URI'),
],
```

### Add provider event listener

Configure the package's listener to listen for `SocialiteWasCalled` events.

Add the event to your `listen[]` array in `app/Providers/EventServiceProvider`. See the [Base Installation Guide](https://socialiteproviders.com/usage/) for detailed instructions.

```php
protected $listen = [
    \SocialiteProviders\Manager\SocialiteWasCalled::class => [
        // ... other providers
        'SocialiteProviders\\AcheiCorridas\\AcheiCorridasExtendSocialite@handle',
    ],
];
```

### Usage

You should now be able to use the provider like you would regularly use Socialite (assuming you have the facade installed):

```php
return Socialite::driver('acheicorridas')->redirect();
```

### Returned User fields

- ``id``
- ``name``
