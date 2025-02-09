<?php

/*
 * App core class
 * Creates URL and loads core controller
 * URL format: /controller/method/params
 */

class Core{
  protected $currentController = "pages";
  protected $currentMethod = "index";
  protected $params = [];

  public function __construct(){
    $url = $this->getUrl();

    // Check if controller (first part of URL) exists
    if(file_exists(APPROOT . '/controllers/' . ucwords($url[0]) . '.php')){
      $this->currentController = ucwords($url[0]);
      unset($url[0]);
    }

    require_once APPROOT . '/controllers/' . $this->currentController . '.php';
    $this->currentController = new $this->currentController;

    if(isset($url[1])){

      // Check if method (second part of URL) exists
      if(method_exists($this->currentController, $url[1])){
        $this->currentMethod = $url[1];
        unset($url[1]);
      }
    }

    // Get params from URL
    $this->params = $url ? array_values($url) : [];

    // Call a callback with array of params
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  public function getUrl(){
    if(isset($_GET['url'])){
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }
}
