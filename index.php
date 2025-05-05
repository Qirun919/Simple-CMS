<?php
    session_start();
    
    // require the functions file
    require "includes/functions.php";
    /*
      Decide what page to load depending on the url the user visit

      localhost:9000/ -> home.php
      localhost:9000/login -> login.php
      localhost:9000/signup -> signup.php
      localhost:9000/logout -> logout.php
    */

    // global variable $_SERVER
    // figure out what path the user is visiting
    $path = $_SERVER["REQUEST_URI"];
  
    
    // once you figure out the path, then we need to load relevent content based on the path
    switch ($path) {
      // pages routes
      case '/login':
        require "pages/login.php";
        break;
      case '/signup':
        require "pages/signup.php";
        break;
      case '/logout':
        require "pages/logout.php";
        break;
      case '/dashboard':
        require "pages/dashboard.php";
        break;
      case '/manage-posts':
        require "pages/manage-posts.php";
        break;
      case '/post':
        require "pages/post.php";
        break;
      case '/manage-posts-add':
        require "pages/manage-posts-add.php";
        break;
      case '/manage-posts-edit':
        require "pages/manage-posts-edit.php";
        break;
      case '/manage-users':
        require "pages/manage-users.php";
        break;
      case '/manage-users-add':
        require "pages/manage-users-add.php";
        break;
      case '/manage-users-edit':
        require "pages/manage-users-edit.php";
        break;
      case '/manage-users-changepwd':
        require "pages/manage-users-changepwd.php";
        break;
      // actions routes
      case '/auth/login':
        require "includes/auth/do_login.php";
        break;
      case '/auth/signup':
        require "includes/auth/do_signup.php";
        break;
      case '/task/add':
        require "includes/tasks/additem.php";
        break;
      case '/task/update':
        require "includes/tasks/update.php";
        break;
      case '/task/delete':
        require "includes/tasks/delete.php";
        break;
        
      
      default:
        require "pages/home.php";
        break;
    }