<?php
session_start();
ini_set('display_errors', 'on');
include 'connectdb.php';
if($db) {
    if(($_SESSION['isAdmin'] == 0)) {
        header("location:index.php");
    }
} else {
    echo "Error";
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
    <title>Admin</title>
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
        <section>
            <div>
                <div>
                    <img src="./assets/images/card.png" alt="profil">
                </div>
                <?php 
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM user WHERE iduser = $id";
                    $result = $db->query($sql);
                    $row = $result->fetch();
                ?>
                <div>
                    <p>Pseudo: <span id="pseudo"><?php echo $row['pseudo'] ?></span></p>
                    <p>Full Name: <span id="name"><?php echo $row['fullName'] ?></span></p>
                    <p>Phone Number: <span id="phone"><?php echo $row['phone'] ?></span></p>
                    <p>Email: <span id="mail"><?php echo $row['email'] ?></span></p>
                </div>
            </div>
            <?php
            if (isset($_POST['updateProfil'])) {
                header("location:updateProfil.php?id=$id");
            }

            if (isset($_POST['deleteProfil'])) {
                $sql = "DELETE FROM user WHERE iduser = $id";
                $result = $db->query($sql);
                session_start();
                session_destroy();
                unset($_SESSION['pseudo']);
                unset($_SESSION['iduser']);
                header("location:index.php");
            }
            ?>
            <div>
                <div>
                    <form action="" method="post">
                        <button type="submit" name="updateProfil">Update</button>
                    </form>
                    <form action="" method="post">
                        <button type="submit" name="deleteProfil">Delete</button>
                    </form>
                </div>
            </div>
            <div id="label">
                <div>
                    <h1>Missing Persons ...</h1>
                </div>
                <?php 
                    $sql = "SELECT * FROM missing ORDER BY idMissing DESC";
                    $result = $db->query($sql);
                    while ($row = $result->fetch()) {
                        $_idIsActive = isset($_POST['idIsActive']) ? $_POST['idIsActive'] : null;
                        $_idUpdate = isset($_POST['idUpdate']) ? $_POST['idUpdate'] : null;
                        $_idDelete = isset($_POST['idDelete']) ? $_POST['idDelete'] : null;
                        echo '<article>';
                        echo '<div>';
                        echo '<h2>ID : ' . $row['idmissing'] . ' -<img src="' . $row['photo'] . '"/>- ' . $row['lastName'] . " " . $row['firstName'] . '</h2>';
                        echo '</div>';
                        echo '<div>';
                        if(isset($_POST['active'])) {
                            $sql = "UPDATE missing SET isActive = 1 WHERE idmissing = $_idIsActive";
                            $db->query($sql);
                            header('Location: admin.php?id=' . $id);
                        }
                        echo '<form action="" method="POST">';
                        echo '<input type="hidden" name="idIsActive" value="' . $row['idmissing'] . '">';
                        echo '<button type="submit" name="active">';
                        if ($row['isActive'] == 1) {
                            echo '<img src="./assets/images/isActive.png" alt="isActive" title="isActive">';
                        } else {
                            echo '<img src="./assets/images/isNotActive.png" alt="isNotActive" title="isNotActive">';
                        }
                        echo '</button>';
                        echo '</form>';
                        if (isset($_POST['update'])) {
                            header("location:updateMissing.php?id=$_idUpdate");
                        }
                        echo '<form action="" method="POST">';
                        echo '<input type="hidden" name="idUpdate" value="' . $row['idmissing'] . '">';
                        echo '<button type="submit" name="update">';
                        echo '<img src="./assets/images/Update.png" alt="Update">';
                        echo '</button>';
                        echo '</form>';
                        if (isset($_POST['delete'])) {
                            $sql = "DELETE FROM missing WHERE idmissing = $_idDelete";
                            $result = $db->query($sql);
                            header('Location: admin.php?id=' . $id);
                        }
                        echo '<form action="" method="POST">';
                        echo '<input type="hidden" name="idDelete" value="' . $row['idmissing'] . '">';
                        echo '<button type="submit" name="delete">';
                    echo '<img src="./assets/images/Delete.png" alt="Delete">';
                    echo '</button>';
                echo '</form>';
                echo '
            </div>';
            echo '</article>';
            }
            ?>
            </div>
        </section>
    </main>
<?php include 'footer.php'; ?>

</body>

</html>