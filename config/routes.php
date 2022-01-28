<?php

return [
  '/' => HomePage::class,
  '/login' => LoginPage::class,
  '/register' => RegisterPage::class,
  '/404' => function () {
    echo "Page not found";
  }
];
