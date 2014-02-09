<?php

include_once('common.php');
$name = $_POST['name'];
$author = $_POST['author'];
$content = $_POST['content'];
$password = $_POST['password'];



try {
    if (!$name) {
        throw new NewStoryException("You must provide a story name.");
    }
    if (!$author) {
        throw new NewStoryException("You must provide an author name");
    }
    if  (!$content) {
        throw new NewStoryException("You cannot leave the content field blank.");
    }
    if (Story::get_by_name($name, false) != null) {
        throw new NewStoryException("A story with this name already exists.");
    }

    $result = Story::post_new($name, $content, $author, $password);
    $url = Story::name_to_url($name);

    head();
    ?>




    <h2> Post successful </h2>
    <p>See your new story <a href="/play.php?story=<?= $url ?>">here</a>.</p>
    <?php
}
catch (NewStoryException $e) {
    errorout($e, 'Post failed');
}



?>

<?php
foot();
?>