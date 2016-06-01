<?php 
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    include '../../koneksi/koneksi.php';
    include '../navbar.php';
    include '../../asset/login/check_login_pegawai.php';
?>
<html>
<head>    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Produk</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../bootstrap/bootstrap/css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bootstrap/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <!-- include Navigation -->
    <?php Navbar(); ?>

    <!-- Page Content -->
    <div class="container">

         <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>Filter dan Pencarian</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    <small>Hot List</small>
                </h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- TAMPILKAN DATA HOT LIST -->
        <?php
            $sql = "SELECT kode_produk, nama_produk, harga, status_produk, url FROM produk LIMIT 6";                      
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $stmt->bind_result($kode_produk, $nama_produk, $harga, $status_produk, $url);

            $file_path = '../../asset/gambar/produk/';
    ?>

        <!-- Content Row -->
        <div class="row">
            <?php
                while ($stmt->fetch()) {
                    ?>
                         <div class="col-md-2">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading">
                                    <h1 class="panel-title">
                                        <small>
                                            <?php echo $nama_produk; ?>
                                        </small>
                                    </h1>
                                </div>
                                <div class="panel-body">
                                    <span class="price"><img src="<?php echo $file_path.$url; ?>" alt="" class="img-responsive"></span>
                                </div>
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <?php 
                                            //format rupiah
                                            $jumlah_desimal ="2";
                                            $pemisah_desimal =",";
                                            $pemisah_ribuan =".";

                                            echo "<strong><small>Rp." .number_format($harga, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</small></strong>"; 
                                        ?> 
                                    </h3>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </div>
        <!-- /.row -->
        <!-- AKHIR HOT LIST -->

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    <small>Produk</small>
                </h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- TAMPILKAN DATA PRODUK -->
        <?php
            $sql = "SELECT kode_produk, nama_produk, harga, status_produk, url FROM produk ORDER BY nama_produk ASC";                      
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $stmt->bind_result($kode_produk, $nama_produk, $harga, $status_produk, $url);

            $file_path = '../../asset/gambar/produk/';
    ?>

        <!-- Content Row -->
        <div class="row">
            <?php
                while ($stmt->fetch()) {
                    ?>
                         <div class="col-md-2">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading">
                                    <h1 class="panel-title">
                                        <small>
                                            <?php echo $nama_produk; ?>
                                        </small>
                                    </h1>
                                </div>
                                <div class="panel-body">
                                    <span class="price"><img src="<?php echo $file_path.$url; ?>" alt="" class="img-responsive"></span>
                                </div>
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <?php 
                                            //format rupiah
                                            $jumlah_desimal ="2";
                                            $pemisah_desimal =",";
                                            $pemisah_ribuan =".";

                                            echo "<strong><small>Rp." .number_format($harga, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</strong></small>"; 
                                        ?> 
                                    </h3>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; LumpurMas 2016</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../../bootstrap/bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bootstrap/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
