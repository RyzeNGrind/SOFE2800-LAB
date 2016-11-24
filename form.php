<?php
$db = new mysqli('sofe2800.cwohowoxlk9c.us-east-1.rds.amazonaws.com',
                                'admin', 'sofe2800project', 'lab');

// TODO You must process the POST data from the form and then set the variables
// below to be inserted in the database

// You should see sucess if you can connect
if($db->connect_errno > 0){
    echo "ERROR";
    die('Unable to connect to database [' . $db->connect_error . ']');
}
else {
    echo "SUCCESS";
}

// Insert sample data into the database
$sql = $db->prepare("INSERT INTO sample(name, email, password, dropdown, checkbox, " .
                    "radio, textarea) VALUES (?, ?, ?, ?, ?, ?, ?)");

//if($_POST['btnSubmit'] == "Submit")
if($_SERVER["REQUEST_METHOD"] == "POST")
{


// These should be retrieved from POST variables
$name = $_POST['name'];
$email = $_POST['email'];
$insecure_pass = $_POST['password']; // This password needs to be securely hashed
$dropdown = $_POST['country']; // This is one of the dropdown selection options
$checkbox = implode(",", $_POST['referral']);  // This is a boolean value 0 or 1
$radio = $_POST['favpet'];   // This is an integer value
$message = $_POST['aboutyou'];

/**$name = "Shawn";
$email = "shawn@test.com";
$insecure_pass = "shawn123"; // This password needs to be securely hashed
$dropdown = "Option 2"; // This is one of the dropdown selection options
$checkbox = 1;  // This is a boolean value 0 or 1
$radio = 3;   // This is an integer value
$message = "YOLO.";**/

// Securely hash the password
$password = password_hash($insecure_pass, PASSWORD_DEFAULT);
}
// Bind the parameters to the SQL query above, s is a string i is an integer
$sql->bind_param("sssssss", $name, $email, $password, $dropdown, $checkbox, $radio, $message);

// Execute the query, inserting the data
$sql->execute();

// Close the connection
$sql->close();
$db->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap and Font Awesome css-->
  <!-- we use cdn but you can also include local files located in css directory-->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/themify-icons.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <!-- Google fonts - Roboto Condensed for headings, Open Sans for copy-->
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300,700%7COpen+Sans:300,400,700">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="css/style.lightblue.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="css/custom.css">

  <link href="css/formValidation.min.css" rel="stylesheet">
  <link href="css/morris.css" rel="stylesheet">

  <!-- Favicon-->
  <link rel="shortcut icon" href="favicon.png">
  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
<style>
p.pad-below {
    padding-bottom: 3cm;
}

h1 {
  font-weight: bold;
}

ul.nodot{
  list-style-type: none;
}

</style>

</head>
<body data-spy="scroll" data-target="#navigation" data-offset="120">
  <!-- intro-->
  <section id="intro" class="intro image-background">
    <div class="overlay"></div>
    <div class="content">
      <div class="container clearfix">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 col-sm-12">
            <h1>We are<br /><span class="bold">Knights In Furry Armor</span></h1>
            <p class="roboto"><strong>Find Your Friend Today</strong></p>
          </div>
        </div>
      </div>
    </div><a href="#about" class="icon faa-float animated scroll-to"><i class="fa fa-angle-double-down"></i></a>
  </section>
  <!-- navbar-->
  <header class="header">
    <div class="sticky-wrapper">
      <div role="navigation" class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a href="#intro" class="navbar-brand scroll-to"><img src="img/logo.png" alt=""></a>
          </div>
          <div id="navigation" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="#about">About Us</a></li>
              <li><a href="#services">Services</a></li>
              <li><a href="#portfolio">Portfolio</a></li>
              <li><a href="plots.php">Plots</a></li>
              <li><a href="form.php">Form</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
  <body>
    <form id="form" class="form-horizontal" action="form.php" method="POST">
      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="name" name="name" placeholder="Name">
        </div>
      </div>
      <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-8">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
      </div>
      <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-8">
          <input type="password" class="form-control" id ="password" name="password" placeholder="Password">
        </div>
      </div>
      <div class="form-group">
        <label for="country" class="col-sm-2 control-label">Country</label>
        <div class="col-sm-8">
          <select class="form-control" form="form" name="country" id="country">
            <option>Canada</option>
            <option>United States</option>
            <option>Mexico</option>
            <option>United Kingdom</option>
            <option>Sri Lanka</option>
            <option>India</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="referral" class="col-sm-2 control-label">Where did you hear about us? (Select all that apply)</label>
        <div class="col-sm-8">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="referral[]" value="Social Media">
              Social media
            </label>
            <label>
              <input type="checkbox"name="referral[]" value="Newspaper">
              Newspaper
            </label>
            <label>
              <input type="checkbox" name="referral[]" value="Friend">
              Person referred me
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="referral" class="col-sm-2 control-label">What's your favorite pet?</label>
        <div class="col-sm-8">
          <div class="radio">
            <label>
              <input type="radio" name="favpet" id="favpet1" value="Dog">
              Dogs
            </label>
            <label>
              <input type="radio" name="favpet" id="favpet2" value="Cat" >
              Cats
            </label>
            <label>
              <input type="radio" name="favpet" id="favpet3" value="Other" >
              Other
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="aboutyou" class="col-sm-2 control-label">Tell us about yourself</label>
        <div class="col-sm-8">
          <textarea class="form-control" name="aboutyou" id="aboutyou"rows="3" required></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-default" value="Submit">Submit</button>
        </div>
      </div>
    </form>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


</body>
  <footer>
    <div class="container">
      <div id="contact" class="row">
        <div class="col-md-8">
          <h1> Contact info/footer</h1>
          <p class="roboto">&copy;2016 Knights in Furry Armour</p>
          <p> Email: knights.in.fury.armour@gmail.ca</p>
          <p> Phone Number: (XXX)-XXX-XXXX</p>
        </div>
        <div class="col-md-9">
          <p class="credit roboto"><a href="http://bootstrapious.com/portfolio-themes">Bootstrapious - Portfolio Themes</a></p>
          <!-- Please do not remove the backlink to us. It is part of the licence conditions. Thanks for understanding :)-->
        </div>
      </div>
    </div>
  </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/formValidation.min.js"></script>
    <script src="js/framework/bootstrap.min.js"></script>
    <script src="js/raphael-min.js"></script>
    <script src="js/morris.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#form').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
              name:  {
              validators: {
                  notEmpty: {
                      message: 'Please enter a name'
                  }
              }
          },
                email:  {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    email: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required and cannot be empty'
                        },
                        stringLength: {
                            min: 6,
                            message: 'The password must be more than 6 characters long'
                        }
                }
            },
            'referral[]': {
                validators: {
                    notEmpty: {
                        message: 'Please select a referral source'
                    }
                }
            },
            favpet: {
                validators: {
                    notEmpty: {
                        message: 'Please select your favorite pet'
                    }
                }
            },
        }
    });
    });
    </script>
</html>
