<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_articulo extends CI_Model 
{
	
		
	
	// documento Get
	public function get_articulos($featured, $recentpost)
	{
		$this->db->select('articulo.*');
		$this->db->from('articulos articulo');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_articulo($id)
	{
		$this->db->select('articulo.*');
		$this->db->from('articulos articulo');
		$this->db->where('articulo.id', $id);
		$query = $this->db->get();
		return $query->row();
	}
	//


	// articulo gets

	public function get_admin_articulos()
	{
		$this->db->select('articulo.*');
		$this->db->from('articulos articulo');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_articulo($id)
	{
		$this->db->select('articulo.*');
		$this->db->from('articulos articulo');
		$this->db->where('articulo.id', $id);
		$query = $this->db->get();
		return $query->row();
	}
    //
    
    // CRUD articulo

	public function insertArticulo($articuloData)
	{
		$this->db->insert('articulos', $articuloData);
		return $this->db->insert_id();
	}

	public function updateArticulo($id, $articuloData)
	{
		$this->db->where('id', $id);
		$this->db->update('articulos', $articuloData);
	}

	public function deleteArticulo($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('articulos');
	}
	//

	


	
}
