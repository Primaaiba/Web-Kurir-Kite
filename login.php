<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/function.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php 
if (isset($_SESSION["UserId"])) {
    Redirect_to("admin/index.php");
}
if (isset($_POST["Submit"])) {
    $NamA = $_POST["Nama"];
    $Password = $_POST["Password"];
    if (empty($NamA)|| empty($Password)) {
        $_SESSION["ErrorMessage"] = "Semua kolom harus diisi";
        Redirect_to("login.php");
    } else {
        $Found_Account=Login_Attempt($NamA,$Password);
        if ($Found_Account) {
            $_SESSION["UserId"] = $Found_Account["id"];
            $_SESSION["NamA"] = $Found_Account["nama"];
            $_SESSION["SuccessMessage"] = "Selamat Datang ".$_SESSION["NamA"]."!";
            if (isset($_SESSION["TrackingURL"])) {
                Redirect_to($_SESSION["TrackingURL"]);
            } else {
                Redirect_to("admin/index.php");
            }            

        } else {
            $_SESSION["ErrorMessage"] = "Nama dan Password salah";
            Redirect_to("login.php");
        }
    }
}
?>

<-- Siapkan kopi dan ucapkan "WHAT THE FUCK MEN"-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>LOGIN || Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="js/all.min.js"></script>
        <script src="js/feather.min.js"></script>
    </head>
    <body  style="background-image: url(admin/img/Bg_Admin.jpg); background-size: cover; background-position: top center;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                            
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">LOGIN</h3></div>
                                    <div class="card-body">

                                    <?php 
                                    echo ErrorMessage();
                                    echo SuccessMessage();
                                    ?>

                                        <form class="" action="login.php" method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="nama">Nama</label>
                                                <input class="form-control py-4" name="Nama" id="nama" type="text" placeholder="Masukan nama" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="password">Password</label>
                                                <input class="form-control py-4" name="Password" id="password" type="password" placeholder="Masukan password" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox"><input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" /><label class="custom-control-label" for="rememberPasswordCheck">Remember password</label></div>
                                            </div>
                                            <input type="submit" name="Submit" class="btn btn-info btn-block" value="Login">
                                        </form>
                                    </div>
                                    <!-- <div class="card-footer text-center">
                                        <div class="small"><a href="signup.html">Need an account? Sign up!</a></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!--Script JS-->
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
