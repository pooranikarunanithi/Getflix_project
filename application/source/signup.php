<?php
ob_start();
// Include config file
require_once "conn.php";
 
// Define variables and initialize with empty values
$firstname = $lastname = $username = $emailid = $password = $confirm_password =  "";
$firstname_err = $lastname_err = $username_err = $emailid_err= $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate firstname
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter a Firstname";
    } 
	else
	{
		$firstname = trim($_POST["firstname"]);
	}

	// Validate lastname
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter a Lastname";
    } 
	else
	{
		$lastname = trim($_POST["lastname"]);
	}

	// Validate emailid
	if(empty(trim($_POST["emailid"]))){
		$emailid_err = "Please enter an Emailid";
		} 
		else
		{
		$emailid = trim($_POST["emailid"]);
        if (!filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
            $emailid_err = "Invalid email format";
        }


		}

	// Validate Username
	if(empty(trim($_POST["username"]))){
	$username_err = "Please enter a Username";
	} 
	else
	{
	$username = trim($_POST["username"]);
	}

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

	// Check input errors before inserting in database
    if(empty($firstname_err) && empty($lastname_err) && empty($username_err) && empty($emailid_err) && empty($password_err) && empty($confirm_password_err))
	{
	
    $sql = "INSERT INTO users (user_firstname, user_lastname, user_email, user_uid, user_password)  VALUES ('$firstname','$lastname','$emailid','$username','$password')";
 
    //echo $sql; 

  if ($conn->query($sql) == TRUE) {
		//echo "Registered Successfully";
  } 
 else {
   echo "Error Inserting table: " . $conn->error;
  }
	header("location: login.php?registered=true");
	$conn->close();	
 
}
 
}
ob_end_flush();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Getflix - Sign Up</title>
    <link rel="icon" href="./images/movie-theater.png" type="image/png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="signup.css">
</head>
<body>
<nav class="navbar navbar-expand p-0">
        <div class="container-fluid kRed fontWide text-light">
            <ul class="navbar-nav justify-content-between mx-5 py-3 navDesk">
            <li class="nav-item"> <a href="slideshow.php" class="nav-link kRed text-light navLink"> <img src="./images/logo-small.jpg" alt="" width="80" height="60"> </a></li>
      </div>
</nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card">
                    <div class="card-header text-center bg-danger">
                        <h1>SignUp</h1>
                    </div>
                    <div class="card-body">
                        <p>Please fill this form to create an account.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" name="firstname" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
                                <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
                            </div> <br>   
							<div class="form-group">
                                <label>Lastname</label>
                                <input type="text" name="lastname" class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>">
                                <span class="invalid-feedback"><?php echo $lastname_err; ?></span>
                            </div> <br>
							
							<div class="form-group">
                                <label>Email id</label>
                                <input type="text" name="emailid" class="form-control <?php echo (!empty($emailid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $emailid; ?>">
                                <span class="invalid-feedback"><?php echo $emailid_err; ?></span>
                            </div> <br>
							
							<div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </div> <br>

							<div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div><br>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            </div>  <br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <input type="reset" class="btn btn-dark ml-2" value="Reset">
                             </div>
                            
                            <div id='lower-side'>
    
                        </form>
                        <br>
                        <p>Already have an account? <a href="login.php">Login here</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>