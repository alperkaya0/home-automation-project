<!DOCTYPE html>
<html>
<head>
	<link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>    

    <link rel="icon" type="image/x-icon" href="./images/logo.png">
</head>
<body>
	<?php include "../navbar.php" ?>


	<?php
   $conn=mysqli_connect('localhost','meryem','localhost','web');

   if(!$conn)
   {
	   echo "connection error: " . mysqli_connect_error();
   }


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $errors = array();

        if (empty($username)) {
            $errors['username'] = 'A username is required <br />';
        } else {
            $username = $_POST['username'];
            if (!preg_match('/^[a-zA-ZğĞıİöÖçÇşŞüÜ\s]+$/u', $username)) {
                $errors['username'] = 'Username must be letters and spaces only<br />';
            }
        }
        if (empty($password)) {
            $errors['password'] = 'A password is required <br />';
        } else {
            $password = $_POST['password'];
            if (!preg_match('/^[0-9]+$/', $password)) {
                $errors['password'] = 'Password must contain only numbers';
            }
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error;
            }
        } else {
            $sql = "SELECT * FROM register WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    // Giriş başarılı
                    echo "Successful login";
                    header("Location: landingPage.php");
                    exit();
                } else {
                    // Geçersiz kimlik bilgileri
                    echo "Invalid credentials";
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }

	?>

	<div class="shadow p-3 my-5 mx-5 bg-body rounded">Please Login To Proceed</div>

	<div class="container mt-5">
		<div class="row align-items-center">
			<div class="col-4"></div>
			<div class="col-3 ms-5">
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="mb-3">
						<label for="username" class="form-label">Username</label>
						<input type="text" name="username" class="form-control" id="username">
					</div>
					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input name="password" type="password" class="form-control" id="password">
					</div>
					<button type="submit" class="btn btn-primary" value="Login">Submit</button>
				</form>
			</div>
			<div class="col-4"><button class="btn btn-primary" style="margin: 0px" onclick="javascript:window.location.href='./landingPage.php'">Skip Logging In</button></div>
		</div>
	</div>

	

	<?php include '../toast.php' ?>
	<?php include "../footer.php" ?>
</body>
</html>
