<?php

session_start();

require "logic/router.php";
require "models/Post.php";
require "logic/database.php";

if (isset($_GET['route']))
{
    checkRoute($_GET['route']);
}
else
{
    checkRoute("");
}

?>