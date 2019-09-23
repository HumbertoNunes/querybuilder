# QueryBuilder

### Before start, make sure you did those steps:

* Config the Connection.php file;
* Create the database and tables of your desire;
* Make sure that your classes name have a Singular form and the tables the plural form, e.g. Product class will search for products table, Category for categories... (the function that pluralize nouns it's very simple, so it may fail in some especial cases.)

## Usage

### Include autoload, import the QueryBuilder class and create a class that extends it

```php
<?php
require 'vendor/autoload.php';

use Passionate\Practitioner\QueryBuilder;

class Product extends QueryBuilder

// You need to set the attributes that you want to be persisted on this fillable variable
protected $fillable = [];
```

#### There are five methods to use (all/find/save/update/delete)

```php

// Fetching all products

$products = Product::all();

foreach($products as $product) {
	echo 'Name: ' . $products->name . 'Price: ' . $product->price;
}

// Fetching a specific product
var_dump(Produto::find(2));

// Inserting a new product

$produto = new Product();

$produto->save([
    'name' => 'PHP for beginners',
    'price' => 39.90
]);

// Updating a Product

$product = Product::find(1);

$product->update([
	'name' => 'PHP for Web Developers',
    'price' => 54.99
]);

// Deleting a Product

$product = Product::find(1);

$product->delete();