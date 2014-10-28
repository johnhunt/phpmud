<?php

use Utility\InputParser;

require './vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

$socket = new \React\Socket\Server($loop);
$socket->listen(10000, '0.0.0.0');

$userCount = 0;

$inputParser = new InputParser();


$socket->on('connection', function(\React\Socket\Connection $conn) use ($dnsResolver, &$userCount) {

    $conn->write('Welcome. Type ? or help for help.' . PHP_EOL);

    // New connection is made
	$userCount++;
    $buffer = '';

    // Incoming data
    $conn->on('data', function($data, $conn) use ($dnsResolver, &$buffer, &$userCount) {

        // Add the data to the buffer
        $buffer .= $data;

        // Detect EOL
        if (strpos($buffer, PHP_EOL) !== false) {

            // Line entered, tokenise it
            $tokens = explode(' ', trim($buffer));


            if ($tokens[0] == 'usercount') {
                $conn->write('Users: ' . $userCount . PHP_EOL);

            }
            // Clear buffer ready for next command
            $buffer = '';
        }
    });

});

$loop->run();
