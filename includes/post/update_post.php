<?php

    // 1. connect to database
    $database = connectToDB();


    // 2. get all the data from the form using $_POST
    $title = $_POST["title"];
    $content = $_POST["content"];
    $status = $_POST["status"];
    $id = $_POST["id"];
    $image = $_FILES["image"];


    /*
        3. error checking
        - make sure all the fields are not empty 
    */
    if (empty($title) || empty($content) || empty($status) || empty($id) ) {
        $_SESSION["error"] = "All fields are required";
        header("Location: /manage-posts-edit?id=" . $id);
        exit;
    }

    // if $image is not empty, then do image upload
    if ( !empty( $image["name"] ) ) {
        // where is the upload folder
        $target_folder = "uploads/";
        // add the image name to the upload folder path
        $target_path = $target_folder . date( "YmdHisv" ) . basename( $image["name"] );
        // move the file to the uploads folder
        move_uploaded_file( $image["tmp_name"] , $target_path );

        // update the post with image path
        $sql = "UPDATE posts SET title = :title, content = :content, status = :status, image = :image WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute([
            "title" => $title,
            "content" => $content,
            "status" => $status,
            "image" => $target_path,
            "id" => $id,
        ]);
    } else {
        // update the post with image path
        $sql = "UPDATE posts SET title = :title, content = :content, status = :status WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute([
            "title" => $title,
            "content" => $content,
            "status" => $status,
            "id" => $id,
        ]);
    }

    //step 4 display success message
    $_SESSION["success"] = "Post has been updated";

    // 5. Redirect back to the /manage-posts page
    header("Location: /manage-posts"); 
    exit; // meow :3
