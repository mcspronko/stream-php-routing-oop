<?php

class App
{
  private Router $router;

  public function run(): void
  {
    $this->initRouting();

    $this->router->dispatch();
  }

  private function initRouting(): void
  {
    $routes = require_once 'config/routes.php';

    $this->router = new Router($routes);
    $this->router->addPageNotFoundRoute(PageNotFoundPage::class);
  }
}