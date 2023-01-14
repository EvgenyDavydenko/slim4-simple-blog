<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

require __DIR__ . '/../vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);

try {
    $connection = new PDO('mysql:dbname=slim4-simple-blog;host=localhost', 'phpmyadmin', 'qwas');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo 'Database error: ' . $exception->getMessage();
    die();
}

// Instantiate app
$app = AppFactory::create();

// Add Error Handling Middleware
$app->addErrorMiddleware(true, false, false);

// Add route callbacks
$app->get('/', function (Request $request, Response $response, array $args) use ($twig, $connection) {
    $statement = $connection->prepare('SELECT * FROM post ORDER BY published_date DESC');
    $statement->execute();
    $posts = $statement->fetchAll();
    $body = $twig->render('home.twig', ['posts' => $posts]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/{slug}', function (Request $request, Response $response, array $args) use ($twig, $connection) {
    $statement = $connection->prepare('SELECT * FROM post WHERE slug = :slug');
    $statement->execute(['slug' => $args['slug']]);
    $post = array_shift($statement->fetchAll());
    if (empty($post)){
        $body = $twig->render('404.twig');
        $response->getBody()->write($body);
        return $response->withStatus(404);;
    }        
    else {
        $body = $twig->render('post.twig', ['post' => $post]);
        $response->getBody()->write($body);
        return $response;
    }
        
});

// Run application
$app->run();
