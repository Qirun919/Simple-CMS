<?php

// connect to database
function connectToDB() {
    // Connect to Database
    // 1. database info
    $host = "127.0.0.1";
    $database_name = "Simple_CMS_app"; // connecting to which database
    $database_user = "root";
    $database_password = ""; // empty string

    // 2. connect PHP with the MySQL database
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name", // host and db name
        $database_user, // username
        $database_password // password
    );

    return $database;
}

/* 
    Get user data by email
    Input: email
    Output: user
*/
function getUserByEmail( $email ) {

    // connect to database
    $database = connectToDB();

    // 5.1 SQL
    $sql = "SELECT * FROM users WHERE email = :email";
    // 5.2 prepare
    $query = $database->prepare( $sql );
    // 5.3 execute
    $query->execute([
        "email" => $email
    ]);
    // 5.4 fetch
    $user = $query->fetch(); // return the first row of the list 

    return $user;
}

/* 
    check if user is logged in
    if user is logged in, return true
    if user is not logged in, return false
*/
function isUserLoggedIn() {
    return isset( $_SESSION["user"] );
}