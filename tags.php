<?php

include_once('common.php');
include_once('word_examples.php');
head();
?>

<h2> About tags </h2>
<h3> Custom word examples </h3>
<p> You can put anything you want inside of the prompt tags. You can also put example
    words in the tags separated by a | character. However, many tags such as [noun] or [place] have
    default examples words, which are capitalised automatically if you capitalise your tag.
    This is best illustrated with an example:</p>
<q> He looked at his [mount | horse, daemon] in despair. [Noun plural] perforated every inch of it.</q>
<ul class="entrylist">
    <li><span class="entrylabel">mount</span> <input type="text" disabled> <span class="eg">e.g. <span>horse, daemon</span></span></li>
    <li><span class="entrylabel">noun</span> <input type="text" disabled/> <span class="eg">e.g. <span>Peanuts, Sheep</span></span></li>
</ul>
<h3> List of default examples </h3>
<p> The tag names are flexible. For example, you could write "plural abstract noun",
    "abstract noun plural", "noun plural abstract", etc.</p>
<?php
    $words = Array("noun", "proper noun", "plural noun", "abstract noun",
        "plural abstract noun", "verb", "verb infinitive",  "verb inf.", "verb-ing",
        "verb gerund", "verb present", "thrid person verb", "verb past", "verb past simple",
        "verb past participle", "verb past perfect", "adjective", "adverb", "place",
        "country", "town", "name", "person", "number", "body part", "body part plural", "time", "colour");
    echo "<ul>";
    foreach ($words as $w) {
        $eg = example_word($w);
        echo "<li><span class=\"entrylabel\">$w</span> <span class=\"eg\"><span>$eg</span></span></li>";
    }
    echo "</ul>";

?>

<h2 id = "repeat"> Repeated words </h2>
<p> It is possible to have the player type a word which you then repeat multiple times throughout your
	story. Brackets at the start of a tag, e.g. <em>[<strong>(person A)</strong>Name]</em> create a tag
	which can be repeated. If you later on use the same brackets in a tag, e.g.<em>[<strong>(person A)</strong>]</em>,
	whatever was typed for that word previously will be reused in this place too. There are some issues with
	this though - especially when used with verbs.  This entire system is best illustrated with an example. </p>
<q> There was a [(1)occupation | fisherman] named [(2)Name | Fisher]<br />
who [(3)verb | fish]ed for some [(4)noun | fish] in a fissure. <br />
Till a [(4)] with a grin,<br />
pulled the [(1)] in.<br />
Now they're [(3)]ing the fissure for [(2)].</q>
<p>Here the user will only be asked to present a single <em>occupation</em>, <em>Name</em>, <em>verb</em>,
	and <em>noun</em>. They are then each reused twice. The problem should be pretty obvious: it doesn't work
	well with irregular words, especially verbs. If the player had typed <em>pay</em> for the verb, the output
	would include <em>payed</em> which is obviously incorrect. Singular/plural nouns will suffer too. However,
	intelligent use of this feature should still allow you a reasonable ammount of flexibility, and there's nothing
	stopping you from creating prompts such as "Regular Verb", or even "Plural of previous noun".</p>
	
<?
foot();
?>
