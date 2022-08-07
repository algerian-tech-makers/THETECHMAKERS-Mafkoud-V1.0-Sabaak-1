<?php
    session_start();
    ini_set('display_errors', 'on');
    include 'connectdb.php';
    if (!isset( $_SESSION['iduser'] )) {
        header("location:login.php");
    }
    if (isset($_POST["create"])) {
        $idUser = $_SESSION["iduser"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $birthDate = $_POST["birthDate"];
        $birthPlace = $_POST["birthPlace"];
        $ageOfMissing = $_POST["ageOfMissing"];
        $sexe = $_POST["sexe"];
        $currentAdress = $_POST["currentAdress"];
        $previousAdress = $_POST["previousAdress"];
        $city = $_POST["city"];
        $wilaya = $_POST["wilaya"];
        $cityOfMissing = $_POST["cityOfMissing"];
        $wilayaOfMissing = $_POST["wilayaOfMissing"];
        $dateOfMissing = $_POST["dateOfMissing"];
        $phone = $_POST["phone"];
        $height = $_POST["height"];
        $weight = $_POST["weight"];
        $hair = $_POST["hair"];
        $eyes = $_POST["eyes"];
        $blood = $_POST["blood"];
        $bloodPressure = isset($_POST["bloodPressure"]) ? 1 : 0;
        $diabet = isset($_POST["diabet"]) ? 1 : 0;
        $mentalIlness = isset($_POST["mentalIlness"]) ? 1 : 0;
        $tatoos = isset($_POST["tatoos"]) ? 1 : 0;
        $birthMarks = isset($_POST["birthmarks"]) ? 1 : 0;
        $scars = isset($_POST["scars"]) ? 1 : 0;
        $describing = $_POST["describing"];

        $pictureName = $_FILES["photo"]["name"];
        $pictureTmpName = $_FILES["photo"]["tmp_name"];
        $pictureSize = $_FILES["photo"]["size"];
        $pictureError = $_FILES["photo"]["error"];
        $pictureType = $_FILES["photo"]["type"];
        $pictureExt = explode(".", $pictureName);
        $pictureActualExt = strtolower(end($pictureExt));
        $allowed = array("jpg", "jpeg", "png");

        $photo = "./images/" . rand() . $pictureName;
        move_uploaded_file($pictureTmpName, $photo);

    try {
        $sql = "INSERT INTO missing(user_iduser,firstName,lastName,birthDate,BirthPlace,ageOfMissing,Sexe,currentAdress,previousAdress,city,wilaya,cityOfMissing,wilayaOfMissing,dateOfMissing,phone,height,weight,hair,eyes,photo,blood,bloodPressure,diabet,mentalIlness,tatoos,birthmarks,scars,describing) VALUES(:user_iduser,:firstName,:lastName,:birthDate,:birthPlace,:ageOfMissing,:Sexe,:currentAdress,:previousAdress,:city,:wilaya,:cityOfMissing,:wilayaOfMissing,:dateOfMissing,:phone,:height,:weight,:hair,:eyes,:photo,:blood,:bloodPressure,:diabet,:mentalIlness,:tatoos,:birthmarks,:scars,:describing)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":user_iduser", $idUser);
        $stmt->bindParam(":firstName", $firstName);
        $stmt->bindParam(":lastName", $lastName);
        $stmt->bindParam(":birthDate", $birthDate);
        $stmt->bindParam(":birthPlace", $birthPlace);
        $stmt->bindParam(":ageOfMissing", $ageOfMissing);
        $stmt->bindParam(":Sexe", $sexe);
        $stmt->bindParam(":currentAdress", $currentAdress);
        $stmt->bindParam(":previousAdress", $previousAdress);
        $stmt->bindParam(":city", $city);
        $stmt->bindParam(":wilaya", $wilaya,);
        $stmt->bindParam(":cityOfMissing", $cityOfMissing);
        $stmt->bindParam(":wilayaOfMissing", $wilayaOfMissing);
        $stmt->bindParam(":dateOfMissing", $dateOfMissing);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":height", $height);
        $stmt->bindParam(":weight", $weight);
        $stmt->bindParam(":hair", $hair);
        $stmt->bindParam(":eyes", $eyes);
        $stmt->bindParam(":blood", $blood);
        $stmt->bindParam(":bloodPressure", $bloodPressure);
        $stmt->bindParam(":diabet", $diabet);
        $stmt->bindParam(":mentalIlness", $mentalIlness);
        $stmt->bindParam(":tatoos", $tatoos);
        $stmt->bindParam(":birthmarks", $birthMarksR);
        $stmt->bindParam(":scars", $scars);
        $stmt->bindParam(":photo", $photo);
        $stmt->bindParam(":describing", $describing);
        $stmt->execute();
        header("Location: ./index.php");
        }
    catch (Exception $e) {
        echo "Error: " . $e->getMessage();
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
    <title>Missing</title>
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
                <h1>Missing Person</h1>
            </div>
            <div class="form">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="POST">
                    <div>
                        <div>
                            <label for="firstName">First Name :</label>
                            <input type="text" name="firstName" id="firstName" placeholder="First Name" />
                        </div>
                        <div>
                            <label for="lastName">Last Name :</label>
                            <input type="text" name="lastName" id="lastName" placeholder="Last Name" />
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="birthDate">Birth Date :</label>
                            <input type="date" name="birthDate" id="birthDate" placeholder="Birth Date" />
                            <label for="birthPlace">Birth Place :</label>
                            <input type="text" name="birthPlace" id="birthPlace" placeholder="Birth Place" />
                        </div>
                        <div>
                            <label for="ageOfMissing">Age Of Missing :</label>
                            <input type="number" name="ageOfMissing" id="ageOfMissing" placeholder="Age Of Missing" />
                            <label for="sexe">Sexe :</label>
                            <select name="sexe" id="sexe">
                                <option value="">sexe</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="currentAdress">Current Adress :</label>
                        <input type="text" name="currentAdress" id="currentAdress" placeholder="Current Adress" />
                    </div>
                    <div>
                        <label for="previousAdress">Previous Adress :</label>
                        <input type="text" name="previousAdress" id="previousAdress" placeholder="Previous Adress" />
                    </div>
                    <div>
                        <div>
                            <label for="city">City :</label>
                            <input type="text" name="city" id="city" placeholder="City" />
                        </div>
                        <div>
                            <label for="wilaya">Wilaya :</label>
                            <select name="wilaya" id="wilaya">
                                <option value="">wilaya</option>
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
                            <input type="text" name="cityOfMissing" id="cityOfMissing" placeholder="City Of Missing" />
                        </div>
                        <div>
                            <label for="wilayaOfMissing">Wilaya Of Missing :</label>
                            <select name="wilayaOfMissing" id="wilayaOfMissing">
                                <option value="">wilaya</option>
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
                            <input type="date" name="dateOfMissing" id="dateOfMissing" placeholder="Date Of Missing" />
                        </div>
                        <div>
                            <label for="phone">Phone :</label>
                            <input type="tel" name="phone" id="phone" placeholder="Phone" />
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="height">Height :</label><input type="number" name="height" id="height"
                                placeholder="Height (Cm)" />
                            <label for="weight">Weight :</label><input type="number" name="weight" id="weight"
                                placeholder="Weight (Kg)" />
                        </div>
                        <div>
                            <label for="hair">Hair :</label><input type="text" name="hair" id="hair"
                                placeholder="Hair Color" />
                            <label for="eyes">Eyes :</label><input type="text" name="eyes" id="eyes"
                                placeholder="Eyes Color" />
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="photo">Photo :<input type="file" name="photo" id="photo" />
                                <span class="file">Upload ...</span></label>
                            <label for="blood">Blood :</label><select name="blood" id="blood">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="O">O</option>
                                <option value="AB">AB</option>
                            </select>
                        </div>
                        <div>
                            <label for="bloodPressure" class="label">Blood Pressure :<input type="checkbox"
                                    name="bloodPressure" id="bloodPressure" value="bloodPressure" />
                                <span class="checkmark"></span></label>
                            <label for="diabet" class="label">diabet<input type="checkbox" name="diabet" id="diabet"
                                    value="diabet" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="mentalIlness" class="label">Mental Ilness :<input type="checkbox"
                                    name="mentalIlness" id="mentalIlness" value="mentalIlness" />
                                <span class="checkmark"></span></label>
                            <label for="tatoos" class="label">Tatoos :<input type="checkbox" name="tatoos" id="tatoos"
                                    value="tatoos" />
                                <span class="checkmark"></span></label>
                        </div>
                        <div>
                            <label for="birthmarks" class="label">Birthmarks<input type="checkbox" name="birthmarks"
                                    id="birthmarks" value="birthmarks" />
                                <span class="checkmark"></span></label>
                            <label for="scars" class="label">scars<input type="checkbox" name="scars" id="scars"
                                    value="scars" />
                                <span class="checkmark"></span></label>
                        </div>
                    </div>
                    <div>
                        <textarea name="describing" id="describing"
                            placeholder="Describe the circumstances of the disappearance ..."></textarea>
                    </div>
                    <div>
                        <button type="submit" name="create">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>