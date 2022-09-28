<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Articulo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('api_model_articulo');
		$this->load->helper('url');
		$this->load->helper('text');

		header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
		header("Access-Control-Allow-Headers: authorization, Content-Type");
        header("Access-Control-Request-Methods: GET, PUT, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Access-Control-Allow-Request-Method");
	}


	//articulos

	public function articulos()
	{

		$articulos = $this->api_model_articulo->get_articulos($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($articulos)){
			foreach($articulos as $articulo){


				$posts[] = array(
					'id' => $articulo->id,
					'title' => $articulo->title,
					'description' => $articulo->description,
					'is_active' => $articulo->is_active,
					'archivo' => base_url('media/images/uploads/pdf/articulos/'.$articulo->archivo),
					'created_at' => $articulo->created_at,
					'updated_at' => $articulo->updated_at,
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function articulo($id)
	{
		header("Access-Control-Allow-Origin: *");
		
		$articulo = $this->api_model_articulo->get_articulo($id);

		$post = array(
			'id' => $articulo->id,
					'title' => $articulo->title,
					'description' => $articulo->description,
					'is_active' => $articulo->is_active,
					'archivo' => base_url('media/images/uploads/pdf/articulos/'.$articulo->archivo),
					'created_at' => $articulo->created_at,
					'updated_at' => $articulo->updated_at,
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}

	public function recent_articulos()
	{
		header("Access-Control-Allow-Origin: *");

		$articulos = $this->api_model_articulo->get_articulos($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($articulos)){
			foreach($articulos as $articulo){
				

				$posts[] = array(
					'id' => $articulo->id,
					'title' => $articulo->title,
					'description' => $articulo->description,
					'is_active' => $articulo->is_active,
					'archivo' => base_url('media/images/uploads/pdf/articulos/'.$articulo->archivo),
					'created_at' => $articulo->created_at,
					'updated_at' => $articulo->updated_at,
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	//


	//CRUD Afiliaciones

	public function adminArticulos()
	{
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		$posts = array();
		if($isValidToken) {
			$articulos = $this->api_model_articulo->get_admin_articulos();
			foreach($articulos as $articulo) {
				$posts[] = array(
					'id' => $articulo->id,
					'title' => $articulo->title,
					'description' => $articulo->description,
					'is_active' => $articulo->is_active,
					'archivo' => base_url('media/images/uploads/pdf/articulos/'.$articulo->archivo),
					'created_at' => $articulo->created_at,
					'updated_at' => $articulo->updated_at,
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminArticulo($id)
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: authorization, Content-Type");

		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$articulo = $this->api_model_articulo->get_admin_articulo($id);

			$post = array(
				'id' => $articulo->id,
					'title' => $articulo->title,
					'description' => $articulo->description,
					'is_active' => $articulo->is_active,
					'archivo' => base_url('media/images/uploads/pdf/articulos/'.$articulo->archivo),
					'created_at' => $articulo->created_at,
					'updated_at' => $articulo->updated_at,
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createArticulo()
	{
		
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$is_active = $this->input->post('is_active');

			$filename = NULL;

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['archivo']['name']) {

				$config['upload_path']          = './media/images/uploads/pdf/articulos/';
	            $config['allowed_types']        = 'pdf';
	            $config['max_size']             = 3000;

	            $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('archivo')) {

	            	$isUploadError = TRUE;

					$response = array(
						'status' => 'error',
						'message' => $this->upload->display_errors()
					);
	            }
	            else {
	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$articuloData = array(
					'title' => $title,
					'user_id' => 1,
					'description' => $description,
					'is_active' => $is_active,
					'archivo' => $filename,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_articulo->insertArticulo($articuloData);

				$response = array(
					'status' => 'success'
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		}
	}

	public function updateArticulo($id)
	{
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$articulo = $this->api_model_articulo->get_admin_articulo($id);
			$filename = $articulo->archivo;

			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$is_active = $this->input->post('is_active');
			

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['archivo']['name']) {

				$config['upload_path']          = './media/images/uploads/pdf/articulos/';
	            $config['allowed_types']        = 'pdf';
	            $config['max_size']             = 3000;

	            $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('archivo')) {

	            	$isUploadError = TRUE;

					$response = array(
						'status' => 'error',
						'message' => $this->upload->display_errors()
					);
	            }
	            else {
	   
					if($articulo->archivo && file_exists(FCPATH.'media/images/uploads/pdf/articulos/'.$articulo->archivo))
					{
						unlink(FCPATH.'media/images/uploads/pdf/articulos/'.$articulo->archivo);
					}

	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$articuloData = array(
					'title' => $title,
					'user_id' => 1,
					'description' => $description,
					'is_active' => $is_active,
					'archivo' => $filename,
					'updated_at' => date('Y-m-d H:i:s', time())
				);

				$this->api_model_articulo->updateArticulo($id, $articuloData);

				$response = array(
					'status' => 'success'
				);
           	}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		}
	}

	public function deleteArticulo($id)
	{
		
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$articulo = $this->api_model_articulo->get_admin_articulo($id);

			if($articulo->archivo && file_exists(FCPATH.'media/images/uploads/pdf/articulos/'.$articulo->archivo))
			{
				unlink(FCPATH.'media/images/uploads/pdf/articulos/'.$articulo->archivo);
			}

			$this->api_model_articulo->deleteArticulo($id);

			$response = array(
				'status' => 'success'
			);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		}
	}
	//

	
	
}
