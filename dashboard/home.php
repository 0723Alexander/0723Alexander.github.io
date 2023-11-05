<?php
/*
* KEYAUTH.CC PHP EXAMPLE
*
* Edit credentials.php file and enter name & ownerid from https://keyauth.cc/app
*
* READ HERE TO LEARN ABOUT KEYAUTH FUNCTIONS https://github.com/KeyAuth/KeyAuth-PHP-Example#keyauthapp-instance-definition
*
*/
error_reporting(0);

require '../keyauth.php';
require '../credentials.php';

session_start();

if (!isset($_SESSION['user_data'])) // if user not logged in
{
    header("Location: ../");
    exit();
}

$KeyAuthApp = new KeyAuth\api($name, $ownerid);

function findSubscription($name, $list)
{
    for ($i = 0; $i < count($list); $i++) {
        if ($list[$i]->subscription == $name) {
            return true;
        }
    }
    return false;
}

$username = $_SESSION["user_data"]["username"];
$subscriptions = $_SESSION["user_data"]["subscriptions"];
$subscription = $_SESSION["user_data"]["subscriptions"][0]->subscription;
$expiry = $_SESSION["user_data"]["subscriptions"][0]->expiry;

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../");
    exit();
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleHome.css">
    <title>GENERADOR DE CLAVES CRUUZ</title>
    <title>Dashboard</title>
    <script src="https://cdn.keyauth.cc/dashboard/unixtolocal.js"></script>
</head>

<body>
    Logged in as <?php echo $username; ?>
    <br>

    <!-- <?php
    for ($i = 0; $i < count($subscriptions); $i++) {
        echo "#" . $i + 1 . " Subscription: " . $subscriptions[$i]->subscription . " - Subscription Expires: " . "<script>document.write(convertTimestamp(" . $subscriptions[$i]->expiry . "));</script>";
    }
    ?>

    <br>
    Does subscription with name <code style="background-color: #eee;border-radius: 3px;font-family: courier, monospace;padding: 0 3px;">default</code> exist: <?php echo ((findSubscription("default", $_SESSION["user_data"]["subscriptions"]) ? 1 : 0) ? 'yes' : 'no'); ?> -->

    <div id="particles-js"></div>
    <div class="cont-home">
        <h1 id="h1">BIENVENIDO <?php echo $username; ?></h1>
        <h2 id="h2">CONFIGURA A TU GUSTO Y GENRALA</h2>

        <div id="password"></div>
        
        <div class="flex-container">
            <div class="container">
                <label for="length">Longitud de la contraseña:</label>
                <div class="select-container">
                    <select id="length">
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="8">8</option>
                    <option value="10">10</option>
                    </select>
                </div>
            </div>
            <div class="container2">
                <button onclick="toggleLetters()" class="btnIL">Incluir letras</button>
            </div>
        </div>
        
        
        <br><br>
        
        <button onclick="generatePassword()" class="btnG">Generar</button>
        <button onclick="copyPassword()" class="btnC">Copiar</button>
        <br><br><br><br>
    </div>

    <script src="js/script.js"></script>
    <script src="js/particles.min.js"></script>
    <script src="js/app.js"></script>

</body>

</html>
