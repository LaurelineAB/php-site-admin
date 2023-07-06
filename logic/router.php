<?php

function checkRoute(string $route) : void
{
    if ($route === "connexion")
    {
        require "pages/login.php";
    }
    if ($route === "creer-un-compte")
    {
        require "pages/register.php";
    }
    if ($route === "admin-posts" && isset($_SESSION['user']))
    {
        require "pages/admin/post.php";
    }
    if ($route === "admin-categories" && isset($_SESSION['user']))
    {
        require "pages/admin/post-category.php";
    }
    else
    {
        require "pages/homepage.php";
    }
}

?>