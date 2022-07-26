<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_model extends CI_Model
{
    public function GetDataUserAll(){
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
  
    // ===== akhir kumpulan block funtion


    // block dasar query ajax
    var $column_order = array(null, 'id', 'name','jabatan'); //set column field database for datatable orderable
    var $column_search = array('id', 'name','jabatan'); //set column field database for datatable searchable
    var $order = array('name' => 'asc'); // default order
    private function _get_datatables_query()
    {
      $this->db->select('*');
      $this->db->from('user');
    
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
    // end bloc query dasar ajax
    public function ProsesSimpanUser($data){
      $roles="";
      if($data['roles']=='1'){
        $roles="Admin";
      }
      elseif($data['roles']=='2'){
        $roles="Pustakawan";

      }
      $insert=[
        'id'=> $this->kodeUser(),
        'name'=>$data['nama'],
        'jabatan'=>$roles,
        'email'=>$this->kodeUser(),
        'image'=>'default.jpg',
        'password'=>'',
        'role_id'=>$data['roles'],
        'is_active'=>1,
        'date_created'=>time()
      ];
      $this->db->insert('user', $insert);
      return $this->db->affected_rows();
    }

    // buat kode user atau pengguna
     private function kodeUser()
     {
       $today = date("Ymd");
       $per="PGS";
       $query = "SELECT max(id) AS last FROM user WHERE id LIKE '$per$today%'";
       $data = $this->db->query($query)->row_array();
       $lastKodeBuku = $data['last'];
       $lastNoUrut = substr($lastKodeBuku,11, 4);
       $nexKodeBuku = $lastNoUrut + 1;
       $newKodeBuku = $per.$today . sprintf('%04s', $nexKodeBuku);
       return $newKodeBuku;
     }
     // end kode user pengguna

    // get data anggota by id
      public function getDataUserById($id){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

     // prosses edit data User
     public function ProsesEditUser($data){
      $roles="";
      if($data['roles']=='1'){
        $roles="Admin";
      }
      elseif($data['roles']=='2'){
        $roles="Pustakawan";

      }

      $insert=[
        'name'=>$data['nama'],
        'jabatan'=>$roles,
        'role_id'=>$data['roles'],
      ];
      
      $this->db->set($insert);
      $this->db->where('id', $data['id']);
      $this->db->update('user');
      return $this->db->affected_rows();
     }

     public function prosesHapusUser($id){
      $this->db->delete('user', ['id' => $id]);
      return $this->db->affected_rows();
     }
}
