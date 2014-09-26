<?php
class EventModel extends CI_model
{
    function viewall()
      {
         $query= $this->db->query("SELECT `event`.`id`, `event`.`title`, `event`.`locationlat`, `event`.`locationlon`, `event`.`venue`, `event`.`startdate`, `event`.`enddate`, `event`.`description`, `event`.`organizer` AS `organizerid`,`organizer`.`name` AS `organizername`,`event`.`alias`, `event`.`listingtype`, `event`.`showremainingticket`, `event`.`logo` 
FROM  `event` 
INNER JOIN  `organizer` ON  `event`.`organizer` =  `organizer`.`id`");
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
         $event=$this->db->query("SELECT `event`.`id`,`event`.`title`,`event`.`venue`,`event`.`startdate`,`event`.`enddate`,`event`.`description`,`event`.`listingtype`,`event`.`showremainingticket`,`event`.`logo`,`event`.`location`,`event`.`alias`,`event`.`organizer` as `organizerid` FROM `event` INNER JOIN `user` ON `event`.`organizer`=`user`.`id` WHERE `event`.`id`='$id'")->row();
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
    function showalleventsbyuserid()
    {
        $id=$this->input->get('id');
        $event=$this->db->query("SELECT `event`.`id`, `event`.`title`, `event`.`locationlat`, `event`.`locationlon`, `event`.`venue`, `event`.`startdate`, `event`.`enddate`, `event`.`description`,`event`.`location`, `event`.`organizer` AS `organizerid`,`user`.`firstname` AS `organizername`,`event`.`alias`, `event`.`listingtype`, `event`.`showremainingticket`, `event`.`logo` ,`user`.`lastname`,`user`.`email`,`user`.`website`,`user`.`description`,`user`.`eventinfo`,`user`.`contact`,`user`.`address`,`user`.`city`,`user`.`pincode`,`user`.`dob`,`user`.`accesslevel` AS `accesslevelid`,`accesslevel`.`name`
FROM  `event` 
INNER JOIN  `user` ON  `event`.`organizer` =  `user`.`id` INNER JOIN `accesslevel` ON `user`.`accesslevel` = `accesslevel`.`id` AND `event`.`organizer`='$id'")->result();
         //$event->category=$this->db->query("SELECT `eventcategory`.`category` FROM `eventcategory` WHERE `eventcategory`.`event`='$id'")->result();
         //$event->topic=$this->db->query("SELECT `eventtopic`.`topic` FROM `eventtopic` WHERE `eventtopic`.`event`='$id'")->result();
         return $event;
    }
    
    function create()
    {
        $title=$this->input->get('title');
        $locationlat=$this->input->get('locationlat');
        $locationlon=$this->input->get('locationlon');
        $venue=$this->input->get('venue');
		$location=$this->input->get('location');
		$alias=$this->input->get('alias');
        $startdate=$this->input->get('startDate');
       
        /*$start= explode("-", $startdate);
        $month=$start[0];
        $date=$start[1];
        $year=$start[2];
        $arraystart=array($date,$month,$month);
        $startdate=implode("-",$arraystart);*/
        
        $enddate=$this->input->get('endDate');
       /* $end= explode("-", $enddate);
        $month=$end[0];
        $date=$end[1];
        $year=$end[2];
        $arrayend=array($year,$month,$date);
        $enddate=implode("-",$arrayend);*/
        
        $description=$this->input->get('description');
        $organizer=$this->input->get('organizer');
        $listingtype=$this->input->get('listingtype');
        $showremainingticket=$this->input->get('showremainingticket');
        $logo=$this->input->get('logo');
        $category=$this->input->get('category');
        $topic=$this->input->get('topic');
        $query=$this->db->query("INSERT INTO `event` (`title`,`location`, `alias`,`venue`, `startdate`, `enddate`,`description`,`listingtype`,`showremainingticket`,`logo`,`organizer`) VALUES ('$title','$location','$alias','$venue','$startdate','$enddate','$description','$listingtype','$showremainingticket','$logo','$organizer')");
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
    
    function update()
    {
        $id=$this->input->get('id');
        $title=$this->input->get('title');
        $locationlat=$this->input->get('locationlat');
        $locationlon=$this->input->get('locationlon');
        $venue=$this->input->get('venue');
        $startdate=$this->input->get('startDate');
        $enddate=$this->input->get('endDate');
        $description=$this->input->get('description');
        $organizer=$this->input->get('organizer');
        $listingtype=$this->input->get('listingtype');
        $showremainingticket=$this->input->get('showremainingticket');
        $logo=$this->input->get('logo');
        $category=$this->input->get('category');
        $topic=$this->input->get('topic');
        $query=$this->db->query("UPDATE `event` SET `title`='$title',`locationlat`='$locationlat',`locationlon`='$locationlon',`venue`='$venue',`startdate`='$startdate',`enddate`='$enddate',`description`='$description',`listingtype`='$listingtype',`showremainingticket`='$showremainingticket',`logo`='$logo' WHERE `id`=$id");
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
    function deleteone()
    {
        $id=$this->input->get('id');
        $queryeventdelet=$this->db->query("DELETE FROM `event` WHERE `id`='$id'");
        $querycategory=$this->db->query("DELETE FROM `eventcategory` WHERE `event`='$id'");
        $querytopic=$this->db->query("DELETE FROM `eventtopic` WHERE `event`='$id'");
        return true;
    }
}
?>