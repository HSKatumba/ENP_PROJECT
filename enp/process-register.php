<?php


if(strlen($_POST["password"]) < 8){
    die("Password must be atleast 8 characters");
}

if (! preg_match("/[a-z]/i", $_POST["password"])){
    die("Password must contain atleast one letter");
}

if (! preg_match("/[0-9]/", $_POST["password"])){
    die("Password must contain atleast one number");
}

if( $_POST["password"] !== $_POST["re_password"]){
    die("Passwords must match ");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
$mysqli = require __DIR__ . "/database.php";


$sql = "INSERT INTO register (first_name, last_name, email, password_hash, address) VALUES (?,?,?,?,?)";
$stmt = $mysqli -> stmt_init();

if (! $stmt -> prepare($sql)){
    die("SQL error: " . $mysqli -> error);
}

$stmt -> bind_param("sssss", $_POST["first_name"],$_POST["last_name"],$_POST["email"],$password_hash, $_POST["address"] );


if ($stmt -> execute()){


header("Location: signup_success.html");
exit;
}else{
    if($mysqli -> errno === 1062){
        die("User Already Exists, Try Loging in");
    }
    else{
        die($mysqli -> error . " " . $mysqli -> errno);
    }
}




