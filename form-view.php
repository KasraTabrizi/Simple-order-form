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

        if(empty($emailErr) and empty($streetNumErr) and empty($streetNameErr) and empty($zipcodeErr) and empty($cityErr)){
            $alertCheck = 2;
        }
        else{
            $alertCheck = 1;
        }
        //whatIsHappening();
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
                <label for="email">E-mail: <span class="validity_check"><?php echo $emailErr; //isEmailValid($email_address); ?></span></label>
                <input type="text" id="email" name="email" class="form-control" value= <?php echo $_SESSION["email"];?>> 
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:<span class="validity_check"><?php echo $streetNameErr;//isNumber($street_number);?></span></label>
                    <input type="text" name="street" id="street" class="form-control" value= <?php echo $_SESSION["street"];?>>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number: <span class="validity_check"><?php echo $streetNumErr;//isNumber($street_number);?></span></label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value= <?php echo $_SESSION["streetnumber"];?>>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:<span class="validity_check"><?php echo $cityErr;//isNumber($street_number);?></span></label>
                    <input type="text" id="city" name="city" class="form-control" value=<?php echo $_SESSION["city"];?>>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode <span class="validity_check"><?php echo $zipcodeErr;//isNumber($zipcode);?></span></label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value=<?php echo $_SESSION["zipcode"];?>>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name=<?php echo $product['name'] ?>    
                    <?php 
                        if($product['name'] == "Club_Ham"){
                            echo $_SESSION['Club_Ham'];
                        }
                        if($product['name'] == "Club_Cheese"){
                            echo $_SESSION['Club_Cheese'];
                        }
                        if($product['name'] == "Club_Cheese_&_Ham"){
                            echo $_SESSION['Club_Cheese_&_Ham'];
                        }
                        if($product['name'] == ""){
                            echo $_SESSION['Club_Chicken'];
                        }
                        if($product['name'] == "Club_Salmon"){
                            echo $_SESSION['Club_Salmon'];
                        }
                    ?>/> 
                    <?php echo str_replace( "_", " ", $product['name']) ?> -&euro; 
                    <?php echo number_format($product['price'], 2) ?>
                </label>
                <br />
            <?php endforeach; ?>
        </fieldset>

        <button type="submit" name="submit" value="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>
</body>
</html>