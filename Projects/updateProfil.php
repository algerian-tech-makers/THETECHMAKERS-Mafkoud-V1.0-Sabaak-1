<?php
session_start();
ini_set('display_errors', 'on');
//connect to database
include 'connectdb.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
$sql = "SELECT * FROM user WHERE iduser = $id";
$result = $db->query($sql);
$row = $result->fetch();

if (isset($_POST['update'])) {
    $fullName = $_POST['fullName'] !== '' ? $_POST['fullName'] : $row['fullName'];
    $phone = $_POST['phone'] !== '' ? $_POST['phone'] : $row['phone'];
    $email = $_POST['email'] !== '' ? $_POST['email'] : $row['email'];
    $password = $_POST['password'] !== '' ? md5($_POST['password']) : $row['password'];
    $stmt = "UPDATE user SET fullName='$fullName', phone='$phone', email='$email', password='$password' WHERE iduser='$id'";
    $result = $db->prepare($stmt);
    $result->execute();
    header("location:profil.php?id=$id");
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
    <title>updateProfil</title>
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
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="missing.php">Missing</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div id="register">
            <div>
                <h1>Update Profil</h1>
                <form action="" method="post">
                    <div>
                        <label for="pseudo">Pseudo :</label>
                        <input type="text" name="pseudo" id="pseudo" placeholder="<?php echo $row['pseudo'] ?>"
                            disabled />
                    </div>
                    <div>
                        <label for="fullName">Full Name :</label>
                        <input type="text" name="fullName" id="fullName" placeholder="<?php echo $row['fullName'] ?>""/>
                    </div>
                    <div>
                        <label for=" phone">Phone :</label>
                        <input type="text" name="phone" id="phone" placeholder="<?php echo $row['phone'] ?>""/>
                    </div>
                    <div>
                        <label for=" email">Email :</label>
                        <input type="text" name="email" id="email" placeholder="<?php echo $row['email'] ?>""/>
                    </div>
                    <div>
                        <label for=" password">Password :</label>
                        <input type="password" name="password" id="password" />
                    </div>
                    <div>
                        <button type="submit" name="update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>