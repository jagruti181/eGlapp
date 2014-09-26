<?php
class EventModel extends CI_model
{
    function viewall()
      {
         $query= $this->db->query("SELECT `event`.`id`, `event`.`title`, `event`.`locationlat`, `event`.`locationlon`, `event`.`venue`, `event`.`startdate`, `event`.`enddate`, `event`.`description`,`event`.`location`,`event`.`starttime`,`event`.`endtime`, `event`.`organizer` AS `organizerid`,`user`.`firstname` AS `organizername`,`event`.`alias`, `event`.`listingtype`, `event`.`showremainingticket`, `event`.`logo` ,`user`.`lastname`,`user`.`email`,`user`.`website`,`user`.`description`,`user`.`eventinfo`,`user`.`contact`,`user`.`address`,`user`.`city`,`user`.`pincode`,`user`.`dob`,`user`.`accesslevel` AS `accesslevelid`,`accesslevel`.`name`
FROM  `event` 
INNER JOIN  `user` ON  `event`.`organizer` =  `user`.`id` INNER JOIN `accesslevel` ON `user`.`accesslevel` = `accesslevel`.`id`");
        if($query->num_rows > 0)
        {
            return $query->row();
        }
        else 
        {
            return false;
        }
        
      }
    
     function viewone($id)
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
    function showalleventsbyuserid($id)
    {
        $event=$this->db->query("SELECT `event`.`id`, `event`.`title`, `event`.`locationlat`, `event`.`locationlon`, `event`.`venue`, `event`.`startdate`, `event`.`enddate`, `event`.`description`,`event`.`location`,`event`.`starttime`,`event`.`endtime`, `event`.`organizer` AS `organizerid`,`user`.`firstname` AS `organizername`,`event`.`alias`, `event`.`listingtype`, `event`.`showremainingticket`, `event`.`logo` ,`user`.`lastname`,`user`.`email`,`user`.`website`,`user`.`description`,`user`.`eventinfo`,`user`.`contact`,`user`.`address`,`user`.`city`,`user`.`pincode`,`user`.`dob`,`user`.`accesslevel` AS `accesslevelid`,`accesslevel`.`name`
FROM  `event` 
INNER JOIN  `user` ON  `event`.`organizer` =  `user`.`id` INNER JOIN `accesslevel` ON `user`.`accesslevel` = `accesslevel`.`id` AND `event`.`organizer`='$id'")->result();
         //$event->category=$this->db->query("SELECT `eventcategory`.`category` FROM `eventcategory` WHERE `eventcategory`.`event`='$id'")->result();
         //$event->topic=$this->db->query("SELECT `eventtopic`.`topic` FROM `eventtopic` WHERE `eventtopic`.`event`='$id'")->result();
         return $event;
    }
    
    function create($title,$location,$alias,$venue,$startdate,$enddate,$description,$listingtype,$showremainingticket,$logo,$organizer,$category,$topic,$starttime,$endtime)
    {
        $query=$this->db->query("INSERT INTO `event` (`title`,`location`, `alias`,`venue`, `startdate`, `enddate`,`description`,`listingtype`,`showremainingticket`,`logo`,`organizer`,`starttime`,`endtime`) VALUES ('$title','$location','$alias','$venue','$startdate','$enddate','$description','$listingtype','$showremainingticket','$logo','$organizer','$starttime','$endtime')");
        $categoryarray= explode(",", $category);
        $topicarray= explode(",", $topic);
        $eventid=$this->db->insert_id();
        foreach($categoryarray as $cat)
        {
         $querycategory=$this->db->query("INSERT INTO eventcategory(`event`,`category`) VALUES ('$eventid','$cat')"); 
        }
        foreach($topicarray as $singletopic)
        {
         $querycategory=$this->db->query("INSERT INTO eventtopic(`event`,`topic`) VALUES ('$eventid','$singletopic')"); 
        }
        return $eventid;
        
    }
    
    function update($id,$title,$location,$alias,$venue,$startdate,$enddate,$description,$listingtype,$showremainingticket,$logo,$organizer,$category,$topic,$starttime,$endtime)
    {
        $query=$this->db->query("UPDATE `event` SET `title`='$title',`locationlat`='$locationlat',`locationlon`='$locationlon',`venue`='$venue',`startdate`='$startdate',`enddate`='$enddate',`description`='$description',`listingtype`='$listingtype',`showremainingticket`='$showremainingticket',`logo`='$logo',`starttime`='$starttime',`endtime`='$endtime' WHERE `id`=$id");
        //$this->db->where('id', $id);
        $querycategorydelet=$this->db->query("DELETE FROM `eventcategory` WHERE `event`='$id'");
        $querytopicdelet=$this->db->query("DELETE FROM `eventtopic` WHERE `event`='$id'");
        $categoryarray= explode(",", $category);
        $topicarray= explode(",", $topic);
        foreach($categoryarray as $cat)
        {
            $querycategory=$this->db->query("INSERT INTO eventcategory(`event`,`category`) VALUES ('$id','$cat')"); 
        }
        foreach($topicarray as $singletopic)
        {
            $querycategory=$this->db->query("INSERT INTO eventtopic(`event`,`topic`) VALUES ('$id','$singletopic')"); 
        }
        return $query;
    }
    function deleteone($id)
    {
        $queryeventdelet=$this->db->query("DELETE FROM `event` WHERE `id`='$id'");
        $querycategory=$this->db->query("DELETE FROM `eventcategory` WHERE `event`='$id'");
        $querytopic=$this->db->query("DELETE FROM `eventtopic` WHERE `event`='$id'");
        return true;
    }
}
?>