<?php


require "models/Post.php";

session_start();

require "logic/database.php";


$_SESSION['categories'] = getAllCategories($db);
$_SESSION['posts'] = getAllPosts($db);

//INSCRIPTION
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

//CONNEXION
if(isset($_POST['submit-login']))
{
    $login = $_POST['login'];
    $password = $_POST['password'];
    $user = loadUser($login, $password, $db);
    $_SESSION['user'] = $user;
    $posts = getPostsByUser($_SESSION['user'], $db);
    $_SESSION['user']->setPosts($posts);
    $_SESSION['user-categories'] = getCategoriesByUser($_SESSION['user'], $db);
}

//CREER UNE NOUVELLE CATEGORIE
if(isset($_POST['submit-new-cat']))
{
    $name = $_POST['name'];
    $description = $_POST['description'];
    $newCat = createCategory($name, $description, $db);
}

//MODIFIER UNE CATEGORIE
if(isset($_POST['submit-edit-cat']))
{
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id = $_POST['id'];
    editCategory($id, $name, $description, $db);
}

//CREER UN NOUVEAU POST
if (isset($_POST['submit-new-post']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];
    $cat = $_POST['category'];
    createPost($_SESSION['user'], $title, $content, $cat, $db);
}

//MODIFIER UN POST
if(isset($_POST['submit-edit-post']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $id = $_POST['id'];
    editPost($id, $title, $content, $category, $db);
    $posts = getPostsByUser($_SESSION['user'], $db);
    $_SESSION['user']->setPosts($posts);
}

//DECONNEXION
if(isset($_POST['logout']))
{
    require "pages/admin/logout.php";
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