<?php

namespace App\Controllers;

class BaseCtr {

  public $view;

  public function __construct()
  {
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
    $twig = new \Twig\Environment($loader);
    $this->view = $twig;
  }

}