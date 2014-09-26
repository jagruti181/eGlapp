<?php
if ( !defined( 'BASEPATH' ) )
	exit( 'No direct script access allowed' );
class Topic_model extends CI_Model
{
	//topic
	public function createtopic($name,$parent,$status)
	{
		$data  = array(
			'name' => $name,
			'parent' => $parent,
			'status' => $status,
		);
		$query=$this->db->insert( 'topic', $data );
		
		return  1;
	}
	function viewtopic()
	{
		$query=$this->db->query("SELECT `topic`.`id`,`topic`.`name`,`tab2`.`name` as `parent` FROM `topic` 
		LEFT JOIN `topic` as `tab2` ON `tab2`.`id`=`topic`.`parent`
		ORDER BY `topic`.`id` ASC")->result();
		return $query;
	}
	public function beforeedittopic( $id )
	{
		$this->db->where( 'id', $id );
		$query=$this->db->get( 'topic' )->row();
		return $query;
	}
	
	public function edittopic( $id,$name,$parent,$status)
	{
		$data = array(
			'name' => $name,
			'parent' => $parent,
			'status' => $status,
		
		);
		$this->db->where( 'id', $id );
		$query=$this->db->update( 'topic', $data );
		
		return 1;
	}
	function deletetopic($id)
	{
		$query=$this->db->query("DELETE FROM `topic` WHERE `id`='$id'");
		
	}
	public function gettopicdropdown()
	{
		$query=$this->db->query("SELECT * FROM `topic`  ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
	public function gettopic()
	{
		$query=$this->db->query("SELECT * FROM `topic`  ORDER BY `name` ASC")->result();
		
		
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