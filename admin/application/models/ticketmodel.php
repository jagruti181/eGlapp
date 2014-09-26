<?php
class TicketModel extends CI_model
{
    
     function viewbyevent($id)
      {
         //$this->db->where('id', $id);
         $event=$this->db->query("SELECT `event`.`id`, `event`.`title`, `event`.`locationlat`, `event`.`locationlon`, `event`.`venue`, `event`.`startdate`, `event`.`enddate`, `event`.`description`,`event`.`location`, `event`.`starttime`,`event`.`endtime`,`event`.`organizer` AS `organizerid`,`user`.`firstname` AS `organizername`,`event`.`alias`, `event`.`listingtype`, `event`.`showremainingticket`, `event`.`logo` ,`user`.`lastname`,`user`.`email`,`user`.`website`,`user`.`description` as orgdescription,`user`.`eventinfo`,`user`.`contact`,`user`.`address`,`user`.`city`,`user`.`pincode`,`user`.`dob`,`user`.`accesslevel` AS `accesslevelid`,`accesslevel`.`name` AS `accesslevelname`
FROM  `event` 
INNER JOIN  `user` ON  `event`.`organizer` =  `user`.`id` INNER JOIN `accesslevel` ON `user`.`accesslevel` = `accesslevel`.`id` WHERE `event`.`id`='$id'")->row();
         $eventcategory=$this->db->query("SELECT `eventcategory`.`category` FROM `eventcategory` WHERE `eventcategory`.`event`='$id'")->result();
         $eventcategoryarray=Array();
         foreach($eventcategory as $eventcat)
         {
             //$eventcategoryarray.push($eventcat->category);
             array_push($eventcategoryarray,$eventcat->category);
         }
            $event->category=$eventcategoryarray;
          $eventtopic=$this->db->query("SELECT `eventtopic`.`topic` FROM `eventtopic` WHERE `eventtopic`.`event`='$id'")->result();
         $eventtopicarray=Array();
         foreach($eventtopic as $eventtop)
         {
            // $eventtopicarray.push($eventcat->category);
             array_push($eventtopicarray,$eventtop->topic);
         }
            $event->topic=$eventtopicarray;
         return $event;
         
      }
}
?>