<?php
class Post{
private $db;

public function __construct(){
  $this->db = new Database;
}

public function getPosts(){
  $this->db->query('SELECT *,
                posts.id as postId,
                users.id as userId
                FROM posts
                INNER JOIN users
                ON posts.user_id = users.id
                ORDER BY posts.created_at DESC
                ');
  return $this->db->resultSet();
}

public function getPostById($id){
  $this->db->query('SELECT * FROM posts WHERE id = :id');
  $this->db->bind(':id', $id);
  $row = $this->db->single();
  return $row;
}

public function addPost($data){
  $this->db->query('INSERT INTO posts (title, user_id, body) VALUES (:title, :user_id, :body)');
  $this->db->bind(':title', $data['title']);
  $this->db->bind(':user_id', $data['user_id']);
  $this->db->bind(':body', $data['body']);

  if($this->db->execute()){
    return true;
  } else {
    return false;
  }
}

public function editPost($data){
  $this->db->query('UPDATE posts SET
                      title = :title,
                      body = :body
                    WHERE id = :id
                    ');
  $this->db->bind(':id', $data['id']);
  $this->db->bind(':title', $data['title']);
  $this->db->bind(':body', $data['body']);

  if($this->db->execute()){
    return true;
  } else {
    return false;
  }
}

public function deletePost($id){
  $this->db->query('DELETE FROM posts WHERE id = :id');
  $this->db->bind(':id', $id);

  if($this->db->execute()){
    return true;
  } else {
    return false;
  }
}
}
