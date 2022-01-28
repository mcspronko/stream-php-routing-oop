<?php

declare(strict_types=1);

class Router
{
  private array $routes;
  private $pageNotFoundRoute;

  public function __construct(array $routes)
  {
    $this->routes = $routes;
  }

  public function route(string $path, $callback): void
  {
    $this->routes[$path] = $callback;
  }

  public function addPageNotFoundRoute($callback): void 
  {
    $this->pageNotFoundRoute = $callback;
  }

  public function dispatch(): void
  {
    $uriArray = parse_url($_SERVER['REQUEST_URI']);
    $uri = $uriArray['path'];

    $found = false;
    foreach ($this->routes as $path => $callback) {
      if ($path !== $uri) continue;
  
      $found = true;

      if (is_string($callback)) {
        $object = new $callback();
        if ($object instanceof ActionInterface) {
          $object();
        } else {
          throw new Exception('Callback should implement ActionInterface');
        }
      } else {
        $callback();
      }
    }
  
    if (!$found && $this->pageNotFoundRoute) {
      $pageNotFoundCallback = new $this->pageNotFoundRoute();
      header("HTTP/1.0 404 Not Found");
      $pageNotFoundCallback();
    }
  }
}
