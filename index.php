<?php 

    // start session
    session_start();

    // require the functions file
    require "includes/functions.php";

    // figure out which path the user is on
    $path = $_SERVER["REQUEST_URI"];
    // remove all the query string from the url
    $path = parse_url( $path, PHP_URL_PATH );

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
      case "/post":
        require "pages/post.php";
        break;
      case "/dashboard":
        require "pages/dashboard.php";
        break;
      case "/manage-users":
        require "pages/manage-users.php";
        break;
      case "/manage-users-add":
        require "pages/manage-users-add.php";
        break;
      case "/manage-users-edit":
        require "pages/manage-users-edit.php";
        break;
      case "/manage-users-changepwd":
        require "pages/manage-users-changepwd.php";
        break;
      case "/manage-posts":
        require "pages/manage-posts.php";
        break;
      case "/manage-posts-add":
        require "pages/manage-posts-add.php";
        break;
      case "/manage-posts-edit":
        require "pages/manage-posts-edit.php";
        break;
        
      // actions routes
      case '/auth/login':
        require "includes/auth/do_login.php";
        break;
      case '/auth/signup':
        require "includes/auth/do_signup.php";
        break;
      // setup the action route for add user
      case '/user/add':
        require "includes/user/add.php";
        break;
      case '/user/update':
        require "includes/user/update.php";
        break;
      case '/user/changepwd':
        require "includes/user/changepwd.php";
        break;
      // setup the action for delete user
      case '/user/delete':
        require "includes/user/delete.php";
        break;
      // setup the action for delete post
      case '/post/delete':
        require "includes/post/delete_post.php";
        break;
      case '/post/add':
        require "includes/post/add_post.php";
        break;
      case '/post/edit':
        require "includes/post/edit_post.php";
        break;
      default:
        require "pages/home.php";
        break;
    }
