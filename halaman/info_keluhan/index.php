<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
include '../../koneksi/koneksi.php';
include '../navbar.php';
include '../../asset/login/check_login_pegawai.php';
include '../../asset/login/check_login_pelanggan.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Info Keluhan</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../bootstrap/bootstrap/css/modern-business.css" rel="stylesheet">

    <!-- data tables -->
    <link rel="stylesheet" href="../../bootstrap/plugins/datatables/dataTables.bootstrap.css">

    <!-- Custom Fonts -->
    <link href="../../bootstrap/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Select2 -->
    <link rel="stylesheet" href="../../bootstrap/plugins/select2/select2.min.css">

    <!-- SweetAlert -->
    <link rel="stylesheet" type="text/css" href="../../bootstrap/dist/sweet/sweetalert.css">

    <script type="text/javascript" src="../../bootstrap/bootstrap/js/jquery1.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

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

        function BerhasilOrder(){
            swal({
                title: "Total Pemesanan anda : Rp.<?php echo $_SESSION['total_bayar']; ?>",
                text: "List Pemesanan berhasil dikirim. Silahkan tunggu konfirmasi dari kami!",
                showConfirmButton: true });
        }

        function OrderDitolak(){
            swal({
                title: "Maaf",
                text: "Total Pemesanan anda : Rp.<?php echo $_SESSION['total_bayar']; ?> dan masih kurang dari 2 juta",
                showConfirmButton: true });
        }

        function TerjadiKesalahan(){
            swal({
                title: "Ooops",
                text: "Terjadi kesalahan dalam proses pemesanan",
                showConfirmButton: true });
        }
    </script>
</head>

<body>

    <!-- include navbar-->
    <?php Navbar();?>

    <!-- Page Content -->
    <div class="container">

        <?php
if (!empty($_SESSION['username']) OR !empty($_SESSION['id_pelanggan'])) {
	?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <small>Histori Keluhan Anda</small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="box-body">
                    <?php

	function Tanggal($tanggal) {
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$tahun = substr($tanggal, 0, 4);
		$bulan = substr($tanggal, 5, 2);
		$tgl = substr($tanggal, 8, 2);

		$hasil = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
		return ($hasil);
	}

	$folder_produk = "../../asset/gambar/keluhan/gambar_produk/";
	$folder_struk = "../../asset/gambar/keluhan/struk/";

	//Tampilkan Data Keluhan

	$sql = "SELECT tgl_keluhan, isi_keluhan, status, pesan_respon, foto_keluhan, foto_struk FROM keluhan WHERE id_pelanggan='" . $_SESSION['id_pelanggan'] . "'";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($tgl_keluhan, $isi_keluhan, $status, $pesan_respon, $foto_keluhan, $foto_struk);
	?>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal Keluhan</th>
                                <th width="30%">Keluhan</th>
                                <th width="30%">Jawaban</th>
                                <th width="10%">File</th>
                                <th>Status Respon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
while ($stmt->fetch()) {
		?>
                            <tr>
                                <td><?php echo Tanggal($tgl_keluhan); ?></td>
                                <td><?php echo $isi_keluhan; ?></td>
                                <td><?php echo $pesan_respon; ?></td>
                                <td>
                                    <a href="<?php echo $folder_produk . $foto_keluhan; ?>" target="_blank">Keluhan</a> |
                                    <a href="<?php echo $folder_struk . $foto_struk; ?>" target="_blank">Struk</a></td>
                                <td>
                                    <?php if ($status == "BR") {
			echo "Belum";
		} else {
			echo "Sudah";
		}?>
                                </td>
                            <?php
}
	$stmt->close();
	?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
} else {
	?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Untuk melakukan pemesanan, silahkan login terlebih dahulu!</small>
                        </h1>
                    </div>
                    <div class="col-md-6">
                        <a href="../../asset/login/"><button class="btn btn-primary">Login</button></a>
                    </div>
                </div>
            <?php
}
?>

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

    <!-- jQuery 2.2.0 -->
    <script src="../../bootstrap/plugins/jQuery/jQuery-2.2.0.min.js"></script>

    <!-- jQuery -->
    <script src="../../bootstrap/bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bootstrap/bootstrap/js/bootstrap.min.js"></script>

    <!-- DataTables -->
    <script src="../../bootstrap/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../bootstrap/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="../../bootstrap/plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="../../bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../../bootstrap/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../../bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>

    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="../../bootstrap/bootstrap/js/jqBootstrapValidation.js"></script>

    <script src="../../bootstrap/bootstrap/js/contact_me.js"></script>
    <!-- SweetAlert -->
    <script src="../../bootstrap/dist/sweet/sweetalert.min.js"></script>
    <!-- JQuery -->
    <script src="../../bootstrap/dist/js/jquery.min.js"></script>
    <!-- Page script -->
    <script>
        function TambahProduk_Old(){
            $(".tambah_produk.clone").clone().add().addClass('additional').removeClass('clone').appendTo("div#clone").find('input').dropdown();
        }

        function TambahProduk(){
            $("#tambah_produk").clone(false).insertAfter("#tambah_produk");
        }

        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
            //Money Euro
            $("[data-mask]").inputmask();
            //Data Tables
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });
        });

        function BerhasilMengirimPesanan(){
            swal({
            title: "Berhasil",
            text: "Proses pemesanan berhasil dikirim.",
            timer: 1000,
            showConfirmButton: false });
        }

        function GagalMengirimPesanan(){
            swal({
            title: "Ooops",
            text: "Proses pemesanan gagal dikirim.",
            timer: 1000,
            showConfirmButton: false });
        }
    </script>

</body>

</html>
