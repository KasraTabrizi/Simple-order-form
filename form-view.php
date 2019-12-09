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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["email"])) {
            $emailErr = "Missing";
        }
        else {
            $email_address = $_POST["email"];
        }
    
        if (empty($_POST["street"])) {
            $streetNameErr = "Missing";
        }
        else {
            $street_name = $_POST["street"];
        }
    
        if (empty($_POST["streetnumber"]))  {
            $streetNumErr = "Missing";
        }
        else {
            $street_number = $_POST["streetnumber"];
        }

        if (empty($_POST["zipcode"]))  {
            $zipcodeErr = "Missing";
        }
        else {
            $zipcode = $_POST["zipcode"];
        }

        if (empty($_POST["city"]))  {
            $cityErr = "Missing";
        }
        else {
            $city = $_POST["city"];
        }
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
            showAlertMessage();
        ?>
    </div>

    <form method="post" action="index.php">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail: <span class="validity_check"><?php echo $emailErr; //isEmailValid($email_address); ?></span></label>
                <input type="text" id="email" name="email" class="form-control" value= <?php //echo $_SESSION["email"];?>> 
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:<span class="validity_check"><?php echo $streetNameErr;//isNumber($street_number);?></span></label>
                    <input type="text" name="street" id="street" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number: <span class="validity_check"><?php echo $streetNumErr;//isNumber($street_number);?></span></label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:<span class="validity_check"><?php echo $cityErr;//isNumber($street_number);?></span></label>
                    <input type="text" id="city" name="city" class="form-control" value="">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode <span class="validity_check"><?php echo $zipcodeErr;//isNumber($zipcode);?></span></label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>

        <button type="submit" name="submit" value="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>
</body>
</html>