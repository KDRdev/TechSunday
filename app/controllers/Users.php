<?php

  class Users extends Controller{
    public function __construct(){
      $this->userModel = $this->model('User');

    }
    public function register(){

      // Check for posts
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Process form

        // Sanitize post data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_error' => '',
          'email_error' => '',
          'password_error' => '',
          'confirm_password_error' => ''
        ];

        // Validate email
        if(empty($data['email'])){
          $data['email_error'] = 'Please enter email';
        } else {

          // Check email
          if($this->userModel->findUserByEmail($data['email'])){
            $data['email_error'] = 'Email already exists';
          }
        }

        // Validate name
        if(empty($data['name'])){
          $data['name_error'] = 'Please enter your name';
        }

        // Validate password
        if(empty($data['password'])){
          $data['password_error'] = 'Please confirm password';
        } elseif (strlen($data['password']) < 6) {
          $data['password_error'] = 'Password must be at least 6 characters';
        }

        // Validate Confirm password
        if(empty($data['confirm_password'])){
          $data['confirm_password_error'] = 'Please enter password';
        } elseif($data['password'] != $data['confirm_password']) {
          $data['confirm_password_error'] = 'Passwords do not match';
        }

        // Make sure errors are empty
        if (empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {

          // Hash passwrd
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register user
          if($this->userModel->register($data)){
            flash('register_success', 'You are now registered');
            redirect('users/login');
          } else {
            die('Something\'s wrong');
          }
        } else {

          // Load view with errors
          $this->view('users/register', $data);
        }

      } else {

        // Init data
        $data = [
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_error' => '',
          'email_error' => '',
          'password_error' => '',
          'confirm_password_error' => ''
        ];

        // Load view
        $this->view('users/register', $data);
      }
    }

    public function login(){

      // Check for posts
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Sanitize post data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_error' => '',
          'password_error' => ''
        ];

        // Validate email
        if(empty($data['email'])){
          $data['email_error'] = 'Please enter email';
        }

        // Validate pass
        if(empty($data['password'])){
          $data['password_error'] = 'Please enter password';
        }

        // Check for user email
        if ($this->userModel->findUserByEmail($data['email'])) {

          // User found
        } else {
          $data['email_error'] = 'No user found';
        }

        // Make sure errors are empty
        if (empty($data['email_error']) && empty($data['password_error'])) {

          // Validated

          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);

          if ($loggedInUser) {

            // Create session
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_error'] = 'Password entered incorrectly';
            $this->view('users/login', $data);
          }
        } else {

          // Load view with errors
          $this->view('users/login', $data);
        }

        // Process form
      } else {

        // Init data
        $data = [
          'email' => '',
          'password' => '',
          'email_error' => '',
          'password_error' => ''
        ];

        // Load view
        $this->view('users/login', $data);
      }
    }
    public function createUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      redirect('posts');
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      session_destroy();
      redirect('users/login');
    }
  }
