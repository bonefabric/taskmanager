### Маршрутизация

Маршуты объявляются с помощью компонента Core\Components\Router\Router;
Компонент текущего приложения получается:
```php
/**
* 1 способ
*/
use Core\Facades\Router;

$router = Router::component();

/**
* 2 способ
*/
use Core\Application;

$router = Application::getInstance()->getComponent(\Core\Components\Router\Router::class);
```
