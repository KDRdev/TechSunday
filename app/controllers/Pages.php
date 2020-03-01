<?php

class Pages extends Controller{
  public function __construct(){

  }
  public function index(){
    $data = [
      'title' => 'TechSunday'
    ];
    $this->view('pages/index', $data);
  }
}
