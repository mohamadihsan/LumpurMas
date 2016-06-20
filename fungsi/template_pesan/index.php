<?php
	
	/*========================= TAMBAH DATA PESAN ========================*/
	function TambahDataTemplatePesan()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$jenis = $_POST['jenis'];
		$isi = $_POST['isi'];

		//insert ke tabel pesan
		$sql = "INSERT INTO pesan (jenis, isi) VALUES(?, ?)";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('ss', $jenis, $isi);
		if($stmt->execute()){
			$stmt->insert_id;
			$_SESSION['status_operasi_tp'] = "berhasil_menyimpan";
		}else{
			$_SESSION['status_operasi_tp'] = "gagal_menyimpan";
		}
		$stmt->close();
	}

	/*========================= EDIT DATA PESAN ========================*/
	function EditDataTemplatePesan()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$jenis = $_POST['jenis'];
		$isi = $_POST['isi'];
		$id = $_POST['id'];

		//update ke tabel pesan
		$sql = "UPDATE pesan SET jenis = ?, isi = ? WHERE id = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('ssi', $jenis, $isi, $id);
		if($stmt->execute()){
			$_SESSION['status_operasi_tp'] = "berhasil_memperbaharui";
		}else{
			$_SESSION['status_operasi_tp'] = "gagal_memperbaharui";
		}
		$stmt->close();
	}

	/*========================= HAPUS DATA PESAN ========================*/
	function HapusDataTemplatePesan()
	{
		include '../../koneksi/koneksi.php';

		//inisialisasi
		$id = $_GET['id'];

		$status_hapus = "0";

		//hapus dari tabel pesan
		$sql = "UPDATE pesan SET status_hapus = ? WHERE id = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('si', $status_hapus, $id);
		if($stmt->execute()){
			$_SESSION['status_operasi_tp'] = "berhasil_menghapus";
		}else{
			$_SESSION['status_operasi_tp'] = "gagal_menghapus";
		}
		$stmt->close();
	}
?>
