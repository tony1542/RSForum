 # Using our database connection class
- Make sure your MySQL is running locally, (open XAMPP control panel and making sure MySQL is running)
- Make sure you've run the `/database_seed.sql` file in the project root
- Run something like the following to use the database: 
```php
// Note, this line could change if we ever update the location of our database class; a good rule of thumb is start typing 'use Connection' and let the intellisense locate it for you
use App\Utils\Database\Connection;

$instance = getDatabase();
$statement = $instance->prepare('SELECT * FROM user');
$statement->execute();

dump($statement->fetchAll(PDO::FETCH_ASSOC));
```

# Using a parametized query with our connection class
```php
// Note, this line could change if we ever update the location of our database class; a good rule of thumb is start typing 'use Connection' and let the intellisense locate it for you
use App\Utils\Database\Connection;

// get database instance
$instance = getDatabase();

// our statement with a parameter for the user_id (note the ? mark)
$statement = $instance->prepare('SELECT * FROM user WHERE user_id = ?');

// calling execute and passing in an array of values to bind with however many ? marks we have
$statement->execute([1]);

// printing out our result set
dd($statement->fetchAll(PDO::FETCH_ASSOC));
