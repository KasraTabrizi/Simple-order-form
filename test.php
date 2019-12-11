<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
//we are going to use session variables so we need to enable sessions
session_start();

//declaring variables
$food = 1;
$alertCheck = 0;
$totalValue = 0;
$email_address = $street_name = $street_number = $city = $zipcode = "";
$arrayErr = array(
    "email" => "",
    "streetnumber" => "",
    "street" => "",
    "zipcode" => "",
    "city" => "",
);

//var_dump(isset($_GET["food"]));
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $arrayErr = $_POST;
    //$emailErr = $streetNumErr = $streetNameErr = $zipcodeErr = $cityErr = "";
    foreach($_POST as $key => $value){

        //var_dump("{$key} => {$value}");

        if(empty($_POST[$key])){ //check if field is empty
            $arrayErr[$key] = "Missing";
            $alertCheck = 1;
        }
        else{ 
            if(!filter_var($value, FILTER_VALIDATE_EMAIL) && $key == 'email'){
                $arrayErr[$key] = 'email address is invalid!';
                $alertCheck = 1;
            }
            elseif(!is_numeric($value) && (($key == 'streetnumber') || ($key == 'zipcode'))){
                $arrayErr[$key] = 'value is not a number!';
                $alertCheck = 1;
            }
            else{
                $arrayErr[$key] = "";
                $_SESSION = $_POST;
            }
        }
    }
    if($alertCheck == 0){
        $alertCheck = 2;
    }

    //checkbox check
    if (empty($_POST["Club_Ham"]))  {
        $_SESSION['Club_Ham'] = 'unchecked';
    }
    else {
        $_SESSION['Club_Ham'] = 'checked';
        $totalValue += 3.2;
    }

    if (empty($_POST["Club_Cheese"]))  { 
        $_SESSION['Club_Cheese'] = 'unchecked';
    }
    else {
        $_SESSION['Club_Cheese'] = 'checked';
        $totalValue += 3;
    }

    if (empty($_POST["Club_Cheese_&_Ham"]))  { 
        $_SESSION['Club_Cheese_&_Ham'] = 'unchecked';
    }
    else {
        $_SESSION['Club_Cheese_&_Ham'] = 'checked';
        $totalValue += 4;
    }

    if (empty($_POST["Club_Chicken"]))  { 
        $_SESSION['Club_Chicken'] = 'unchecked';
    }
    else {
        $_SESSION['Club_Chicken'] = 'checked';
        $totalValue += 4;
    }

    if (empty($_POST["Club_Salmon"]))  { 
        $_SESSION['Club_Salmon'] = 'unchecked';
    }
    else {
        $_SESSION['Club_Salmon'] = 'checked';
        $totalValue += 5;
    }

    if (empty($_POST["Cola"]))  { 
        $_SESSION['Cola'] = 'unchecked';
    }
    else {
        $_SESSION['Cola'] = 'checked';
    }

    if (empty($_POST["Fanta"]))  { 
        $_SESSION['Fanta'] = 'unchecked';
    }
    else {
        $_SESSION['Fanta'] = 'checked';
    }

    if (empty($_POST["Sprite"]))  { 
        $_SESSION['Sprite'] = 'unchecked';
    }
    else {
        $_SESSION['Sprite'] = 'checked';
    }

    if (empty($_POST["Ice-tea"]))  { 
        $_SESSION['Ice-tea'] = 'unchecked';
    }
    else {
        $_SESSION['Ice-tea'] = 'checked';
    }
    //whatIsHappening();
    //mail($_SESSION["email"], 'My Subject', $street_name);
}
// $email_address = $_POST['email'];
// $street_name = $_POST['street'];
// $street_number = $_POST['streetnumber'];
// $city = $_POST['city'];
// $zipcode = $_POST['zipcode'];

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

//function that shows an alert danger box
function showAlertMessage($error = "", $showAlert = false){
    //if there is no error message and the showAlert is true than show a succes alert
    if( empty($error) && $showAlert == true ){ 
        echo'<div class="alert alert-success" role="alert">Form succesfully send!</div>';
    }
    //if there is an error message and the showAlert is true, then show a danger alert
    elseif(!empty($error) && $showAlert == true){ 
        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
    }
}
//your products with their price.
if(isset($_GET["food"])){
    $food = $_GET["food"];
}

if($food == "1"){
    $products = [
        ['name' => 'Club_Ham', 'price' => 3.20],
        ['name' => 'Club_Cheese', 'price' => 3],
        ['name' => 'Club_Cheese_&_Ham', 'price' => 4],
        ['name' => 'Club_Chicken', 'price' => 4],
        ['name' => 'Club_Salmon', 'price' => 5]
    ];
}
else{
    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3]
    ];
}

require 'form-view.php';