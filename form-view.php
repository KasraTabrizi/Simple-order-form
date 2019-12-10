<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Order food & drinks</title>
    <style>
        .validity_check{
            color:red; 
            font-weight:bold;
        }
        footer {
        text-align: center;
        }
    </style>
</head>
<body>

<?php 
    $emailErr = $streetNumErr = $streetNameErr = $zipcodeErr = $cityErr = "";
    $email_address = $street_name = $street_number = $city = $zipcode = "";
    $alertCheck = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $emailErr = $streetNumErr = $streetNameErr = $zipcodeErr = $cityErr = "";
        if (empty($_POST["email"])) {
            $emailErr = "Missing";
            $_SESSION["email"] = $email_address;
            //$alertCheck = 1;
        }
        else {
            $email_address = $_POST["email"];
            $_SESSION["email"] = $email_address;
            if(!isEmailValid($email_address)){
                $emailErr = 'email address is invalid!';
                //$alertCheck = 1;
            }
            else{
                $emailErr = "";
                //$alertCheck = 2;
            }
        }
        if (empty($_POST["street"])) {
            $streetNameErr = "Missing";
            $_SESSION['street'] = $street_name;
            //$alertCheck = 1;
        }
        else {
            $street_name = $_POST["street"];
            $_SESSION['street'] = $street_name;
            //$alertCheck = 2;
        }
        if (empty($_POST["streetnumber"]))  {
            $streetNumErr = "Missing";
            $_SESSION['streetnumber'] = $street_number;
            //$alertCheck = 1;
        }
        else {
            $street_number = $_POST["streetnumber"];
            $_SESSION['streetnumber'] = $street_number;
            if(!isNumber($street_number)){
                $streetNumErr = 'value is not a number!';
                //$alertCheck = 1;
            }
            else{
                $streetNumErr = "";
                //$alertCheck = 2;
            }
        }
        if (empty($_POST["zipcode"]))  {
            $zipcodeErr = "Missing";
            $_SESSION['zipcode'] = $zipcode;
            //$alertCheck = 1;
        }
        else {
            $zipcode = $_POST["zipcode"];
            $_SESSION['zipcode'] = $zipcode;
            if(!isNumber($zipcode)){
                $streetNumErr = 'value is not a number!';
                //$alertCheck = 1;
            }
            else{
                $streetNumErr = "";
                //$alertCheck = 2;
            }
        }
        if (empty($_POST["city"]))  {
            $cityErr = "Missing";
            $_SESSION['city'] = $city;
            //$alertCheck = 1;
        }
        else {
            $city = $_POST["city"];
            $_SESSION['city'] = $city;
            //$alertCheck = 2;
        }

        //checkbox check
        if (empty($_POST["Club_Ham"]))  {
            $_SESSION['Club_Ham'] = 'unchecked';
        }
        else {
            $_SESSION['Club_Ham'] = 'checked';
        }

        if (empty($_POST["Club_Cheese"]))  { 
            $_SESSION['Club_Cheese'] = 'unchecked';
        }
        else {
            $_SESSION['Club_Cheese'] = 'checked';
        }

        if (empty($_POST["Club_Cheese_&_Ham"]))  { 
            $_SESSION['Club_Cheese_&_Ham'] = 'unchecked';
        }
        else {
            $_SESSION['Club_Cheese_&_Ham'] = 'checked';
        }

        if (empty($_POST["Club_Chicken"]))  { 
            $_SESSION['Club_Chicken'] = 'unchecked';
        }
        else {
            $_SESSION['Club_Chicken'] = 'checked';
        }

        if (empty($_POST["Club_Salmon"]))  { 
            $_SESSION['Club_Salmon'] = 'unchecked';
        }
        else {
            $_SESSION['Club_Salmon'] = 'checked';
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
        //whatIsHappening();
    }
    else{
        // $_SESSION["email"] = "";
        // $_SESSION['street'] = "";
        // $_SESSION['streetnumber'] = "";
        // $_SESSION['city'] = "";
        // $_SESSION['zipcode'] = "";
        // $_SESSION['Club_Ham'] = "";
        // $_SESSION['Club_Cheese'] = "";
        // $_SESSION['Club_Cheese_&_Ham'] = "";
        // $_SESSION['Club_Chicken'] = "";
        // $_SESSION['Club_Salmon'] = "";
        // $_SESSION['Cola'] = "";
        // $_SESSION['Fanta'] = "";
        // $_SESSION['Sprite'] = "";
        // $_SESSION['Ice-tea'] = "";
    }
?>

<div class="container">
    <h1>Order food in restaurant "the Personal Ham Processors"</h1>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>

    <div>
        <?php 
            switch($alertCheck){
                case 0:
                    showAlertMessage(); //default nothing
                break;
                case 1:
                    showAlertMessage("error in form", true); //error in form
                break;
                case 2:
                    showAlertMessage("", true); //form succesfully send!
                break;
                default:
                break;
            }
        ?>
    </div>

    <form method="post" action="index.php">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail: <span class="validity_check"><?php echo $emailErr;?></span></label>
                <input type="text" id="email" name="email" class="form-control" 
                value= 
                <?php if(empty($_SESSION["email"])):
                            echo $_SESSION["email"] = "";
                        else:
                            echo $_SESSION["email"];
                        endif; ?>
                > 
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:<span class="validity_check"><?php echo $streetNameErr;//isNumber($street_number);?></span></label>
                    <input type="text" name="street" id="street" class="form-control" 
                    value= 
                    <?php if(empty($_SESSION["street"])):
                            echo $_SESSION["street"] = "";
                        else:
                            echo $_SESSION["street"];
                        endif; ?>
                    >
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number: <span class="validity_check"><?php echo $streetNumErr;//isNumber($street_number);?></span></label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" 
                    value= 
                    <?php if(empty($_SESSION["streetnumber"])):
                            echo $_SESSION["streetnumber"] = "";
                        else:
                            echo $_SESSION["streetnumber"];
                        endif; ?>
                    >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:<span class="validity_check"><?php echo $cityErr;//isNumber($street_number);?></span></label>
                    <input type="text" id="city" name="city" class="form-control" 
                    value=
                    <?php if(empty($_SESSION["city"])):
                            echo $_SESSION["city"] = "";
                        else:
                            echo $_SESSION["city"];
                        endif; ?>
                    >
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode <span class="validity_check"><?php echo $zipcodeErr;//isNumber($zipcode);?></span></label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" 
                    value=
                    <?php if(empty($_SESSION["zipcode"])):
                            echo $_SESSION["zipcode"] = "";
                        else:
                            echo $_SESSION["zipcode"];
                        endif; ?>
                    >
                </div>
            </div>
        </fieldset>
        <div class="form-row">
            <div class="form-group col-md-6">
                <fieldset>
                    <legend>Products</legend>
                    <?php foreach ($products AS $i => $product): ?>
                        <label>
                            <input type="checkbox" value="1" name=<?php echo $product['name'] ?>    
                            <?php
                                if(empty($_SESSION['Club_Ham']) and empty($_SESSION['Club_Cheese'])){
                                    $_SESSION['Club_Cheese'] = "";
                                    $_SESSION['Club_Cheese_&_Ham'] = "";
                                    $_SESSION['Club_Chicken'] = "";
                                    $_SESSION['Club_Salmon'] = "";
                                    $_SESSION['Cola'] = "";
                                    $_SESSION['Fanta'] = "";
                                    $_SESSION['Sprite'] = "";
                                    $_SESSION['Ice-tea'] = "";
                                }
                                else{
                                    if($product['name'] == "Club_Ham"){
                                        echo $_SESSION['Club_Ham'];
                                    }
                                    if($product['name'] == "Club_Cheese"){
                                        echo $_SESSION['Club_Cheese'];
                                    }
                                    if($product['name'] == "Club_Cheese_&_Ham"){
                                        echo $_SESSION['Club_Cheese_&_Ham'];
                                    }
                                    if($product['name'] == "Club_Chicken"){
                                        echo $_SESSION['Club_Chicken'];
                                    }
                                    if($product['name'] == "Club_Salmon"){
                                        echo $_SESSION['Club_Salmon'];
                                    }
    
                                    if($product['name'] == "Cola"){
                                        echo $_SESSION['Cola'];
                                    }
                                    if($product['name'] == "Fanta"){
                                        echo $_SESSION['Fanta'];
                                    }
                                    if($product['name'] == "Sprite"){
                                        echo $_SESSION['Sprite'];
                                    }
                                    if($product['name'] == "Ice-tea"){
                                        echo $_SESSION['Ice-tea'];
                                    }
                                }
                            ?>/> 
                            <?php echo str_replace( "_", " ", $product['name']) ?> -&euro; 
                            <?php echo number_format($product['price'], 2) ?>
                        </label>
                        <br />
                    <?php endforeach; ?>
                    </fieldset>
                </div>
            
            <div class="form-group col-md-6">
                <fieldset>
                    <legend>Delivery Time</legend>
                    <!-- <label for="inputState">Delivery Time</label> -->
                    <select id="inputState" class="form-control">
                        <option selected>Choose a delivery time</option>
                        <option>Normal Delivery | 2 hours - 10 &euro;</option>
                        <option>Express Delivery | 45 minutes - 20 &euro;</option>
                    </select>
                </fieldset>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group mx-auto">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Order!</button>
            </div>
        </div>
    </form>
    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>