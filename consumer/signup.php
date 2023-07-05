<!DOCTYPE html>
<html>
<head>
	<link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>    

    <link rel="icon" type="image/x-icon" href="../consumer/images/logo.png"></head>
<body>
	<?php include "../navbar.php" ?>


	<?php

$conn=mysqli_connect('localhost','meryem','localhost','web');

if(!$conn)
{
	echo "connection error: " . mysqli_connect_error();
}

if(isset($_POST["submit"])){
	$name=$_POST["name"];
	$surname=$_POST["surname"];
	$username=$_POST["username"];
	$password=$_POST["password"];
	$duplicate=mysqli_query($conn,"SELECT * FROM register WHERE username='$username'");


	$errors = array();

		if (empty($name) || empty($surname) || empty($username) || empty($password)) {
			$errors[] = 'Please fill in all fields.';
		} else {
			if (!preg_match("/^[a-zA-Z]+$/", $name)) {
				$errors[] = 'Name can only contain letters (a-zA-Z).';
			}
			if (!preg_match("/^[a-zA-Z]+$/", $surname)) {
				$errors[] = 'Surname can only contain letters (a-zA-Z).';
			}
			if (!preg_match("/^[a-zA-Z]+$/", $username)) {
				$errors[] = 'Username can only contain letters (a-zA-Z).';
			}
			if (!preg_match("/^[0-9]+$/", $password)) {
				$errors[] = 'Password can only contain numbers (0-9).';
			}
		}

		if (!empty($errors)) {
			foreach ($errors as $error) {
				echo '<span style="color:red;">'.$error.'</span><br>';
			}
		}

		

		$duplicate = mysqli_query($conn, "SELECT * FROM register WHERE username='$username'");
        if (mysqli_num_rows($duplicate) > 0) {
            echo '<span style="color:red;">Username already exists.</span>';
        } else {
            // Hata olmadığı durumda veritabanına kaydetme işlemi yapabilirsiniz
            $query = "INSERT INTO register VALUES('$name','$surname','$username','$password')";
            mysqli_query($conn, $query);
            header("location: login.php");
        
	}
}

	?>

	<div class="shadow p-3 my-5 mx-5 bg-body rounded">Please Signup To Proceed</div>

	<div class="container mt-5">
		<div class="row align-items-center">
			<div class="col-4"></div>
			<div class="col-3 ms-5">
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<?php if (!empty($errors)) {
						foreach ($errors as $error) {
							echo '<span style="color:red;">'.$error.'</span>';
						}
					}
					?>
					<div class="mb-3">
						<label for="username" class="form-label">Name</label>
						<input type="text" name="name" class="form-control" id="name">
						
					</div>
					<div class="mb-3">
						<label for="username" class="form-label">Surname</label>
						<input type="text" name="surname" class="form-control" id="surname">
						
					</div>
					<div class="mb-3">
						<label for="username" class="form-label">Username</label>
						<input type="text" name="username" class="form-control" id="username">
						
					</div>
					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input name="password" type="password" class="form-control" id="password">
						
					</div>
					<button type="submit" name="submit" class="btn btn-primary" >Submit</button>
				</form>
			</div>
		</div>
	</div>

	
	
	<?php include '../toast.php' ?>
	<?php include "../footer.php" ?>
</body>
</html>
