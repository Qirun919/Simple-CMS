<?php
    // start session  (we want to use $SESSION in this page)
    $database = connectToDB();
$email = $_POST["email"];
$password = $_POST["password"];
//check for errir (make sure all the fields are filled)
if(empty($email) || empty($password)) {
    echo"All fields are required";
} else {
    // get the user date by email
    $sql = "SELECT * FROM users WHERE email = :email";
    $query = $database->prepare( $sql );
    $query -> execute([
        "email" => $email
    ]);
    $user = $query->fetch();
    if( $user) {
            // check if the password is correct or not
            if ( password_verify($password, $user["password"])) {
                // store the user session storage to login the user
                $_SESSION["users"] = $user;
                header("Location: /dashboard ");
                exit;
            } else {
                echo "The password provided is incorrect";
            }
        } else {
            echo "The email provided does not exist";
        };
}
?>