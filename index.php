<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
//we are going to use session variables so we need to enable sessions
session_start();

// $email_address = $_POST['email'];
// $street_name = $_POST['street'];
// $street_number = $_POST['streetnumber'];
// $city = $_POST['city'];
// $zipcode = $_POST['zipcode'];


//check if the submit button is pressed
if(isset($_POST['submit'])){

    $email_address = $_POST['email'];
    $street_name = $_POST['street'];
    $street_number = $_POST['streetnumber'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];

    $_SESSION["email"] = $email_address;
    $_SESSION['street'] = $street_name; 
    $_SESSION['streetnumber'] = $street_number;
    $_SESSION['city'] = $city;
    $_SESSION['zipcode'] = $zipcode ;
}


//whatIsHappening();

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//function that check if email adres is valid
function isEmailValid($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return 'email address is invalid!';
    }
}

//function that check if street number and zip code contain only numbers
function isNumber($inputText){
    if(! is_numeric($inputText)){
        return 'information should be numeric!';
    }
}

//function that shows an alert danger box
function showAlertMessage($error = "", $showAlert = false){
    //if there is no error message and the showAlert is true than show a succes alert
    if( empty($error) and $showAlert == true ){ 
        echo'<div class="alert alert-success" role="alert">Form succesfully send!</div>';
    }
    //if there is an error message and the showAlert is true, then show a danger alert
    elseif(!empty($error) and $showAlert == true){ 
        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
    }
}

//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];
$products = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];
$totalValue = 0;

require 'form-view.php';