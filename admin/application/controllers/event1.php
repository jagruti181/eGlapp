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
        $data['json']=$this->eventmodel->create();
		$this->load->view('json',$data);
	}
    public function update()
	{
        $data['json']=$this->eventmodel->update();
		$this->load->view('json',$data);
	}
	public function find()
	{
        $data['json']=$this->eventmodel->viewall();
		$this->load->view('json',$data);
	}
    public function findone()
	{
        $data['json']=$this->eventmodel->viewone();
		$this->load->view('json',$data);
	}
    public function showalleventsbyuserid()
    {
        $data['json']=$this->eventmodel->showalleventsbyuserid();
		$this->load->view('json',$data);
    }
    public function delete()
	{
        $data['json']=$this->eventmodel->deleteone();
		$this->load->view('json',$data);
	}
}