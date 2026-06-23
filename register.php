<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';
$message = "";

if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($check);

    if($result->num_rows > 0)
    {
        $message = "<p class='error'>Email already exists</p>";
    }
    else
    {
        $sql = "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')";

        if($conn->query($sql))
        {
            $message = "<p class='success'>Registration Successful</p>";
        }
        else
        {
            $message = "<p class='error'>Error: " . $conn->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
<h2>User Registration</h2>

<?php echo $message; ?>

<form method="POST">

<input type="text" name="name" placeholder="Name" required><br><br>

<input type="email" name="email" placeholder="Email" required><br><br>

<input type="password" name="password" placeholder="Password" required><br><br>

<button type="submit" name="register">Register</button>

</form>

<a href="login.php"> already have an account? Login Here</a>
</div>
</body>
</html>