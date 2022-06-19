<?php require_once("Includes/navbar.php"); ?>
<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php 
global $ConnectingDB;
$sql = "SELECT judul_1,deskripsi,judul_2,konten FROM set_web";
$stmt = $ConnectingDB->prepare($sql);
$stmt->execute();
while ($DateRows = $stmt->fetch()) {
    $Judul = $DateRows['judul_1'];
    $Deskripsi = $DateRows['deskripsi'];
    $Judul2 = $DateRows['judul_2'];
    $Konten = $DateRows['konten'];
}
?>

                    <header class="page-header page-header">
                        <div class="page-header-content pt-10">
                            <div class="container text-center">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <h1 class="page-header-title mb-3"><?php echo $Judul; ?></h1>
                                        <p class="page-header-text"><?php echo $Deskripsi; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="svg-border-rounded text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" /></svg>
                        </div>
                    </header>
                    <section class="bg-white py-10">
                        <div class="container">
                            <div>
                                <h1><?php echo $Judul2; ?></h1>
                                <p class="lead"><?php echo $Konten; ?></p>
                            </div>

                        </div>

                        <div class="svg-border-rounded text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" /></svg>
                        </div>
                    </section>
                </main>
            </div>
            <?php require_once("Includes/footer.php"); ?>   