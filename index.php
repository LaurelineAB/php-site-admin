<?php

session_start();

require "models/Post.php";
require "logic/database.php";


if(isset($_POST['submit-register']))
{
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    if($_POST['password'] === $_POST['confirmPassword'])
    {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    else {
        echo "Vous devez saisir deux fois le même mot de passe.";
    }
    $user = new User($first_name, $last_name, $email, $password);
    saveUser($user, $db);
}

if(isset($_POST['submit-login']))
{
    $login = $_POST['login'];
    $password = $_POST['password'];
    $user = loadUser($login, $password, $db);
    $_SESSION['user'] = $user;
    $posts = getPostsByUser($_SESSION['user'], $db);
}

if(isset($_POST['submit-new-cat']))
{
    $name = $_POST['name'];
    $description = $_POST['description'];
    $newCat = createCategory($name, $description, $db);
}

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