<?php

# Classes go into the /src/Classes directory; follow link below for more details (based upon our composer.json file)
# @see https://getcomposer.org/doc/04-schema.md#psr-4

# 1. Run 'php composer.phar install' to pull down our copy of the composer.json contents and have it run ok.
# 2. Fill out the methods within /src/Classes for the pre-made classes i've made for you
# 3. Add 5 more custom armor classes that extend the 'Armor' abstract class.
# 4. Print out every single one of them within this script. Example, "Bronze: 1". So show the name of the class & what the defence level is that is required.

include 'vendor/autoload.php';

use App\Classes\Bronze;
use App\Classes\Bandos;
use App\Classes\Mithril;
use App\Classes\Dragon;
use App\Classes\Adamant;
use App\Classes\barrows;
use App\Classes\justiciar;
use App\Classes\Iron;
use App\Classes\Rune;

# example of bronze
$bronze = new Bronze();
dump($bronze->getDefenceLevel() . " defense level for Bronze Armor");

echo "\n";

$bandos = new Bandos();
echo "Bandos defense level: " . $bandos->getDefenceLevel();

echo "\n";

$dragon = new Dragon();
echo "dragon defense level: " . $dragon->getDefenceLevel();

echo "\n";

$mithril = new mithril();
echo "Mithril defense level: " . $mithril->getDefenceLevel();

echo "\n";

$adamant = new Adamant();
echo "Adamant defense level: " . $adamant->getDefenceLevel();

echo "\n";

$barrows = new barrows();
echo "Barrows defense level: " . $barrows->getDefenceLevel();

echo "\n";

$justicair = new justiciar();
echo "Justicair defense level: " . $justicair->getDefenceLevel();

echo "\n";

$iron = new Iron();
echo "Iron defense level: " . $iron->getDefenceLevel();

echo "\n";

$rune = new Rune();
echo "Rune defense level: " . $rune->getDefenceLevel();