<?php
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    include '../../koneksi/koneksi.php';
    include '../navbar.php';
    include '../../asset/login/check_login_pegawai.php';
    include '../../asset/login/check_login_pelanggan.php';

    //inisialisasi
        $jenis = $_POST['jenis'];

    /*JIKA KELUHAN/KRITIK/SARAN DIKIRIM*/
    if (isset($_POST['kirim']) AND $jenis == "keluhan") {
        
        //inisialisasi
        $isi_keluhan = $_POST['pesan'];
        $tgl_keluhan = date('Y-m-d H:i:s');
        $id_pelanggan = $_SESSION['id_pelanggan'];

        $gambar_produk = $_FILES["gambar_produk"]["name"]; 
        $file_basename = substr($gambar_produk, 0, strripos($gambar_produk, '.')); // get ekstensi 
        $file_ext = substr($gambar_produk, strripos($gambar_produk, '.')); // get nama file 

        $struk_pembelian = $_FILES["struk_pembelian"]["name"]; 
        $file_basename_struk = substr($struk_pembelian, 0, strripos($struk_pembelian, '.')); // get ekstensi 
        $file_ext_struk = substr($struk_pembelian, strripos($struk_pembelian, '.')); // get nama file 

        $folder_produk = "../../asset/gambar/keluhan/gambar_produk/";
        $folder_struk = "../../asset/gambar/keluhan/struk/";

        if (($gambar_produk==null)OR($struk_pembelian==null)) {
            $gambar_produk = "default.jpg";
            $struk_pembelian = "default.jpg";
        }

        if (($_FILES["gambar_produk"]["error"] > 0) AND ($_FILES["struk_pembelian"]["error"] > 0)){
            // jika file gambar tidak diupload
            //insert ke tabel produk
            $foto_keluhan = $gambar_produk;
            $foto_struk = $struk_pembelian;

            $sql = "INSERT INTO keluhan (tgl_keluhan, isi_keluhan, foto_keluhan, foto_struk, id_pelanggan) VALUES(?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('ssssi', $tgl_keluhan, $isi_keluhan, $foto_keluhan, $foto_struk, $id_pelanggan);
            if($stmt->execute()){
                $stmt->insert_id;
                ?>
                <body onload="BerhasilMengirim()"></body>
                <?php
            }else{
                ?>
                <body onload="GagalMengirim()"></body>
                <?php
            }
            $stmt->close();
        }else{
            // Rename file
            $newfilename = md5($file_basename) . $file_ext;
            $newfilename_struk = md5($file_basename_struk) . $file_ext_struk;

            // cek apakah file sudah ada 
            if (file_exists("$folder_produk".$newfilename)OR file_exists("$folder_struk".$newfilename_struk)){
                $_SESSION['status_operasi_k'] = "gagal_dikirim";
            }else{  
                //simpan gambar ke folder lalu save path/url ke database
                if(move_uploaded_file($_FILES["gambar_produk"]["tmp_name"],"$folder_produk".$gambar_produk)AND move_uploaded_file($_FILES["struk_pembelian"]["tmp_name"],"$folder_struk".$struk_pembelian)){
                    $foto_keluhan = $gambar_produk;
                    $foto_struk = $struk_pembelian;

                    $sql = "INSERT INTO keluhan (tgl_keluhan, isi_keluhan, foto_keluhan, foto_struk, id_pelanggan) VALUES(?, ?, ?, ?, ?)";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param('ssssi', $tgl_keluhan, $isi_keluhan, $foto_keluhan, $foto_struk, $id_pelanggan);
                    if($stmt->execute()){
                        $stmt->insert_id;
                        ?>
                        <body onload="BerhasilMengirim()"></body>
                        <?php
                    }else{
                        ?>
                        <body onload="GagalMengirim()"></body>
                        <?php
                    }
                    $stmt->close();
                }
            }
        }
    }else if (isset($_POST['kirim']) AND $jenis == "kritik_saran" AND isset($_SESSION['id_pelanggan'])) {
        //inisialisasi
        $isi_kritiksaran = $_POST['pesan'];
        $tgl_kritiksaran = date('Y-m-d H:i:s');
        $id_pelanggan = $_SESSION['id_pelanggan'];

        $sql = "INSERT INTO kritiksaran (tgl_kritiksaran, isi_kritiksaran, id_pelanggan) VALUES(?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssi', $tgl_kritiksaran, $isi_kritiksaran, $id_pelanggan);
        if($stmt->execute()){
            $stmt->insert_id;
            ?>
            <body onload="BerhasilMengirim()"></body>
            <?php
        }else{
            ?>
            <body onload="GagalMengirim()"></body>
            <?php
        }
        $stmt->close();

        //get id kritiksaran
        $sql = "SELECT id_kritiksaran, id_pelanggan FROM kritiksaran ORDER BY id_kritiksaran DESC LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($id_kritiksaran, $id_pelanggan);
        $stmt->fetch();
        $stmt->close();

        if ($id_pelanggan!=null) {
            //get info pelanggan terdaftar
            $sql = "SELECT pelanggan.nama, pelanggan.no_telp, pelanggan.email FROM pelanggan, kritiksaran WHERE kritiksaran.id_pelanggan=pelanggan.id_pelanggan AND kritiksaran.id_kritiksaran='$id_kritiksaran'";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($nama_pel, $no_telp_pel, $email_pel);
            $stmt->fetch();
            $stmt->close();

            //update info pelanggan di kritiksaran
            $sql = "UPDATE kritiksaran SET nama = ?, no_telp = ?, email = ? WHERE id_kritiksaran = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('sssi', $nama_pel, $no_telp_pel, $email_pel, $id_kritiksaran);
            $stmt->execute();
            $stmt->close();
        }
        
    }else if (isset($_POST['kirim']) AND $jenis == "kritik_saran" AND empty($_SESSION['id_pelanggan'])) {
        //inisialisasi
        $nama = $_POST['nama'];
        $no_telp = $_POST['no_telp'];
        $email = $_POST['email'];
        $isi_kritiksaran = $_POST['pesan'];
        $tgl_kritiksaran = date('Y-m-d H:i:s');

        $sql = "INSERT INTO kritiksaran (tgl_kritiksaran, isi_kritiksaran, nama, no_telp, email) VALUES(?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('sssss', $tgl_kritiksaran, $isi_kritiksaran, $nama, $no_telp, $email);
        if($stmt->execute()){
            $stmt->insert_id;
            ?>
            <body onload="BerhasilMengirim()"></body>
            <?php
        }else{
            ?>
            <body onload="GagalMengirim()"></body>
            <?php
        }
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Keluhan Saran</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../bootstrap/bootstrap/css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bootstrap/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="../../bootstrap/bootstrap/js/jquery1.min.js"></script>

    <!-- SweetAlert -->
    <link rel="stylesheet" type="text/css" href="../../bootstrap/dist/sweet/sweetalert.css">

    <script type="text/javascript">

        $(function () {

            $("input[name='jenis']").click(function () {

                if ($("#keluhan").is(":checked")) {

                    $("#bukti_keluhan").show();

                } else {

                    $("#bukti_keluhan").hide();

                }

            });

        });

        function BerhasilMengirim(){
            swal({
                title: "Berhasil",      
                text: "Pesan berhasil dikirim.",   
                timer: 1000,  
                showConfirmButton: false });
        }

        function GagalMengirim(){
            swal({      
                title: "Berhasil",
                text: "Pesan gagal dikirim.",   
                timer: 1000,  
                showConfirmButton: false });
        }
    </script>
</head>

<body>

    <!-- include navbar-->
    <?php Navbar(); ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>Keluhan Saran</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Form Keluhan Saran-->
        <div class="row">
            <div class="col-md-3">
                
            </div>
            <div class="col-md-6">
                <h3></h3>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="control-group form-group">
                            <div class="radio">
                                <label>
                                    <?php if(isset($_SESSION['id_pelanggan'])){ ?>
                                        <input type="radio" name="jenis" id="keluhan" value="keluhan">
                                    Keluhan
                                    <?php }else{ ?>
                                        <input type="radio" name="jenis" id="keluhan" value="keluhan" disabled="">
                                        Keluhan <small><font color="red">(harus login)</font></small>
                                    <?php } ?>
                                </label>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="control-group form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="jenis" id="kritik_saran" value="kritik_saran" checked="">
                                    Kritik Saran
                                </label>
                            </div>
                        </div>
                    </div> 
                    <?php if(!isset($_SESSION['id_pelanggan'])){ ?>
                    <div class="col-md-12">
                        <div class="control-group form-group">
                            <div class="controls">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" required data-validation-required-message="Masukkan Nama Anda.">
                                <p class="help-block"></p>
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-12">  
                        <div class="control-group form-group">
                            <div class="controls">
                                <input type="tel" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp..." required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="control-group form-group">
                            <div class="controls">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <div class="control-group form-group">
                            <div class="controls">
                                <textarea rows="10" cols="100" class="form-control" name="pesan" id="pesan" placeholder="Pesan" required data-validation-required-message="Anda belum menulis pesan" maxlength="999" style="resize:none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" id="bukti_keluhan" style="display: none">
                        <!-- BUKTI KELUHAN -->
                        <div class="form-group">
                            <label for="gambar_produk">Gambar Produk</label>
                            <input type="file" name="gambar_produk" id="gambar_produk">

                            <p class="help-block">Format : jpeg,png</p>
                        </div>

                        <!-- STRUK PEMBELIAN -->
                        <div class="form-group">
                            <label for="gambar_produk">Struk Pembelian</label>
                            <input type="file" name="struk_pembelian" id="gambar_produk">

                            <p class="help-block">Format : jpeg,png</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" name="kirim" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>

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

    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="../../bootstrap/bootstrap/js/jqBootstrapValidation.js"></script>
    <script src="../../bootstrap/bootstrap/js/contact_me.js"></script>
    <!-- SweetAlert -->
    <script src="../../bootstrap/dist/sweet/sweetalert.min.js"></script>

</body>

</html>
