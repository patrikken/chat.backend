<?php

use Phalcon\Mvc\Micro;

$router = $di->getRouter();

$app = new Micro();

// Define your routes here
$usersCollection = new \Phalcon\Mvc\Micro\Collection();
$usersCollection->setHandler('\App\Controllers\UserController', true);
$usersCollection->setPrefix('/user');
$usersCollection->post('/add', 'addAction');
$usersCollection->get('/list', 'getUserListAction');
$usersCollection->put('/{userId:[1-9][0-9]*}', 'updateUserAction');
$usersCollection->delete('/{userId:[1-9][0-9]*}', 'deleteUserAction');

$msgCollection = new \Phalcon\Mvc\Micro\Collection();
$msgCollection->setHandler('\App\Controllers\MessageController', true);
$msgCollection->setPrefix('/chat');
$msgCollection->post('/send', 'sendMessageAction'); 


$app->mount($usersCollection);
$app->mount($msgCollection);
// not found URLs
$app->notFound(
  function () use ($app) {
      $exception =
        new \App\Controllers\HttpExceptions\Http404Exception(
          _('URI not found or error in request.'),
          \App\Controllers\AbstractController::ERROR_NOT_FOUND,
          new \Exception('URI not found: ' . $app->request->getMethod() . ' ' . $app->request->getURI())
        );
      throw $exception;
  }
);

$router->handle();
