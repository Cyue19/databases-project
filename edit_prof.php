<?php
require("connect-db.php");
require("account_db.php");
session_start();

$firstName = getFirstName();
$lastName = getLastName();
$email = getEmail();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST["btnAction"]) && $_POST["btnAction"]=="update") {
        //log in to website
        $res = updateProfile($_SESSION['user'], $_POST["firstName"], $_POST["lastName"], $_POST["email"]);
		if ($res) {
			header('Location: ./profile.php');
		}
    }
}

?>

<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  
    
  <title>My Profile</title>
  
  <!-- 3. link bootstrap -->
  <!-- if you choose to use CDN for CSS bootstrap -->  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  
  <!-- If you choose to use a favicon, specify the destination of the resource in href -->
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  -->
       
</head>

<body style="background-color: #0F1C48">
    <?php
        include("navBar.php");
    ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

<div class="container">
<div class="row justify-content-md-center">
	<div class="col-10 text-white" style="background-color: #091436">
		<!-- Page title -->
		<div class="my-5">
			<h3>Edit Account</h3>
			<hr>
		</div>
		<!-- Form START -->
		<form class="file-upload" action="" method="POST">
			<div class="row mb-5 gx-5">
				<!-- account detail -->
				<div class="col-12 mb-5 mb-xxl-0">
					<div class="bg-secondary-soft px-4 py-5 rounded">
						<div class="row g-3">
							<h4 class="mb-4 mt-0">Account Details</h4>
							<!-- First Name -->
							<div class="col-md-6">
								<label class="form-label">First Name:</label>
								<input name="firstName" type="text" class="form-control" placeholder="" aria-label="First name" value="<?php echo $firstName ?>">
							</div>
							<!-- Last name -->
							<div class="col-md-6">
								<label class="form-label">Last Name:</label>
								<input name="lastName" type="text" class="form-control" placeholder="" aria-label="Last name" value="<?php echo $lastName ?>">
							</div>
							<!-- username -->
							<div class="col-md-6">
								<label class="form-label">Username:</label>
								<input type="text" class="form-control" placeholder="" aria-label="Username" value="<?php echo $_SESSION['user'] ?>" disabled>
							</div>
							<!-- email -->
							<div class="col-md-6">
								<label class="form-label">Email:</label>
								<input name="email" type="text" class="form-control" placeholder="" aria-label="Email" value="<?php echo $email ?>">
							</div>
						</div> <!-- Row END -->
					</div>
				</div>					
			<!-- button -->
			<div class="col text-center">
				<!-- <button type="submit" class="btn btn-primary">Update profile</button> -->
				<button type="submit" value="update" name="btnAction" class="btn btn-primary">Update Profile</button>   
			</div>
			<div class="col text-center">
				<a role="button" class="btn btn-secondary" href="profile.php">Cancel</a>
			</div>
		</form> <!-- Form END -->
		</div>
	</div>
	</div>
</body>
</html>