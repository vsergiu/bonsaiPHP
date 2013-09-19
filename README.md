bonsaiPHP
=========

sinatra style micro framework for PHP

Usage:
=========

```php

$b = new Bonsai();

$b->map('/', function() {
	// do logic here
})

// register /home , /about , /greet pages

$b
	->map('/home', function() use ($b) {
		return $b->render('home');
	})
	->map('/about', function() use ($b) {
		return $b->render('about');
	})
	->map('/greet/:name', function($name) use ($b) {
		return $b->render('about', array(
			'name' => $name
		));
	})

```