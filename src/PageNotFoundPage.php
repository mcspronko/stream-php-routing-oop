<?php

class PageNotFoundPage implements ActionInterface
{
  public function __invoke()
  {
    echo "Page not found from class";
  }
}