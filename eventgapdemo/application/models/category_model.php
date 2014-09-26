<?php
if ( !defined( 'BASEPATH' ) )
	exit( 'No direct script access allowed' );
class Category_model extends CI_Model
{
	//category
	public function createcategory($name,$parent,$status)
	{
		$data  = array(
			'name' => $name,
			'parent' => $parent,
			'status' => $status,
		);
		$query=$this->db->insert( 'category', $data );
		
		return  1;
	}
	function viewcategory()
	{
		$query=$this->db->query("SELECT `category`.`id`,`category`.`name`,`tab2`.`name` as `parent` FROM `category` 
		LEFT JOIN `category` as `tab2` ON `tab2`.`id`=`category`.`parent`
		ORDER BY `category`.`id` ASC")->result();
		return $query;
	}
	public function beforeeditcategory( $id )
	{
		$this->db->where( 'id', $id );
		$query=$this->db->get( 'category' )->row();
		return $query;
	}
	
	public function editcategory( $id,$name,$parent,$status)
	{
		$data = array(
			'name' => $name,
			'parent' => $parent,
			'status' => $status,
		
		);
		$this->db->where( 'id', $id );
		$query=$this->db->update( 'category', $data );
		
		return 1;
	}
	function deletecategory($id)
	{
		$query=$this->db->query("DELETE FROM `category` WHERE `id`='$id'");
		
	}
	public function getcategorydropdown()
	{
		$query=$this->db->query("SELECT * FROM `category`  ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
	public function getcategory()
	{
		$query=$this->db->query("SELECT * FROM `category`  ORDER BY `name` ASC")->result();
		
		
		return $query;
	}
	public function getstatusdropdown()
	{
		$status= array(
			 "1" => "Enabled",
			 "0" => "Disabled",
			);
		return $status;
	}
}
?>