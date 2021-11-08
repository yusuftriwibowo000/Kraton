<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{


    function getPembelian($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
        // $searchSuplier = $postData['searchSuplier'];
        // $searchNama = $postData['searchNama'];
        $tglawal = $postData['tglawal'];
        $tglakhir = $postData['tglakhir'];




        ## Search 


        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->join('admin', 'admin.id_admin=pembelian.id_admin');
        $records  = $this->db->get('pembelian')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->where('tanggal_pembelian >=', $tglawal);
        $this->db->where('tanggal_pembelian <=', $tglakhir);
        $this->db->join('admin', 'admin.id_admin=pembelian.id_admin');
        $records  = $this->db->get('pembelian')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        $this->db->where('tanggal_pembelian >=', $tglawal);
        $this->db->where('tanggal_pembelian <=', $tglakhir);
        $this->db->limit($rowperpage, $start);
        $this->db->join('admin', 'admin.id_admin=pembelian.id_admin');
        $records  = $this->db->get('pembelian')->result();

        $this->db->select('*');
        $this->db->limit($rowperpage, $start);
        $this->db->join('admin', 'admin.id_admin=pembelian.id_admin');
        $records2  = $this->db->get('pembelian')->result();

        $data = array();
        if ($tglawal ==  null || $tglakhir == null) {
            foreach ($records2 as $record) {


                $data[] = array(
                    "kode_pembelian" => $record->kode_pembelian,
                    "tanggal_pembelian" => $record->tanggal_pembelian,
                    "total" => $record->total,
                    "username" => $record->username,
                    "keterangan" => $record->keterangan
                );
            }
        } else {
            foreach ($records as $record) {


                $data[] = array(
                    "kode_pembelian" => $record->kode_pembelian,
                    "tanggal_pembelian" => $record->tanggal_pembelian,
                    "total" => $record->total,
                    "username" => $record->username,
                    "keterangan" => $record->keterangan
                );
            }
        }



        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }


    function getPenjualan($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
        // $searchSuplier = $postData['searchSuplier'];
        // $searchNama = $postData['searchNama'];
        $tglawal = $postData['tglawal'];
        $tglakhir = $postData['tglakhir'];




        ## Search 


        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->join('admin', 'admin.id_admin=penjualan.id_admin');
        $records  = $this->db->get('penjualan')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->where('tanggal_penjualan >=', $tglawal);
        $this->db->where('tanggal_penjualan <=', $tglakhir);
        $this->db->join('admin', 'admin.id_admin=penjualan.id_admin');
        $records  = $this->db->get('penjualan')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        $this->db->where('tanggal_penjualan >=', $tglawal);
        $this->db->where('tanggal_penjualan <=', $tglakhir);
        $this->db->limit($rowperpage, $start);
        $this->db->join('admin', 'admin.id_admin=penjualan.id_admin');
        $records  = $this->db->get('penjualan')->result();

        $this->db->select('*');
        $this->db->limit($rowperpage, $start);
        $this->db->join('admin', 'admin.id_admin=penjualan.id_admin');
        $records2  = $this->db->get('penjualan')->result();

        $data = array();
        if ($tglawal ==  null || $tglakhir == null) {
            foreach ($records2 as $record) {


                $data[] = array(
                    "kode_penjualan" => $record->kode_penjualan,
                    "tanggal_penjualan" => $record->tanggal_penjualan,
                    "nama_pembeli" => $record->nama_pembeli,
                    "total_qty" => $record->total_qty,
                    "total_penjualan" => $record->total_penjualan,
                    "total_bayar" => $record->total_bayar,
                    "potongan" => $record->potongan,
                    "username" => $record->username,
                    "keterangan" => $record->keterangan
                );
            }
        } else {
            foreach ($records as $record) {


                $data[] = array(
                    "kode_penjualan" => $record->kode_penjualan,
                    "tanggal_penjualan" => $record->tanggal_penjualan,
                    "nama_pembeli" => $record->nama_pembeli,
                    "total_qty" => $record->total_qty,
                    "total_penjualan" => $record->total_penjualan,
                    "total_bayar" => $record->total_bayar,
                    "potongan" => $record->potongan,
                    "username" => $record->username,
                    "keterangan" => $record->keterangan
                );
            }
        }



        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }

    function getBukubesar($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
        // $searchSuplier = $postData['searchSuplier'];
        // $searchNama = $postData['searchNama'];
        $bulan = $postData['bulan'];
        $tahun = $postData['tahun'];

        $tanggal = $tahun . '-' . $bulan . '-01';

        // ## Search 
        // $search_arr = array();
        // $searchQuery = "";
        // if ($searchValue != '') {
        //     $search_arr[] = " (nama_pengeluaran like '%" . $searchValue . "%'  ) ";
        // }
        // // if ($searchSuplier != '') {
        // //     $search_arr[] = " nama_suplier='" . $searchSuplier . "' ";

        // if ($searchTahun != '') {
        //     $search_arr[] = " tgl_pengeluaran like'%" . $searchTahun . "%' ";
        // }        // }

        // if ($searchBulan != '') {
        //     $search_arr[] = " tgl_pengeluaran like'%" . $searchBulan . "%' ";
        // }
        // if (count($search_arr) > 0) {
        //     $searchQuery = implode(" and ", $search_arr);
        // }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $records  = $this->db->get('buku_besar')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($bulan != '' || $tahun != '')
            $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('MONTH(tanggal)', $bulan);
        $records  = $this->db->get('buku_besar')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($bulan != '' || $tahun != '')
            $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->order_by('buku_besar.id_bukubesar');
        $this->db->limit($rowperpage, $start);
        $records  = $this->db->get('buku_besar')->result();

        // $this->db->select('*');
        $this->db->select('SUM(buku_besar.nominal) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('jenis', 'kredit');
        $this->db->where('tanggal <', $tanggal);
        $totalKredit  = $this->db->get('buku_besar')->result();

        $this->db->select('SUM(buku_besar.nominal) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('jenis', 'debit');
        $this->db->where('tanggal <', $tanggal);
        $totalDebit  = $this->db->get('buku_besar')->result();



        $data = array();

        $saldoAwal = $totalDebit[0]->total - $totalKredit[0]->total;
        $data[] = array(
            "kode_transaksi" => 'saldo awal',
            "tipe" => 'Saldo awal',
            "tanggal" => $tanggal,
            "debit" => $totalDebit[0]->total,
            "kredit" => $totalKredit[0]->total,
            "saldo" => $saldoAwal,
            "keterangan" => '-'
        );


        $debit = '';
        $kredit = '';
        foreach ($records as $key => $record) {
            if ($key == 0) {
                $saldoTerakhir = $saldoAwal;
            } else {
                $saldoTerakhir = $records[$key - 1]->saldoSekarang;
            }
            if ($record->jenis == 'debit') {
                $saldoSekarang = $saldoTerakhir + $record->nominal;
            } else {
                $saldoSekarang = $saldoTerakhir - $record->nominal;
            }
            $records[$key]->saldoSekarang = $saldoSekarang;

            if ($record->jenis == 'debit') {
                $debit = $record->nominal;
            } else {
                $debit = '-';
            }
            if ($record->jenis == 'kredit') {
                $kredit = $record->nominal;
            } else {
                $kredit = '-';
            }

            $data[] = array(
                "kode_transaksi" => $record->kode_transaksi,
                "tipe" => $record->tipe,
                "tanggal" => $record->tanggal,
                "debit" => $debit,
                "kredit" => $kredit,
                "saldo" => $saldoSekarang,
                "keterangan" => $record->keterangan
            );
        }


        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }
    function getLabarugi($postData = null)
    {

        $response = array();

        ## Read value
/*         $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
 */
        // Custom search filter 
        // $searchSuplier = $postData['searchSuplier'];
        // $searchNama = $postData['searchNama'];
        $bulan = $postData['bulan'];
        $tahun = $postData['tahun'];

        $tanggal = $tahun . '-' . $bulan . '-01';

        // ## Search 
        // $search_arr = array();
        // $searchQuery = "";
        // if ($searchValue != '') {
        //     $search_arr[] = " (nama_pengeluaran like '%" . $searchValue . "%'  ) ";
        // }
        // // if ($searchSuplier != '') {
        // //     $search_arr[] = " nama_suplier='" . $searchSuplier . "' ";

        // if ($searchTahun != '') {
        //     $search_arr[] = " tgl_pengeluaran like'%" . $searchTahun . "%' ";
        // }        // }

        // if ($searchBulan != '') {
        //     $search_arr[] = " tgl_pengeluaran like'%" . $searchBulan . "%' ";
        // }
        // if (count($search_arr) > 0) {
        //     $searchQuery = implode(" and ", $search_arr);
        // }

/*         ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $records  = $this->db->get('buku_besar')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($bulan != '' || $tahun != '')
            $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('MONTH(tanggal)', $bulan);
        $records  = $this->db->get('buku_besar')->result();
        $totalRecordwithFilter = $records[0]->allcount;
 */
        ## Fetch records
        $this->db->select('*');
        if ($bulan != '' || $tahun != '')
            $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->order_by('buku_besar.id_bukubesar');
//        $this->db->limit($rowperpage, $start);
        $records  = $this->db->get('buku_besar')->result();

        // $this->db->select('*');
        $this->db->select('SUM(buku_besar.nominal) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('jenis', 'kredit');
        $this->db->where('tanggal <', $tanggal);
        $totalKredit  = $this->db->get('buku_besar')->result();

        $this->db->select('SUM(penjualan.total_penjualan) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('YEAR(tanggal_penjualan)', $tahun);
        $this->db->where('MONTH(tanggal_penjualan)', $bulan);
        $penjualan  = $this->db->get('penjualan')->result();


        $this->db->select('SUM(pembelian.total) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('YEAR(tanggal_pembelian)', $tahun);
        $this->db->where('MONTH(tanggal_pembelian)', $bulan);
        $pembelian  = $this->db->get('pembelian')->result();

        $this->db->select('SUM(penjualan.potongan) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('YEAR(tanggal_penjualan)', $tahun);
        $this->db->where('MONTH(tanggal_penjualan)', $bulan);
        $potongan  = $this->db->get('penjualan')->result();

        $this->db->select('SUM(buku_besar.nominal) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('jenis', 'debit');
        $this->db->where('tanggal <', $tanggal);
        $totalDebit  = $this->db->get('buku_besar')->result();



        $data = array();

        $saldoAwal = $totalDebit[0]->total - $totalKredit[0]->total;
        $totalpenjualan = $penjualan[0]->total-$potongan[0]->total;
        $returnpenjualan = 0;
        $returnpembelian = 0;
        $potonganpembelian = 0;
        $pembelianbersih = $pembelian[0]->total-$returnpembelian-$potonganpembelian;
        $totalpersediaan = $totalDebit[0]->total+$pembelian[0]->total;
        $persediaanakhir = $totalDebit[0]->total-$totalpenjualan;
        $hpp = $totalpersediaan-$persediaanakhir;
        $data[] = array(
            "penjualan" => $penjualan[0]->total,
            "potongan_penjualan" => $potongan[0]->total,
            "return_penjualan" => $returnpenjualan,
            "total_penjualan" => $totalpenjualan,
            "pembelian" => $pembelian[0]->total,
            "potongan_pembelian" => $potonganpembelian,
            "return_pembelian" => $returnpembelian,
            "pembelian_bersih" => $pembelianbersih,
            "persediaan_awal" => $totalDebit[0]->total,
            "total_persediaan" => $totalpersediaan,
            "persediaan_akhir" =>  $persediaanakhir,
            "hpp" => $hpp,
            "laba_rugi" => $totalpenjualan-$hpp
        );


        


        ## Response
/*         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
 */
        return $data;
    }
   
    function getLaba($postData = null)
    {


        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
        // $searchSuplier = $postData['searchSuplier'];
        // $searchNama = $postData['searchNama'];
        // $searchBulan = $postData['searchBulan'];
        $searchTahun = $postData['searchTahun'];


        ## Search 
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '') {
            $search_arr[] = "(  tgl_transaksi like '%" . $searchValue . "%'  ) ";
        }

        if ($searchTahun != '') {
            $search_arr[] = "  tgl_transaksi like '%" . $searchTahun . "%'  ";
        }
        // if ($searchBulan != '') {
        //     $search_arr[] = "  tgl_transaksi like '%" . $searchBulan . "%' ";
        // }

        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->group_by('month(tgl_transaksi)');
        $records  = $this->db->get('transaksi')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->group_by('month(tgl_transaksi)');
        $records  = $this->db->get('transaksi')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by('id_transaksi');
        $this->db->limit($rowperpage, $start);
        $this->db->group_by('month(tgl_transaksi)');
        $records  = $this->db->get('transaksi')->result();

        $data = array();

        $i = 1;
        foreach ($records as $record) {

            $bulan = date('m', strtotime($record->tgl_transaksi));
            $tahun = date('Y', strtotime($record->tgl_transaksi));

            $data[] = array(
                "no" => $i++,
                "bulan" => bulan($bulan) . ' ' . $tahun,
                "action" => ' <form action="' . base_url("Admin/Laporan/detail_laba") . '" method="post">
                <input name="bulan" hidden value="' . $bulan . '">
                <input name="tahun" hidden value="' . $tahun . '">
                <td><button class="btn btn-info" type="submit">Lihat Laba Rugi</button></td>
            </form>',

            );
        }


        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }
}
