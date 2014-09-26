<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
        $this->load->model('usermodel11');
        $data['json']=$this->usermodel1->create();
		$this->load->view('json',$data);
	}
    public function update()
	{
        $this->load->model('usermodel11');
        $data['json']=$this->usermodel1->update();
		$this->load->view('json',$data);
	}
	public function find()
	{
		$this->load->model('usermodel11');
        $data['json']=$this->usermodel1->viewall();
		$this->load->view('json',$data);
	}
    public function findone()
	{
        //$id=$this->input->get('id');
        $this->load->model('usermodel11');
        $data['json']=$this->usermodel1->viewone();
		$this->load->view('json',$data);
	}
    public function delete()
	{
        $this->load->model('usermodel11');
        $data['json']=$this->usermodel1->deleteone();
		$this->load->view('json',$data);
	}
    public function login()
    {
        $this->load->model('usermodel1');
        $email=$this->input->get("email");
        $password=$this->input->get("password");
        $data['json']=$this->usermodel1->login($email,$password);
        $this->load->view('json',$data);
    }
    public function authenticate()
    {
        $this->load->model('usermodel1');
        $data['json']=$this->usermodel1->authenticate();
        $this->load->view('json',$data);
    }
    public function signup()
    {
        $this->load->model('usermodel1');
        $email=$this->input->get("email");
        $password=$this->input->get("password");
        $data['json']=$this->usermodel1->signup($email,$password);
        $this->load->view('json',$data);
        
    }
    public function logout()
    {
        $this->session->sess_destroy();
        $data['json']=true;
        $this->load->view('json',$data);
    }
}