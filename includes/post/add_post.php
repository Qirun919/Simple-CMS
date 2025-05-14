<?php

    // 1. connect to database
    $database = connectToDB();


    // 2. get all the data from the form using $_POST
    $title = $_POST["title"];
    $content = $_POST["content"];
    $image = $_FILES["image"];

    /*
        3. error checking
        - make sure all the fields are not empty 
    */
    if (empty($title) || empty($content) ) {
        $_SESSION["error"] = "All fields are required";
        header("Location: /manage-posts-add");
        exit;
    }

    // trigger the file upload
    // make sure $image is not empty
    if ( !empty( $image ) ) {
        // where is the upload folder
        $target_folder = "uploads/";
        // add the image name to the upload folder path
        $target_path = $target_folder . basename( $image["name"] );
        // move the file to the uploads folder
        move_uploaded_file( $image["tmp_name"] , $target_path );
    }

    // create the post

    $sql = "INSERT INTO posts (`title`,`content`, `image`, `user_id`) VALUES (:title, :content, :image, :user_id)";
    $query = $database->prepare($sql);
    $query->execute([
        "title" => $title,
        "content" => $content,
        "image" => isset( $target_path ) ? $target_path : "",
        "user_id" => $_SESSION["user"]["id"]
    ]);

    //step 4 display success message
    $_SESSION["success"] = "Post has been created";


    // 5. Redirect back to the /manage-posts page
    header("Location: /manage-posts"); 
    exit; // meow :3
