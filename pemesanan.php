<?php require_once("Includes/navbar.php"); ?>
<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/sessions.php"); ?>

                    <header class="page-header page-header">
                        <div class="page-header-content pt-10">
                            <div class="container text-center">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <h1 class="page-header-title mb-3">PEMESANAN</h1>
                                        <form class="page-header-signup mb-2 mb-md-0">
                                            <div class="form-row justify-content-center">
                                                <div class="col-lg-6 col-md-8">
                                                    <div class="form-group mr-0 mr-lg-2"><input class="form-control form-control-solid rounded-pill" type="text" placeholder="Cari yang anda butuhkan..."/></div>
                                                </div>
                                                <div class="col-lg-3 col-md-4"><button class="btn btn-teal btn-block btn-marketing rounded-pill" type="submit">Mencari</button></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="svg-border-rounded text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" /></svg>
                        </div>
                    </header>

                    

                    <section class="bg-white py-10">
                        <div class="container" >
                            <div>
                                <h1>PASTI ADA SESUATU BUAT TIAP ORANG</h1>                                

                            <hr />
                            <div class="row">

                            <?php 
                                echo ErrorMessage();
                                echo SuccessMessage();
                            ?>

                            <?php 
                            global $ConnectingDB;
                            if (isset($_GET["SearchButton"])) {
                                $Search = $_GET["Search"];
                                $sql = "SELECT * FROM posts 
                                WHERE datetime LIKE :search 
                                OR judul LIKE :search
                                OR kategori LIKE :search
                                OR post LIKE :search ";
                                $stmt = $ConnectingDB->prepare($sql);
                                $stmt->bindValue(':search','%'.$Search.'%');
                                $stmt->execute();
                            } elseif (isset($_GET["page"])) {
                                $Page = $_GET["page"];
                                if ($Page == 0||$Page<1) {
                                    $ShowPostFrom = 0;
                                } else {
                                $ShowPostFrom = ($Page * 5)-5;
                                }
                                $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,5";
                                $stmt = $ConnectingDB->query($sql);
                            } elseif (isset($_GET["kategori"])) {
                                $Kategori = $_GET["kategori"];
                                $sql = "SELECT * FROM posts WHERE kategori='$Kategori' ORDER BY id desc";
                                $stmt = $ConnectingDB->query($sql);
                            } else {
                                $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,3";
                                $stmt = $ConnectingDB->query($sql);
                            }            
                            while ($DataRows = $stmt->fetch()) {
                                $PostId = $DataRows["id"];
                                $DateTime = $DataRows["datetime"];
                                $PostTitle = $DataRows["judul"];
                                $Category = $DataRows["kategori"];
                                $Image = $DataRows["image"];
                                $PostDescription = $DataRows["post"];
                            ?>

                                <div class="col-md-6 col-xl-4 mb-5">
                                    <a class=" post-preview lift h-100" href="#!">
                                    <img class="card-img-top" src="uploads/<?php echo htmlentities($Image); ?>" alt="photo" />
                                    </a>
                                    <h7 style="color:#0DCB00D1;"><a href="pemesanan.php?kategori=<?php echo htmlentities($Category); ?>"><?php echo htmlentities($Category); ?></a></h7>
                                    <a class=" post-preview lift h-100" href="#!">
                                    <h4 class="card-title"><?php echo htmlentities($PostTitle); ?></h4>
                                    <button type="button" class="btn btn-light">PESAN SEKARANGt</button>
                                    </a>
                                </div>
                                
                                <?php } ?>

                                <nav>
                                <ul class="pagination pagination-lg">

                                    <?php 
                                    if (isset($Page)) {
                                        if ($Page>1) {  
                                    ?>
                                    <li class="page-item">
                                        <a href="Blog.php?page=<?php echo $Page-1; ?>" class="page-link">&laquo;</a>
                                    </li>
                                    <?php } } ?>

                                    <?php 
                                    global $ConnectingDB;
                                    $sql = "SELECT COUNT(*) FROM posts";
                                    $stmt = $ConnectingDB->query($sql);
                                    $RowPagination = $stmt->fetch();
                                    $TotalPosts = array_shift($RowPagination);
                                    // echo $TotalPosts."<br>";
                                    $PostPagination = $TotalPosts/5;
                                    $PostPagination = ceil($PostPagination);
                                    // echo $PostPagination;
                                    for ($i=1; $i <=$PostPagination; $i++) {
                                        if (isset($Page)) {
                                            if ($i == $Page) { ?>

                                        <li class="page-item active">
                                        <a href="pemesanan.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                        </li>
                                    <?php
                
                                            } else { ?>
                                        <li class="page-item">
                                        <a href="pemesanan.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                        </li>
                                        
                                    <?php }  } } ?>

                                    <?php 
                                    if (isset($Page)&&!empty($Page)) {
                                        if ($Page+1<=$PostPagination) {  
                                    ?>
                                    <li class="page-item">
                                        <a href="pemesanan.php?page=<?php echo $Page+1; ?>" class="page-link">&raquo;</a>
                                    </li>
                                    <?php } } ?>

                                </ul>
                            </nav>

                            </div>

                            </div>

                        </div>

                        <div class="svg-border-rounded text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" /></svg>
                        </div>
                    </section>
                </main>
            </div>
            <?php require_once("Includes/footer.php"); ?>   