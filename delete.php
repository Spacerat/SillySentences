<?php
include_once('model/story.php');
include_once('common.php');
db::get_connection();

head();

try {
    $story = Story::get_by_urlname($_POST['story']);
    $story->delete($_POST['password']);
    ?>
    <h2><?=$story->safename(); ?> has been deleted</h2>
    <p> Below is the code of the story you have deleted </p>
    <pre><?= $story->content ; ?></pre>
    <a href="javascript:javascript:history.go(-1);">Go back</a>

    <?php
}
catch (StoryException $e) {
    errorout($e);
}

foot(); ?>