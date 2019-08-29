<?php

# Classes go into the /src/Classes directory; follow link below for more details (based upon our composer.json file)
# @see https://getcomposer.org/doc/04-schema.md#psr-4

# 1. Run 'php composer.phar install' to pull down our copy of the composer.json contents and have it run ok.
# 2. Fill out the methods within /src/Classes for the pre-made classes i've made for you
# 3. Add 5 more custom armor classes that extend the 'Armor' abstract class.
# 4. Print out every single one of them within this script. Example, "Bronze: 1". So show the name of the class & what the defence level is that is required.

include 'vendor/autoload.php';

$bronze = new \App\Classes\Bronze();
dump($bronze->getDefenceLevel());