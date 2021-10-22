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

#### Методы для регистрации:

```php
// GET маршрут
$router->get('/path', \Core\Controllers\Api\v1\IndexController::class, 'index');

// POST маршрут
$router->post('/path', \Core\Controllers\Api\v1\IndexController::class, 'index');

// PUT маршрут
$router->put('/path', \Core\Controllers\Api\v1\IndexController::class, 'index');

// PATCH маршрут
$router->patch('/path', \Core\Controllers\Api\v1\IndexController::class, 'index');

// DELETE маршрут
$router->delete('/path', \Core\Controllers\Api\v1\IndexController::class, 'index');

// Ресурс
$router->resource('resourceName', \Core\Controllers\Api\v1\IndexController::class);
/**
* Ресурс создает автоматически маршруты
*/
$router->get('/resourceName', \Core\Controllers\Api\v1\IndexController::class, 'index');
$router->get('/resourceName/{id}', \Core\Controllers\Api\v1\IndexController::class, 'show');
$router->post('/resourceName', \Core\Controllers\Api\v1\IndexController::class, 'create');
$router->patch('/resourceName/{id}', \Core\Controllers\Api\v1\IndexController::class, 'edit');
$router->delete('/resourceName/{id}', \Core\Controllers\Api\v1\IndexController::class, 'delete');
/**
*
*/

// Группа маршрутов
$router->group($options, function() {});

// Запасной маршрут
$router->fallback(\Core\Controllers\Api\v1\IndexController::class, 'fallbackMethod);
```

#### Параметры маршрутов:
```php
$router->get('/user/{id}/account/{name}', \Core\Controllers\Api\v1\IndexController::class, 'index', [
    'patterns' => [
        'id' => '\d+',
        'name' => '.*'
    ]
```
- _patterns_ - паттерны для проверки параметров

#### Параметры группы маршрутов:
```php
// Префикс маршрутов
$router->group(['prefix' => 'api'], function() {
    
    //Маршрут GET api/path
    $router->get('/path', \Core\Controllers\Api\v1\IndexController::class, 'index');
    
});
```

Параметы передаются в вызываемый метод контроллера в порядке следования в маршруте.
