<?php

class PostCategory {
    
    //ATTRIBUTES
    private ?int $id;
    private string $name;
    private string $description;
    private array $posts;
    
    //CONSTRUCTOR
    public function __construct(string $name, string $description)
    {
        $this->id = null;
        $this->name = $name;
        $this->description = $description;
        $this->posts = [];
    }
    
    //ID
    public function  getId() : int
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = $id;
    }
    
    //NAME
    public function  getName() : string
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    
    //DESCRIPTION
    public function  getDescription() : string
    {
        return $this->description;
    }
    public function setDescription(string $description)
    {
        $this->description = $description;
    }
    
    //POSTS
    public function  getPosts() : array
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
        return $this->posts;
    }
    
    public function removePost(Post $post) : array
    {
        $key = array_search($post,$this->posts);
        array_splice($this->posts, $key, 1);
        return $this->posts;
    }
}

?>