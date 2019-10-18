In our `/src/helpers.php`, we have some globally-accessible functions that should be used to help you debug.

- `dump()`, this function will take in any variable as the first parameter (_string, int, float, a class, etc._) and whether or not you want a verbose description of it as the second paramter (_this second parameter is optional and set to `false` by default_)
- `dd()`, this function is idential to `dump()` with the only difference being, that after execution of `dd()`, it will kill execution of the script. `dd()` stands for dump and die.

Example code:
```php
// Look at these examples, the first one will simply output the string, the second one gives more information about the string
dump('this is a test string');
dump('this is a test string', 1);

// Look at this example to have it output the array simply, and then verbosely
$test_array = [1, 'second_key', 2, 'pineapple'];
dump($test_array);
dump($test_array, 1);
