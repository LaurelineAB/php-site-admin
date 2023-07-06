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
  
 
function loadUser(string $email, PDO $db) : User
{
    $query = $db->prepare(
        "SELECT * FROM users WHERE users.email = :email;");
    $parameters = ['email' => $email];
    $query->execute($parameters);
    $fetch = $query->fetch(PDO::FETCH_ASSOC);
    $user = new User($fetch['first_name'], $fetch['last_name'], $fetch['email'], $fetch['password']);
    $user->setId($fetch['id']);
    return $user;
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
  
?>