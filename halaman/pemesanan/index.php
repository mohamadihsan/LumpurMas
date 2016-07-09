<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
include '../../koneksi/koneksi.php';
include '../navbar.php';
include '../../asset/login/check_login_pegawai.php';
include '../../asset/login/check_login_pelanggan.php';

if (isset($_POST['pesan'])) {

	//inisialisasi
	$produk = $_POST['produk'];
	$jumlah_beli = $_POST['jumlah_beli'];
	$id_pelanggan = $_SESSION['id_pelanggan'];

	//insert ke pemesanan
	$sql = "INSERT INTO pemesanan (id_pelanggan) VALUES(?)";
	$stmt = $db->prepare($sql);
	$stmt->bind_param('i', $id_pelanggan);
	if ($stmt->execute()) {
		$stmt->insert_id;

	} else {

	}
	$stmt->close();

	//select id pemesanan
	$sql = "SELECT id_pemesanan FROM pemesanan ORDER BY id_pemesanan DESC LIMIT 1";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($id_pemesanan);
	$stmt->fetch();
	$stmt->close();

	for ($i = 0; $i < count($produk); $i++) {
		//insert ke detail transaksi
		$sql = "INSERT INTO detail_pemesanan (id_pemesanan, id_produk, jumlah_beli) VALUES(?, ?, ?)";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('isi', $id_pemesanan, $produk[$i], $jumlah_beli[$i]);
		if ($stmt->execute()) {

		} else {

		}
		$stmt->close();
	}

	//select data produk
	$sql = "SELECT detail_pemesanan.id_pemesanan, detail_pemesanan.id_produk, jumlah_beli, harga FROM detail_pemesanan, pemesanan, produk WHERE detail_pemesanan.id_pemesanan='$id_pemesanan' AND pemesanan.id_pemesanan=detail_pemesanan.id_pemesanan AND detail_pemesanan.id_produk=produk.id_produk";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($id_pemesanan, $id_produk, $jumlah_beli, $harga);

	$total_bayar = 0;

	while ($stmt->fetch()) {
		$total_bayar = $total_bayar + ($harga * $jumlah_beli);
	}

	$_SESSION['total_bayar'] = $total_bayar;
	$stmt->close();

	if ($_SESSION['total_bayar'] >= 2000000) {
		//Update Pemesanan
		$sql = "UPDATE pemesanan SET total_bayar = ? WHERE id_pemesanan = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('ii', $total_bayar, $id_pemesanan);
		if ($stmt->execute()) {
			?><body onload="BerhasilOrder()"></body><?php
} else {
			?><body onload="TerjadiKesalahan()"></body><?php
}
		$stmt->close();
	} else {

		//hapus dari tabel user
		$sql = "DELETE FROM pemesanan WHERE id_pemesanan = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('i', $id_pemesanan);
		if ($stmt->execute()) {
			?><body onload="OrderDitolak()"></body><?php
} else {

		}
		$stmt->close();
	}
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

    <title>Pemesanan</title>

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
            <!-- Page Heading/Breadcrumbs -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <small>Form Pemesanan</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <!-- Form Keluhan Saran-->
            <div class="row">
                <div class="box-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="col-md-10">
                                    <label>Produk</label>
                                </div>
                                <div class="col-md-2">
                                    <label>Qty</label>
                                </div>
                                <div id="tambah_produk">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <?php
//select produk
	$sql = "SELECT id_produk, nama_produk, harga, status_produk, url, id_kategori, kode_produk FROM produk ORDER BY nama_produk ASC";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->bind_result($id_produk, $nama_produk, $harga, $status_produk, $url, $id_kategori, $kode_produk);
	?>
                                            <select class="form-control select" style="width: 100%;" name="produk[]" required>
                                                <option selected="selected">Pilih Produk</option>
                                                <?php
while ($stmt->fetch()) {
		?>
                                                            <option value="<?php echo $id_produk; ?>"><?php echo $nama_produk;if ($status_produk == "DG" OR $status_produk == "G") {
			echo "(Garansi)";
		}
		?></option>
                                                        <?php
}
	$stmt->close();
	?>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input class="form-control" type="number" name="jumlah_beli[]" placeholder="0" min="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12" align="right">
                                    <a href="javascript:TambahProduk()"><i class="fa fa-plus"></i> Tambah Produk</a>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <label>Keterangan</label>
                                </div>

                                <div class="col-md-12"></div>

                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <p>Pemesanan hanya dapat dilakukan untuk total pembelian lebih dari Rp.2.000.000,- (dua juta rupiah)</p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" name="pesan">Pesan</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </form>
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
