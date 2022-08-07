<?php
    session_start();
    ini_set('display_errors', 'on');
    include 'connectdb.php';

    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $sql = "SELECT * FROM missing WHERE idmissing = $id";
    $result = $db->prepare($sql);
    $result->execute();
    $missing = $result->fetch();
    
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
    <title>Fiche de <?php echo $missing['firstName'] . " " . $missing['lastName'] ?></title>
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
                <ul>
                    <li><a href="<?php
                    if (isset($_SESSION['pseudo'])) {
                        if ($_SESSION['isAdmin'] === 1) {
                            echo "admin.php?id=" . $_SESSION['iduser'];
                        } else {
                            echo "profil.php?id=" . $_SESSION['iduser'];
                        }
                    } else {
                        echo "login.php";
                    }
                    ?>">Profil</a>
                    </li>
                    <li><a href="missing.php">Missing</a></li>
                    <?php 
                    if (isset($_SESSION['pseudo'])) {
                        echo "<li><a href='logout.php'>Logout</a></li>";
                    } else {
                        echo "<li><a href='login.php'>Login</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>
    <main id="profil">
        <aside>
            <div>
                <img src="<?php echo $missing['photo'] ?>" alt="missing Person">
            </div>
            <div>
                <p>Height :<span><?php echo $missing['height'] ?></span> Cm</p>
                <p>Weight :<span><?php echo $missing['weight']  ?></span> Kg</p>
                <p>Hair :<span><?php echo $missing['hair']  ?></span></p>
                <p>Eyes :<span><?php echo $missing['eyes']  ?></span></p>
                <p>Sexe :<span><?php echo $missing['Sexe']  ?></span></p>
                <p>Mental Ilness :<span><?php echo $missing['mentalIlness'] ? "Yes" : "No" ?></span></p>
                <p>Age Of Missing :<span><?php echo $missing['ageOfMissing']  ?></span> Years</p>
            </div>
        </aside>
        <section id="info">
            <div>
                <div>
                    <p>First Name :<span><?php echo $missing['firstName']  ?></span></p>
                    <p>Birth Date :<span><?php echo $missing['birthDate']  ?></span></p>
                    <p>Current Adress :<span><?php echo $missing['currentAdress']  ?></span></p>
                    <p>City :<span><?php echo $missing['city']  ?></span></p>
                    <p>City Of Missing :<span><?php echo $missing['cityOfMissing']  ?></span></p>
                    <p>Date Of Missing :<span><?php echo $missing['dateOfMissing']  ?></span></p>
                    <p>Blood :<span><?php echo $missing['blood']  ?></span></p>
                    <p>Diabet :<span><?php echo $missing['diabet'] ? "Yes" : "No"; ?></span></p>
                    <p>BirthMarks :<span><?php echo $missing['birthmarks'] ? "Yes" : "No";  ?></span></p>
                </div>
                <div>
                    <p>Last Name :<span><?php echo $missing['lastName']  ?></span></p>
                    <p>Birth Place :<span><?php echo $missing['BirthPlace']  ?></span></p>
                    <p>Previous Adress :<span><?php echo $missing['previousAdress']  ?></span></p>
                    <p>Wilaya :<span><?php echo $missing['wilaya']  ?></span></p>
                    <p>wilaya Of Missing :<span><?php echo $missing['wilayaOfMissing']  ?></span></p>
                    <p>Phone :<span>0<?php echo $missing['phone']  ?></span></p>
                    <p>Blood Pressure :<span><?php echo $missing['bloodPressure'] ? "Yes" : "No";  ?></span></p>
                    <p>Tatoos :<span><?php echo $missing['tatoos'] ? "Yes" : "No";  ?></span></p>
                    <p>Scars :<span><?php echo $missing['scars'] ? "Yes" : "No";  ?></span></p>
                </div>
            </div>
            <div>
                <p>Describing The Situation Of Missing :<span><?php echo $missing['describing']  ?></span></p>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>