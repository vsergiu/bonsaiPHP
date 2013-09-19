<?php

require 'Bonsai/Bonsai.php';

$b = new Bonsai();

$b
	->map('/', function() {
		echo 'Hello world';die;
	})
	->map('/greet/:name', function($name) use ($b) {
		return $b->render('index', array(
			'name' => $name
		));
	});

$b->execute();
