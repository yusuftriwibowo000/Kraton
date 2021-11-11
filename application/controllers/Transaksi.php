<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->icon = "fa-cubes";
		$this->load->model('M_pembelian');
		$this->load->model('M_penjualan');
		$this->load->model('M_kas');
		$this->load->model('M_bukubesar');
		$this->load->model('common');
		if ($this->session->userdata('status') != "login") {
			echo "<script>
                alert('Anda harus login terlebih dahulu');
                window.location.href = '" . base_url('Login') . "';
            </script>"; //Url Logi
		}
	}
	public function home()
	{
		$this->load->view("pages/home");
	}
	public function dashboard()
	{
		$param['pageInfo'] = "Dashboard";
	}
	public function form_tambahbarang()
	{
		$param['pageInfo'] = "Example Form";
		$this->template->load("pages/v_tambahbarang", $param);
	}
	public function table_barang()
	{
		$param['pageInfo'] = "Example Table";
		$param['barang'] = $this->M_transaksi->get_transaksi();
		$this->template->load("pages/v_transaksi", $param);
	}

	public function login()
	{
		$this->load->view("auth/login");
	}
	public function pembelian()
	{
		$param['pageInfo'] = "Pembelian Barang";
		$this->template->load("pembelian/v_pembelian", $param);
	}
	public function editpembelian()
	{
		$id = $this->uri->segment(3);
		$param['pageInfo'] = "Edit Pembelian Barang";
		$param['beli'] = $this->db->query("SELECT * FROM pembelian  WHERE kode_pembelian='$id'")->result();
		$param['detail'] = $this->db->get_where('detail_pembelian', ['kode_pembelian' => $id])->result_array();
		$this->template->load("pembelian/v_editpembelian", $param);
	}
	public function editpenjualan()
	{
		$id = $this->uri->segment(3);
		$param['pageInfo'] = "Edit Penjualan Barang";
		$param['jual'] = $this->db->query("SELECT * FROM penjualan  WHERE kode_penjualan='$id'")->result();
		$param['detail'] = $this->db->get_where('detail_penjualan', ['kode_penjualan' => $id])->result_array();
		$this->template->load("penjualan/v_editpenjualan", $param);
	}
	public function penjualan()
	{
		$param['pageInfo'] = "Penjualan Barang";
		$this->template->load("penjualan/v_penjualan", $param);
	}
	public function kas()
	{
		$param['pageInfo'] = "Kas";
		$this->template->load("kas/v_kas", $param);
	}
	public function vkas()
	{
		$kode_kas = $this->uri->segment(3);
		$param['edit'] = $this->db->query("SELECT * FROM kas WHERE kode_kas='$kode_kas'")->result();
		$param['pageInfo'] = "Edit Kas";
		$this->template->load("kas/v_editkas", $param);
	}

	public function tambah_kas()
	{
		$kode_kas = $this->M_kas->get_idkas();
		$this->M_kas->addKas($kode_kas);
		$this->M_bukubesar->addkasbukubesar($kode_kas);
		$this->session->set_flashdata('tambahkas', '<div class="alert alert-success" role="alert">kas Berhasil Disimpan :)</div>');
		redirect('Transaksi/listkas');
	}
	public function editkas()
	{
		$kode_kas = $this->input->post('kode_kas');
		$this->M_kas->updateKas($kode_kas);
		$bukuBesar = array(
			'tanggal' => $_POST['tanggal_kas'],
			'nominal' => $_POST['nominal'],
			'keterangan' => $_POST['keterangan']
		);
		$this->common->update('buku_besar', $bukuBesar, ['kode_transaksi' => $kode_kas]); //update buku besar

		$this->session->set_flashdata('editkas', '<div class="alert alert-warning" role="alert">kas Berhasil Di edit :)</div>');
		redirect('Transaksi/listkas');
	}
	public function hapuskas()
	{
		$kode_kas = $this->uri->segment(3);
		$this->M_kas->deleteKas($kode_kas);
		$this->db->delete('buku_besar', array('kode_transaksi' => $kode_kas));
		$this->session->set_flashdata('hapuskas', '<div class="alert alert-danger" role="alert">Kas Berhasil dihapus :)</div>');
		redirect('Transaksi/listkas');
	}
	public function listkas()
	{
		$param['pageInfo'] = "List Kas";
		$param['kas'] = $this->M_kas->listkas();
		$this->template->load("kas/v_listkas", $param);
	}
	public function addDetailPembelian()
	{
		$this->load->view("pembelian/loop-detail", ['now' => $_GET['counting'], 'start' => 0]);
	}
	public function addDetailPenjualan()
	{
		$this->load->view("penjualan/loop-detail", ['now' => $_GET['counting'], 'start' => 0]);
	}

	public function listpembelian()
	{
		$param['pageInfo'] = "List Pembelian Barang";
		$param['pembelian'] = $this->M_pembelian->listpembelian();
		$this->template->load("pembelian/v_listpembelian", $param);
	}



	public function listpenjualan()
	{

		$param['pageInfo'] = "List Penjualan Barang";
		$param['penjualan'] = $this->M_penjualan->listpenjualan();
		$this->template->load("penjualan/v_listpenjualan", $param);
	}

	public function aksipenjualan()
	{
		$total = 0;
		foreach ($_POST['subtotal'] as $value) {
			$total += $value;
		}
		$total_qty = 0;
		foreach ($_POST['qty'] as $value) {
			$total_qty += $value;
		}
		$total_bayar = $this->input->post('total_bayar');
		
		$potongan = $this->input->post('potongan');
		$kode_penjualan = $this->M_penjualan->get_kodepenjualan();
		$penjualan = array(
			'kode_penjualan' => $kode_penjualan,
			'tanggal_penjualan' => date('Y/m/d'),
			
			'total_qty' => $total_qty,
			'total_penjualan' => $total,
			'total_bayar' => $total_bayar,
			'potongan' => $potongan,
			'id_admin' => $this->session->userdata("id_admin"),
			'keterangan' => $_POST['keterangan2'],
		);
		$penjualanbukubesar = array(
			'kode_transaksi' => $kode_penjualan,
			'tipe' => 'penjualan',
			'tanggal' => date('Y/m/d'),
			'nominal' =>  $total,
			'jenis' => 'debit',
			'keterangan' => $_POST['keterangan2'],
		);
		$this->db->insert('penjualan', $penjualan);
		$this->db->insert('buku_besar', $penjualanbukubesar);
		$lasId = $this->M_penjualan->getLastId();
		foreach ($_POST['kode_barang'] as $key => $value) {
			$data = [
				'kode_penjualan' => $lasId[0]['kode_penjualan'],
				'kode_barang' => $this->input->post('kode_barang')[$key],
				'qty' => $this->input->post('qty')[$key],
				'harga_satuan' => $this->input->post('harga_satuan')[$key],
				'keterangan' => $this->input->post('keterangan')[$key],
			];
			$this->db->insert('detail_penjualan', $data);
		}
		foreach ($_POST['kode_barang'] as $key => $value) {

			$kode_barang = $this->input->post('kode_barang')[$key];
			$qty = $this->input->post('qty')[$key];
			$this->db->query("UPDATE `barang` SET `stok`=stok-'$qty' WHERE kode_barang='$kode_barang'");
		}
		$this->session->set_flashdata('tambahpenjualan', '<div class="alert alert-success" role="alert">Penjualan Berhasil Disimpan</div>');
		redirect('transaksi/penjualan');
	}


	public function deletepembelian()
	{
		$id = $this->uri->segment(3);
		$this->db->delete('pembelian', array('kode_pembelian' => $id));
		$this->db->delete('detail_pembelian', array('kode_pembelian' => $id));
		$this->db->delete('buku_besar', array('kode_transaksi' => $id));
		$this->session->set_flashdata('deletepembelian', '<div class="alert alert-success" role="alert">Pembelian Berhasil Di Hapus</div>');
		redirect('transaksi/pembelian');
	}
	public function deletepenjualan()
	{
		$id = $this->uri->segment(3);
		$this->db->delete('penjualan', array('kode_penjualan' => $id));
		$this->db->delete('detail_penjualan', array('kode_penjualan' => $id));
		$this->db->delete('buku_besar', array('kode_transaksi' => $id));
		$this->session->set_flashdata('deletepenjualan', '<div class="alert alert-success" role="alert">Penjualan Berhasil Di Hapus</div>');
		redirect('transaksi/penjualan');
	}

	public function aksipembelian()
	{
		$total = 0;
		foreach ($_POST['subtotal'] as $value) {
			$total += $value;
		}
		$kode_pembelian = $this->M_pembelian->get_kodepembelian();
		$pembelian = array(
			'kode_pembelian' => $kode_pembelian,
			'tanggal_pembelian' => $_POST['tanggal_beli'],
			'total' => $total,
			'id_admin' => $this->session->userdata("id_admin"),
			'keterangan' => $_POST['keterangan2'],
		);
		$pembelianbukubesar = array(
			'kode_transaksi' => $kode_pembelian,
			'tipe' => 'pembelian',
			'tanggal' => $_POST['tanggal_beli'],
			'nominal' =>  $total,
			'jenis' => 'kredit',
			'keterangan' => $_POST['keterangan2'],
		);
		$this->db->insert('pembelian', $pembelian);
		$this->db->insert('buku_besar', $pembelianbukubesar);
		$lasId = $this->M_pembelian->getLastId();
		foreach ($_POST['kode_barang'] as $key => $value) {
			$data = [
				'kode_pembelian' => $lasId[0]['kode_pembelian'],
				'kode_barang' => $this->input->post('kode_barang')[$key],
				'qty' => $this->input->post('qty')[$key],
				'harga_satuan' => $this->input->post('harga_satuan')[$key],
				'keterangan' => $this->input->post('keterangan')[$key],
			];
			$this->db->insert('detail_pembelian', $data);
		}
		foreach ($_POST['kode_barang'] as $key => $value) {

			$kode_barang = $this->input->post('kode_barang')[$key];
			$qty = $this->input->post('qty')[$key];
			$this->db->query("UPDATE `barang` SET `stok`=stok+'$qty' WHERE kode_barang='$kode_barang'");
		}
		$this->session->set_flashdata('tambahpembelian', '<div class="alert alert-success" role="alert">Pembelian Berhasil Disimpan</div>');
		redirect('transaksi/pembelian');
	}
	public function aksieditpembelian()
	{
		$total = 0;
		foreach ($_POST['subtotal'] as $value) {
			$total += $value;
		}
		$kode_pembelian = $_POST['kode_pembelian'];
		$pembelian = array(
			'kode_pembelian' => $kode_pembelian,
			'tanggal_pembelian' => $_POST['tanggal_beli'],
			'total' => $total,
			'id_admin' => $_SESSION['id_admin'],
			'keterangan' => $_POST['keterangan2'],
		);
		$this->common->update('pembelian', $pembelian, ['kode_pembelian' => $kode_pembelian]); //update pembelian
		$bukuBesar = array(
			'tanggal' => $_POST['tanggal_beli'],
			'nominal' => $total,
			'keterangan' => $_POST['keterangan2']
		);
		$this->common->update('buku_besar', $bukuBesar, ['kode_transaksi' => $kode_pembelian]); //update buku besar


		if (isset($_POST['id_delete'])) {
			foreach ($_POST['id_delete'] as $key => $value) {
				$barangDelete = $this->common->getData('qty,kode_barang', 'detail_pembelian', '', ['id_detail' => $value], '', '')[0];
				$stokValue = $barangDelete['qty'];
				$this->db->query("UPDATE barang SET stok=stok-$stokValue WHERE kode_barang='$barangDelete[kode_barang]'");
				$this->common->delete('detail_pembelian', ['id_detail' => $value]);
			}
		}
		foreach ($_POST['kode_barang'] as $key => $value) {
			$data = [
				'kode_pembelian' => $kode_pembelian,
				'kode_barang' => $this->input->post('kode_barang')[$key],
				'qty' => $this->input->post('qty')[$key],
				'harga_satuan' => $this->input->post('harga_satuan')[$key],
				'keterangan' => $this->input->post('keterangan')[$key],
			];
			if (isset($_POST['id_detail'][$key])) {
				$data['id_detail'] = $this->input->post('id_detail')[$key];
				$getDetail = $this->common->getData('qty', 'detail_pembelian', '', ['id_detail' => $data['id_detail']], '', '')[0];
				if ($getDetail['qty'] != $data['qty']) {
					$kode_barang = $data['kode_barang'];
					if ($getDetail['qty'] > $data['qty']) {
						$selisih = $getDetail['qty'] - $data['qty'];
						$this->db->query("UPDATE barang SET stok=stok-$selisih WHERE kode_barang='$kode_barang'");
					} else {
						$selisih = $data['qty'] - $getDetail['qty'];
						$this->db->query("UPDATE barang SET stok=stok+$selisih WHERE kode_barang='$kode_barang'");
					} //update stok
				}
				$this->common->update('detail_pembelian', $data, ['id_detail' => $data['id_detail']]); //update detail pembelian
			} else {
				$qty = $data['qty'];
				$kode_barang = $data['kode_barang'];
				$this->db->query("UPDATE barang SET stok=stok+$qty WHERE kode_barang='$kode_barang'"); //update stok
				$this->common->insert('detail_pembelian', $data); //insert new detail pembelian
			}
		}

		$this->session->set_flashdata('msg', 'Pembelian Berhasil Diupdate');
		redirect('pembelian/edit/' . $kode_pembelian);
	}
	public function aksieditpenjualan()
	{
		$total = 0;
		foreach ($_POST['subtotal'] as $value) {
			$total += $value;
		}
		$kode_penjualan = $_POST['kode_penjualan'];
		$total_qty = 0;
		foreach ($_POST['qty'] as $value) {
			$total_qty += $value;
		}

		$total_bayar = $this->input->post('total_bayar');
		$nama_pembeli = $this->input->post('nama_pembeli');
		$potongan = $this->input->post('potongan');
		$penjualan = array(
			'kode_penjualan' => $kode_penjualan,
			'tanggal_penjualan' => date('Y/m/d'),
			'nama_pembeli' => $_POST['nama_pembeli'],
			'total_qty' => $total_qty,
			'total_penjualan' => $total,
			'total_bayar' => $_POST['total_bayar'],
			'potongan' => $_POST['potongan'],
			'id_admin' => $_POST['id_admin'],
			'keterangan' => $_POST['keterangan2'],
		);
		$this->common->update('penjualan', $penjualan, ['kode_penjualan' => $kode_penjualan]); //update penjualan
		$bukuBesar = array(
			'tanggal' => date('Y/m/d'),
			'nominal' => $total,
			'keterangan' => $_POST['keterangan2']
		);
		$this->common->update('buku_besar', $bukuBesar, ['kode_transaksi' => $kode_penjualan]); //update buku besar

		if (isset($_POST['id_delete'])) {
			foreach ($_POST['id_delete'] as $key => $value) {
				$barangDelete = $this->common->getData('qty,kode_barang', 'detail_penjualan', '', ['id_detail' => $value], '', '')[0];
				$stokValue = $barangDelete['qty'];
				$this->db->query("UPDATE barang SET stok=stok+$stokValue WHERE kode_barang='$barangDelete[kode_barang]'");
				$this->common->delete('detail_penjualan', ['id_detail' => $value]);
			}
		}
		foreach ($_POST['kode_barang'] as $key => $value) {
			$data = [
				'kode_penjualan' => $kode_penjualan,
				'kode_barang' => $this->input->post('kode_barang')[$key],
				'qty' => $this->input->post('qty')[$key],
				'harga_satuan' => $this->input->post('harga_satuan')[$key],
				'keterangan' => $this->input->post('keterangan')[$key],
			];
			if (isset($_POST['id_detail'][$key])) {
				$data['id_detail'] = $this->input->post('id_detail')[$key];
				$getDetail = $this->common->getData('qty', 'detail_penjualan', '', ['id_detail' => $data['id_detail']], '', '')[0];
				if ($getDetail['qty'] != $data['qty']) {
					$kode_barang = $data['kode_barang'];
					if ($getDetail['qty'] > $data['qty']) {
						$selisih = $getDetail['qty'] - $data['qty'];
						$this->db->query("UPDATE barang SET stok=stok+$selisih WHERE kode_barang='$kode_barang'");
					} else {
						$selisih = $data['qty'] - $getDetail['qty'];
						$this->db->query("UPDATE barang SET stok=stok-$selisih WHERE kode_barang='$kode_barang'");
					} //update stok
				}
				$this->common->update('detail_penjualan', $data, ['id_detail' => $data['id_detail']]); //update detail pembelian
			} else {
				$qty = $data['qty'];
				$kode_barang = $data['kode_barang'];
				$this->db->query("UPDATE barang SET stok=stok-$qty WHERE kode_barang='$kode_barang'"); //update stok
				$this->common->insert('detail_penjualan', $data); //insert new detail pembelian
			}
		}

		$this->session->set_flashdata('msg', 'Pembelian Berhasil Diupdate');
		redirect('penjualan/edit/' . $kode_penjualan);
	}
}
