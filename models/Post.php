<?php

require "User.php";
require "PostCategory.php";

class Post {
    
    //ATTRIBUTES
    private ?int $id;
    private string $title;
    private string $content;
    private User $author;
    private PostCategory $category;
    
    //CONSTRUCTOR
    public function __construct(string $title, string $content, User $author, PostCategory $category)
    {
        $this->id = null;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->category = $category;
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
    
    //TITLE
    public function  getTitle() : string
    {
        return $this->title;
    }
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
    
    //CONTENT
    public function  getContent() : string
    {
        return $this->content;
    }
    public function setContent(string $content)
    {
        $this->content = $content;
    }
    
    //AUTHOR
    public function  getAuthor() : User
    {
        return $this->author;
    }
    public function setAuthor(User $author)
    {
        $this->author = $author;
    }
    
    //CATEGORY
    public function  getCategory() : PostCategory
    {
        return $this->category;
    }
    public function setCategory(PostCategory $category)
    {
        $this->category = $category;
    }
}

?>