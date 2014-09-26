<?php
class TopicModel extends CI_model
{
    function viewall()
      {
        $query= $this->db->query("SELECT * FROM `topic`");
        if($query->num_rows > 0)
        {
            return $query->result();
        }
        else 
        {
            return false;
        }
        return $data;
        
      }
    
     function viewone()
      {
         $id=$this->input->get('id');
         $query= $this->db->query("SELECT * FROM `topic` WHERE `id`='$id'");
        if($query->num_rows > 0)
        {
            return $query->row();
        }
        else 
        {
            return false;
        }
        return $data;
         
      }
    
    function create()
    {
        $name=$this->input->get('name');
        $parent=$this->input->get('parent');
        $status=$this->input->get('status');
        $query=$this->db->query("INSERT INTO `topic` (`name`, `parent`, `status`) VALUES ('$name','$parent','$status')");
        return $query;
        
    }
    
    function update()
    {
        $id=$this->input->get('id');
        $name=$this->input->get('name');
        $parent=$this->input->get('parent');
        $status=$this->input->get('status');
        $query=$this->db->query("UPDATE `topic` SET `name`='$name',`parent`='$parent',`status`='$status' WHERE `id`=$id");
        return $query;
    }
    function deleteone()
    {
        $id=$this->input->get('id');
        $queryeventdelet=$this->db->query("DELETE FROM `topic` WHERE `id`='$id'");
        return true;
    }
}
?>