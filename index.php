<?php

# Classes go into the /src/Classes directory; follow link below for more details (based upon our composer.json file)
# @see https://getcomposer.org/doc/04-schema.md#psr-4

# 1. Run 'php composer.phar install' to pull down our copy of the composer.json contents and have it run ok.
# 2. Create another directory under /classes/equipment/weapons/ like i did with Daggers
# 3. Create another base class like Dagger.php but use a different weapon type, scimitar, sword, spear etc.
# 4. Create at least 3 sub-classes of this new base weapon class you've created
# 5. print them out below like i did with the bronze dagger

include 'vendor/autoload.php';

use App\Classes\Equipment\Weapons\Daggers\BronzeDagger;

$bronzeDagger = new BronzeDagger();
echo $bronzeDagger->levelRequirement();
