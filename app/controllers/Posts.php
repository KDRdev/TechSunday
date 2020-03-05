<?php

class Posts extends Controller{
  public function __construct(){
    $this->postModel = $this->model('Post');
  }
  public function index(){
    $posts = $this->postModel->getPosts();

    $data = [
      'posts' => $posts
    ];

    $this->view('posts/index', $data);
  }

  public function add(){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'title' => trim($_POST['title']),
        'body' => trim($_POST['body']),
        'user_id' => $_SESSION['user_id'],
        'title_err' => '',
        'body_err' => ''
      ];
      if(empty($data['title'])){
        $data['title_err'] = 'Cannot be empty';
      }
      if(empty($data['body'])){
        $data['body_err'] = 'Cannot be empty';
      }
      if(empty($data['title_err']) && empty($data['body_err'])){
        if ($this->postModel->addPost($data)) {
          flash('post_message', 'Posted!');
          redirect('posts');
        } else {
          die('Oops. Something went wrong');
        }
      } else {
        $this->view('posts/add', $data);
      }
    } else {
      $data = [
        'title' => '',
        'body' => ''
      ];
      $this->view('posts/add', $data);
    }
  }

  public function show($id){
    $post = $this->postModel->getPostById($id);
    $data = [
      'post' => $post
    ];
    $this->view('posts/show', $data);
  }

  public function delete($id){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if ($this->postModel->deletePost($id)){
        flash('post_message', 'Deleted!');
        redirect('posts');
      } else {
        die('Oops. Something went wrong');
      }
    } else {
      redirect('posts');
    }
  }
}
