<?php
include_once('model/story.php');
include_once('word_examples.php');
$story = null;
if (isset($_GET['story'])) {
    $story = Story::get_by_urlname($_GET['story']);
}
?>

<h2> <?= $story->safename(); ?></h2>
<span id="author">by <?= $story->author ?></span>
<form method="GET" action="/result.php">
<ul class="entrylist">
        <?php
        $words = $story->get_words();
        $used_types = Array();
        for ($i = 0; $i < count($words); $i++) {

            $eg = null;
            $w = null;
            if (strpos($words[$i], "|")) {
                $exp = explode("|", $words[$i]);
                $w = htmlentities(trim($exp[0]));
                $eg = htmlentities(trim($exp[1]));
            }
            else {
                $w = htmlentities($words[$i]);
            }

            echo "<li><label for=\"w$i\" class=\"entrylabel\">$w</label> <input id=\"w$i\" type=\"text\" name=\"words[]\" />";
            if (!isset($used_types[$w]) && $eg == null) {
                $eg = example_word($words[$i]);
                $used_types[$w] = true;
            }
            if ($eg) {
                echo " <span class=\"eg\">e.g. <span>$eg</span></span>";
            }
            echo "</li>";
        }
        ?>
</ul>
    <input type="hidden" name="story" value="<?= $story->get_url(); ?>" />
    <input type="submit" value="Submit" />
</form>
