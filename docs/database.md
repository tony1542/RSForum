 # Using our database connection class
- Make sure your MySQL is running locally, (open XAMPP control panel and making sure MySQL is running)
- Make sure you've run the `/database_seed.sql` file in the project root
- Run something like the following to use the database: 
```php
// Note, this line could change if we ever update the location of our database class; a good rule of thumb is start typing 'use Connection' and let the intellisense locate it for you
use App\Utils\Database\Connection;

$instance = Connection::getInstance();
$statement = $instance->prepare('SELECT * FROM user');
$statement->execute();

dump($statement->fetchAll(PDO::FETCH_ASSOC));
```
