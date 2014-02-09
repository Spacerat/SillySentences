
<?php
include_once('model/story.php');
include_once('common.php');
db::get_connection();

head();
try {
    $story = Story::get_by_urlname($_GET['story']);
    if (!isset($_GET['words'])) {
        //error
        die("Null words");
    }

    ?>
    <h2> <?= $story->safename(); ?> </h2>
    <span id="author">by <?= $story->author ?></span>
    <div id="result">
        <?= $story->sub_words($_GET['words']) ?>
    </div>
    <br /> <br />
    <div> <span class="delete">Delete game</span><form method="POST" action="delete.php">
            <input type="passowrd" value="" name="password" />
            <input name ="story" type="hidden" value="<?= $story->get_url(); ?>" />
            <input type="submit" value="Delete" />
        </form>
    </div>

<?php
}
catch (StoryException $e) {
    errorout($e);
}

foot();
?>