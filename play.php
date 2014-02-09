<?php

include_once('common.php');

head();

try {
    include_once('playform.php');
}
catch (StoryException $e) {
    errorout($e);
}

foot(); ?>