<?php
include_once('common.php');
db::get_connection();
head();
$_GET['story'] = 'Example';
?>
<h2> Welcome</h2>
<p>Silly Sentences is an online version of Mad-libs which lets you post and play
with your friends without restriction. Try out some of the games people have posted
on the left, or <a href="/create.php">make your own!</a></p>

<?php
include_once('playform.php');
foot();

?>