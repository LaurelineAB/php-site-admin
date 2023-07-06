<?php

require "logic/router.php";

if (isset($_GET['route']))
{
    checkRoute($_GET['route']);
}
else
{
    checkRoute("");
}

?>