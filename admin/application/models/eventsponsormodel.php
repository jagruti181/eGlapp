<?php
class EventsponsorModel extends CI_model
{
    function viewall()
      {
         $query= $this->db->query("SELECT  `eventsponsor`.`event` AS  `Event ID` ,  `event`.`title` AS  `Event Title` ,  `eventsponsor`.`user` AS  `User ID` ,  `user`.`firstname` AS  `User Name` , `eventsponsor`.`amountsponsor` ,  `eventsponsor`.`image` ,  `eventsponsor`.`starttime` ,  `eventsponsor`.`endtime` 
FROM  `eventsponsor` 
INNER JOIN  `event` ON  `event`.`id` =  `eventsponsor`.`event` 
INNER JOIN  `user` ON  `user`.`id` =  `eventsponsor`.`user`");
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
         $event=$this->input->get('event');
         //$this->db->where('id', $id);
         $query= $this->db->query("SELECT  `eventsponsor`.`event` AS  `Event ID` ,  `event`.`title` AS  `Event Title` ,  `eventsponsor`.`user` AS  `User ID` ,  `user`.`firstname` AS  `User Name` , `eventsponsor`.`amountsponsor` ,  `eventsponsor`.`image` ,  `eventsponsor`.`starttime` ,  `eventsponsor`.`endtime` 
FROM  `eventsponsor` 
INNER JOIN  `event` ON  `event`.`id` =  `eventsponsor`.`event` 
INNER JOIN  `user` ON  `user`.`id` =  `eventsponsor`.`user` WHERE `eventsponsor`.`event`='$event'");
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
    
    function create()
    {
        $event=$this->input->get('event');
        $user=$this->input->get('user');
        $amountsponsor=$this->input->get('amountsponsor');
        $image=$this->input->get('image');
        $starttime=$this->input->get('starttime');
        $endtime=$this->input->get('endtime');
        $query=$this->db->query("INSERT INTO `eventsponsor` (`event`,`user`, `amountsponsor`,`image`, `starttime`, `endtime`) VALUES ('$event','$user','$amountsponsor','$image','$starttime','$endtime')");
        return $query;
        
    }
    
    function update()
    {
        $id=$this->input->get('id');
        $event=$this->input->get('event');
        $user=$this->input->get('user');
        $amountsponsor=$this->input->get('amountsponsor');
        $image=$this->input->get('image');
        $starttime=$this->input->get('starttime');
        $endtime=$this->input->get('endtime');
        $query=$this->db->query("UPDATE `eventsponsor` SET `event`='$event',`user`='$user',`amountsponsor`='$amountsponsor',`image`='$image',`starttime`='$starttime',`endtime`='$endtime' WHERE `id`=$id");
        return $query;
    }
    function deleteone()
    {
        $id=$this->input->get('id');
        $queryeventdelet=$this->db->query("DELETE FROM `eventsponsor` WHERE `id`='$id'");
        return true;
    }
}
?>