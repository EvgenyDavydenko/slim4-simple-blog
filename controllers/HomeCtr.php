<?php

namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



class HomeCtr extends BaseCtr{
  
  public function __invoke(Request $request, Response $response) {
    $post = new \App\Models\Post();
    $posts = $post->getList();
    $body = $this->view->render('home.twig', ['posts' => $posts]);
    $response->getBody()->write($body);
    return $response;

  }

}