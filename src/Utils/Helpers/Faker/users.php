<?php

require('vendor/autoload.php');

setApplicationVariables();

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
