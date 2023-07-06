<?php

$host = "db.3wa.io";
$port = "3306";
$dbname = "laurelineagabibrac_site_admin";
$connexionString = "mysql:host=$host;port=$port;dbname=$dbname";

$user = "laurelineagabibrac";
$password = "c8b4d35a0077655c5f327ec2af4c0eac";

$db = new PDO(
    $connexionString,
    $user,
    $password
    );
  
 
function loadUser(string $email, string $password, PDO $db) : User
{
    $query = $db->prepare(
        "SELECT * FROM users WHERE users.email = :email;");
    $parameters = ['email' => $email];
    $query->execute($parameters);
    $fetch = $query->fetch(PDO::FETCH_ASSOC);
    if (password_verify($password, $fetch['password']))
    {
        $user = new User($fetch['first_name'], $fetch['last_name'], $fetch['email'], $password);
        $user->setId($fetch['id']);
        return $user;
    }
}

function saveUser(User $user, PDO $db) : User
{
    $query = $db->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password);" );
    $parameters = [
        'first_name' => $user->getFirstName(),
        'last_name' => $user->getLastName(),
        'email' => $user->getEmail(),
        'password' => $user->getPassword()
    ];
    $query->execute($parameters);
    $query = $db->prepare(
        "SELECT * FROM users WHERE users.email = ?;");
        $query->execute([$user->getEmail()]);
    $fetch = $query->fetch(PDO::FETCH_ASSOC);
    $user->setId($fetch['id']);
    return $user;
}

function getPostsByUser (User $user, PDO $db) : array
{
    $query = $db->prepare("SELECT * FROM posts WHERE posts.author = :userId");
    $parameters = ['userId' => $user->getId()];
    $query->execute($parameters);
    $posts = $query->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function getAllCategories(PDO $db) : array
{
    $query = $db->prepare("SELECT * FROM post_categories");
    $query->execute();
    $categories = $query->fetchAll(PDO::FETCH_ASSOC);
    return $categories;
}

function getCategoriesByUser (User $user, PDO $db) : array
{
    $query = $db->prepare("SELECT category FROM posts WHERE posts.author = :userId");
    $parameters = ['userId' => $user->getId()];
    $query->execute($parameters);
    $postCategories = $query->fetchAll(PDO::FETCH_ASSOC);
    $categories = [];
    foreach($postCategories as $category)
    {
        if (!array_search($category, $categories))
        {
            array_push($categories, $category);
        }
    }
    return $categories;
}

function createCategory(string $name, string $description, PDO $db) : PostCategory
{
    $query = $db->prepare("INSERT INTO post_categories (name, description) values (:name, :description)");
    $parameters =
    [
        'name' => $name,
        'description' => $description
    ];
    $query->execute($parameters);
    $query = $db->prepare("SELECT * FROM post_categories WHERE post_categories.name = ?");
    $query->execute([$name]);
    $fetch = $query->fetch(PDO::FETCH_ASSOC);
    $cat = new PostCategory($name, $description);
    $cat->setId($fetch['id']);
    return $cat;
}

function editCategory(int $id, string $name, string $description, PDO $db) : void
{
    $query = $db->prepare("UPDATE post_categories SET name = :name, description = :description WHERE post_categories.id = :id");
    $parameters =
    [
        'name' => $name,
        'description' => $description,
        'id' => $id
    ];
    $query->execute($parameters);
}


//CREER UNE CATEGORIE A PARTIR D'UN ID
function getCategoryById(int $id, PDO $db) : PostCategory
{
    $query = $db->prepare("SELECT * FROM post_categories WHERE post_categories.id = ?");
    $query->execute([$id]);
    $fetch = $query->fetch(PDO::FETCH_ASSOC);
    $category = new PostCategory($fetch['name'], $fetch['description']);
    return $category;
}

//CREER UN NOUVEAU POST
function createPost(User $user, string $title, string $content, int $cat, PDO $db) : void
{
    $query = $db->prepare("INSERT INTO posts (title, content, author, category) values (:title, :content, :author, :category)");
    $parameters =
    [
        'title' => $title,
        'content' => $content,
        'author' => $user->getId(),
        'category' => $cat
    ];
    $query->execute($parameters);
    $query = $db->prepare("SELECT * FROM posts WHERE posts.title = ?");
    $query->execute([$title]);
    $fetch = $query->fetch(PDO::FETCH_ASSOC);
    $category = getCategoryById($cat, $db);
    $post = new Post($fetch['title'], $fetch['content'], $user, $category);
    $post->setId($fetch['id']);
    $user->addPost($post);
    $category->addPost($post);
}
  
?>