<?php

// create a class named article 
class Article {
    private $conn;


    public function __construct($db) {
        $this->conn = $db;
    }

    // Get the latest 5 posts for the home page
    public function all() {
        $query = "SELECT p.*, c.name AS cat_name, c.slug AS cat_slug
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
        $query = "SELECT p.*, c.name AS cat_name, c.slug AS cat_slug
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
        $query = "SELECT p.*, c.name AS cat_name, c.slug AS cat_slug
                  FROM posts p 
                  JOIN categories c ON p.category_id = c.id
                  WHERE p.id = :id AND p.status = 'published'
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}