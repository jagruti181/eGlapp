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
        
        $data['json']= $this->eventmodel->create($title,$location,$alias,$venue,$startdate,$enddate,$description,$listingtype,$showremainingticket,$logo,$organizer,$category,$topic,$starttime,$endtime);
		$this->load->view('json',$data);
	}
    public function update()
	{
        $id=$this->input->get('id');
        $title=$this->input->get('title');
        $locationlat=$this->input->get('locationlat');
        $locationlon=$this->input->get('locationlon');
        $venue=$this->input->get('venue');
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
        $data['json']=$this->eventmodel->update($id,$title,$location,$alias,$venue,$startdate,$enddate,$description,$listingtype,$showremainingticket,$logo,$organizer,$category,$topic,$starttime,$endtime);
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