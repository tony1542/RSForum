 # Using our database connection class
- Make sure your MySQL is running locally, (open XAMPP control panel and making sure MySQL is running)
- Make sure you've run the `/database_seed.sql` file in the project root
- Run something like the following to use the database: 
```php
use App\Utils\Database;

$instance = Database::getInstance();
$statement = $instance->prepare('SELECT * FROM user');
$statement->execute();

dump($statement->fetchAll(PDO::FETCH_ASSOC));
```
