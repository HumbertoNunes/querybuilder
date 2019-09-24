# QueryBuilder

#### Before start, make sure you did those steps:

* Config the Connection.php file;
* Create the database and tables of your desire;
* Make sure that your classes name have a singular form and the tables the plural form, e.g. Product class will search for products table, Category for categories... (the function that pluralize nouns it's very simple, so it may fail in some especial cases.)

## Usage

#### Include autoload, import the QueryBuilder class and create a class that extends it

```php
<?php
require 'vendor/autoload.php';

use Passionate\Practitioner\QueryBuilder;

// Create some classes and set the attributes that you want to be persisted on this fillable variable

class Product extends QueryBuilder { protected $fillable = ['name', 'price']; }
class Category extends QueryBuilder { protected $fillable = ['name']; }
```

#### There are five methods to use (save/all/find/update/delete)

#### Save - Persist a new object
```php
$product = new Product();
$category = new Category();

$product->save(['name' => 'PHP for Beginners', 'price' => 59.90]);
$product->save(['name' => 'Laravel', 'price' => 79.90]);
$product->save(['name' => 'Become a PHP Ninja', 'price' => 99.90]);

$category->save(['name' => 'books']);
$category->save(['name' => 'eletronics']);
```

#### All - Fetching all
```php
$categories = Category::all();

foreach($categories as $category) {
	echo 'id: ' . $category->id . ' | name: ' . $category->name . PHP_EOL;
}

$products = Product::all();

foreach ($products as $product) {
	echo 'name: ' . $product->name . ' | price: ' . $product->price . PHP_EOL;
}
```

#### Find - Fetching a specific object
```php
$product = Product::find(2);
$category = Category::find(2);

echo 'id: ' . $category->id . ' | Name: ' . $category->name . PHP_EOL;
echo 'id: ' . $product->id . ' | Name: ' . $product->name . PHP_EOL;
```

#### Update
```php
$product = Product::find(1);

$product->update([
	'name' => 'Become a PHP Ninja',
    'price' => 79.99
]);
```

#### Delete
```php
$product = Product::find(1);

$product->delete();
```