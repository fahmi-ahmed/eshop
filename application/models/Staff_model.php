<?php

if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Staff_model extends CI_Model {

	public function usersdata($id) {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('uid', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function insertu($user){
		$this->db->insert('user', $user);
	}

	public function getuser($id) {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('uid', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_user() {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user_type', 1);
		$this->db->or_where('user_type', 2);
		$query = $this->db->get();
		$result = $query->result();
		$id = array('0');
		$name = array('Select user to terminate');
		for ($i = 0; $i < count($result); $i++)
		{
				array_push($id, $result[$i]->uid);
				array_push($name, $result[$i]->uname);
		}
		return array_combine($id, $name);
	}

	public function udelete($id) {
		$this->db->where('uid', $id);
		$this->db->delete('user');
	}

	public function sdelete($id) {
		$this->db->where('sellerid', $id);
		$this->db->delete('sellers');
	}

	public function ddelete($id) {
		$this->db->where('delid', $id);
		$this->db->delete('delivery');
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('orders');
	}

	public function fetch_order($product,$seller,$table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('sellername', $seller);
		$this->db->where('name', $product);
		$query = $this->db->get();
		return $query->result();
	}

	public function update($table,$pro_id, $new){
		$this->db->where('id', $pro_id);
		$this->db->update($table, $new);
	}

	public function subtype($subtype) {
		$this->db->select('*');
		$this->db->from('subtype');
		$this->db->where('stid', $subtype);
		$query = $this->db->get();
		return $query->result();
	}

	public function supdate($id, $new){
		$this->db->where('sellerid', $id);
		$this->db->update('sellers', $new);
	}

	public function dupdate($id, $newd){
		$this->db->where('delid', $id);
		$this->db->update('delivery', $newd);
	}

	public function oupdate($id, $newo){
		$this->db->where('id', $id);
		$this->db->update('orders', $newo);
	}

	public function proupdate($id, $new,$table){
		$this->db->where('id', $id);
		$this->db->update($table, $new);
	}

	public function get_delivery() {
			$result = $this->db->select('*')->get('delivery')->result();;
			$id = array('0');
			$name = array('Select delivery company');
			for ($i = 0; $i < count($result); $i++)
			{
					array_push($id, $result[$i]->delid);
					array_push($name, $result[$i]->dname);
			}
			return array_combine($id, $name);
	}

	public function get_del($id) {
		$this->db->select('*');
		$this->db->from('delivery');
		$this->db->where('delid', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_seller($sname) {
		$this->db->select('*');
		$this->db->from('sellers');
		$this->db->where('sellername', $sname);
		$query = $this->db->get();
		return $query->result();
	}

	public function product($table, $pro_name) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('name', $pro_name);
		$query = $this->db->get();
		return $query->result();
	}

	public function updateorder($id,$new){
		$this->db->where('id', $id);
		$this->db->update('orders', $new);
	}

	public function getdelivery($shname) {
		$this->db->select('*');
		$this->db->from('delivery');
		$this->db->where('dname', $shname);
		$query = $this->db->get();
		return $query->result();
	}

	public function getorders($sname) {
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('seller', $sname);
		$this->db->where('fstat', 0);
		$query = $this->db->get();
		return $query->result();
	}

	public function getorderss($sname) {
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('seller', $sname);
		$this->db->where('fstat', 1);
		$this->db->where('dstat', 0);
		$query = $this->db->get();
		return $query->result();
	}

	public function getnotpaidorders($sname) {
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('seller', $sname);
		$this->db->where('paystat', 0);
		$query = $this->db->get();
		return $query->result();
	}

	public function getorder($id) {
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function uname_email_check($email,$user_name) {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email', $email);
		$this->db->or_where('uname', $user_name);
		$query = $this->db->get();
		if($query->num_rows() == 0) {
			return true;
		}else {
			return false;
		}
  }

	public function insertsellers($sellers){
		$this->db->insert('sellers', $sellers);
  }

	public function insertdelivery($delivery){
		$this->db->insert('delivery', $delivery);
	}

	public function insertseller($seller){
		$this->db->insert('user', $seller);
  }

	public function insert($article) {
		$this->db->insert('hottopics', $article);
	}

	public function get_article($id,$limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `hottopics` WHERE `topic` LIKE '%$st%' AND `id` = $id ORDER BY `created_date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_article_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('hottopics');
		$this->db->like('topic',$st);
		$this->db->order_by('created_date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getarticle($id) {
		$this->db->select('*');
		$this->db->from('hottopics');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_type() {
			$result = $this->db->select('*')->get('type')->result();;
			$id = array('0');
			$name = array('Select type');
			for ($i = 0; $i < count($result); $i++)
			{
					array_push($id, $result[$i]->typeid);
					array_push($name, $result[$i]->name);
			}
			return array_combine($id, $name);
	}

	public function get_subtype($typeid=NULL) {
			$result = $this->db->where('typeid',$typeid)->get('subtype')->result();;
			$id = array('0');
			$name = array('Select subtype');
			for ($i = 0; $i < count($result); $i++)
			{
					array_push($id, $result[$i]->stid);
					array_push($name, $result[$i]->name);
			}
			return array_combine($id, $name);
	}

	public function a_update($id,$article) {
		$this->db->where('id',$id);
		$this->db->update('hottopics',$article);
	}

	public function sellers() {
		$this->db->select('*');
		$this->db->from('sellers');
		$query = $this->db->get();
		return $query->result();
	}

	public function delivery() {
		$this->db->select('*');
		$this->db->from('delivery');
		$query = $this->db->get();
		return $query->result();
	}

	public function camera($pro) {
		$this->db->insert('camera', $pro);
	}

	public function get_camera($sellername) {
		$this->db->select('*');
		$this->db->from('camera');
		$this->db->where('sellername',$sellername);
		$this->db->limit('6');
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function laptop($pro) {
		$this->db->insert('laptop', $pro);
	}

	public function get_laptop($sellername) {
		$this->db->select('*');
		$this->db->from('laptop');
		$this->db->where('sellername',$sellername);
		$this->db->limit('6');
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function desktop($pro) {
		$this->db->insert('desktop', $pro);
	}

	public function get_desktop($sellername) {
		$this->db->select('*');
		$this->db->from('desktop');
		$this->db->where('sellername',$sellername);
		$this->db->limit('6');
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function gaminglaptop($pro) {
		$this->db->insert('gaminglaptop', $pro);
	}

	public function get_gaminglaptop($sellername) {
		$this->db->select('*');
		$this->db->from('gaminglaptop');
		$this->db->where('sellername',$sellername);
		$this->db->limit('6');
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function mobile($pro) {
		$this->db->insert('mobile', $pro);
	}

	public function get_mobile($sellername) {
		$this->db->select('*');
		$this->db->from('mobile');
		$this->db->where('sellername',$sellername);
		$this->db->limit('6');
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function motherboard($pro) {
		$this->db->insert('motherboard', $pro);
	}

	public function get_motherboard($sellername) {
		$this->db->select('*');
		$this->db->from('motherboard');
		$this->db->where('sellername',$sellername);
		$this->db->limit('6');
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function pcgames($pro) {
		$this->db->insert('pcgames', $pro);
	}

	public function get_pcgames($sellername) {
		$this->db->select('*');
		$this->db->from('pcgames');
		$this->db->where('sellername',$sellername);
		$this->db->limit('6');
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function harddisk($pro) {
		$this->db->insert('harddisk', $pro);
	}

	public function get_harddisk($sellername) {
		$this->db->select('*');
		$this->db->from('harddisk');
		$this->db->where('sellername',$sellername);
		$this->db->limit('6');
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function ram($pro) {
		$this->db->insert('ram', $pro);
	}

	public function get_ram($sellername) {
		$this->db->select('*');
		$this->db->from('ram');
		$this->db->where('sellername',$sellername);
		$this->db->limit('6');
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function headphone($pro) {
		$this->db->insert('headphone', $pro);
	}

	public function get_headphone($sellername) {
		$this->db->select('*');
		$this->db->from('headphone');
		$this->db->where('sellername',$sellername);
		$this->db->limit('6');
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function ipad($pro) {
		$this->db->insert('ipad', $pro);
	}

	public function get_ipad($sellername) {
		$this->db->select('*');
		$this->db->from('ipad');
		$this->db->where('sellername',$sellername);
		$this->db->limit('6');
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function tablet($pro) {
		$this->db->insert('tablet', $pro);
	}

	public function get_tablet($sellername) {
		$this->db->select('*');
		$this->db->from('tablet');
		$this->db->where('sellername',$sellername);
		$this->db->limit('6');
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function gamingtools($pro) {
		$this->db->insert('gamingtools', $pro);
	}

	public function get_gamingtools($sellername) {
		$this->db->select('*');
		$this->db->from('gamingtools');
		$this->db->where('sellername',$sellername);
		$this->db->limit('6');
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function xbox($pro) {
		$this->db->insert('xbox', $pro);
	}

	public function get_xbox($sellername) {
		$this->db->select('*');
		$this->db->from('xbox');
		$this->db->where('sellername',$sellername);
		$this->db->limit('6');
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->result();
	}

}
