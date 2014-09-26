<?php
class CategoryModel extends CI_model
{
    function viewall()
      {
         $query= $this->db->query("SELECT * FROM `category`");
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
         //$this->db->where('id', $id);
         $query= $this->db->query("SELECT * FROM `category` WHERE `id`='$id'");
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
        $query=$this->db->query("INSERT INTO `category` (`name`, `parent`, `status`) VALUES ('$name','$parent','$status')");
        return $query;
        
    }
    
    function update()
    {
        $id=$this->input->get('id');
        $name=$this->input->get('name');
        $parent=$this->input->get('parent');
        $status=$this->input->get('status');
        $query=$this->db->query("UPDATE `category` SET `name`='$name',`parent`='$parent',`status`='$status' WHERE `id`=$id");
        return $query;
    }
    function deleteone()
    {
        $id=$this->input->get('id');
        $queryeventdelet=$this->db->query("DELETE FROM `category` WHERE `id`='$id'");
        return true;
    }
    function findalleventbycategory()
    {
        $category=$this->input->get('category');
        $query=$this->db->query("SELECT `event`.`id` as `eventid`,`eventcategory`.`category`,`event`.`title`,`event`.`venue`,`event`.`startdate`,`event`.`enddate`,`event`.`description`,`event`.`listingtype`,`event`.`showremainingticket`,`event`.`logo`,`event`.`location`,`event`.`alias`,`event`.`organizer` as `organizerid`,`user`.`firstname`,`user`.`lastname`,`user`.`email` as `useremail`,`user`.`website` as `userwebsite`,`user`.`description`,`user`.`eventinfo`,`user`.`contact`,`user`.`address`,`user`.`city`,`user`.`pincode`,`user`.`dob`,`user`.`accesslevel`,`accesslevel`.`name` as `accesslevelname` FROM `eventcategory` INNER JOIN `event` ON `event`.`id`=`eventcategory`.`event`  AND `eventcategory`.`category`='$category' LEFT OUTER JOIN `user` ON `user`.`id`=`event`.`organizer` LEFT OUTER JOIN `accesslevel` ON `user`.`accesslevel`=`accesslevel`.`id`GROUP BY `eventid`");
        return $query->result();
     }
    function findalleventbysearch()
    {
        $search=$this->input->get_post('search');
        $query=$this->db->query("SELECT `event`.`id` as `eventid`,`event`.`title`,`event`.`venue`,`event`.`startdate`,`event`.`enddate`,`event`.`description`,`event`.`listingtype`,`event`.`showremainingticket`,`event`.`logo`,`event`.`location`,`event`.`alias`,`event`.`organizer` as `organizerid`,`user`.`firstname`,`user`.`lastname`,`user`.`email` as `useremail`,`user`.`website` as `userwebsite`,`user`.`description`,`user`.`eventinfo`,`user`.`contact`,`user`.`address`,`user`.`city`,`user`.`pincode`,`user`.`dob`,`user`.`accesslevel`,`accesslevel`.`name` as `accesslevelname` FROM `eventcategory` INNER JOIN `event` ON `event`.`id`=`eventcategory`.`event` LEFT OUTER JOIN `user` ON `user`.`id`=`event`.`organizer` LEFT OUTER JOIN `accesslevel` ON `user`.`accesslevel`=`accesslevel`.`id` WHERE `event`.`venue` LIKE '%$search%' OR `event`.`location` LIKE '%$search%' OR `user`.`firstname` LIKE '%$search%' OR `event`.`title` LIKE '%$search%' OR `event`.`startdate` LIKE '%$search%' OR `event`.`enddate` LIKE '%$search%' group by `eventid`");
        return $query->result();
    }
    
}
?>