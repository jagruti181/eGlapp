<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
	public function index()
	{
		//$access = array("1","2");
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'page' ] = 'dashboard';
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );	
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );	
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('firstname','First Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('lastname','Last Name','trim|max_length[30]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('contact','contactno','trim');
		$this->form_validation->set_rules('website','Website','trim|max_length[50]');
		$this->form_validation->set_rules('description','Description','trim|');
		$this->form_validation->set_rules('address','Address','trim|');
		$this->form_validation->set_rules('city','City','trim|max_length[30]');
		$this->form_validation->set_rules('pincode','Pincode','trim|max_length[20]');
		$this->form_validation->set_rules('facebookuserid','facebookuserid','trim|max_length[20]');
		
		$this->form_validation->set_rules('email','Email','trim|valid_email');
		$this->form_validation->set_rules('status','Status','trim');
		$this->form_validation->set_rules('dob','DOB','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
			$data['page']='createuser';
			$data['title']='Create New User';
			$this->load->view('template',$data);
		}
		else
		{
            $website=$this->input->post('website');
            $description=$this->input->post('description');
            $address=$this->input->post('address');
            $city=$this->input->post('city');
            $pincode=$this->input->post('pincode');
			$password=$this->input->post('password');
			if($dob != "")
			{
				$dob = date("Y-m-d",strtotime($dob));
			}
			$accesslevel=$this->input->post('accesslevel');
			$email=$this->input->post('email');
			$contact=$this->input->post('contact');
			$status=$this->input->post('status');
			$facebookuserid=$this->input->post('facebookuserid');
			$firstname=$this->input->post('firstname');
			$lastname=$this->input->post('lastname');
			if($this->user_model->create($firstname,$lastname,$dob,$password,$accesslevel,$email,$contact,$status,$facebookuserid,$website,$description,$address,$city,$pincode)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			
			$data['table']=$this->user_model->viewusers();
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->user_model->viewusers();
		$data['page']='viewusers';
		$data['title']='View Users';
		$this->load->view('template',$data);
	}
    
    function viewsponsor()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->sponsor_model->viewall();
		$data['page']='viewsponsor';
		$data['title']='View Sponsor';
		$this->load->view('template',$data);
	}
	function viewuserinterestevents()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['table']=$this->user_model->userinterestevents($this->input->get('id'));
		$data['page']='viewuserinterestevents';
		$data['page2']='block/userblock';
		$data['title']='View User Interest Events';
		$this->load->view('template',$data);
	}
	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('template',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('contact','contactno','trim');
		$this->form_validation->set_rules('website','Website','trim|max_length[50]');
		$this->form_validation->set_rules('description','Description','trim|');
		$this->form_validation->set_rules('address','Address','trim|');
		$this->form_validation->set_rules('city','City','trim|max_length[30]');
		$this->form_validation->set_rules('pincode','Pincode','trim|max_length[20]');
        
		$this->form_validation->set_rules('fname','First Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('lname','Last Name','trim|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|valid_email');
		$this->form_validation->set_rules('status','Status','trim');
		$this->form_validation->set_rules('dob','DOB','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
            $website=$this->input->post('website');
            $description=$this->input->post('description');
            $address=$this->input->post('address');
            $city=$this->input->post('city');
            $pincode=$this->input->post('pincode');
			$id=$this->input->post('id');
			$password=$this->input->post('password');
			$dob=$this->input->post('dob');
			if($dob != "")
			{
				$dob = date("Y-m-d",strtotime($dob));
			}
			$accesslevel=$this->input->post('accesslevel');
			$contact=$this->input->post('contact');
			$status=$this->input->post('status');
			$facebookuserid=$this->input->post('facebookuserid');
			$fname=$this->input->post('fname');
			$lname=$this->input->post('lname');
			if($this->user_model->edit($id,$fname,$lname,$dob,$password,$accesslevel,$contact,$status,$facebookuserid,$website,$description,$address,$city,$pincodes)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	function editaddress()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='editaddress';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('template',$data);
	}
	function editaddresssubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('address','address','trim');
		$this->form_validation->set_rules('facebookuserid','facebookuserid','trim');
		$this->form_validation->set_rules('city','city','trim');
		$this->form_validation->set_rules('pincode','pincode','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='editaddress';
			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$address=$this->input->post('address');
			$city=$this->input->post('city');
			$pincode=$this->input->post('pincode');
			if($this->user_model->editaddress($id,$address,$city,$pincode)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			$data['table']=$this->user_model->viewusers();
			$data['redirect']="site/editaddress?id=".$id;
			//$data['other']="template=$template";
			$this->load->view("redirect2",$data);
			
		}
	}
	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['page']='viewusers';
		$data['title']='View Users';
		$this->load->view('template',$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    
    function changesponsorstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->sponsor_model->changestatus($this->input->get('user'),$this->input->get('event'));
		$data['table']=$this->sponsor_model->viewall();
		$data['alertsuccess']="Status Changed Successfully";
        
		$data['redirect']="site/viewsponsor";
        
        $this->load->view("redirect",$data);
	}
    
    
    /*-----------------User/Organizer Finctions added by avinash for frontend APIs---------------*/
    public function update()
	{
        $id=$this->input->get('id');
        $firstname=$this->input->get('firstname');
        $lastname=$this->input->get('lastname');
        $password=$this->input->get('password');
        $password=md5($password);
        $email=$this->input->get('email');
        $website=$this->input->get('website');
        $description=$this->input->get('description');
        $eventinfo=$this->input->get('eventinfo');
        $contact=$this->input->get('contact');
        $address=$this->input->get('address');
        $city=$this->input->get('city');
        $pincode=$this->input->get('pincode');
        $dob=$this->input->get('dob');
       // $accesslevel=$this->input->get('accesslevel');
        $accesslevel=2;
        $timestamp=$this->input->get('timestamp');
        $facebookuserid=$this->input->get('facebookuserid');
        $newsletterstatus=$this->input->get('newsletterstatus');
        $status=$this->input->get('status');
        $logo=$this->input->get('logo');
        $showwebsite=$this->input->get('showwebsite');
        $eventsheld=$this->input->get('eventsheld');
        $topeventlocation=$this->input->get('topeventlocation');
        $data['json']=$this->user_model->update($id,$firstname,$lastname,$password,$email,$website,$description,$eventinfo,$contact,$address,$city,$pincode,$dob,$accesslevel,$timestamp,$facebookuserid,$newsletterstatus,$status,$logo,$showwebsite,$eventsheld,$topeventlocation);
        print_r($data);
		//$this->load->view('json',$data);
	}
	public function finduser()
	{
        $data['json']=$this->user_model->viewall();
        print_r($data);
		//$this->load->view('json',$data);
	}
    public function findoneuser()
	{
        $id=$this->input->get('id');
        $data['json']=$this->user_model->viewone($id);
        print_r($data);
		//$this->load->view('json',$data);
	}
    public function deleteoneuser()
	{
        $id=$this->input->get('id');
        $data['json']=$this->user_model->deleteone($id);
		//$this->load->view('json',$data);
	}
    public function login()
    {
        $email=$this->input->get("email");
        $password=$this->input->get("password");
        $data['json']=$this->user_model->login($email,$password);
        //$this->load->view('json',$data);
    }
    public function authenticate()
    {
        $data['json']=$this->user_model->authenticate();
        //$this->load->view('json',$data);
    }
    public function signup()
    {
        $email=$this->input->get_post("email");
        $password=$this->input->get_post("password");
        $data['json']=$this->user_model->signup($email,$password);
        //$this->load->view('json',$data);
        
    }
    public function logout()
    {
        $this->session->sess_destroy();
        $data['json']=true;
        //$this->load->view('json',$data);
    }
    
    
    
    /*-----------------End of User/Organizer functions----------------------------------*/
    
    
    
	//category
	public function createcategory()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createcategory';
		$data[ 'title' ] = 'Create category';
		$this->load->view( 'template', $data );	
	}
	function createcategorysubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('parent','parent','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['category']=$this->category_model->getcategorydropdown();
			$data[ 'page' ] = 'createcategory';
			$data[ 'title' ] = 'Create category';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
			$parent=$this->input->post('parent');
			$status=$this->input->post('status');
			if($this->category_model->createcategory($name,$parent,$status)==0)
			$data['alerterror']="New category could not be created.";
			else
			$data['alertsuccess']="category  created Successfully.";
			$data['table']=$this->category_model->viewcategory();
			$data['redirect']="site/viewcategory";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewcategory()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->category_model->viewcategory();
		$data['page']='viewcategory';
		$data['title']='View category';
		$this->load->view('template',$data);
	}
	function editcategory()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->category_model->beforeeditcategory($this->input->get('id'));
		$data['category']=$this->category_model->getcategorydropdown();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['page']='editcategory';
		$data['title']='Edit category';
		$this->load->view('template',$data);
	}
	function editcategorysubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('parent','parent','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['category']=$this->category_model->getcategorydropdown();
			$data['before']=$this->category_model->beforeeditcategory($this->input->post('id'));
			$data['page']='editcategory';
			$data['title']='Edit category';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$parent=$this->input->post('parent');
			$status=$this->input->post('status');
			
			if($this->category_model->editcategory($id,$name,$parent,$status)==0)
			$data['alerterror']="category Editing was unsuccesful";
			else
			$data['alertsuccess']="category edited Successfully.";
			$data['table']=$this->category_model->viewcategory();
			$data['redirect']="site/viewcategory";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['page']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletecategory()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->category_model->deletecategory($this->input->get('id'));
		$data['table']=$this->category_model->viewcategory();
		$data['alertsuccess']="category Deleted Successfully";
		$data['page']='viewcategory';
		$data['title']='View category';
		$this->load->view('template',$data);
	}
	//topic
	public function createtopic()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['topic']=$this->topic_model->gettopicdropdown();
		$data[ 'page' ] = 'createtopic';
		$data[ 'title' ] = 'Create topic';
		$this->load->view( 'template', $data );	
	}
	function createtopicsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('parent','parent','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['topic']=$this->topic_model->gettopicdropdown();
			$data[ 'page' ] = 'createtopic';
			$data[ 'title' ] = 'Create topic';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
			$parent=$this->input->post('parent');
			$status=$this->input->post('status');
			if($this->topic_model->createtopic($name,$parent,$status)==0)
			$data['alerterror']="New topic could not be created.";
			else
			$data['alertsuccess']="topic  created Successfully.";
			$data['table']=$this->topic_model->viewtopic();
			$data['redirect']="site/viewtopic";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewtopic()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->topic_model->viewtopic();
		$data['page']='viewtopic';
		$data['title']='View topic';
		$this->load->view('template',$data);
	}
	function edittopic()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->topic_model->beforeedittopic($this->input->get('id'));
		$data['topic']=$this->topic_model->gettopicdropdown();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['page']='edittopic';
		$data['title']='Edit topic';
		$this->load->view('template',$data);
	}
	function edittopicsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('parent','parent','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['topic']=$this->topic_model->gettopicdropdown();
			$data['before']=$this->topic_model->beforeedittopic($this->input->post('id'));
			$data['page']='edittopic';
			$data['title']='Edit topic';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$parent=$this->input->post('parent');
			$status=$this->input->post('status');
			
			if($this->topic_model->edittopic($id,$name,$parent,$status)==0)
			$data['alerterror']="topic Editing was unsuccesful";
			else
			$data['alertsuccess']="topic edited Successfully.";
			$data['table']=$this->topic_model->viewtopic();
			$data['redirect']="site/viewtopic";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['page']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletetopic()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->topic_model->deletetopic($this->input->get('id'));
		$data['table']=$this->topic_model->viewtopic();
		$data['alertsuccess']="topic Deleted Successfully";
		$data['page']='viewtopic';
		$data['title']='View topic';
		$this->load->view('template',$data);
	}
	//discountcoupon
	public function creatediscountcoupon()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'ticketevent' ] =$this->ticketevent_model->getticketevent();
		$data[ 'page' ] = 'creatediscountcoupon';
		$data[ 'title' ] = 'Create discountcoupon';
		$this->load->view( 'template', $data );	
	}
	function creatediscountcouponsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','name','trim|');
		$this->form_validation->set_rules('couponcode','couponcode','trim|');
		$this->form_validation->set_rules('percent','percent','trim|');
		$this->form_validation->set_rules('amount','amount','trim|');
		$this->form_validation->set_rules('minimumticket','minimumticket','trim|');
		$this->form_validation->set_rules('maximumticket','maximumticket','trim|');
		$this->form_validation->set_rules('ticketevent','ticketevent','trim|');
		$this->form_validation->set_rules('userperuser','userperuser','trim|');
		$this->form_validation->set_rules('starttime','Start Time','trim|required');
		$this->form_validation->set_rules('endtime','End Time','trim|required');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'ticketevent' ] =$this->ticketevent_model->getticketevent();
			$data[ 'page' ] = 'creatediscountcoupon';
			$data[ 'title' ] = 'Create discountcoupon';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
			$percent=$this->input->post('percent');
			$amount=$this->input->post('amount');
			$couponcode=$this->input->post('couponcode');
			$minimumticket=$this->input->post('minimumticket');
			$maximumticket=$this->input->post('maximumticket');
			$ticketevent=$this->input->post('ticketevent');
			$userperuser=$this->input->post('userperuser');
			$starttime=date("H:i",strtotime($this->input->post('starttime')));
			$starttime = $starttime.":00";
			$starttime = date("H:i:s",strtotime($starttime));
			$endtime=date("H:i",strtotime($this->input->post('endtime')));
			$endtime = $endtime.":00";
			$endtime = date("H:i:s",strtotime($endtime));
			if($this->discountcoupon_model->creatediscountcoupon($name,$percent,$amount,$minimumticket,$maximumticket,$ticketevent,$couponcode,$userperuser,$starttime,$endtime)==0)
			$data['alerterror']="New discountcoupon could not be created.";
			else
			$data['alertsuccess']="discountcoupon  created Successfully.";
			$data['table']=$this->discountcoupon_model->viewdiscountcoupon();
			$data['redirect']="site/viewdiscountcoupon";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewdiscountcoupon()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->discountcoupon_model->viewdiscountcoupon();
		$data['page']='viewdiscountcoupon';
		$data['title']='View discountcoupon';
		$this->load->view('template',$data);
	}
	function editdiscountcoupon()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->discountcoupon_model->beforeeditdiscountcoupon($this->input->get('id'));
		$data[ 'ticketevent' ] =$this->ticketevent_model->getticketevent();
		$data['page']='editdiscountcoupon';
		$data['title']='Edit discountcoupon';
		$this->load->view('template',$data);
	}
	function editdiscountcouponsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','name','trim|');
		$this->form_validation->set_rules('couponcode','couponcode','trim|');
		$this->form_validation->set_rules('percent','percent','trim|');
		$this->form_validation->set_rules('amount','amount','trim|');
		$this->form_validation->set_rules('minimumticket','minimumticket','trim|');
		$this->form_validation->set_rules('maximumticket','maximumticket','trim|');
		$this->form_validation->set_rules('ticketevent','ticketevent','trim|');
		$this->form_validation->set_rules('userperuser','userperuser','trim|');
		$this->form_validation->set_rules('starttime','Start Time','trim|required');
		$this->form_validation->set_rules('endtime','End Time','trim|required');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['before']=$this->discountcoupon_model->beforeeditdiscountcoupon($this->input->post('id'));
			$data[ 'ticketevent' ] =$this->ticketevent_model->getticketevent();
			$data['page']='editdiscountcoupon';
			$data['title']='Edit discountcoupon';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$percent=$this->input->post('percent');
			$amount=$this->input->post('amount');
			$couponcode=$this->input->post('couponcode');
			$minimumticket=$this->input->post('minimumticket');
			$maximumticket=$this->input->post('maximumticket');
			$ticketevent=$this->input->post('ticketevent');
			$userperuser=$this->input->post('userperuser');
			$starttime=date("H:i",strtotime($this->input->post('starttime')));
			$starttime = $starttime.":00";
			$starttime = date("H:i:s",strtotime($starttime));
			$endtime=date("H:i",strtotime($this->input->post('endtime')));
			$endtime = $endtime.":00";
			$endtime = date("H:i:s",strtotime($endtime));
			if($this->discountcoupon_model->editdiscountcoupon($id,$name,$percent,$amount,$minimumticket,$maximumticket,$ticketevent,$couponcode,$userperuser,$starttime,$endtime)==0)
			$data['alerterror']="discountcoupon Editing was unsuccesful";
			else
			$data['alertsuccess']="discountcoupon edited Successfully.";
			$data['table']=$this->discountcoupon_model->viewdiscountcoupon();
			$data['redirect']="site/viewdiscountcoupon";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['discountcoupon']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletediscountcoupon()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->discountcoupon_model->deletediscountcoupon($this->input->get('id'));
		$data['table']=$this->discountcoupon_model->viewdiscountcoupon();
		$data['alertsuccess']="discountcoupon Deleted Successfully";
		$data['page']='viewdiscountcoupon';
		$data['title']='View discountcoupon';
		$this->load->view('template',$data);
	}
	public function createorganizer()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'page' ] = 'createorganizer';
		$data[ 'title' ] = 'Create organizer';
		$data['user']=$this->user_model->getorganizeruser();
		$this->load->view( 'template', $data );	
	}
	function createorganizersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|');
		$this->form_validation->set_rules('contact','contactno','trim');
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('description','description','trim');
		$this->form_validation->set_rules('info','info','trim');
		$this->form_validation->set_rules('website','website','trim');
		$this->form_validation->set_rules('user','user','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['page']='createorganizer';
			$data['title']='Create New organizer';
			$data['user']=$this->user_model->getorganizeruser();
			$this->load->view('template',$data);
		}
		else
		{
			$info=$this->input->post('info');
			$email=$this->input->post('email');
			$website=$this->input->post('website');
			$contact=$this->input->post('contact');
			$name=$this->input->post('name');
			$description=$this->input->post('description');
			$user=$this->input->post('user');
			if($this->organizer_model->create($name,$description,$email,$contact,$info,$website,$user)==0)
			$data['alerterror']="New organizer could not be created.";
			else
			$data['alertsuccess']="organizer created Successfully.";
			
			$data['table']=$this->organizer_model->vieworganizers();
			$data['redirect']="site/vieworganizers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function vieworganizers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->organizer_model->vieworganizers();
		$data['page']='vieworganizers';
		$data['title']='View organizers';
		$this->load->view('template',$data);
	}
	function editorganizer()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->organizer_model->beforeedit($this->input->get('id'));
		$data['user']=$this->user_model->getorganizeruser();
		$data['page']='editorganizer';
		$data['title']='Edit organizer';
		$this->load->view('template',$data);
	}
	function editorganizersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|');
		$this->form_validation->set_rules('contact','contactno','trim');
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('description','description','trim');
		$this->form_validation->set_rules('info','info','trim');
		$this->form_validation->set_rules('website','website','trim');
		$this->form_validation->set_rules('user','user','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['user']=$this->user_model->getorganizeruser();
			$data['before']=$this->organizer_model->beforeedit($this->input->post('id'));
			$data['page']='editorganizer';
			$data['title']='Edit organizer';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$info=$this->input->post('info');
			$email=$this->input->post('email');
			$website=$this->input->post('website');
			$contact=$this->input->post('contact');
			$name=$this->input->post('name');
			$description=$this->input->post('description');
			$user=$this->input->post('user');
			if($this->organizer_model->edit($id,$name,$description,$email,$contact,$info,$website,$user)==0)
			$data['alerterror']="organizer Editing was unsuccesful";
			else
			$data['alertsuccess']="organizer edited Successfully.";
			
			$data['redirect']="site/vieworganizers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteorganizer()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->organizer_model->deleteorganizer($this->input->get('id'));
		$data['table']=$this->organizer_model->vieworganizers();
		$data['alertsuccess']="organizer Deleted Successfully";
		$data['page']='vieworganizers';
		$data['title']='View organizers';
		$this->load->view('template',$data);
	}
	//Event
	public function createevent()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'page' ] = 'createevent';
		$data[ 'title' ] = 'Create event';
		$data['organizer']=$this->organizer_model->getorganizer();
        $data['category']=$this->category_model->getcategory();
        $data['topic']=$this->topic_model->gettopic();
		$data['listingtype']=$this->event_model->getlistingtype();
		$data['remainingticket']=$this->event_model->getremainingticket();
		$this->load->view( 'template', $data );	
	}
	function createeventsubmit()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$this->form_validation->set_rules('title','title','trim|required');
		$this->form_validation->set_rules('alias','alias','trim|required');
		$this->form_validation->set_rules('location','location','trim|required');
		$this->form_validation->set_rules('starttime','starttime','trim|required');
		$this->form_validation->set_rules('endtime','endtime','trim|required');
		$this->form_validation->set_rules('locationlat','locationlat','trim');
		$this->form_validation->set_rules('locationlon','locationlon','trim|');
		$this->form_validation->set_rules('description','description','trim');
		$this->form_validation->set_rules('venue','venue','trim');
		$this->form_validation->set_rules('startdate','startdate','trim');
		$this->form_validation->set_rules('enddate','enddate','trim');
		$this->form_validation->set_rules('title','title','trim|required');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['page']='createevent';
			$data['title']='Create New event';
			$data['organizer']=$this->organizer_model->getorganizer();
			$data['listingtype']=$this->event_model->getlistingtype();
			$data['remainingticket']=$this->event_model->getremainingticket();
			$this->load->view('template',$data);
		}
		else
		{
			$title=$this->input->post('title');
			$alias=$this->input->post('alias');
			$location=$this->input->post('location');
			$starttime=$this->input->post('starttime');
			$endtime=$this->input->post('endtime');
			$locationlat=$this->input->post('locationlat');
			$locationlon=$this->input->post('locationlon');
			$venue=$this->input->post('venue');
			$description=$this->input->post('description');
			$startdate=date("Y-m-d",strtotime($this->input->post('startdate')));
			$enddate=date("Y-m-d",strtotime($this->input->post('enddate')));
			$organizer=$this->input->post('organizer');
			$listingtype=$this->input->post('listingtype');
			$showremainingticket=$this->input->post('showremainingticket');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="logo";
			$logo="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$logo=$uploaddata['file_name'];
			}
			if($this->event_model->create($title,$locationlat,$locationlon,$venue,$description,$startdate,$enddate,$organizer,$listingtype,$showremainingticket,$logo,$alias,$location,$startdate,$enddate)==0)
			$data['alerterror']="New event could not be created.";
			else
			$data['alertsuccess']="event created Successfully.";
			
			$data['table']=$this->event_model->viewevents();
			$data['redirect']="site/viewevents";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewevents()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->event_model->viewevents();
		$data['page']='viewevents';
		$data['title']='View events';
		$this->load->view('template',$data);
	}
	function editevent()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->event_model->beforeedit($this->input->get('id'));
		$data['organizer']=$this->organizer_model->getorganizer();
		$data['listingtype']=$this->event_model->getlistingtype();
		$data['remainingticket']=$this->event_model->getremainingticket();
		$data['page2']='block/eventblock';
		$data['page']='editevent';
		$data['title']='Edit event';
		$this->load->view('template',$data);
	}
	function editeventsubmit()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$this->form_validation->set_rules('title','title','trim|required');
		$this->form_validation->set_rules('alias','alias','trim|required');
		$this->form_validation->set_rules('location','location','trim|required');
		$this->form_validation->set_rules('starttime','starttime','trim|required');
		$this->form_validation->set_rules('endtime','endtime','trim|required');
		$this->form_validation->set_rules('locationlat','locationlat','trim');
		$this->form_validation->set_rules('locationlon','locationlon','trim|');
		$this->form_validation->set_rules('description','description','trim');
		$this->form_validation->set_rules('venue','venue','trim');
		$this->form_validation->set_rules('startdate','startdate','trim');
		$this->form_validation->set_rules('enddate','enddate','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['organizer']=$this->organizer_model->getorganizer();
			$data['listingtype']=$this->event_model->getlistingtype();
			$data['remainingticket']=$this->event_model->getremainingticket();
			$data['before']=$this->event_model->beforeedit($this->input->post('id'));
			$data['page2']='block/eventblock';
			$data['page']='editevent';
			$data['title']='Edit event';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$title=$this->input->post('title');
			$alias=$this->input->post('alias');
			$location=$this->input->post('location');
			$starttime=$this->input->post('starttime');
			$endtime=$this->input->post('endtime');
			$locationlat=$this->input->post('locationlat');
			$locationlon=$this->input->post('locationlon');
			$venue=$this->input->post('venue');
			$description=$this->input->post('description');
			$startdate=date("Y-m-d",strtotime($this->input->post('startdate')));
			$enddate=date("Y-m-d",strtotime($this->input->post('enddate')));
			$organizer=$this->input->post('organizer');
			$listingtype=$this->input->post('listingtype');
			$showremainingticket=$this->input->post('showremainingticket');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="logo";
			$logo="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$logo=$uploaddata['file_name'];
			}
			if($this->event_model->edit($id,$title,$locationlat,$locationlon,$venue,$description,$startdate,$enddate,$organizer,$listingtype,$showremainingticket,$logo,$alias,$location,$startdate,$enddate)==0)
			$data['alerterror']="event Editing was unsuccesful";
			else
			$data['alertsuccess']="event edited Successfully.";
			
			$data['redirect']="site/viewevents";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteevent()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->event_model->deleteevent($this->input->get('id'));
		$data['table']=$this->event_model->viewevents();
		$data['alertsuccess']="event Deleted Successfully";
		$data['page']='viewevents';
		$data['title']='View events';
		$this->load->view('template',$data);
	}
    
    /*-----------------Event functions Addes by Avinash------------------------*/
    public function showalleventsbyuserid()
    {
        $id=$this->input->get('id');
        $data['json']=$this->event_model->showalleventsbyuserid($id);
        print_r ($data);
		//$this->load->view('json',$data);
    }
    public function findone()
	{
        $id=$this->input->get('id');
        $data['json']=$this->event_model->viewone($id);
        print_r($data);
		//$this->load->view('json',$data);
	}
    
    /*-----------------End of event functions----------------------------------*/
    
	function editeventcategorytopic()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->event_model->beforeedit($this->input->get('id'));
		$data['category']=$this->category_model->getcategory();
		$data['topic']=$this->topic_model->gettopic();
		$data['page2']='block/eventblock';
		$data['page']='eventcategorytopic';
		$data['title']='Edit event category';
		$this->load->view('template',$data);
	}
	function editeventcategorytopicsubmit()
	{
		$this->form_validation->set_rules('id','id','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['before']=$this->event_model->beforeeditevent($this->input->post('id'));
			$data['category']=$this->category_model->getcategory();
			$data['topic']=$this->topic_model->gettopic();
			$data['page2']='block/eventblock';
			$data['page']='eventcategorytopic';
			$data['title']='Edit Related events';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			
			$category=$this->input->post('category');
			$topic=$this->input->post('topic');
			if($this->event_model->editeventcategorytopic($id,$category,$topic)==0)
			$data['alerterror']=" Event category-topic Editing was unsuccesful";
			else
			$data['alertsuccess']=" Event category-topic edited Successfully.";
			
			$data['redirect']="site/editeventcategorytopic?id=".$id;
			//$data['other']="template=$template";
			$this->load->view("redirect2",$data);
		}
	}
	//ticketevent
	public function createticketevent()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'page' ] = 'createticketevent';
		$data[ 'title' ] = 'Create ticketevent';
		$data['event']=$this->event_model->getevent();
		$data['tickettype']=$this->ticketevent_model->gettickettype();
		$this->load->view( 'template', $data );	
	}
	function createticketeventsubmit()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$this->form_validation->set_rules('event','event','trim|');
		$this->form_validation->set_rules('tickettype','tickettype','trim');
		$this->form_validation->set_rules('ticket','ticket','trim|');
		$this->form_validation->set_rules('ticketname','ticketname','trim');
		$this->form_validation->set_rules('amount','amount','trim');
		$this->form_validation->set_rules('starttime','Start Time','trim|required');
		$this->form_validation->set_rules('endtime','End Time','trim|required');
		$this->form_validation->set_rules('quantity','quantity','trim');
		$this->form_validation->set_rules('description','description','trim');
		$this->form_validation->set_rules('ticketmaxallowed','ticketmaxallowed','trim');
		$this->form_validation->set_rules('ticketminallowed','ticketminallowed','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['page']='createticketevent';
			$data['title']='Create New ticketevent';
			$data['event']=$this->event_model->getevent();
			$data['tickettype']=$this->ticketevent_model->gettickettype();
			$this->load->view('template',$data);
		}
		else
		{
			$event=$this->input->post('event');
			$ticket=$this->input->post('ticket');
			$tickettype=$this->input->post('tickettype');
			$amount=$this->input->post('amount');
			$ticketname=$this->input->post('ticketname');
			$quantity=$this->input->post('quantity');
			$description=$this->input->post('description');
			$ticketmaxallowed=$this->input->post('ticketmaxallowed');
			$ticketminallowed=$this->input->post('ticketminallowed');
			$starttime=date("H:i",strtotime($this->input->post('starttime')));
			$starttime = $starttime.":00";
			$starttime = date("H:i:s",strtotime($starttime));
			$endtime=date("H:i",strtotime($this->input->post('endtime')));
			$endtime = $endtime.":00";
			$endtime = date("H:i:s",strtotime($endtime));
			if($this->ticketevent_model->create($event,$ticket,$tickettype,$amount,$ticketname,$quantity,$description,$ticketmaxallowed,$ticketminallowed,$starttime,$endtime)==0)
			$data['alerterror']="New ticketevent could not be created.";
			else
			$data['alertsuccess']="ticketevent created Successfully.";
			
			$data['table']=$this->ticketevent_model->viewticketevent();
			$data['redirect']="site/viewticketevent";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewticketevent()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->ticketevent_model->viewticketevent();
		$data['page']='viewticketevent';
		$data['title']='View ticketevent';
		$this->load->view('template',$data);
	}
	function editticketevent()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->ticketevent_model->beforeedit($this->input->get('id'));
		$data['event']=$this->event_model->getevent();
		$data['tickettype']=$this->ticketevent_model->gettickettype();
		$data['page']='editticketevent';
		$data['title']='Edit ticketevent';
		$this->load->view('template',$data);
	}
	function editticketeventsubmit()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$this->form_validation->set_rules('event','event','trim|');
		$this->form_validation->set_rules('tickettype','tickettype','trim');
		$this->form_validation->set_rules('ticket','ticket','trim|');
		$this->form_validation->set_rules('ticketname','ticketname','trim');
		$this->form_validation->set_rules('amount','amount','trim');
		$this->form_validation->set_rules('starttime','Start Time','trim|required');
		$this->form_validation->set_rules('endtime','End Time','trim|required');
		$this->form_validation->set_rules('quantity','quantity','trim');
		$this->form_validation->set_rules('description','description','trim');
		$this->form_validation->set_rules('ticketmaxallowed','ticketmaxallowed','trim');
		$this->form_validation->set_rules('ticketminallowed','ticketminallowed','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['event']=$this->event_model->getevent();
			$data['tickettype']=$this->ticketevent_model->gettickettype();
			$data['before']=$this->ticketevent_model->beforeedit($this->input->post('id'));
			$data['page']='editticketevent';
			$data['title']='Edit ticketevent';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$event=$this->input->post('event');
			$ticket=$this->input->post('ticket');
			$tickettype=$this->input->post('tickettype');
			$amount=$this->input->post('amount');
			$ticketname=$this->input->post('ticketname');
			$quantity=$this->input->post('quantity');
			$description=$this->input->post('description');
			$ticketmaxallowed=$this->input->post('ticketmaxallowed');
			$ticketminallowed=$this->input->post('ticketminallowed');
			$starttime=date("H:i",strtotime($this->input->post('starttime')));
			$starttime = $starttime.":00";
			$starttime = date("H:i:s",strtotime($starttime));
			$endtime=date("H:i",strtotime($this->input->post('endtime')));
			$endtime = $endtime.":00";
			$endtime = date("H:i:s",strtotime($endtime));
			if($this->ticketevent_model->edit($id,$event,$ticket,$tickettype,$amount,$ticketname,$quantity,$description,$ticketmaxallowed,$ticketminallowed,$starttime,$endtime)==0)
			$data['alerterror']="ticketevent Editing was unsuccesful";
			else
			$data['alertsuccess']="ticketevent edited Successfully.";
			
			$data['redirect']="site/viewticketevent";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteticketevent()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->ticketevent_model->deleteticketevent($this->input->get('id'));
		$data['table']=$this->ticketevent_model->viewticketevent();
		$data['alertsuccess']="ticketevent Deleted Successfully";
		$data['page']='viewticketevent';
		$data['title']='View ticketevent';
		$this->load->view('template',$data);
	}
	//Newsletter
	public function createnewsletter()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'page' ] = 'createnewsletter';
		$data[ 'title' ] = 'Create newsletter';
		$this->load->view( 'template', $data );	
	}
	public function createnewslettersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('title','title','trim|');
		$this->form_validation->set_rules('subject','subject','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'page' ] = 'createnewsletter';
			$data[ 'title' ] = 'Create newsletter';
			$this->load->view('template',$data);
		}
		else
		{
			$title=$this->input->post('title');
			$subject=$this->input->post('subject');
			if($this->newsletter_model->createnewsletter($title,$subject)==0)
			$data['alerterror']="New newsletter could not be created.";
			else
			$data['alertsuccess']="newsletter  created Successfully.";
			$data['redirect']="site/viewnewsletter";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	public function editnewsletter()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->newsletter_model->beforeeditnewsletter($this->input->get('id'));
		$data[ 'page' ] = 'editnewsletter';
		$data[ 'title' ] = 'Edit newsletter';
		$this->load->view( 'template', $data );	
	}
	function editnewslettersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('title','title','trim|');
		$this->form_validation->set_rules('subject','subject','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['before']=$this->newsletter_model->beforeeditnewsletter($this->input->post('id'));
			$data['page']='editnewsletter';
			$data['title']='Edit newsletter';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$title=$this->input->post('title');
			$subject=$this->input->post('subject');
			
			if($this->newsletter_model->editnewsletter($id,$title,$subject)==0)
			$data['alerterror']="newsletter Editing was unsuccesful";
			else
			$data['alertsuccess']="newsletter edited Successfully.";
			$data['table']=$this->newsletter_model->viewnewsletter();
			$data['redirect']="site/viewnewsletter";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['page']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletenewsletter()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->newsletter_model->deletenewsletter($this->input->get('id'));
		$data['table']=$this->newsletter_model->viewnewsletter();
		$data['alertsuccess']="newsletter Deleted Successfully";
		$data['page']='viewnewsletter';
		$data['title']='View newsletter';
		$this->load->view('template',$data);
	}
	function viewnewsletter()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->newsletter_model->viewnewsletter();
		$data['page']='viewnewsletter';
		$data['title']='View newsletter';
		$this->load->view('template',$data);
	}
}
?>