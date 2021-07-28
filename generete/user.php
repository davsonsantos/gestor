<?php

require __DIR__."/../vendor/autoload.php";

use Source\Models\Admin\User;

$userFaker = Faker\Factory::create();

for ($i = 0; $i < 30; $i++)
{
    $user = new User();
    $user->first_name = $userFaker->name;
    $user->last_name = $userFaker->name;
    $user->email = $userFaker->email;
    $user->password = password_hash($userFaker->text(8), PASSWORD_DEFAULT);
    $user->level = 1;
    $user->status = 'confirmed';
    // var_dump($post);
   $user->save();
}