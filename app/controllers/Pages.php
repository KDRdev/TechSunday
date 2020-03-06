<?php

class Pages extends Controller{
  public function __construct(){

  }
  public function index(){
    if(isLoggedIn()){
      redirect('posts');
    }
    $data = [
      'title' => 'TechSunday'
    ];
    $this->view('pages/index', $data);
  }
}
