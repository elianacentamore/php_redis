<?php

require "vendor/predis/predis/autoload.php";
Predis\Autoloader::register();


try {
    $client = new Predis\Client(['persistent' => true, 'read_write_timeout' => 0]);

    $client->pubSubLoop(['subscribe' => 'test-channel'], function ($l, $msg) {
        echo "$msg->payload on $msg->channel", PHP_EOL;
    });
} catch (Exception $e) {
    die($e->getMessage());
}
