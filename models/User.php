<?php

class User {
    
    //ATTRIBUTES
    private ?int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $password;
    private array $posts;
    
    //CONSTRUCTOR
    public function __construct(string $first_name, string $last_name, string $email, string $password)
    {
        $this->id = null;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->posts = [];
    }
    
    //ID
    public function getId() : int
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = $id;
    }
    
    //FIRST NAME
    public function getFirstName() : string
    {
        return $this->first_name;
    }
    public function setFirstName(string $first_name)
    {
        $this->first_name = $first_name;
    }
    
    //LAST NAME
    public function getLastName() : string
    {
        return $this->last_name;
    }
    public function setLastName(string $last_name)
    {
        $this->last_name = $last_name;
    }
    
    //EMAIL
    public function getEmail() : string
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    
    //PASSWORD
    public function getPassword() : string
    {
        return $this->password;
    }
    public function setPassword(string $password)
    {
        $this->password = $password;
    }
    
    //POSTS
    public function getPosts() : array
    {
        return $this->posts;
    }
    public function setPosts(array $posts)
    {
        $this->posts = $posts;
    }
    
    //METHODS
    public function addPost(Post $post) : array
    {
        array_push($this->posts, $post);
        return $posts;
    }
    
    public function removePost(Post $post) : array
    {
        $key = array_search($post,$this->posts);
        array_splice($this->posts, $key, 1);
        return $this->posts;
    }
}

?>