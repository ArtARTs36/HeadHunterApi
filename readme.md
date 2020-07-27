Usage:

```php
use ArtARTs36\HeadHunterApi\Client;
use ArtARTs36\HeadHunterApi\Features\Vacancy\Vacancy;

$client = new Client('https://api.hh.ru', "User-Agent: MyApp/temicska99@mail.ru");
$feature = new Vacancy($client);
$vacancy = $feature->find(33411209);

var_dump($vacancy->getSpecializations());
```
