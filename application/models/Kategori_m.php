<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kategori_m extends CI_Model
{

    // Reques datatables
    public function GetDataKategoriAll(){
        $this->_get_datatables_query();
        if (@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
        }
    
        function count_filtered()
        {
          $this->_get_datatables_query();
          $query = $this->db->get();
          return $query->num_rows();
        }
        
        function count_all()
        {
          $this->db->from('user');
          return $this->db->count_all_results();
        }


        var $column_order = array(null, 'idKategori', 'kategori'); //set column field database for datatable orderable
        var $column_search = array('idKategori', 'kategori'); //set column field database for datatable searchable
        var $order = array('kategori' => 'asc'); // default order
        private function _get_datatables_query()
        {
          $this->db->select('*');
          $this->db->from('kategoribuku');
        
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
    // end reques data tables

    // proses simpan kategori
    public function ProsesSimpanKategori($data){
        $insert=[
          'idKategori'=> $data['kodeKategori'],
          'kategori'=>$data['kategori'],
        ];
        $this->db->insert('kategoribuku', $insert);
        return $this->db->affected_rows();
      }

    //   getdataKategoriby id
    public function getDataKategoriById($id){
        $this->db->select('*');
        $this->db->from('kategoribuku');
        $this->db->where('idKategori', $id);
        return $this->db->get()->row_array();
    }

    // proses edit data kategori
     // prosses edit data Kategori
     public function ProsesEditKategori($data){
        
        $insert=[
            'kategori'=>$data['kategori']
          ];
        
        $this->db->set($insert);
        $this->db->where('idKategori', $data['id']);
        $this->db->update('kategoribuku');
        return $this->db->affected_rows();
       }



}