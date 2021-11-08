<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->icon = "fa-desktop";
		$this->load->model('M_barang');
		$this->load->model('M_kategori');
		$this->load->model('M_akun');
		if ($this->session->userdata('status') != "login") {
            echo "<script>
                alert('Anda harus login terlebih dahulu');
                window.location.href = '" . base_url('Login') . "';
            </script>"; //Url Logi
        }
	}
	public function index()
	{
        $tahun = date('Y');
        $bulan = date('m');

        $tanggal = date('Y/m/01');
        $this->db->select('SUM(kas.nominal) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('YEAR(tanggal_kas)', $tahun);
        $this->db->where('MONTH(tanggal_kas)', $bulan);
        $param['kas']  = $this->db->get('kas')->result();

        $this->db->select('SUM(penjualan.total_penjualan) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('YEAR(tanggal_penjualan)', $tahun);
        $this->db->where('MONTH(tanggal_penjualan)', $bulan);
        $param['penjualan']  = $this->db->get('penjualan')->result();

        $this->db->select('SUM(pembelian.total) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('YEAR(tanggal_pembelian)', $tahun);
        $this->db->where('MONTH(tanggal_pembelian)', $bulan);
        $param['pembelian']  = $this->db->get('pembelian')->result();

        $this->db->select('SUM(buku_besar.nominal) as total');
        $this->db->where('jenis', 'kredit');
        $this->db->where('tanggal <', $tanggal);
        $totalKredit  = $this->db->get('buku_besar')->result();

        $this->db->select('SUM(buku_besar.nominal) as total');

        $this->db->where('jenis', 'debit');
        $this->db->where('tanggal <', $tanggal);
        $totalDebit  = $this->db->get('buku_besar')->result();

        $param['saldoawal'] = $totalDebit[0]->total - $totalKredit[0]->total;
        $param['pageInfo'] = "Dashboard";
		$this->template->load("pages/home", $param);
	}
	
}
