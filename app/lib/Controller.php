<?php

// core controller class
// loads views and models

class Controller{

  // load model
  public function model($model){
    require_once '../app/models/' . $model . '.php';
    return new $model();
  }

  //load view
  public function view($view, $data = []){
    if(file_exists('../app/views/' . $view . '.php')){
      require_once '../app/views/' . $view . '.php';
    } else {
      echo 'View does not exist';
    }
  }
}
