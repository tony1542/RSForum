<?php

// Sort the following array in alphabetical order using an array function (look up PHP array functions if you don't know it off-hand)
$array_of_unsorted_words = [
    'Shovel',
    'Green',
    'Car',
    'Spatula',
    'Watering can',
    'Bandos'
];

//Sorting the array in alphabetical order
sort($array_of_unsorted_words);

$item = count($array_of_unsorted_words);
for($x = 0; $x < $item; $x++) {
    echo $array_of_unsorted_words[$x];
    echo "<br>";
}

//holy crap I struggled with that hard.







// Fill the following array with 5 different weapons and their requirements
// Make the level requirement the array key and the weapon name the value
$array_of_weapons_and_requirements = [
    // The "whip" is the
    70         => "Whip",
    40         => "Rune Scim",
    20         => "Black Scim",
    5          => "Iron Scim",
    1          => "Bronze Scim"
];


asort($array_of_weapons_and_requirements);
foreach($array_of_weapons_and_requirements as $x => $x_value) {
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br>";
}




// Print out the highest leveled player, then the lowest leveled player by accessing the array key directly
// Something like: $array[$key]
$array_of_total_levels = [
    'Zezima'        => 2277,
    'Noob_slayer13' => 1588,
    'Mediocre_moo'  => 1182,
    'Garbage_fire'  => 884
];
$max = max($array_of_total_levels);
$min = min($array_of_total_levels);

echo "Max value is $max <br/>";
echo "min value is $min <br/>";





// Write a foreach loop to iterate over the following array and print out its contents
$array_of_justice = [
    'Tony',
    'Raymond',
    'Susan',
    'Bob'
];

foreach($array_of_justice as $value){
    echo "$value <br/>";


}

// I used google for every one of these. For the first array I was just gonna echo the arrow like this:  sort($array_of_unsorted_words); echo "$array_of_unsorted_words";  rip mate.





