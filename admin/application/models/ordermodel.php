<?php
class OrderModel extends CI_model
{
    function viewallticketsbyuser($user)
    {
        $query= $this->db->query("SELECT * FROM `orderticket` WHERE `user`='$user'");
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
    
    function create($user,$event,$ticketid,$ticketquantity)
    {
        
       /* $query=$this->db->query("INSERT INTO `orderticket` (`user`, `event`) VALUES ('$user','$event')");
        $orderid=$this->db->insert_id();*/
        
        $ticketid=explode(",",$ticketid);
        $ticketquantity=explode(",",$ticketquantity);
        foreach($ticketid as $key=>$value)
        {
            if($ticketquantity[$key]!="0" || $ticketquantity[$key]!="")
            {
                $this->db->query("INSERT INTO `orderticket` (`order`, `event`, `ticket`, `quantity`, `position`, `amount`, `user`) VALUES (null, '$event', '$ticketid[$key]', '$ticketquantity[$key]', 'position', '0', '$user');");
                $this->db->query("UPDATE `ticketevent` SET `quantity`=`quantity`-'$ticketquantity[$key]' WHERE `event`='$event' AND `id`='$ticketid[$key]'");
            }
        }
        return true;
        
    }
    function viewuserticket($user,$event)
    {
        $ticket=$this->db->query("SELECT Distinct `orderticket`.`event`,`orderticket`.`user`,`user`.`id`,`user`.`firstname`,`user`.`lastname`,`event`.`id`,`event`.`title`, `event`.`location`,`event`.`startdate`,`event`.`enddate`,`event`.`starttime`,`event`.`endtime`,`event`.`logo`,`eventsponsor`.`event`, `eventsponsor`.`user`,`eventsponsor`.`image` FROM `orderticket` LEFT OUTER JOIN `user` ON `user`.`id`=`orderticket`.`user` LEFT OUTER JOIN `event` ON `event`.`id`=`orderticket`.`event` LEFT OUTER JOIN `eventsponsor` ON `eventsponsor`.`event`=`event`.`id` WHERE `user`.`id`='$user' AND `event`.`id`='$event'")->row();
        $userticket=$this->db->query("SELECT `orderticket`.`ticket`,`orderticket`.`quantity`,`orderticket`.`amount`,`orderticket`.`event`,`ticketevent`.`id`,`ticketevent`.`ticket`,`ticketevent`.`tickettype` FROM `orderticket` LEFT OUTER JOIN `ticketevent` ON `ticketevent`.`id`=`orderticket`.`ticket` WHERE `orderticket`.`user`='$user' AND `orderticket`.`event`='$event'")->result();
         
        $ticket->usertickets=$userticket;
        return $ticket;
        
    }
    
    function bookticket($order,$ticket,$quantity)
    {
        $queryfree=$this->db->query("");
        $ticketarray= explode(",", $ticket);
        $quantityarray= explode(",", $quantity);
        foreach($ticketarray as $key => $value)
        {
         $queryticket=$this->db->query("INSERT INTO `bookticket`(`order`, `ticket`, `quantity`)VALUES('$order','$ticketarray[$key]','$quantityarray[$key]')"); 
        }
        return $order;
        
    }
    
    function viewticket($user,$event)
    {
        $query=$this->db->query("SELECT `id` FROM `orderticket` WHERE `user`='$user' AND `event`='$event'");
        
        return $query->row();
        
    }
        
    function viewalleventsbookedbyuser($user)
    {
        $query= $this->db->query("SELECT Distinct `orderticket`.`user`,`orderticket`.`event` as `eventid`,`event`.`title`as `eventtitle`,`event`.`venue`,`event`.`startdate`,`event`.`enddate`,`event`.`description`,`event`.`listingtype`,`event`.`showremainingticket`,`event`.`logo`,`event`.`location`,`event`.`alias`,`event`.`organizer` as `organizerid`,`organizer`.`name` as `organizername`,`organizer`.`description` as `organizerdescription`,`organizer`.`email`,`organizer`.`info` as `organizerinfo`,`organizer`.`website`,`organizer`.`contact`,`organizer`.`user` as `userid`,`user`.`firstname`,`user`.`lastname`,`user`.`email` as `useremail`,`user`.`website` as `userwebsite`,`user`.`description`,`user`.`contact`,`user`.`address`,`user`.`eventinfo`,`user`.`city`,`user`.`pincode`,`user`.`dob`,`user`.`accesslevel`,`accesslevel`.`name` as `accesslevelname`
FROM `orderticket` INNER JOIN `event` ON `event`.`id` = `orderticket`.`event` AND `orderticket`.`user`='$user'  LEFT OUTER JOIN `organizer` ON `organizer`.`id`=`event`.`organizer` LEFT OUTER JOIN `user` ON `user`.`id`=`organizer`.`user` LEFT OUTER JOIN `accesslevel` ON `user`.`accesslevel`=`accesslevel`.`id`");
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
    /*function bookticket($user,$event,$order,$ticket,$quantity,$amount)
    {
        $query=$this->db->query("UPDATE `orderticket` SET `ticket`='$ticket',`quantity`='$quantity',`amount`='$amount', `order`='$order'  WHERE  `user`='$user' AND `event`='$event'");
        return true;
    }
    
    function update()
    {
        $id=$this->input->get('id');
        $name=$this->input->get('name');
        $parent=$this->input->get('parent');
        $status=$this->input->get('status');
        $query=$this->db->query("UPDATE `topic` SET `name`='$name',`parent`='$parent',`status`='$status' WHERE `id`='$id'");
        return $query;
    }
    function deleteone()
    {
        $id=$this->input->get('id');
        $queryeventdelet=$this->db->query("DELETE FROM `topic` WHERE `id`='$id'");
        return true;
    }
    */
}
?>