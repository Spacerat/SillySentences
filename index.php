<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

include_once('common.php');
head();
$_GET['story'] = 'Example';
?>
<h2> Welcome</h2>
<p>Silly Sentences is an online version of Mad-libs which lets you post and play
with your friends without restriction. Try out some of the games people have posted
on the left, or <a href="/create.php">make your own!</a></p>

<?php
include('playform.php');
foot();

?>