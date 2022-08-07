<?php
session_start();
ini_set('display_errors', 'on');
//connect to database
include 'connectdb.php';

if(isset($_POST['signup'])) {
    $username=$_POST['pseudo'];
    $fullname=$_POST['fullName'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];  
    $sql = "SELECT * FROM user WHERE pseudo = '$username'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
            if($result) {
                    echo '<script language="javascript">';
                    echo 'alert("Username already exists")';
                    echo '</script>';
            } else {
                    if($password==$password2) {
                            $password=md5($password); //hash password before storing for security purposes
                            $sql="INSERT INTO user(pseudo,fullname,phone,email,password) VALUES('$username','$fullname','$phone','$email','$password')";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();
                            header("location:login.php");  //redirect home page
                    } else {
                            $_SESSION['message']="The two password do not match";   
                    }
                }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon-16x16.png">
    <link rel="manifest" href="./assets/site.webmanifest">
    <title>Register</title>
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="index.php">
                    <p>Mafkoud</p>
                </a>
            </div>
            <nav>
                <ul class="profil">
                    <li><a href="login.php">Login</a></li>
                    <li><a href="missing.php">Missing</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div id="register">
            <div>
                <h1>Register</h1>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div>
                        <label for="pseudo">Pseudo :</label>
                        <input type="text" name="pseudo" id="pseudo" />
                    </div>
                    <div>
                        <label for="fullName">Full Name :</label>
                        <input type="text" name="fullName" id="fullName" />
                    </div>
                    <div>
                        <label for="phone">Phone :</label>
                        <input type="text" name="phone" id="phone" />
                    </div>
                    <div>
                        <label for="email">Email :</label>
                        <input type="text" name="email" id="email" />
                    </div>
                    <div>
                        <label for="password">Password :</label>
                        <input type="password" name="password" id="password" />
                    </div>
                    <div>
                        <label for="password2">Password :</label>
                        <input type="password" name="password2" id="password2" />
                    </div>
                    <div>
                        <button type="submit" name="signup">Signup</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>