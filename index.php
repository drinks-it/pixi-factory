<?php

require_once 'vendor/autoload.php';

use Pixi\AppsFactory\Factory;

$uri = "https://your.endpoint";
$username = "username";
$password = "password";

Factory::addOption('customer-soap', new Pixi\API\Soap\Options($username, $password, $uri));

$client = Factory::createObject('\Pixi\API\Soap\Client', 'customer-soap', 'customer-soap-client');

print_r($client);

print_r($client->pixiGetOrderline(array('RowCount' => 1))->getResultset());
print_r($client->pixiGetOrderline()->getResultset());
