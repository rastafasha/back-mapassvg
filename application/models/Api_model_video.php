<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_video extends CI_Model 
{
	public function get_videos($featured, $recentpost)
	{
		$this->db->select('video.*');
		$this->db->from('videos video');
		$this->db->where('video.is_active', 1);

		if($recentpost){
			$this->db->order_by('video.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_video($id)
	{
		$this->db->select('video.*');
		$this->db->from('videos video');
		$this->db->where('video.is_active', 1);
		$this->db->where('video.id', $id);
		$query = $this->db->get();
		return $query->row();
	}



	public function get_admin_videos()
	{
		$this->db->select('video.*, u.first_name, u.last_name');
		$this->db->from('videos video');
		$this->db->join('users u', 'u.id=video.user_id');
		$this->db->order_by('video.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_video($id)
	{
		$this->db->select('video.*, u.first_name, u.last_name');
		$this->db->from('videos video');
		$this->db->join('users u', 'u.id=video.user_id');
		$this->db->where('video.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertVideo($videoData)
	{
		$this->db->insert('videos', $videoData);
		return $this->db->insert_id();
	}

	public function updateVideo($id, $videoData)
	{
		$this->db->where('id', $id);
		$this->db->update('videos', $videoData);
	}

	public function deleteVideo($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('videos');
	}
}
