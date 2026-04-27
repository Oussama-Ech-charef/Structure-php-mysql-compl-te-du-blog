<?php

// create a class named article 
class Article {
    private $conn;


    public function __construct($db) {
        $this->conn = $db;
    }

    // Get the latest 5 posts for the home page
    public function getHomePosts() {
        $query = "SELECT p.*, c.name AS cat_name
                  FROM posts p
                  JOIN categories c ON p.category_id = c.id
                  WHERE p.status = 'published'
                  ORDER BY p.created_at DESC
                  LIMIT 5";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get all published posts for the explore page
    public function readAll() {
        $query = "SELECT p.*, c.name AS cat_name
                  FROM posts p
                  JOIN categories c ON p.category_id = c.id
                  WHERE p.status = 'published'
                  ORDER BY p.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a single post by its ID
    public function getById($id) {
        $query = "SELECT p.*, c.name AS cat_name
                  FROM posts p 
                  JOIN categories c ON p.category_id = c.id
                  WHERE p.id = :id AND p.status = 'published'
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get a single post by its ID for Admin (no status filter)
    public function getByIdAdmin($id) {
        $query = "SELECT * FROM posts WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // --- Admin Functions ---

    // 1. Get all posts for Admin (including drafts)
    public function getAllAdmin() {
        $query = "SELECT p.*, c.name AS cat_name 
                  FROM posts p 
                  JOIN categories c ON p.category_id = c.id 
                  ORDER BY p.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Delete a post
    public function delete($id) {
        $query = "DELETE FROM posts WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // 3. Create a new post
    public function create($title, $category_id, $image, $description, $content, $status) {
        $query = "INSERT INTO posts (title, category_id, image, description, content, status) 
                  VALUES (:title, :category_id, :image, :description, :content, :status)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':status', $status);
        
        return $stmt->execute();
    }

    // 4. Update an existing post
    public function update($id, $title, $category_id, $image, $description, $content, $status) {
        $query = "UPDATE posts 
                  SET title = :title, 
                      category_id = :category_id, 
                      image = :image, 
                      description = :description, 
                      content = :content, 
                      status = :status 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':status', $status);
        
        return $stmt->execute();
    }

    // --- Category Functions ---

    // Get all categories for dropdowns
    public function getAllCategories() {
        $query = "SELECT * FROM categories ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- User Functions ---

    // Fetch user by email for login
    public function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Check if email already exists
    public function emailExists($email) {
        $query = "SELECT id FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Register a new user
    public function createUser($name, $email, $password) {
        $query = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, 'user')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }
}