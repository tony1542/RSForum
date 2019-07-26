<?php

// Fill this array up with a random string with a length of 5, 10 times using a loop.
$random_array = [];

function genRanStr($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strLen($characters);
    $ranString = '';
    for ($i = 0; $i < $length; $i++){
        $ranString .= $characters[rand(0, $charLength - 1)];
    }
    return $ranString;

}

//echo genRanStr();

for ($i = 0; $i < 10; $i++) {
    $random_array[] = genRanStr();

}

echo "<pre>";
print_r($random_array);


//this took SOOOO LOOOONGGGG OMG I FINALLY GOT IT HOLY FUCK

# Looks good!












// Filter out all elements in this array that contain the letter 'e'.
// Do it once manually, and then do it a second time using a built-in PHP function.
$array_to_filter = [
    'Basic_key',
    'Advanced_key',
    'Master_key',
    'Dog'
];



//This is my manual attempt but I still use the array_filter, so I guess it isn't manual.
# Correct, this isn't manual yet. I'll give you a hint: loop through the array by hand and use `unset()` on elements that you want to obliterate.

function leFilter($string){

    return strpos($string, 'e') === false;
}
$newArray_to_filter = array_filter($array_to_filter, 'leFilter');
print_r($newArray_to_filter);








//PHP Function
# I like the use of the anonymous function here instead of passing 'leFilter' again. Shows that you did it with a PHP function 2 different ways.
# Anonymous functions are mid-to-high level concepts, but I really like them. They are used a lot in high-level javascript too.
print_r(array_filter($array_to_filter, function ($var) { return (stripos($var, 'e') === false); }));






// Combine the following 2 arrays once manually, and then once using a built-in PHP function.
// Once they are combined, print out ONLY the values that are above 2000.


$array_of_total_levels = [
    'Zezima'        => 2277,
    'Noob_slayer13' => 1588,
    'Mediocre_moo'  => 1182,
    'Garbage_fire'  => 884
];

$array_of_total_levels2 = [
    'player82' => 481,
    'B0aty'    => 2276,
    'Schlitz'  => 2270,
    'tony_x'   => 1111
];
//Manual merging, son.
$StonkMains = $array_of_total_levels + $array_of_total_levels2;

# Looks good! Isn't it fucking weird you can just use `+` on two arrays in PHP?

function filterArray($value){
    return ($value > 2000);
}

# Nice usage of array_filter here. Nice and clean.
$filteredArray = array_filter($StonkMains, 'filterArray');

//foreach($filteredArray as $k => $v){
//    echo " $k = $v, ";
//}






//Built-in PHP Function merging, son.
$StackedMain = array_merge($array_of_total_levels,$array_of_total_levels2);

function maxAcc($max_values)
{
    if ($max_values > 2000)
    {
        return true;
    }
    return false;
}
print_r(array_filter($StackedMain, "maxAcc"));


echo "</pre>";

?>


