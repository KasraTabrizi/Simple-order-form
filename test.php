<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
//we are going to use session variables so we need to enable sessions
session_start();

//declaring variables
$food = 1;
$alertCheck = 0;
$totalValue = 0;
$emailErr = $streetNumErr = $streetNameErr = $zipcodeErr = $cityErr = ""; 
$email_address = $street_name = $street_number = $city = $zipcode = "";

//var_dump(isset($_GET["food"]));
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $emailErr = $streetNumErr = $streetNameErr = $zipcodeErr = $cityErr = "";
    if (empty($_POST["email"])) {
        $emailErr = "Missing";
        $_SESSION["email"] = $email_address;
    }
    else {
        $email_address = $_POST["email"];
        $_SESSION["email"] = $email_address;
        if(!isEmailValid($email_address)){
            $emailErr = 'email address is invalid!';
        }
        else{
            $emailErr = "";
        }
    }
    if (empty($_POST["street"])) {
        $streetNameErr = "Missing";
        $_SESSION['street'] = $street_name;
    }
    else {
        $street_name = $_POST["street"];
        $_SESSION['street'] = $street_name;
    }
    if (empty($_POST["streetnumber"]))  {
        $streetNumErr = "Missing";
        $_SESSION['streetnumber'] = $street_number;
    }
    else {
        $street_number = $_POST["streetnumber"];
        $_SESSION['streetnumber'] = $street_number;
        if(!isNumber($street_number)){
            $streetNumErr = 'value is not a number!';

        }
        else{
            $streetNumErr = "";

        }
    }
    if (empty($_POST["zipcode"]))  {
        $zipcodeErr = "Missing";
        $_SESSION['zipcode'] = $zipcode;
    }
    else {
        $zipcode = $_POST["zipcode"];
        $_SESSION['zipcode'] = $zipcode;
        if(!isNumber($zipcode)){
            $streetNumErr = 'value is not a number!';

        }
        else{
            $streetNumErr = "";

        }
    }
    if (empty($_POST["city"]))  {
        $cityErr = "Missing";
        $_SESSION['city'] = $city;
    }
    else {
        $city = $_POST["city"];
        $_SESSION['city'] = $city;
    }
    if (isset($_POST["divtime"]))  {
        //$_SESSION['test'] = 'unchecked';
        foreach ($_POST["divtime"] as $subject)  
            var_dump($subject); 
        //$totalValue += 10;
    }
    else {
        // Retrieving each selected option 
        
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

    if(empty($emailErr) and empty($streetNumErr) and empty($streetNameErr) and empty($zipcodeErr) and empty($cityErr)){
        $alertCheck = 2;
    }
    else{
        $alertCheck = 1;
    }
    whatIsHappening();
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

//function that check if email adres is valid
function isEmailValid($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return false; //email is invalid
    }
    else{
        return true; //email is valid
    }
}

//function that check if street number and zip code contain only numbers
function isNumber($inputText){
    if(! is_numeric($inputText)){
        return false; //is not a number
    }
    else{
        return true; //is a number
    }
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