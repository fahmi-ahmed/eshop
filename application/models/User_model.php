<?php

if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_model extends CI_Model {

	public function seller($sellername) {
		$this->db->select('*');
		$this->db->from('sellers');
		$this->db->where('sellername',$sellername);
		$query = $this->db->get();
		return $query->result();
	}

	public function delete($id) {
		$this->db->where('uid', $id);
		$this->db->delete('user');
	}

	public function user($sellername) {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('uname',$sellername);
		$query = $this->db->get();
		return $query->result();
	}

	public function orderin($order) {
		$this->db->insert('orders',$order);
	}

	public function pro($table,$id){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function update($table,$id,$data){
		$this->db->where('id', $id);
		$this->db->update($table, $data);
	}

	public function get_article($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `hottopics` WHERE `topic` LIKE '%$st%' ORDER BY `created_date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function selectedtopic($id) {
		$this->db->select('*');
		$this->db->from('hottopics');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function laptop() {
		$this->db->select('*');
		$this->db->from('laptop');
		$this->db->order_by('orders','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->result();
	}

	public function gaminglaptop() {
		$this->db->select('*');
		$this->db->from('gaminglaptop');
		$this->db->order_by('orders','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->result();
	}

	public function mobile() {
		$this->db->select('*');
		$this->db->from('mobile');
		$this->db->order_by('orders','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->result();
	}

	public function motherboard() {
		$this->db->select('*');
		$this->db->from('motherboard');
		$this->db->order_by('orders','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->result();
	}

	public function pcgames() {
		$this->db->select('*');
		$this->db->from('pcgames');
		$this->db->order_by('orders','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_camera($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `camera` WHERE `name` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_camerab($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `camera` WHERE `brand` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_cameral($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `camera` WHERE `lensesize` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_camera_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('camera');
		$this->db->like('name',$st);
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_laptop($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `laptop` WHERE `name` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_laptopb($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `laptop` WHERE `brand` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_laptopp($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `laptop` WHERE `processor` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_laptopr($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `laptop` WHERE `ram` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_laptoph($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `laptop` WHERE `hdd` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_laptop_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('laptop');
		$this->db->like('name',$st);
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_desktop($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `desktop` WHERE `name` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_desktop_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('desktop');
		$this->db->like('name',$st);
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_gaminglaptop($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `gaminglaptop` WHERE `name` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_gaminglaptopb($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `gaminglaptop` WHERE `brand` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_gaminglaptopp($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `gaminglaptop` WHERE `processor` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_gaminglaptopr($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `gaminglaptop` WHERE `ram` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_gaminglaptoph($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `gaminglaptop` WHERE `hdd` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_gaminglaptop_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('gaminglaptop');
		$this->db->like('name',$st);
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_mobile($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `mobile` WHERE `name` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_mobileb($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `mobile` WHERE `brand` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_mobilep($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `mobile` WHERE `processor` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_mobiler($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `mobile` WHERE `ram` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_mobile_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('mobile');
		$this->db->like('name',$st);
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_motherboard($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `motherboard` WHERE `name` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_motherboard_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('motherboard');
		$this->db->like('name',$st);
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_pcgames($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `pcgames` WHERE `name` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_pcgamesb($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `pcgames` WHERE `brand` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_pcgames_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('pcgames');
		$this->db->like('name',$st);
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_harddisk($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `harddisk` WHERE `name` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_harddisk_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('harddisk');
		$this->db->like('name',$st);
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_ram($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `ram` WHERE `name` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_ram_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('ram');
		$this->db->like('name',$st);
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_headphone($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `headphone` WHERE `name` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_headphone_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('headphone');
		$this->db->like('name',$st);
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_ipad($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `ipad` WHERE `name` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_ipad_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('ipad');
		$this->db->like('name',$st);
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_tablet($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `tablet` WHERE `name` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_tablet_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('tablet');
		$this->db->like('name',$st);
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_gamingtools($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `gamingtools` WHERE `name` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_gamingtools_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('gamingtools');
		$this->db->like('name',$st);
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_xbox($limit, $start, $st = NULL) {
		if ($st == "NIL") $st = "";
		$sql = "SELECT * FROM `xbox` WHERE `name` LIKE '%$st%' ORDER BY `date` DESC LIMIT " . $start . ",  " . $limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_xbox_count($st = NULL){
		if ($st == "NIL") $st = "";
		$this->db->select('*');
		$this->db->from('xbox');
		$this->db->like('name',$st);
		$this->db->order_by('date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

}
