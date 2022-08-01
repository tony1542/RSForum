<?php

/**
 * Script iterates 10 times and enters in dummy user data
 */

use App\Utils\Database\EnvException;

require('vendor/autoload.php');

try {
    setApplicationVariables();
} catch (EnvException $e) {
    die('Error initializing application');
}

$faker = Faker\Factory::create();
$database = getDatabase();

for ($i = 0; $i < 10; $i++) {
    $sql = $database->prepare('INSERT INTO user SET username = ?, email_address = ?, password = ?');
    $sql->execute([
        $faker->firstName,
        $faker->email,
        password_hash($faker->password, PASSWORD_DEFAULT)
    ]);
}
