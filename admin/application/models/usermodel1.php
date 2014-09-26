<?php
class UserModel extends CI_model
{
    function viewall()
      {
         $query= $this->db->query("SELECT `user`.`id` ,  `user`.`firstname` ,  `user`.`lastname` ,  `user`.`password` ,  `user`.`email` ,  `user`.`website` ,  `user`.`description` ,  `user`.`info` ,  `user`.`contact` , `user`.`address` ,  `user`.`city` ,  `user`.`pincode` ,  `user`.`dob` ,  `accesslevel`.`id` ,  `accesslevel`.`name` AS `Accesslevel` ,  `user`.`timestamp` ,  `user`.`facebookuserid` ,  `user`.`newsletterstatus` ,  `user`.`status` 
FROM  `user` 
INNER JOIN  `accesslevel` ON  `user`.`accesslevel` =  `accesslevel`.`id`");
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
         $query= $this->db->query("SELECT `user`.`id` ,  `user`.`firstname` ,  `user`.`lastname` ,  `user`.`password` ,  `user`.`email` ,  `user`.`website` ,  `user`.`description` ,  `user`.`info` ,  `user`.`contact` , `user`.`address` ,  `user`.`city` ,  `user`.`pincode` ,  `user`.`dob` ,  `accesslevel`.`id` ,  `accesslevel`.`name` AS `Accesslevel` ,  `user`.`timestamp` ,  `user`.`facebookuserid` ,  `user`.`newsletterstatus` ,  `user`.`status` 
FROM  `user` WHERE `user`.`id`='$id'");
        if($query->num_rows > 0)
        {
            return $query->row();
        }
        else 
        {
            return false;
        }
        
      }
    
    function create()
    {
        $firstname=$this->input->get('firstname');
        $lastname=$this->input->get('lastname');
        $password=$this->input->get('password');
        $password=md5($password);
        $email=$this->input->get('email');
        $website=$this->input->get('website');
        $description=$this->input->get('description');
        $info=$this->input->get('info');
        $contact=$this->input->get('contact');
        $address=$this->input->get('address');
        $city=$this->input->get('city');
        $pincode=$this->input->get('pincode');
        $dob=$this->input->get('dob');
        $accesslevel=$this->input->get('accesslevel');
        $timestamp=$this->input->get('timestamp');
        $facebookuserid=$this->input->get('facebookuserid');
        $newsletterstatus=$this->input->get('newsletterstatus');
        $status=$this->input->get('status');
        $query=$this->db->query("INSERT INTO `user` (`firstname`,`lastname`, `password`,`email`, `website`, `description`,`info`,`contact`,`address`,`city`,`pincode`,`dob`, `accesslevel`,`timestamp`,`facebookuserid`,`newsletterstatus`,`status`) VALUES ('$firstname','$lastname','$password','$email','$website','$description','$info','$contact','$address','$city','$pincode','$dob','$accesslevel','$timestamp','$facebookuserid','$newsletterstatus','$status')");
        $user=$this->db->insert_id();
        $queryorganizer=$this->db->query("INSERT INTO `organizer`(`name`, `description`, `email`, `info`, `website`, `contact`, `user`) VALUES('$firstname','$description','$email','$info','$website','$contact','$user')");
        //$query=$this
        return $query;
    }
    
    function update()
    {
        $id=$this->input->get('id');
        $firstname=$this->input->get('firstname');
        $lastname=$this->input->get('lastname');
        $password=$this->input->get('password');
        $password=md5($password);
        $email=$this->input->get('email');
        $website=$this->input->get('website');
        $description=$this->input->get('description');
        $info=$this->input->get('info');
        $contact=$this->input->get('contact');
        $address=$this->input->get('address');
        $city=$this->input->get('city');
        $pincode=$this->input->get('pincode');
        $dob=$this->input->get('dob');
        $accesslevel=$this->input->get('accesslevel');
        $timestamp=$this->input->get('timestamp');
        $facebookuserid=$this->input->get('facebookuserid');
        $newsletterstatus=$this->input->get('newsletterstatus');
        $status=$this->input->get('status');
        $query=$this->db->query("UPDATE `user` SET firstname='$firstname',lastname='$lastname',password='$password',email='$email',website='$website',description='$description',info='$info',contact='$contact',address='$address',city='$city',pincode='$pincode',dob='$dob',accesslevel='$accesslevel',timestamp='$timestamp',facebookuserid='$facebookuserid',newsletterstatus='$newsletterstatus',status='$status' WHERE id=$id");
        $queryorganizer=$this->db->query("UPDATE organizer SET name='$firstname',email='$email',website='$website',description='$description',info='$info',contact='$contact' WHERE user=$id");
        //$query=$this
        return $query;
    }
    function deleteone()
    {
        $id=$this->input->get('id');
        $this->db->where('id', $id);
        $query= $this->db->delete('user');
        $this->db->where('user', $id);
        $queryorganizer=$this->db->delete('organizer');
        return $query;
    }
    function signup($email,$password) 
    {
         $password=md5($password);   
        $query=$this->db->query("SELECT `id` FROM `user` WHERE `email`='$email' ");
        if($query->num_rows == 0)
        {
            $this->db->query("INSERT INTO `user` (`id`, `firstname`, `lastname`, `password`, `email`, `website`, `description`, `eventinfo`, `contact`, `address`, `city`, `pincode`, `dob`, `accesslevel`, `timestamp`, `facebookuserid`, `newsletterstatus`, `status`) VALUES (NULL, NULL, NULL, '$password', '$email', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP, NULL, NULL, NULL);");
            $user=$this->db->insert_id();
            $newdata = array(
                'email'     => $email,
                'password' => $password,
                'logged_in' => true,
                'id'=> $user
            );

            $this->session->set_userdata($newdata);
            
            $queryorganizer=$this->db->query("INSERT INTO `organizer`(`name`, `description`, `email`, `info`, `website`, `contact`, `user`) VALUES(NULL,NULL,NULL,NULL,NULL,NULL,'$user')");
            
            
           return $user;
        }
        else
         return false;
        
        
    }
    function login($email,$password) 
    {
        $password=md5($password);
        $query=$this->db->query("SELECT `id` FROM `user` WHERE `email`='$email' AND `password`= '$password'");
        if($query->num_rows > 0)
        {
            $user=$query->row();
            $user=$user->id;
            

            $newdata = array(
                'email'     => $email,
                'password' => $password,
                'logged_in' => 'true',
                'id'=> $user
            );

            $this->session->set_userdata($newdata);
			//return $this->session->userdata( 'email' );
            //print_r($newdata);
            return $newdata;
        }
        else
        return false;


    }
    function authenticate() {
        $is_logged_in = $this->session->userdata( 'logged_in' );
        //print_r($this->session->userdata( 'logged_in' ));
        if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
            return false;
        } //$is_logged_in !== 'true' || !isset( $is_logged_in )
        else {
		$userid=$this->session->userdata('id');
		$query=$this->db->query("SELECT * FROM `user` WHERE `id`='$userid'")->row();
           // $userid = $this->session->userdata( );
         return $query;
        }
    }
}
?>