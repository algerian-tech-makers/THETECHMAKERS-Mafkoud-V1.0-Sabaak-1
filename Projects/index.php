<?php 
    session_start();
    ini_set('display_errors', 'on');
    include 'connectdb.php';
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
    <title>Mafkoud</title>
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="index.php">
                    <p>Mafkoud</p>
                </a>
            </div>
            <?php if (isset($_SESSION['iduser'])) {
                echo '<nav>
                    <ul class="profil">
                        <li><a href="logout.php">Logout</a></li>
                        <li><a href="missing.php">Missing</a></li>
                    </ul>
                </nav>';
            } else {
                echo '<nav>
                    <ul class="profil">
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    </ul>
                </nav>';
            } ?>
        </div>
    </header>
    <main>
        <div class="dash">
            <div>
                <h1>
                    Find the people<br />
                    who matter<br />
                    to you !!!
                </h1>
            </div>
            <div class="form">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <input type="text" name="firstName" id="firstName" placeholder="First Name" />
                    <input type="text" name="lastName" id="lastName" placeholder="Last Name" />
                    <input type="text" name="city" id="city" placeholder="City" />
                    <select name="wilaya" id="wilaya">
                        <option value="">wilaya</option>
                        <option value="Alger">Alger</option>
                        <option value="Annaba">Annaba</option>
                        <option value="Oran">Oran</option>
                        <option value="Constantine">Constantine</option>
                        <option value="Tipaza">Tipaza</option>
                        <option value="Boumerdes">Boumerdes</option>
                    </select>
                    <button type="submit" name="find">Find</button>
                </form>
            </div>
        </div>
        <section id="search">
            <?php 
            $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
            $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
            $city = isset($_POST['city']) ? $_POST['city'] : '';
            $wilaya = isset($_POST['wilaya']) ? $_POST['wilaya'] : '';

            if (isset($_POST['find'])) {
                $sql = "SELECT * FROM missing WHERE isActive = 1 AND isFind = 0 AND firstName LIKE '$firstName' AND lastName LIKE '$lastName' AND (city LIKE '$city' OR wilaya LIKE '$wilaya')";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                if($result) {
                    foreach ($result as $row) {
                        echo '<a href="fiche.php?id='.$row['idmissing'].'">';
                        echo '<article class="card">';
                        echo '<div class="card_img">';
                        echo '<img src="'.$row['photo'].'" alt="card_img" />';
                        echo '</div>';
                        echo '<div class="card_text">';
                        echo '<h3>';
                        echo '<span>'.$row['firstName'].' </span>';
                        echo '<span>'.$row['lastName'].'</span>';
                        echo '</h3>';
                        echo '<h4>';
                        echo '<span>'.$row['city'].' </span>';
                        echo '<span>'.$row['wilaya'].'</span>';
                        echo '</h4>';
                        echo '<p>';
                        echo '<span>Age: '.$row['ageOfMissing'].' years</span>';
                        echo '<br />';
                        echo '<span>';
                        echo '<img src="./assets/images/heart.png" alt="heart" />';
                        echo '</span>';
                        echo '<span>Last Seen:<br> '.$row['dateOfMissing'].'</span>';
                        echo '</p>';
                        echo '</div>';
                        echo '</article>';
                        echo '</a>';
                    }
                } else {
                    echo '<p>No result found</p>';
                }

            }
            ?>
        </section>
        <div class="main">
            <h2>Last Missing !!!</h2>
            <div id="card">
                <?php
        try {
          $stmt=$db->prepare("SELECT * FROM missing WHERE isActive = 1 AND isFind = 0 ORDER BY idmissing DESC LIMIT 16");
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row){
            echo '<a href="fiche.php?id='.$row['idmissing'].'">';
            echo '<article class="card">';
            echo '<div class="card_img">';
            echo '<img src="'.$row['photo'].'" alt="card_img" />';
            echo '</div>';
            echo '<div class="card_text">';
            echo '<h3>';
            echo '<span>'.$row['firstName'].' </span>';
            echo '<span>'.$row['lastName'].'</span>';
            echo '</h3>';
            echo '<h4>';
            echo '<span>'.$row['city'].' </span>';
            echo '<span>'.$row['wilaya'].'</span>';
            echo '</h4>';
            echo '<p>';
            echo '<span>Age: '.$row['ageOfMissing'].' years</span>';
            echo '<br />';
            echo '<span>';
            echo '<img src="./assets/images/heart.png" alt="heart" id="heart"/>';
            echo '</span>';
            echo '<span>Last Seen:<br> '.$row['dateOfMissing'].'</span>';
            echo '</p>';
            echo '</div>';
            echo '</article>';
            echo '</a>';
          }
        } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
         ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>