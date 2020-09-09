## HeadHunter API

![PHP Composer](https://github.com/ArtARTs36/HeadHunterApi/workflows/PHP%20Composer/badge.svg?branch=master)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
<a href="https://poser.pugx.org/artarts36/head-hunter-api/d/total.svg">
    <img src="https://poser.pugx.org/artarts36/head-hunter-api/d/total.svg" alt="Total Downloads">
</a>

----

### Description:

Client for work with API https://hh.ru

HeadHunter API Documentation: https://github.com/hhru/api

---

### Installation:

`composer require artarts36/head-hunter-api`

----

### Examples:

#### Simple:

```php
use ArtARTs36\HeadHunterApi\Client;
use ArtARTs36\HeadHunterApi\Features\Vacancy\Vacancy;

$client = new Client('https://api.hh.ru', 'MyApp/my@mail.ru');
$feature = new Vacancy($client);
$vacancy = $feature->find(123456789);

var_dump($vacancy->getSpecializations());
```

#### Connect in Laravel:

1*. Set variables in .env:
```bash
HEADHUNTER_API_BASE_URL='https://api.hh.ru'
HEADHUNTER_API_USER_AGENT='MyApp/my@mail.ru'
```

2*. Binding in bootstrap/app.php:

```php
$app->singleton(
    \ArtARTs36\HeadHunterApi\Contracts\Client::class,
    function () {
        return new \ArtARTs36\HeadHunterApi\Client(
              env('HEADHUNTER_API_BASE_URL'),
              env('HEADHUNTER_API_USER_AGENT')
        );
    }
);
```
