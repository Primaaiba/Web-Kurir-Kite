<?php require_once("includes/navbar.php"); ?>
<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php 
if (isset($_POST["Submit"])) {
    $Nama = $_POST["PNama"];
    $Email = $_POST["PEmail"];
    $Pengadu = $_POST["PPengadu"];

    date_default_timezone_set("Asia/Jakarta");
    $CurrentTime=time();
    $DateTime=strftime("%d-%B-%Y %H:%M:%S",$CurrentTime);

    if(empty($Nama) || empty($Email) || empty($Pengadu)) {
        $_SESSION["ErrorMessage"] = "Semua kolom harus diisi";

    } else {
    global $ConnectingDB;
    $sql = "INSERT INTO pengaduan (datetime,nama,email,komen)";
    $sql .= "VALUES (:datetime,:nama,:email,:komen)";
    $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':datetime',$DateTime);
        $stmt->bindValue(':nama',$Nama);
        $stmt->bindValue(':email',$Email);
        $stmt->bindValue(':komen',$Pengadu);        
        $Execute = $stmt->execute();
        if ($Execute) {
			$_SESSION["SuccessMessage"] = "Pengaduan anda, berhasil dikirim !";
		} else {
            $_SESSION["ErrorMessage"] = "Ada yang salah. Coba lagi !";
        }
    
    }
}
?>
<?php 
global $ConnectingDB;
$sql = "SELECT judul_p,deskripsi_p FROM set_web";
$stmt = $ConnectingDB->prepare($sql);
$stmt->execute();
while ($DateRows = $stmt->fetch()) {
    $Judul = $DateRows['judul_p'];
    $Deskripsi = $DateRows['deskripsi_p'];
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

                        <?php 
                            echo ErrorMessage();
                            echo SuccessMessage();
                        ?>
                            
                            <form class="" action="pengaduan.php" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-6"><label class="text-dark" for="pnama">Nama Lengkap</label>
                                    <input class="form-control py-4" name="PNama" type="text" id="pnama" placeholder="Nama lengkap" value=""/></div>
                                    <div class="form-group col-md-6"><label class="text-dark" for="email">Email</label>
                                    <input class="form-control py-4" name="PEmail" id="email" type="email" placeholder="nama@gmail.com" value=""/></div>
                                </div>
                                <div class="form-group"><label class="text-dark" for="ppengadu">Pengaduan</label>
                                <textarea class="form-control py-3" name="PPengadu" id="ppengadu" type="text" placeholder="Pengaduan anda..." rows="4"></textarea>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary btn-marketing mt-4" name="Submit" id="submit" type="submit">KIRIM</button></div>
                            </form>

                    

                        </div>

                        <div class="svg-border-rounded text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" /></svg>
                        </div>
                    </section>
                </main>
            </div>
            <?php require_once("includes/footer.php"); ?>   