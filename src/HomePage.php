<?php

class HomePage implements ActionInterface
{
  public function __invoke()
  {
    echo "Home Page from class";
  }
}