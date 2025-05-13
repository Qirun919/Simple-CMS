<?php

    // 1. connect to database
    $database = connectToDB();


    // 2. get all the data from the form using $_POST
    $title = $_POST["title"];
    $content = $_POST["content"];
    $status = $_POST["status"];
    $id = $_POST["id"];

    /*
        3. error checking
        - make sure all the fields are not empty 
    */
    if (empty($title) || empty($content) || empty($status) || empty($id) ) {
        $_SESSION["error"] = "All fields are required";
        header("Location: /manage-posts-edit?id=" . $id);
        exit;
    }

    // create the post

    $sql = "UPDATE posts SET title = :title, content = :content, status = :status WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        "title" => $title,
        "content" => $content,
        "status" => $status,
        "id" => $id,
    ]);

    //step 4 display success message
    $_SESSION["success"] = "Post has been updated";


    // 5. Redirect back to the /manage-posts page
    header("Location: /manage-posts"); 
    exit; // meow :3
