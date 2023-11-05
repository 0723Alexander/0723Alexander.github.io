<?php
/*
* KEYAUTH.CC PHP EXAMPLE
*
* Edit credentials.php file and enter name & ownerid from https://keyauth.cc/app
*
* READ HERE TO LEARN ABOUT KEYAUTH FUNCTIONS https://github.com/KeyAuth/KeyAuth-PHP-Example#keyauthapp-instance-definition
*
*/
include 'keyauth.php';
include 'credentials.php';

if (isset($_SESSION['user_data'])) {
        header("Location: dashboard/");
        exit();
}

$KeyAuthApp = new KeyAuth\api($name, $ownerid);

if (!isset($_SESSION['sessionid'])) {
        $KeyAuthApp->init();
}
?>

<html lang="en">

<head>
        <title>KeyAuth PHP Example</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="https://cdn.keyauth.cc/assets/img/favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <link rel="stylesheet" href="./css/styleLogin.css">

        <link href="https://cdn.keyauth.cc/v2/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.keyauth.cc/v2/assets/css/style.bundle.css" rel="stylesheet" type="text/css">
</head>
<body class="bg-black">
        <div id="particles-js"></div>
        <div class="center">
                <div class="conten-master">
                        <div>
                                <div>
                                        <form method="post">
                                                <div class="conten-titulo">
                                                        <h1 class="text-light">BIENVENIDO</h1>
                                                </div>

                                                <div>
                                                        <!-- username -->
                                                        <label class="form-label fs-6 fw-bolder text-light">Username</label>
                                                        <input class="form-control form-control text-light mb-3" type="text" name="username" placeholder="Enter username here" autocomplete="on" />
                                                        <!-- password -->
                                                        <label class="form-label fw-bolder text-light fs-6 mb-0">Password</label>
                                                        <input class="form-control form-control text-light mb-3" type="password" placeholder="Enter password here" name="password" autocomplete="on" />
                                                        <!-- License -->
                                                        <label class="form-label fw-bolder text-light fs-6 mb-0">License</label>
                                                        <input class="form-control form-control text-light mb-3" type="text" placeholder="Enter license key" name="key" autocomplete="on" />
                                                        <br>
                                                        <div class="text-center">
                                                                <button name="login" class="btn-lg w-100 mb-5 color-button">
                                                                        <span class="indicator-label">Login</span>
                                                                </button>
                                                                <button name="register" class="btn-lg w-100 color-button">
                                                                        <span class="indicator-label">Register</span>
                                                                </button>
                                                                <!-- <button name="upgrade" class="btn btn-lg btn-primary w-100 mb-5">
                                                                        <span class="indicator-label">Upgrade</span>
                                                                </button>
                                                                <button name="license" class="btn btn-lg btn-primary w-100 mb-5">
                                                                        <span class="indicator-label">License</span>
                                                                </button> -->
                                                        </div>
                                                </div>
                                        </form>
                                </div>
                        </div>
                </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
        <script src="./dashboard/js/particles.min.js"></script>
        <script src="./dashboard/js/app.js"></script>
        <?php
        if (isset($_POST['login'])) {
                // login with username and password
                if ($KeyAuthApp->login($_POST['username'], $_POST['password'])) {
                        echo "<meta http-equiv='Refresh' Content='2; url=dashboard/'>";
                        $KeyAuthApp->success("You have successfully logged in!");
                }
        }

        if (isset($_POST['register'])) {
                // register with username,password,key
                if ($KeyAuthApp->register($_POST['username'], $_POST['password'], $_POST['key'])) {
                        echo "<meta http-equiv='Refresh' Content='2; url=dashboard/'>";
                        $KeyAuthApp->success("You have successfully registered!");
                }
        }

        if (isset($_POST['license'])) {
                // login with just key
                if ($KeyAuthApp->license($_POST['key'])) {
                        echo "<meta http-equiv='Refresh' Content='2; url=dashboard/'>";
                        $KeyAuthApp->success("You have successfully logged in!");
                }
        }

        if (isset($_POST['upgrade'])) {
                if ($KeyAuthApp->upgrade($_POST['username'], $_POST['key'])) {
                        // don't login, upgrade function is not for authentication, it's simply for redeeming keys
                        $KeyAuthApp->success("Upgraded Successfully! Now login please.");
                }
        }
        ?>

</body>

</html>