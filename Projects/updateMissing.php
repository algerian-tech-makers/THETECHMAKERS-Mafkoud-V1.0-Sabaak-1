<?php
    session_start();
    ini_set('display_errors', 'on');
    include 'connectdb.php';
    if (!isset( $_SESSION['iduser'] )) {
        header("location:login.php");
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM missing WHERE idmissing = $id";
    $result = $db->query($sql);
    $row = $result->fetch();

    if (isset($_POST['update'])) {
        $fisrtName = $_POST['firstName'] != '' ? $_POST['firstName'] : $row['firstName'];
        $lastName = $_POST['lastName'] != '' ? $_POST['lastName'] : $row['lastName'];
        $birthDate = $_POST['birthDate'] != '' ? $_POST['birthDate'] : $row['birthDate'];
        $BirthPlace = $_POST['BirthPlace'] != '' ? $_POST['BirthPlace'] : $row['BirthPlace'];
        $ageOfMissing = $_POST['ageOfMissing'] != '' ? $_POST['ageOfMissing'] : $row['ageOfMissing'];
        $Sexe = $_POST['Sexe'] != $row['Sexe'] ? $_POST['Sexe'] : $row['Sexe'];
        $currentAdress = $_POST['currentAdress'] != '' ? $_POST['currentAdress'] : $row['currentAdress'];
        $previousAdress = $_POST['previousAdress'] != '' ? $_POST['previousAdress'] : $row['previousAdress'];
        $city = $_POST['city'] != '' ? $_POST['city'] : $row['city'];
        $wilaya = $_POST['wilaya'] !=  $row['wilaya'] ? $_POST['wilaya'] : $row['wilaya'];
        $cityOfMissing = $_POST['cityOfMissing'] != '' ? $_POST['cityOfMissing'] : $row['cityOfMissing'];
        $wilayaOfMissing = $_POST['wilayaOfMissing'] != $row['wilayaOfMissing'] ? $_POST['wilayaOfMissing'] : $row['wilayaOfMissing'];
        $dateOfMissing = $_POST['dateOfMissing'] != '' ? $_POST['dateOfMissing'] : $row['dateOfMissing'];
        $phone = $_POST['phone'] != '' ? $_POST['phone'] : $row['phone'];
        $height = $_POST['height'] != '' ? $_POST['height'] : $row['height'];
        $weight = $_POST['weight'] != '' ? $_POST['weight'] : $row['weight'];
        $hair = $_POST['hair'] != '' ? $_POST['hair'] : $row['hair'];
        $eyes = $_POST['eyes'] != '' ? $_POST['eyes'] : $row['eyes'];
        $blood = $_POST['blood'] != $row['blood'] ? $_POST['blood'] : $row['blood'];
        $bloodPressure = isset($_POST['bloodPressure']) ?  1 : 0;
        $diabet = isset($_POST['diabet']) ?  1 : 0;
        $mentalIlness = isset($_POST['mentalIlness']) ?  1 : 0;
        $tatoos =  isset($_POST['tatoos']) ?  1 : 0;
        $birthmarks = isset($_POST['birthmarks']) ?  1 : 0;
        $scars = isset($_POST['scars']) ?  1 : 0;
        
        if ($_FILES['photo']['name'] != "") {
            $pictureName = $_FILES["photo"]["name"];
            $pictureTmpName = $_FILES["photo"]["tmp_name"];
            $pictureSize = $_FILES["photo"]["size"];
            $pictureError = $_FILES["photo"]["error"];
            $pictureType = $_FILES["photo"]["type"];
            $pictureExt = explode(".", $pictureName);
            $pictureActualExt = strtolower(end($pictureExt));
            $allowed = array("jpg", "jpeg", "png");
            $photo = "./images/" . rand() . $pictureName;
                unlink($row['photo']);
                move_uploaded_file($pictureTmpName, $photo);
        } else {
            $photo = $row['photo'];
        }

        $sql = "UPDATE missing SET firstName = '$fisrtName', lastName = '$lastName', birthDate = '$birthDate', BirthPlace = '$BirthPlace', ageOfMissing = '$ageOfMissing', Sexe = '$Sexe', currentAdress = '$currentAdress', previousAdress = '$previousAdress', city = '$city', wilaya = '$wilaya', cityOfMissing = '$cityOfMissing', wilayaOfMissing = '$wilayaOfMissing', dateOfMissing = '$dateOfMissing', phone = '$phone', height = '$height', weight = '$weight', hair = '$hair', eyes = '$eyes', blood = '$blood', bloodPressure = '$bloodPressure', diabet = '$diabet', mentalIlness = '$mentalIlness', tatoos = '$tatoos', birthmarks = '$birthmarks', scars = '$scars', photo = '$photo' WHERE idmissing = $id";
        $result = $db->query($sql);
        header("location:fiche.php?id=$id");
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
    <title>Update Missing</title>
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
                    <li><a
                            href="<?php echo $_SESSION['isAdmin'] ? 'admin.php?id=' . $_SESSION['iduser'] :  'profil.php?id=' . $_SESSION['iduser']?>">Profil</a>
                    </li>
                    <li><a href="missing.php">Missing</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="missing_form">
            <div>
                <h1>Update Missing Person</h1>
            </div>
            <div class="form">
                <form action="" enctype="multipart/form-data" method="POST">
                    <div>
                        <div>
                            <label for="firstName">First Name :</label>
                            <input type="text" name="firstName" id="firstName"
                                placeholder="<?php echo $row['firstName'] ?>" />
                        </div>
                        <div>
                            <label for="lastName">Last Name :</label>
                            <input type="text" name="lastName" id="lastName"
                                placeholder="<?php echo $row['lastName'] ?>" />
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="birthDate">Birth Date :</label>
                            <input type="date" name="birthDate" id="birthDate"
                                value="<?php echo $row['birthDate'] ?>" />
                            <label for="BirthPlace">Birth Place :</label>
                            <input type="text" name="BirthPlace" id="BirthPlace"
                                placeholder="<?php echo $row['BirthPlace'] ?>" />
                        </div>
                        <div>
                            <label for="ageOfMissing">Age Of Missing :</label>
                            <input type="number" name="ageOfMissing" id="ageOfMissing"
                                placeholder="<?php echo $row['ageOfMissing'] ?>" />
                            <label for="Sexe">Sexe :</label>
                            <select name="Sexe" id="Sexe">
                                <option value="<?php echo $row['Sexe'] ?>"><?php echo $row['Sexe'] ?></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="currentAdress">Current Adress :</label>
                        <input type="text" name="currentAdress" id="currentAdress"
                            placeholder="<?php echo $row['currentAdress'] ?>" />
                    </div>
                    <div>
                        <label for="previousAdress">Previous Adress :</label>
                        <input type="text" name="previousAdress" id="previousAdress"
                            placeholder="<?php echo $row['previousAdress'] ?>" />
                    </div>
                    <div>
                        <div>
                            <label for="city">City :</label>
                            <input type="text" name="city" id="city" placeholder="<?php echo $row['city'] ?>" />
                        </div>
                        <div>
                            <label for="wilaya">Wilaya :</label>
                            <select name="wilaya" id="wilaya">
                                <option value="<?php echo $row['wilaya'] ?>"><?php echo $row['wilaya'] ?></option>
                                <option value="Alger">Alger</option>
                                <option value="Annaba">Annaba</option>
                                <option value="Oran">Oran</option>
                                <option value="Constantine">Constantine</option>
                                <option value="Tipaza">Tipaza</option>
                                <option value="Boumerdes">Boumerdes</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="cityOfMissing">City Of Missing :</label>
                            <input type="text" name="cityOfMissing" id="cityOfMissing"
                                placeholder="<?php echo $row['cityOfMissing'] ?>" />
                        </div>
                        <div>
                            <label for="wilayaOfMissing">Wilaya Of Missing :</label>
                            <select name="wilayaOfMissing" id="wilayaOfMissing">
                                <option value="<?php echo $row['wilayaOfMissing'] ?>">
                                    <?php echo $row['wilayaOfMissing'] ?></option>
                                <option value="Alger">Alger</option>
                                <option value="Annaba">Annaba</option>
                                <option value="Oran">Oran</option>
                                <option value="Constantine">Constantine</option>
                                <option value="Tipaza">Tipaza</option>
                                <option value="Boumerdes">Boumerdes</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="dateOfMissing">Date Of Missing :</label>
                            <input type="date" name="dateOfMissing" id="dateOfMissing"
                                value="<?php echo $row['dateOfMissing'] ?>" />
                        </div>
                        <div>
                            <label for="phone">Phone :</label>
                            <input type="tel" name="phone" id="phone" placeholder="0<?php echo $row['phone'] ?>" />
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="height">Height :</label><input type="number" name="height" id="height"
                                placeholder="<?php echo $row['height'] ?> (Cm)" />
                            <label for="weight">Weight :</label><input type="number" name="weight" id="weight"
                                placeholder="<?php echo $row['weight'] ?> (Kg)" />
                        </div>
                        <div>
                            <label for="hair">Hair :</label><input type="text" name="hair" id="hair"
                                placeholder="<?php echo $row['hair'] ?> Color" />
                            <label for="eyes">Eyes :</label><input type="text" name="eyes" id="eyes"
                                placeholder="<?php echo $row['eyes'] ?> Color" />
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="photo">Photo :<input type="file" name="photo" id="photo" />
                                <span class="file">Upload ...</span></label>
                            <label for="blood">Blood :</label><select name="blood" id="blood">
                                <option value="<?php echo $row['blood'] ?>">
                                    <?php echo $row['blood'] ?></option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="O">O</option>
                                <option value="AB">AB</option>
                            </select>
                        </div>
                        <div>
                            <label for="bloodPressure" class="label">Blood Pressure :<input type="checkbox"
                                    name="bloodPressure" id="bloodPressure"
                                    <?php echo $row['bloodPressure'] == 1 ? "checked" : null ?> />
                                <span class="checkmark"></span></label>
                            <label for="diabet" class="label">diabet<input type="checkbox" name="diabet" id="diabet"
                                    value="diabet" <?php echo $row['diabet'] == 1 ? "checked" : null ?> />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="mentalIlness" class="label">Mental Ilness :<input type="checkbox"
                                    name="mentalIlness" id="mentalIlness"
                                    <?php echo $row['mentalIlness'] == 1 ? "checked" : null ?> />
                                <span class="checkmark"></span></label>
                            <label for="tatoos" class="label">Tatoos :<input type="checkbox" name="tatoos" id="tatoos"
                                    value="tatoos" <?php echo $row['tatoos'] == 1 ? "checked" : null ?> />
                                <span class="checkmark"></span></label>
                        </div>
                        <div>
                            <label for="birthmarks" class="label">Birthmarks<input type="checkbox" name="birthmarks"
                                    id="birthmarks" <?php echo $row['birthmarks'] == 1 ? "checked" : null ?> />
                                <span class="checkmark"></span></label>
                            <label for="scars" class="label">scars<input type="checkbox" name="scars" id="scars"
                                    value="scars" <?php echo $row['scars'] == 1 ? "checked" : null ?> />
                                <span class="checkmark"></span></label>
                        </div>
                    </div>
                    <div>
                        <textarea name="describing" id="describing"
                            placeholder="Describe the circumstances of the disappearance ... <?php echo $row['describing'] ?>"></textarea>
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