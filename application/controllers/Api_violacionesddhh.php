<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Violacionesddhh extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('api_model_violacionesddhh');
		$this->load->helper('url');
		$this->load->helper('text');

		header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
		header("Access-Control-Allow-Headers: authorization, Content-Type");
        header("Access-Control-Request-Methods: GET, PUT, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Access-Control-Allow-Request-Method");
	}

	public function violacionesddhhs()
	{
		
		$violacionesddhhs = $this->api_model_violacionesddhh->get_violacionesddhhs($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($violacionesddhhs)){
			foreach($violacionesddhhs as $violacionesddhh){


				$posts[] = array(
					'id' => $violacionesddhh->id,
					'pais_code' => $violacionesddhh->pais_code,
					'violacionesDdhhTotal' => $violacionesddhh->violacionesDdhhTotal,
					'clasificacionDCP' => $violacionesddhh->clasificacionDCP,
					'clasificacionDESCA' => $violacionesddhh->clasificacionDESCA,
					'calsificacionPueblos' => $violacionesddhh->calsificacionPueblos,
					'lugar' => $violacionesddhh->lugar,
					'breveDescripcion' => $violacionesddhh->breveDescripcion,
					'numCasosCorteInterDDHH' => $violacionesddhh->numCasosCorteInterDDHH,
					'numCasosComDHNU' => $violacionesddhh->numCasosComDHNU,
					'casosNoAccionar' => $violacionesddhh->casosNoAccionar,
					'created_at' => $violacionesddhh->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	
	public function violacionesddhh($code)
	{
		$violacionesddhh = $this->api_model_violacionesddhh->get_violacionesddhh($code);


		$post = array(
			'id' => $violacionesddhh->id,
			'pais_code' => $violacionesddhh->pais_code,
					'violacionesDdhhTotal' => $violacionesddhh->violacionesDdhhTotal,
					'clasificacionDCP' => $violacionesddhh->clasificacionDCP,
					'clasificacionDESCA' => $violacionesddhh->clasificacionDESCA,
					'calsificacionPueblos' => $violacionesddhh->calsificacionPueblos,
					'lugar' => $violacionesddhh->lugar,
					'breveDescripcion' => $violacionesddhh->breveDescripcion,
					'numCasosCorteInterDDHH' => $violacionesddhh->numCasosCorteInterDDHH,
					'numCasosComDHNU' => $violacionesddhh->numCasosComDHNU,
					'casosNoAccionar' => $violacionesddhh->casosNoAccionar,
					'created_at' => $violacionesddhh->created_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}


	//


	//CRUD blog

	public function adminViolacionesddhhs()
	{
		
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		$posts = array();
		if($isValidToken) {
			$violacionesddhhs = $this->api_model_violacionesddhh->get_admin_violacionesddhhs();
			foreach($violacionesddhhs as $violacionesddhh) {
				$posts[] = array(
					'id' => $violacionesddhh->id,
					'pais_code' => $violacionesddhh->pais_code,
					'violacionesDdhhTotal' => $violacionesddhh->violacionesDdhhTotal,
					'clasificacionDCP' => $violacionesddhh->clasificacionDCP,
					'clasificacionDESCA' => $violacionesddhh->clasificacionDESCA,
					'calsificacionPueblos' => $violacionesddhh->calsificacionPueblos,
					'lugar' => $violacionesddhh->lugar,
					'breveDescripcion' => $violacionesddhh->breveDescripcion,
					'numCasosCorteInterDDHH' => $violacionesddhh->numCasosCorteInterDDHH,
					'numCasosComDHNU' => $violacionesddhh->numCasosComDHNU,
					'casosNoAccionar' => $violacionesddhh->casosNoAccionar,
					'created_at' => $violacionesddhh->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminViolacionesddhh($id)
	{
		
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$violacionesddhh = $this->api_model_violacionesddhh->get_admin_violacionesddhh($id);

			$post = array(
				'id' => $violacionesddhh->id,
				'pais_code' => $violacionesddhh->pais_code,
				
					'violacionesDdhhTotal' => $violacionesddhh->violacionesDdhhTotal,
					'clasificacionDCP' => $violacionesddhh->clasificacionDCP,
					'clasificacionDESCA' => $violacionesddhh->clasificacionDESCA,
					'calsificacionPueblos' => $violacionesddhh->calsificacionPueblos,
					'lugar' => $violacionesddhh->lugar,
					'breveDescripcion' => $violacionesddhh->breveDescripcion,
					'numCasosCorteInterDDHH' => $violacionesddhh->numCasosCorteInterDDHH,
					'numCasosComDHNU' => $violacionesddhh->numCasosComDHNU,
					'casosNoAccionar' => $violacionesddhh->casosNoAccionar,
					'created_at' => $violacionesddhh->created_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createViolacionesddhh()
	{
		
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {
			$pais_code = $this->input->post('pais_code');
            $violacionesDdhhTotal = $this->input->post('violacionesDdhhTotal');
			$clasificacionDCP = $this->input->post('clasificacionDCP');
			$clasificacionDESCA = $this->input->post('clasificacionDESCA');
			$calsificacionPueblos = $this->input->post('calsificacionPueblos');
			$lugar = $this->input->post('lugar');
			$breveDescripcion = $this->input->post('breveDescripcion');
			$numCasosCorteInterDDHH = $this->input->post('numCasosCorteInterDDHH');
			$numCasosComDHNU = $this->input->post('numCasosComDHNU');
			$casosNoAccionar = $this->input->post('casosNoAccionar');

			$filename = NULL;

			$isUploadError = FALSE;

			if( ! $isUploadError) {
	        	$violacionesddhhData = array(
					'user_id' => 1,
					'pais_code' => $pais_code,
					'violacionesDdhhTotal' => $violacionesDdhhTotal,
					'clasificacionDCP' => $clasificacionDCP,
					'clasificacionDESCA' => $clasificacionDESCA,
					'calsificacionPueblos' => $calsificacionPueblos,
					'lugar' => $lugar,
					'breveDescripcion' => $breveDescripcion,
					'numCasosCorteInterDDHH' => $numCasosCorteInterDDHH,
					'numCasosComDHNU' => $numCasosComDHNU,
					'casosNoAccionar' => $casosNoAccionar,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_violacionesddhh->insertViolacionesddhh($violacionesddhhData);

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

	public function updateViolacionesddhh($id)
	{
		
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$violacionesddhh = $this->api_model_violacionesddhh->get_admin_violacionesddhh($id);

			$pais_code = $this->input->post('pais_code');
			$violacionesDdhhTotal = $this->input->post('violacionesDdhhTotal');
			$clasificacionDCP = $this->input->post('clasificacionDCP');
			$clasificacionDESCA = $this->input->post('clasificacionDESCA');
			$calsificacionPueblos = $this->input->post('calsificacionPueblos');
			$lugar = $this->input->post('lugar');
			$breveDescripcion = $this->input->post('breveDescripcion');
			$numCasosCorteInterDDHH = $this->input->post('numCasosCorteInterDDHH');
			$numCasosComDHNU = $this->input->post('numCasosComDHNU');
			$casosNoAccionar = $this->input->post('casosNoAccionar');

			$isUploadError = FALSE;


			if( ! $isUploadError) {
	        	$violacionesddhhData = array(
					'user_id' => 1,
					'pais_code' => $pais_code,
					'violacionesDdhhTotal' => $violacionesDdhhTotal,
					'clasificacionDCP' => $clasificacionDCP,
					'clasificacionDESCA' => $clasificacionDESCA,
					'calsificacionPueblos' => $calsificacionPueblos,
					'lugar' => $lugar,
					'breveDescripcion' => $breveDescripcion,
					'numCasosCorteInterDDHH' => $numCasosCorteInterDDHH,
					'numCasosComDHNU' => $numCasosComDHNU,
					'casosNoAccionar' => $casosNoAccionar,
					'updated_at' => date('Y-m-d H:i:s', time())
				);

				$this->api_model_violacionesddhh->updateViolacionesddhh($id, $violacionesddhhData);

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

	public function deleteViolacionesddhh($id)
	{
		
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$violacionesddhh = $this->api_model_violacionesddhh->get_admin_violacionesddhh($id);


			$this->api_model_violacionesddhh->deleteViolacionesddhh($id);

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
