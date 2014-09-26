<?php
class EventModel extends CI_model
{
    
    function send_reminders() 
    {
    
        $this->load->config('mandrill');

$this->load->library('mandrill');
        $mandrill_ready = NULL;

        try {

            $this->mandrill->init('Wflir9K2pGRYFFfr88rREg');
            $mandrill_ready = TRUE;

        } catch(Mandrill_Exception $e) {

            $mandrill_ready = FALSE;

        }
$query=$this->db->query("SELECT `event`.`id`,`event`.`title`,`event`.`venue`,`event`.`location`,`event`.`startdate`,`event`.`enddate`,`event`.`starttime`, `event`.`endtime`,`event`.`logo`,`useremails`.`event`,`useremails`.`email` FROM `event` INNER JOIN `useremails` ON `event`.`id`=`useremails`.`event` WHERE `event`.`startdate`=DATE_SUB(CURDATE(),INTERVAL 2 DAY)
")->result();
 if( $mandrill_ready ) {
        foreach($query as $email)
        {
           

                //Send us some email!
                $email = array(
                    'html' => '<p>Event name : '+$email->title+'</p>', //Consider using a view file
                    'text' => '',
                    'subject' => 'Reminder from Eventgap',
                    'from_email' => 'eglapp@eglapp.com',
                    'from_name' => 'Eventgap',
                    'to' => array(array('email' => $email->email )) //Check documentation for more details on this one
                    //'to' => array(array('email' => 'joe@example.com' ),array('email' => 'joe2@example.com' )) //for multiple emails
                    );

               $result = $this->mandrill->messages_send($email);


          }
      }

    }
     function dateop()
    {
         $rem=$this->dateoperations->subtract(date('y-m-d'),'day',2);
         $query=$this->db->query("SELECT `startdate` FROM `event`")->result();
         return json_decode($query);
    }
    function saveticket($ticket)
    {
        $eventcategoryarray=Array();
         foreach($ticket as $eventcat)
         {
             //$eventcategoryarray.push($eventcat->category);
             array_push($eventcategoryarray,$eventcat->name);
         }
        return $eventcategoryarray;
        
    }
    /*function savemails($id)
    {
        $info = array();
       //$folder_name = $this->input->post('admin');
        $info['id'] = $id;
        $info['name'] = "hello";
        $json = json_encode($info);
        $file = "./email.json";
        //using the FILE_APPEND flag to append the content.
        file_put_contents ($file, $json, FILE_APPEND);
        echo "file saved";
    }*/
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
    function getprivateevents($email)
    {
        $query= $this->db->query("SELECT `useremails`.`event` ,`event`.`id`, `event`.`title`,`event`.`location`,`event`.`logo` FROM `event` INNER JOIN `useremails` ON `event`.`id`=`useremails`.`event` WHERE `useremails`.`email`='$email'")->result();
        return $query;
    }
    
     function viewone($id)
      {
         //$this->db->where('id', $id);
         $event=$this->db->query("SELECT `event`.`id`, `event`.`title`, `event`.`locationlat`, `event`.`locationlon`, `event`.`venue`, `event`.`startdate`, `event`.`enddate`, `event`.`description`,`event`.`location`, `event`.`starttime`,`event`.`endtime`,`event`.`organizer` AS `organizerid`,`user`.`firstname` AS `organizername`,`event`.`alias`, `event`.`listingtype`, `event`.`showremainingticket`, `event`.`logo` ,`user`.`lastname`,`user`.`email`,`user`.`website`,`user`.`description` as orgdescription,`user`.`eventinfo`,`user`.`contact`,`user`.`address`,`user`.`city`,`user`.`pincode`,`user`.`dob`,`user`.`accesslevel` AS `accesslevelid`,`accesslevel`.`name` AS `accesslevelname`
FROM  `event` 
INNER JOIN  `user` ON  `event`.`organizer` =  `user`.`id` INNER JOIN `accesslevel` ON `user`.`accesslevel` = `accesslevel`.`id` WHERE `event`.`id`='$id'")->row();
         
         $email=$this->db->query("SELECT `email` FROM `useremails` WHERE `event`='$id'")->result();
         $event->emails=$email;
         
         $pemail=$this->db->query("SELECT `publicemail` FROM `userpublicemails` WHERE `event`='$id'")->result();
         $allemails=array();
         foreach($pemail as $email) {
             array_push($allemails,$email->publicemail);
         }
         
         $event->publicemails=array();
         $event->publicemails=$allemails;
         
         $ticket=$this->db->query("SELECT `id`,`ticket`,`tickettype`,`amount`,`quantity` FROM `ticketevent` WHERE `event`='$id'")->result();
         
         $event->tickets=$ticket;
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
    
    function savedevents($user,$event)
    {
        $query=$this->db->query("SELECT `user`, `event` FROM `savedevents` WHERE `user`='$user' AND `event`= '$event'");
        if($query->num_rows > 0)
        {
            return 0;
        }else{
            $query=$this->db->query("INSERT INTO `savedevents` (`user`, `event`) VALUES ('$user','$event')");
            return 1;
        }
    }
    function getsavedevents($user)
    {
        $query=$this->db->query("SELECT `savedevents`.`user`,`savedevents`.`event`,`event`.`id`, `event`.`title`, `event`.`venue`,`event`.`logo`, `event`.`startdate`, `event`.`enddate`, `event`.`description`,`event`.`location`,`event`.`starttime`,`event`.`endtime` FROM `savedevents` INNER JOIN `event` ON `savedevents`.`event` = `event`.`id` WHERE `savedevents`.`user`='$user'")->result();
        return $query;
    }
    
    function create($title,$location,$alias,$venue,$startdate,$enddate,$description,$listingtype,$showremainingticket,$logo,$organizer,$category,$topic,$starttime,$endtime,$ticketname,$ticketqty,$ticketprice,$ticketpricetype,$email,$publicemail)
    {
        $query=$this->db->query("INSERT INTO `event` (`title`,`location`, `alias`,`venue`, `startdate`, `enddate`,`description`,`listingtype`,`showremainingticket`,`logo`,`organizer`,`starttime`,`endtime`) VALUES ('$title','$location','$alias','$venue','$startdate','$enddate','$description','$listingtype','$showremainingticket','$logo','$organizer','$starttime','$endtime')");
        
        $emailarray=explode(",",$email);
        $publicemailarray=explode(",",$publicemail);
        $categoryarray= explode(",", $category);
         $topicarray= explode(",", $topic);
        $eventid=$this->db->insert_id();
        $ticketnamearray= explode(",", $ticketname);
        $ticketqtyarray= explode(",", $ticketqty);
        $ticketpricearray= explode(",", $ticketprice);
        $ticketpricetypearray= explode(",", $ticketpricetype);
        if($emailarray[0]!='')
        {
        foreach($emailarray as $em)
        {
         $queryemail=$this->db->query("INSERT INTO `useremails`(`event`,`email`) VALUES ('$eventid','$em')"); 
        }
        }
        
        foreach($publicemailarray as $pem)
        {
         $querypublicemail=$this->db->query("INSERT INTO `userpublicemails`(`event`,`publicemail`) VALUES ('$eventid','$pem')"); 
        }
        foreach($ticketnamearray as $key => $value)
        {
         $queryticket=$this->db->query("INSERT INTO `ticketevent`(`event`, `ticket`, `tickettype`, `amount`,`quantity`) VALUES ('$eventid','$value','$ticketpricetypearray[$key]','$ticketpricearray[$key]','$ticketqtyarray[$key]')"); 
        }
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
    
    function update($id,$title,$location,$alias,$venue,$startdate,$enddate,$description,$listingtype,$showremainingticket,$logo,$organizer,$category,$topic,$starttime,$endtime,$ticketname,$ticketqty,$ticketprice,$ticketpricetype,$email,$publicemail)
    {
        $query=$this->db->query("UPDATE `event` SET `title`='$title',`venue`='$venue',`startdate`='$startdate',`enddate`='$enddate',`description`='$description',`listingtype`='$listingtype',`showremainingticket`='$showremainingticket',`logo`='$logo',`starttime`='$starttime',`endtime`='$endtime' WHERE `id`=$id");
        //$this->db->where('id', $id);
        $querycategorydelet=$this->db->query("DELETE FROM `eventcategory` WHERE `event`='$id'");
        $querytopicdelet=$this->db->query("DELETE FROM `eventtopic` WHERE `event`='$id'");
        $querytopicdelet=$this->db->query("DELETE FROM `ticketevent` WHERE `event`='$id'");
        $querytopicdelet=$this->db->query("DELETE FROM `useremails` WHERE `event`='$id'");
        $querytopicdelet=$this->db->query("DELETE FROM `userpublicemails` WHERE `event`='$id'");
        
        
        $ticketnamearray= explode(",", $ticketname);
        $ticketqtyarray= explode(",", $ticketqty);
        $ticketpricearray= explode(",", $ticketprice);
        $ticketpricetypearray= explode(",", $ticketpricetype);
        $publicemailarray=explode(",",$publicemail);
        $emailarray=explode(",",$email);
        foreach($emailarray as $em)
        {
            $queryemail=$this->db->query("INSERT INTO `useremails`(`event`,`email`) VALUES ('$id','$em')");
        }
        
        foreach($publicemailarray as $pem)
        {
         $querypublicemail=$this->db->query("INSERT INTO `userpublicemails`(`event`,`publicemail`) VALUES ('$id','$pem')"); 
        }
       
        foreach($ticketnamearray as $key => $value)
        {
         $queryticket=$this->db->query("INSERT INTO `ticketevent`(`event`, `ticket`, `tickettype`, `amount`,`quantity`) VALUES ('$id','$value','$ticketpricetypearray[$key]','$ticketpricearray[$key]','$ticketqtyarray[$key]')"); 
        }
        
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