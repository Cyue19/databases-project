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

<body>
    <?php
        include("navBar.php");
    ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

<div class="container">
<div class="row">
		<div class="col-12">
			<!-- Page title -->
			<div class="my-5">
				<h3>Account</h3>
				<hr>
			</div>
			<!-- Form START -->
			<form class="file-upload">
				<div class="row mb-5 gx-5">
					<!-- account detail -->
					<div class="col-xxl-8 mb-5 mb-xxl-0">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="mb-4 mt-0">Account Details</h4>
								<!-- First Name -->
								<div class="col-md-6">
									<label class="form-label">First Name:</label>
									<input type="text" class="form-control" placeholder="" aria-label="First name" value="John">
								</div>
								<!-- Last name -->
								<div class="col-md-6">
									<label class="form-label">Last Name:</label>
									<input type="text" class="form-control" placeholder="" aria-label="Last name" value="Smith">
								</div>
								<!-- Phone number -->
								<div class="col-md-6">
									<label class="form-label">Email:</label>
									<input type="text" class="form-control" placeholder="" aria-label="Phone number" value="example@gmail.com">
								</div>
								<!-- Mobile number -->
								<div class="col-md-6">
									<label class="form-label">Password:</label>
									<input type="text" class="form-control" placeholder="" aria-label="Phone number" value="********">
								</div>
							</div> <!-- Row END -->
						</div>
					</div>					
          <!-- personal preferences -->
					<div class="col-xxl-8 mb-5 mb-xxl-0">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="mb-4 mt-0">Personal Preferences</h4>
								<!-- First Name -->
								<div class="col-md-12">
									<label class="form-label">Favorite Genre:</label>
									<input type="text" class="form-control" placeholder="" aria-label="First name" value="Comedy">
								</div>
								<!-- Last name -->
								<div class="col-md-12">
									<label class="form-label">Favorite Movie:</label>
									<input type="text" class="form-control" placeholder="" aria-label="Last name" value="Star Wars">
								</div>
								<!-- Phone number -->
								<div class="col-md-12">
									<label class="form-label">Favorite Show:</label>
									<input type="text" class="form-control" placeholder="" aria-label="Phone number" value="The Office">
								</div>
							</div> <!-- Row END -->
						</div>
					</div>
				<!-- button -->
				<div class="col text-center">
					<button type="button" class="btn btn-primary">Update profile</button>
				</div>
			</form> <!-- Form END -->
		</div>
	</div>
	</div>
</body>
</html>