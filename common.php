<?php
include_once('model/story.php');


function head() { 
    db::get_connection();
    $stories = Story::get_all();
    ?>
<!DOCTYPE html>
<html>
    </head>
        <title>Silly Sentences</title>
        <link type="text/css" rel="stylesheet" href="/wordgame/styles.css" />
    </head>
    <body>
        
        <div id="cols"">
            <!---->
            <h1><a href="/wordgame/"><img class="banner" src="/wordgame/banner.png" alt="Silly Sentences" /></a></h1>
            <div id="leftbar">
                <div id="newgames">
                    <h3> Recent creations </h3>
                    <ul class="gamelist">
                        <?php foreach ($stories as $story) { ?>
                        <li> <a href="/wordgame/play/<?= $story->get_url(); ?>"><?= $story->safename(); ?></a> </li>
                        <?php } ?>
                    </ul>
                </div>
                <div><a href="/wordgame/create.php">Create your own</a></div>

            </div>
            <div id="mainbox"> 
<?php
}

function foot() { ?>

            </div>
        
        <div id="footer">
            Site design and code by Joseph Atkins-Turkish
        </div>
        </div>
    </body>
</html>

<?php }

function errorout($e, $title="Error") {
    ?>
    <h2><?=$title ?></h2>
    <p><?=$e->getMessage(); ?></p>
    <a href="javascript:javascript:history.go(-1);">Go back</a>
    <?php
} ?>