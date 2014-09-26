<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    public function reminder()
    {
        $this->load->config('mandrill');
        $this->load->library('mandrill');
        $data['json']=$this->eventmodel->send_reminders();
         $this->load->view('json',$data);
    //$this->load->view('themes/base/header', array('title'=>"Access Denied"));
    //$this->load->view('cron/access_denied');
    //$this->load->view('themes/base/footer');
    }
     public function dateop()
    {
        $this->load->library('dateoperations');
        $data['json']=$this->eventmodel->dateop();
         $this->load->view('json',$data);

    }
    public function savedevents()
    {
        $user=$this->input->get('user');
        $event=$this->input->get('event');
        $data['json']= $this->eventmodel->savedevents($user,$event);
		$this->load->view('json',$data);
    }
    public function getsavedevents()
    {
        $user=$this->input->get('user');
        $data['json']= $this->eventmodel->getsavedevents($user);
		$this->load->view('json',$data);
    }
    public function ticket()
    {
        $ticket=$this->input->get('ticket');
        $data['json']= $this->eventmodel->saveticket($ticket);
		$this->load->view('json',$data);
    }
    public function create()
	{
        
        $title=$this->input->get('title');
        $locationlat=$this->input->get('locationlat');
        $locationlon=$this->input->get('locationlon');
        $venue=$this->input->get('venue');
		$location=$this->input->get('location');
		$alias=$this->input->get('alias');
        $startdate=$this->input->get('startdate');
        $enddate=$this->input->get('enddate');
        $description=$this->input->get('description');
        $organizer=$this->input->get('organizer');
        $listingtype=$this->input->get('listingtype');
        $showremainingticket=$this->input->get('showremainingticket');
        $logo=$this->input->get('logo');
        $category=$this->input->get('category');
        $topic=$this->input->get('topic');
        $starttime=$this->input->get('starttime');
        $endtime=$this->input->get('endtime');
        $ticketname=$this->input->get('ticketname');
        $ticketqty=$this->input->get('ticketqty');
        $ticketprice=$this->input->get('ticketprice');
        $ticketpricetype=$this->input->get('ticketpricetype');
        $email=$this->input->get('email');
        $publicemail=$this->input->get('publicemail');
        
        $data['json']= $this->eventmodel->create($title,$location,$alias,$venue,$startdate,$enddate,$description,$listingtype,$showremainingticket,$logo,$organizer,$category,$topic,$starttime,$endtime,$ticketname,$ticketqty,$ticketprice,$ticketpricetype,$email,$publicemail);
		$this->load->view('json',$data);
	}
    public function update()
	{
        $id=$this->input->get('id');
        $title=$this->input->get('title');
        $locationlat=$this->input->get('locationlat');
        $locationlon=$this->input->get('locationlon');
        $venue=$this->input->get('venue');
        $location=$this->input->get('location');
        $alias=$this->input->get('alias');
        $startdate=$this->input->get('startdate');
        $enddate=$this->input->get('enddate');
        $description=$this->input->get('description');
        $organizer=$this->input->get('organizer');
        $listingtype=$this->input->get('listingtype');
        $showremainingticket=$this->input->get('showremainingticket');
        $logo=$this->input->get('logo');
        $category=$this->input->get('category');
        $topic=$this->input->get('topic');
        $starttime=$this->input->get('starttime');
        $endtime=$this->input->get('endtime');
        $ticketname=$this->input->get('ticketname');
        $ticketqty=$this->input->get('ticketqty');
        $ticketprice=$this->input->get('ticketprice');
        $ticketpricetype=$this->input->get('ticketpricetype');
        $email=$this->input->get('email');
        $publicemail=$this->input->get('publicemail');

        $data['json']=$this->eventmodel->update($id,$title,$location,$alias,$venue,$startdate,$enddate,$description,$listingtype,$showremainingticket,$logo,$organizer,$category,$topic,$starttime,$endtime,$ticketname,$ticketqty,$ticketprice,$ticketpricetype,$email,$publicemail);
		$this->load->view('json',$data);
	}
	public function find()
	{
        $data['json']=$this->eventmodel->viewall();
		$this->load->view('json',$data);
	}
    public function findone()
	{
        $id=$this->input->get('id');
        $data['json']=$this->eventmodel->viewone($id);
		$this->load->view('json',$data);
	}
   /* public function savemails()
	{
        
        $id=$this->input->get('id');
       $this->eventmodel->savemails($id);
		//$this->load->view('json',$data);
	}*/
    public function savemails()
	{
        
        $id=$this->input->get('event');
        $email=$this->input->get('email');
       $data['json']=$this->eventmodel->savemails($id,$email);
		$this->load->view('json',$data);
	}
    
    public function getprivateevents()
	{
        $email=$this->input->get('email');
       $data['json']=$this->eventmodel->getprivateevents($email);
		$this->load->view('json',$data);
	}
    public function showalleventsbyuserid()
    {
        $id=$this->input->get('id');
        $data['json']=$this->eventmodel->showalleventsbyuserid($id);
		$this->load->view('json',$data);
    }
    public function delete()
	{
        $id=$this->input->get('id');
        $data['json']=$this->eventmodel->deleteone($id);
		$this->load->view('json',$data);
	}
}