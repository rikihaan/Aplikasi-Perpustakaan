<?php
class Books_m extends CI_Model
{

    // ambbil data buku all
    public function getDataBukuAll(){
        $this->_get_datatables_query();
        if (@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    // filter data buku 
    function count_filtered()
    {
      $this->_get_datatables_query();
      $query = $this->db->get();
      return $query->num_rows();
    }

    // hitung jumlah buku
    function count_all()
    {
      $this->db->from('buku');
      return $this->db->count_all_results();
    }

    // set variabel untuk search, filter, dan sort
    var $column_order = array(null,'judul','tahun','kategori'); //set column field database for datatable orderable
    var $column_search = array( 'judul','tahun','kategori'); //set column field database for datatable searchable
    var $order = array('judul' => 'asc'); // default order

    private function _get_datatables_query()
    {
      $this->db->select('buku.*, kategoribuku.kategori as kategoriBuku, kategoribuku.idKategori');
      $this->db->from('buku');
      $this->db->join('kategoribuku', 'buku.idKategori = kategoribuku.idKategori');
    //   $this->db->where('statusPendaftaran', 1);

      // $this->db->join('jalur_ppdb', 'pendaftar.id_jalur = jalur_ppdb.id');
      $i = 0;
      foreach ($this->column_search as $item) { // loop column
        if (@$_POST['search']['value']) { // if datatable send POST for search
          if ($i === 0) { // first loop
            $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
            $this->db->like($item, $_POST['search']['value']);
          } else {
            $this->db->or_like($item, $_POST['search']['value']);
          }
          if (count($this->column_search) - 1 == $i) //last loop
            $this->db->group_end(); //close bracket
        }
        $i++;
      }
  
      if (isset($_POST['order'])) { // here order processing
        $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      } else if (isset($this->order)) {
        $order = $this->order;
        $this->db->order_by(key($order), $order[key($order)]);
      }
    }

    
}