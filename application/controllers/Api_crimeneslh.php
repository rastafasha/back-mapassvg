<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Crimeneslh extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('api_model_crimeneslh');
		$this->load->helper('url');
		$this->load->helper('text');

		header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
		header("Access-Control-Allow-Headers: authorization, Content-Type");
        header("Access-Control-Request-Methods: GET, PUT, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Access-Control-Allow-Request-Method");
	}

	public function crimeneslhs()
	{
		
		$crimeneslhs = $this->api_model_crimeneslh->get_crimeneslhs($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($crimeneslhs)){
			foreach($crimeneslhs as $crimeneslh){


				$posts[] = array(
					'id' => $crimeneslh->id,
					'pais_code' => $crimeneslh->pais_code,
					'crimeneslh' => $crimeneslh->crimeneslh,
					'clasificacionColectiva' => $crimeneslh->clasificacionColectiva,
					'clasificacionIndividual' => $crimeneslh->clasificacionIndividual,
					'lugar' => $crimeneslh->lugar,
					'breveDescripcion' => $crimeneslh->breveDescripcion,
					'numCasosCPIAprobados' => $crimeneslh->numCasosCPIAprobados,
					'numCasosCPIPendientes' => $crimeneslh->numCasosCPIPendientes,
					'numCasosNoCpiAprobado' => $crimeneslh->numCasosNoCpiAprobado,
					'numCasosNoCpiPendiente' => $crimeneslh->numCasosNoCpiPendiente,
					'created_at' => $crimeneslh->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function crimeneslh($code)
	{
		
		
		$crimeneslh = $this->api_model_crimeneslh->get_crimeneslh($code);

		$post = array(
			'id' => $crimeneslh->id,
			'pais_code' => $crimeneslh->pais_code,
			'crimeneslh' => $crimeneslh->crimeneslh,
			'clasificacionColectiva' => $crimeneslh->clasificacionColectiva,
			'clasificacionIndividual' => $crimeneslh->clasificacionIndividual,
			'lugar' => $crimeneslh->lugar,
			'breveDescripcion' => $crimeneslh->breveDescripcion,
			'numCasosCPIAprobados' => $crimeneslh->numCasosCPIAprobados,
			'numCasosCPIPendientes' => $crimeneslh->numCasosCPIPendientes,
			'numCasosNoCpiAprobado' => $crimeneslh->numCasosNoCpiAprobado,
			'numCasosNoCpiPendiente' => $crimeneslh->numCasosNoCpiPendiente,
			'created_at' => $crimeneslh->created_at
		);

		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}


	//


	//CRUD blog

	public function adminCrimeneslhs()
	{
		
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		$posts = array();
		if($isValidToken) {
			$crimeneslhs = $this->api_model_crimeneslh->get_admin_crimeneslhs();
			foreach($crimeneslhs as $crimeneslh) {
				$posts[] = array(
					'id' => $crimeneslh->id,
					'crimeneslh' => $crimeneslh->crimeneslh,
					'clasificacionColectiva' => $crimeneslh->clasificacionColectiva,
					'clasificacionIndividual' => $crimeneslh->clasificacionIndividual,
					'lugar' => $crimeneslh->lugar,
					'breveDescripcion' => $crimeneslh->breveDescripcion,
					'numCasosCPIAprobados' => $crimeneslh->numCasosCPIAprobados,
					'numCasosCPIPendientes' => $crimeneslh->numCasosCPIPendientes,
					'numCasosNoCpiAprobado' => $crimeneslh->numCasosNoCpiAprobado,
					'numCasosNoCpiPendiente' => $crimeneslh->numCasosNoCpiPendiente,
					'created_at' => $crimeneslh->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminCrimeneslh($id)
	{
		

		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$crimeneslh = $this->api_model_crimeneslh->get_admin_crimeneslh($id);

			$post = array(
				'id' => $crimeneslh->id,
				
					'pais_code' => $crimeneslh->pais_code,
					'crimeneslh' => $crimeneslh->crimeneslh,
					'clasificacionColectiva' => $crimeneslh->clasificacionColectiva,
					'clasificacionIndividual' => $crimeneslh->clasificacionIndividual,
					'lugar' => $crimeneslh->lugar,
					'breveDescripcion' => $crimeneslh->breveDescripcion,
					'numCasosCPIAprobados' => $crimeneslh->numCasosCPIAprobados,
					'numCasosCPIPendientes' => $crimeneslh->numCasosCPIPendientes,
					'numCasosNoCpiAprobado' => $crimeneslh->numCasosNoCpiAprobado,
					'numCasosNoCpiPendiente' => $crimeneslh->numCasosNoCpiPendiente,
					'created_at' => $crimeneslh->created_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createCrimeneslh()
	{
		

		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$pais_code = $this->input->post('pais_code');
			$crimeneslh = $this->input->post('crimeneslh');
			$clasificacionColectiva = $this->input->post('clasificacionColectiva');
			$clasificacionIndividual = $this->input->post('clasificacionIndividual');
			$lugar = $this->input->post('lugar');
			$breveDescripcion = $this->input->post('breveDescripcion');
			$numCasosCPIAprobados = $this->input->post('numCasosCPIAprobados');
			$numCasosCPIPendientes = $this->input->post('numCasosCPIPendientes');
			$numCasosNoCpiAprobado = $this->input->post('numCasosNoCpiAprobado');
			$numCasosNoCpiPendiente = $this->input->post('numCasosNoCpiPendiente');

			$filename = NULL;

			$isUploadError = FALSE;


			if( ! $isUploadError) {
	        	$crimeneslhData = array(
					'user_id' => 1,
					'pais_code' => $pais_code,
					'crimeneslh' => $crimeneslh,
					'clasificacionColectiva' => $clasificacionColectiva,
					'clasificacionIndividual' => $clasificacionIndividual,
					'lugar' => $lugar,
					'breveDescripcion' => $breveDescripcion,
					'numCasosCPIAprobados' => $numCasosCPIAprobados,
					'numCasosCPIPendientes' => $numCasosCPIPendientes,
					'numCasosNoCpiAprobado' => $numCasosNoCpiAprobado,
					'numCasosNoCpiPendiente' => $numCasosNoCpiPendiente,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_crimeneslh->insertCrimeneslh($crimeneslhData);

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

	public function updateCrimeneslh($id)
	{
		

		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$crimeneslh = $this->api_model_crimeneslh->get_admin_crimeneslh($id);

			$pais_code = $this->input->post('pais_code');
			$crimeneslh = $this->input->post('crimeneslh');
			$clasificacionColectiva = $this->input->post('clasificacionColectiva');
			$clasificacionIndividual = $this->input->post('clasificacionIndividual');
			$lugar = $this->input->post('lugar');
			$breveDescripcion = $this->input->post('breveDescripcion');
			$numCasosCPIAprobados = $this->input->post('numCasosCPIAprobados');
			$numCasosCPIPendientes = $this->input->post('numCasosCPIPendientes');
			$numCasosNoCpiAprobado = $this->input->post('numCasosNoCpiAprobado');
			$numCasosNoCpiPendiente = $this->input->post('numCasosNoCpiPendiente');

			$isUploadError = FALSE;

			if( ! $isUploadError) {
	        	$crimeneslhData = array(
					'user_id' => 1,
					'pais_code' => $pais_code,
					'crimeneslh' => $crimeneslh,
					'clasificacionColectiva' => $clasificacionColectiva,
					'clasificacionIndividual' => $clasificacionIndividual,
					'lugar' => $lugar,
					'breveDescripcion' => $breveDescripcion,
					'numCasosCPIAprobados' => $numCasosCPIAprobados,
					'numCasosCPIPendientes' => $numCasosCPIPendientes,
					'numCasosNoCpiAprobado' => $numCasosNoCpiAprobado,
					'numCasosNoCpiPendiente' => $numCasosNoCpiPendiente,
					'updated_at' => date('Y-m-d H:i:s', time())
				);

				$this->api_model_crimeneslh->updateCrimeneslh($id, $crimeneslhData);

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

	public function deleteCrimeneslh($id)
	{
		

		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$crimeneslh = $this->api_model_crimeneslh->get_admin_crimeneslh($id);


			$this->api_model_crimeneslh->deleteCrimeneslh($id);

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