<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

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
        $user=$this->input->get_post('user');
        $event=$this->input->get('event');
        $ticketid=$this->input->get('ticketid');
        $ticketquantity=$this->input->get('ticketquantity');
        $data['json']=$this->ordermodel->create($user,$event,$ticketid,$ticketquantity);
		$this->load->view('json',$data);
	}
    public function view()
	{
        $user=$this->input->get_post('user');
        $event=$this->input->get('event');
        $data['json']=$this->ordermodel->viewticket($user,$event);
		$this->load->view('json',$data);
	}
    public function viewticket()
	{
        $user=$this->input->get_post('user');
        $event=$this->input->get('event');
        $data['json']=$this->ordermodel->viewuserticket($user,$event);
		$this->load->view('json',$data);
	}
   /* public function bookticket()
	{
        $user=$this->input->get_post('user');
        $event=$this->input->get('event');
        $order=$this->input->get('orderid');
        $ticket=$this->input->get('ticket');
        $quantity=$this->input->get('quantity');
        $amount=$this->input->get('amount');
        $data['json']=$this->ordermodel->bookticket($user,$event,$order,$ticket,$quantity,$amount);
		$this->load->view('json',$data);
	}*/
    public function bookticket()
	{
        $order=$this->input->get_post('order');
        $ticket=$this->input->get('ticket');
        $quantity=$this->input->get('quantity');
        $amount=$this->input->get('amount');
        $data['json']=$this->ordermodel->bookticket($order,$ticket,$quantity,$amount);
		$this->load->view('json',$data);
	}
    public function viewuserticket()
    {
        $orderid=$this->input->get_post('orderid');
        $data['json']=$this->ordermodel->viewuserticket($orderid);
		$this->load->view('json',$data);
    }
    public function viewallticketsbyuser()
    {
        $user=$this->input->get_post('user');
        $data['json']=$this->ordermodel->viewallticketsbyuser($user);
		$this->load->view('json',$data);
    }
    public function viewalleventsbookedbyuser()
    {
        $user=$this->input->get_post('user');
        $data['json']=$this->ordermodel->viewalleventsbookedbyuser($user);
		$this->load->view('json',$data);
    }
    /*
    public function update()
	{
        $data['json']=$this->ordermodel->update();
		$this->load->view('json',$data);
	}
	public function find()
	{
        $data['json']=$this->ordermodel->viewall();
		$this->load->view('json',$data);
	}
    public function findone()
	{
        $data['json']=$this->ordermodel->viewone();
		$this->load->view('json',$data);
	}
    public function delete()
	{
        $data['json']=$this->ordermodel->deleteone();
		$this->load->view('json',$data);
	}
    */
}