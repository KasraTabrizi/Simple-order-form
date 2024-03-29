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

    <form method="post" action="test.php">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail: <span class="validity_check"><?php echo $arrayErr['email'];?></span></label>
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
                    <label for="street">Street:<span class="validity_check"><?php echo $arrayErr['street'];?></span></label>
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
                    <label for="streetnumber">Street number: <span class="validity_check"><?php echo $arrayErr['streetnumber'];?></span></label>
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
                    <label for="city">City:<span class="validity_check"><?php echo $arrayErr['city'];?></span></label>
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
                    <label for="zipcode">Zipcode <span class="validity_check"><?php echo $arrayErr['zipcode'];?></span></label>
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
                            <input type="checkbox" value="<?php echo $i; ?>" name="products[]"/> 
                            <?php echo $product['name'] ?> -&euro; 
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
                    <label>
                        <input type="checkbox" value="1" name="normal">Normal Delivery | 2 hours - 10 &euro;
                        <br>
                        <input type="checkbox" value="1" name="express">Express Delivery | 45 minutes - 15 &euro;
                    </label> 
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