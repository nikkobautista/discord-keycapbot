<?php

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\Factory;
use React\Http\Browser;

require __DIR__ . '/vendor/autoload.php';

$loop = Factory::create();

$browser = new Browser($loop);

$discord = new Discord([
    'token' => '',
    'loop' => $loop,
]);

$discord->on('message', function (Message $message, Discord $discord) use ($browser) {
    $content = $message->content;
    if (strpos($content, '!gmk') === 0) {
        $set = explode(' ', $content);
        $set = $set[1];
        $browser->get('https://matrixzj.github.io/docs/gmk-keycaps')->then(function (Psr\Http\Message\ResponseInterface $response) use ($message) {
            var_dump($response->getHeaders(), (string)$response->getBody());
        });

    }
});

$discord->run();
