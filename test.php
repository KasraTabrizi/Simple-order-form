<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
//we are going to use session variables so we need to enable sessions
session_start();

//declaring variables
$food;
$products;
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

//your products with their price.
if(isset($_GET["food"])){
    $food = $_GET["food"];
}

if($food == "1"){
    $totalValue = 0;
    $products = [
        ['name' => 'Club Ham', 'price' => 3.20],
        ['name' => 'Club Cheese', 'price' => 3],
        ['name' => 'Club Cheese & Ham', 'price' => 4],
        ['name' => 'Club Chicken', 'price' => 4],
        ['name' => 'Club Salmon', 'price' => 5]
    ];
}
else{
    $totalValue = 0;
    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $arrayErr = $_POST;
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
                $arrayErr[$key] = ""; //if no errors found, make the value of that key in the array error empty
                $_SESSION = $_POST; //copy everything from the $_POST into the $_SESSION
            }
        }
    }
    
    if(empty($_POST["products"])){ //check if field is empty
        $alertCheck = 1;
    }else{
        $alertCheck = 2;
        foreach($_POST["products"] as $key => $value){
            $val = $products[$value];
            $totalValue += $val['price'];
            var_dump($val);
        }
    }
    if($alertCheck == 0){
        $alertCheck = 2;
    }
    //whatIsHappening();
    //mail($_SESSION["email"], 'My Subject', $street_name); doesn't work at the moment
}

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

//include the form-view php file and give error if something happens
require 'form-view.php';