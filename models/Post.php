<?php

namespace App\Models;
use PDO;
use PDOException;


class Post {

    public $connection;

    public function __construct()
    {

        try {
            $connection = new PDO('mysql:dbname=slim4-simple-blog;host=localhost', 'phpmyadmin', 'qwas');
        } catch (PDOException $exception) {
            echo 'Database error: ' . $exception->getMessage();
            die();
        }
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->connection = $connection;
    }

    public function getList(): ?array
    {
        $statement = $this->connection->prepare('SELECT * FROM post ORDER BY published_date DESC');
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getBySlug(string $slug): ?array
    {
        $statement = $this->connection->prepare('SELECT * FROM post WHERE slug = :slug');
        $statement->execute([
            'slug' => $slug
        ]);

        $result = $statement->fetchAll();

        return array_shift($result);
    }
}