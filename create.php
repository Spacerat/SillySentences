<?php
include_once('common.php');
db::get_connection();
head();
?>
<h2> Game builder </h2>
<p> Write your story in the text box below. Any words inside [tags] will be
    replaced by users of your story, with the content inside used as a prompt (see
    <a href="/tags.php">this page</a> for more information about the tags). For example:
</p>
<q> One [adjective] [season | summer]'s day, [name] decided to [infinitive verb] her [noun] with her toilet.</q>
<form method="POST" action="/post.php">
    <textarea cols="30" rows="8" id="storytextarea" name="content" required placeholder="Write your [adjective] story here."></textarea> <br />
    <input type="text" name="name" id="nameinput" required /> <label for="nameinput"> Story name (must be unique, used for the URL) </label><br/>
    <input type="text" name="author" id="authorinput" value="Anonymous" required /> <label for="authorinput"> Your name/nickname </label><br/>
    <input type="submit" value="Post" target="_blank" />
    <input type="password" value="" id="passwordinput" name="password" /> <label for="passwordinput"> Password (optional, used for deleting the story later if you wish.) </label> <br />
</form>
<?php
foot();
?>