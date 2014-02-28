<?php
require_once('bootstrap.php');

// User
$klein->with('/?', 'controllers/user.php');
// Work on tags
$klein->with('/?', 'controllers/tags.php');
// Gallery
$klein->with('/?', 'controllers/default.php');
// Like
$klein->with('/like', 'controllers/like.php');

$klein->dispatch();
