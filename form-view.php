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
            if(isset($_POST['submit'])){
                $_SESSION["email"] = $email_address;
                $_SESSION['street'] = $street_name; 
                $_SESSION['streetnumber'] = $street_number;
                $_SESSION['city'] = $city;
                $_SESSION['zipcode'] = $zipcode;
            }
            showAlertMessage();
        ?>
    </div>

    <form method="post" action="index.php">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail: <span class="validity_check"><?php echo isEmailValid($email_address);?></span></label>
                <input type="text" id="email" name="email" class="form-control" value= <?php echo $_SESSION["email"];?> required> 
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number: <span class="validity_check"><?php echo isNumber($street_number);?></span></label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" value="" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode <span class="validity_check"><?php echo isNumber($zipcode);?></span></label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="" required>
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

        <button type="submit" name="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>
</body>
</html>