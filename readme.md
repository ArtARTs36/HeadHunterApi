Usage:

```php
use ArtARTs36\HeadHunterApi\Client;
use ArtARTs36\HeadHunterApi\Features\Vacancy\Vacancy;

$client = new Client('https://api.hh.ru', "MyApp/mymail.ru");
$feature = new Vacancy($client);
$vacancy = $feature->find(123456789);

var_dump($vacancy->getSpecializations());
```
