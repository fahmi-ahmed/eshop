<?php
class Chart_model extends CI_Model{
    function report(){
        $query = $this->db->query("SELECT * from sellers");

        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
}
?>
