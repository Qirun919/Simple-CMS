<?php

    // 1. connect to database
    $database = connectToDB();

    // 2. get all the data from the form using $_POST
    
    $title = $_POST["title"];
    $content = $_POST["content"];
    /*
        3. error checking
        - make sure all the fields are not empty 
        - make sure the password is match 
        - make sure the email provided does not exist in the system
    */
    
    if (empty($title) || empty($content) ) {
        $_SESSION["error"] = "All fields are required";
        header("Location: /manage-posts-add");
        exit;
    } 

        //step 1 recipe
        $sql = "INSERT INTO posts (`title`, `content`,`user_id`) VALUES (:title, :content, :user_id)";
        //step 2 prepare
        $statement = $database->prepare($sql);
        //step 3 let them cook
        
        $statement->execute([ // add more
            "title" => $title,
            "content" => $content,
            "user_id" => $_SESSION["user"]["id"]
        ]);
        
        //step 4 display success message
        $_SESSION["success"] = "users post has been created";


    // 5. Redirect back to the /manage-users page
    header("Location: /manage-posts"); 
    exit; 
?>