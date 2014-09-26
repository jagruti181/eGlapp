<?php
class SponsorModel extends CI_model
{
    
    function create()
    {
        $event=$this->input->get('event');
        $user=$this->input->get('user');
        $amountsponsor=$this->input->get('amountsponsor');
        $image=$this->input->get('image');
        $query=$this->db->query("INSERT INTO `eventsponsor`(`event`, `user`, `amountsponsor`, `image`) VALUES ('$event','$user','$amountsponsor','$image')");
        return $query;
    }
    
   
    
    
}
?>