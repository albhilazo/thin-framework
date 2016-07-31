# ThinFramework

Small experimental PHP framework.


### Related repositories

- [ThinFramework](https://github.com/albhilazo/thin-framework)
- [ThinFramework-app](https://github.com/albhilazo/thin-framework-app)


### Installation

Add and require the repository in your `composer.json`.

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/albhilazo/thin-framework"
    }
],
"require": {
    "php": ">=5.6",
    "albhilazo/thin-framework": "dev-master"
},
```

Update your dependencies.

```
$ composer update
```


### Routing configuration

The routing configuration items must match the following format:

```yaml
<route_id>:
  path: <route_path>
  controller: <controller_class_with_full_namespace>
  action: <action_method_in_controller>  # optional, defaults to indexAction
```

Route parameters can be specified between brackets (`{param}`) in the path and will be passed as arguments to the action method.

Configuration example:

```yaml
root:
  path: /
  controller: ThinApp\Controller\HomeController

studentScore:
  path: /students/{student_id}/scores/{score_id}
  controller: ThinApp\Controller\StudentController
  action: scoreAction
```


### Service configuration

Service configuration items must match the following format:

```yaml
<service_id>
  class: <service_class_with_full_namespace>
  arguments:
    - "@another_service"
    - "static_argument"
```

Service arguments that are instances of other configured services are specified with their service ID prefixed with an `@`.

Configuration example:

```yaml

symfony.yaml:
  class: Symfony\Component\Yaml\Parser

thin.router:
  class: ThinFramework\Component\Router\Router
  arguments:
    - "@symfony.yaml"
    - "/path/to/app/routing/routing.yml"
```


### Sample controller

```php
<?php

namespace ThinApp\Controller;

use ThinFramework\Component\Controller\ThinController;
use ThinFramework\Component\Container\Container;
use ThinFramework\Component\Templating\TemplatingAdapter;
use ThinFramework\Component\Request\Request;


class SampleController extends ThinController
{

    const TEMPLATE = 'example.tpl';


    public function __construct(Container $container, TemplatingAdapter $templating, Request $request)
    {
        parent::__construct($container, $templating, $request);

        $this->template->setLayout(self::TEMPLATE);
    }


    public function indexAction($firstParam, $secondParam)
    {
        $this->sendResponse();
    }

}
```


### Framework components

 - **Bootstrap**: Entry point to the framework.
 - **Container**: Service container used by both the framework and the application.
 - **Controller**: Abstract controller class.
 - **Repository**: MySQL PDO repository.
 - **Request**: HTTP request object.
 - **Response**: HTTP and JSON response objects.
 - **Router**: Router service and route object.
 - **Templating**: Templating adapters for Smarty and Twig engines.
