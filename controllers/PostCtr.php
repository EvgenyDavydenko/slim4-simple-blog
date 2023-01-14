<?php

namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



class PostCtr extends BaseCtr{
  
  public function __invoke(Request $request, Response $response, array $args) {
    $post = new \App\Models\Post();
    $post = $post->getBySlug($args['slug']);
    if (empty($post)){
      $body = $this->view->render('404.twig');
      $response->getBody()->write($body);
      return $response->withStatus(404);;
    }        
    else {
      $body = $this->view->render('post.twig', ['post' => $post]);
      $response->getBody()->write($body);
      return $response;
    }
  }

}