<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Slider extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('api_model_slider');
		$this->load->helper('url');
		$this->load->helper('text');

		header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        header("Access-Control-Request-Methods: GET, PUT, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Access-Control-Allow-Request-Method");
	
	}

	public function sliders()
	{
		

		$sliders = $this->api_model_slider->get_sliders($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($sliders)){
			foreach($sliders as $slider){


				$posts[] = array(
					'id' => $slider->id,
					'title' => $slider->title,
					'description' => $slider->description,
					'video_review' => $slider->video_review,
					'boton' => $slider->boton,
					'enlace' => $slider->enlace,
                    'target' => $slider->target,
					'is_activeBot' => $slider->is_activeBot,
					'is_activeText' => $slider->is_activeText,
					'is_modal' => $slider->is_modal,
                    'is_active' => $slider->is_active,
					'image' => base_url('media/images/uploads/sliders/'.$slider->image),
					'updated_at' => $slider->updated_at,
                    'created_at' => $slider->created_at,
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function featured_sliders()
	{

		$sliders = $this->api_model_slider->get_sliders($featured=true, $recentpost=false);

		$posts = array();
		if(!empty($sliders)){
			foreach($sliders as $slider){
				

				$posts[] = array(
					'id' => $slider->id,
					'title' => $slider->title,
					'description' => $slider->description,
					'video_review' => $slider->video_review,
					'boton' => $slider->boton,
					'enlace' => $slider->enlace,
                    'target' => $slider->target,
					'is_activeBot' => $slider->is_activeBot,
					'is_activeText' => $slider->is_activeText,
					'is_modal' => $slider->is_modal,
                    'is_active' => $slider->is_active,
					'image' => base_url('media/images/'.$slider->image),
					'updated_at' => $slider->updated_at,
                    'created_at' => $slider->created_at,
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function slider($id)
	{
		
		
		$slider = $this->api_model_slider->get_slider($id);

		$post = array(
			'id' => $slider->id,
					'title' => $slider->title,
					'description' => $slider->description,
					'video_review' => $slider->video_review,
					'boton' => $slider->boton,
					'enlace' => $slider->enlace,
                    'target' => $slider->target,
					'is_activeBot' => $slider->is_activeBot,
					'is_activeText' => $slider->is_activeText,
					'is_modal' => $slider->is_modal,
                    'is_active' => $slider->is_active,
					'image' => base_url('media/images/uploads/sliders/'.$slider->image),
					'updated_at' => $slider->updated_at,
                    'created_at' => $slider->created_at,
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}

	public function recent_sliders()
	{
		
		$sliders = $this->api_model_slider->get_sliders($featured=false, $recentpost=1);

		$posts = array();
		if(!empty($sliders)){
			foreach($sliders as $slider){

				$posts[] = array(
					'id' => $slider->id,
					'title' => $slider->title,
					'description' => $slider->description,
					'video_review' => $slider->video_review,
					'boton' => $slider->boton,
					'enlace' => $slider->enlace,
                    'target' => $slider->target,
					'is_activeBot' => $slider->is_activeBot,
					'is_activeText' => $slider->is_activeText,
					'is_modal' => $slider->is_modal,
                    'is_active' => $slider->is_active,
					'image' => base_url('media/images/uploads/sliders/'.$slider->image),
					'updated_at' => $slider->updated_at,
                    'created_at' => $slider->created_at,
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	//


	//CRUD slider

	public function adminSliders()
	{
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		$posts = array();
		if($isValidToken) {
			$sliders = $this->api_model_slider->get_admin_sliders();
			foreach($sliders as $slider) {
				$posts[] = array(
					'id' => $slider->id,
					'title' => $slider->title,
					'description' => $slider->description,
					'video_review' => $slider->video_review,
					'boton' => $slider->boton,
					'enlace' => $slider->enlace,
                    'target' => $slider->target,
					'is_activeBot' => $slider->is_activeBot,
					'is_activeText' => $slider->is_activeText,
					'is_modal' => $slider->is_modal,
                    'is_active' => $slider->is_active,
					'image' => base_url('media/images/uploads/sliders/'.$slider->image),
					'updated_at' => $slider->updated_at,
                    'created_at' => $slider->created_at,
					
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminSlider($id)
	{
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$slider = $this->api_model_slider->get_admin_slider($id);

			$post = array(
				'id' => $slider->id,
					'title' => $slider->title,
					'description' => $slider->description,
					'video_review' => $slider->video_review,
					'boton' => $slider->boton,
					'enlace' => $slider->enlace,
                    'target' => $slider->target,
					'is_activeBot' => $slider->is_activeBot,
					'is_activeText' => $slider->is_activeText,
					'is_modal' => $slider->is_modal,
                    'is_active' => $slider->is_active,
					'image' => base_url('media/images/uploads/sliders/'.$slider->image),
					'updated_at' => $slider->updated_at,
                    'created_at' => $slider->created_at,
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createSlider()
	{
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$video_review = $this->input->post('video_review');
			$is_activeText = $this->input->post('is_activeText');
			$is_activeBot = $this->input->post('is_activeBot');
			$boton = $this->input->post('boton');
			$enlace = $this->input->post('enlace');
			$target = $this->input->post('target');
			$is_active = $this->input->post('is_active');
			$is_modal = $this->input->post('is_modal');

			$filename = NULL;

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['image']['name']) {

				$config['upload_path']          = './media/images/uploads/sliders/';
	            $config['allowed_types']        = 'gif|jpg|png|jpeg';
	            $config['max_size']             = 500;

	            $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('image')) {

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
	        	$sliderData = array(
					'title' => $title,
					'user_id' => 1,
					'description' => $description,
					'video_review' => $video_review,
					'image' => $filename,
					'is_activeText' => $is_activeText,
					'is_activeBot' => $is_activeBot,
					'boton' => $boton,
					'enlace' => $enlace,
					'target' => $target,
					'is_active' => $is_active,
					'is_modal' => $is_modal,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_slider->insertSlider($sliderData);

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

	public function updateSlider($id)
	{
		
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$slider = $this->api_model_slider->get_admin_slider($id);
			$filename = $slider->image;

			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$video_review = $this->input->post('video_review');
			$is_activeText = $this->input->post('is_activeText');
			$is_activeBot = $this->input->post('is_activeBot');
			$boton = $this->input->post('boton');
			$enlace = $this->input->post('enlace');
			$target = $this->input->post('target');
			$is_active = $this->input->post('is_active');
			$is_modal = $this->input->post('is_modal');

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['image']['name']) {

				$config['upload_path']          = './media/images/uploads/sliders/';
	            $config['allowed_types']        = 'gif|jpg|png|jpeg';
	            $config['max_size']             = 500;

	            $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('image')) {

	            	$isUploadError = TRUE;

					$response = array(
						'status' => 'error',
						'message' => $this->upload->display_errors()
					);
	            }
	            else {
	   
					if($slider->image && file_exists(FCPATH.'media/images/uploads/sliders/'.$slider->image))
					{
						unlink(FCPATH.'media/images/uploads/sliders/'.$slider->image);
					}

	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$sliderData = array(
					'title' => $title,
					'user_id' => 1,
					'description' => $description,
					'video_review' => $video_review,
					'image' => $filename,
					'is_activeText' => $is_activeText,
					'is_activeBot' => $is_activeBot,
					'boton' => $boton,
					'enlace' => $enlace,
					'target' => $target,
					'is_active' => $is_active,
					'is_modal' => $is_modal,
					'updated_at' => date('Y-m-d H:i:s', time())
				);

				$this->api_model_slider->updateSlider($id, $sliderData);

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

	public function deleteSlider($id)
	{
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: authorization, Content-Type");


		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {
			$slider = $this->api_model_slider->get_admin_slider($id);

			if($slider->image && file_exists(FCPATH.'./media/images/uploads/sliders/'.$slider->image))
			{
				unlink(FCPATH.'./media/images/uploads/sliders/'.$slider->image);
			}

			$this->api_model_slider->deleteSlider($id);

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
