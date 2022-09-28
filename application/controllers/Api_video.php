<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Video extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('api_model_video');
		$this->load->helper('url');
		$this->load->helper('text');

		header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        header("Access-Control-Request-Methods: GET, PUT, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Access-Control-Allow-Request-Method");
	
	}

	public function videos()
	{
		

		$videos = $this->api_model_video->get_video($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($videos)){
			foreach($videos as $video){


				$posts[] = array(
					'id' => $video->id,
					'title' => $video->title,
					'video_review' => $video->video_review,
                    'is_featured' => $video->is_featured,
                    'is_active' => $video->is_active,
					'updated_at' => $video->updated_at,
                    'created_at' => $video->created_at,
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function featured_videos()
	{

		$videos = $this->api_model_video->get_videos($featured=true, $recentpost=false);

		$posts = array();
		if(!empty($videos)){
			foreach($videos as $video){
				

				$posts[] = array(
					'id' => $video->id,
					'title' => $video->title,
					'video_review' => $video->video_review,
                    'is_featured' => $video->is_featured,
                    'is_active' => $video->is_active,
					'updated_at' => $video->updated_at,
                    'created_at' => $video->created_at,
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function video($id)
	{
		
		
		$video = $this->api_model_video->get_video($id);

		$post = array(
			'id' => $video->id,
					'title' => $video->title,
					'video_review' => $video->video_review,
                    'is_featured' => $video->is_featured,
                    'is_active' => $video->is_active,
					'updated_at' => $video->updated_at,
                    'created_at' => $video->created_at,
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}

	public function recent_videos()
	{
		
		$videos = $this->api_model_video->get_videos($featured=false, $recentpost=1);

		$posts = array();
		if(!empty($videos)){
			foreach($videos as $video){

				$posts[] = array(
					'id' => $video->id,
					'title' => $video->title,
					'video_review' => $video->video_review,
                    'is_featured' => $video->is_featured,
                    'is_active' => $video->is_active,
					'updated_at' => $video->updated_at,
                    'created_at' => $video->created_at,
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	//


	//CRUD 

	public function adminVideos()
	{
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		$posts = array();
		if($isValidToken) {
			$videos = $this->api_model_video->get_admin_videos();
			foreach($videos as $video) {
				$posts[] = array(
					'id' => $video->id,
					'title' => $video->title,
					'video_review' => $video->video_review,
                    'is_featured' => $video->is_featured,
                    'is_active' => $video->is_active,
					'updated_at' => $video->updated_at,
                    'created_at' => $video->created_at,
					
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminVideo($id)
	{
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$video = $this->api_model_video->get_admin_video($id);

			$post = array(
				'id' => $video->id,
					'title' => $video->title,
					'video_review' => $video->video_review,
                    'is_featured' => $video->is_featured,
                    'is_active' => $video->is_active,
					'updated_at' => $video->updated_at,
                    'created_at' => $video->created_at,
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createVideo()
	{
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$title = $this->input->post('title');
			$video_review = $this->input->post('video_review');
			$is_active = $this->input->post('is_active');
			$is_featured = $this->input->post('is_featured');

			$filename = NULL;

			$isUploadError = FALSE;

			if( ! $isUploadError) {
	        	$videoData = array(
					'title' => $title,
					'user_id' => 1,
					'video_review' => $video_review,
					'is_active' => $is_active,
					'is_featured' => $is_featured,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_video->insertVideo($videoData);

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

	public function updateVideo($id)
	{
		
		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {

			$video = $this->api_model_video->get_admin_video($id);
			$filename = $video->image;

			$title = $this->input->post('title');
			$video_review = $this->input->post('video_review');
			$is_active = $this->input->post('is_active');
			$is_featured = $this->input->post('is_featured');

			$isUploadError = FALSE;


			if( ! $isUploadError) {
	        	$videoData = array(
					'title' => $title,
					'user_id' => 1,
					'video_review' => $video_review,
					'is_active' => $is_active,
					'is_featured' => $is_featured,
					'updated_at' => date('Y-m-d H:i:s', time())
				);

				$this->api_model_video->updateVideo($id, $videoData);

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

	public function deleteVideo($id)
	{
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: authorization, Content-Type");


		$token = $this->input->get_request_header('Authorization');

		$isValidToken = $this->api_model->checkToken($token);

		if($isValidToken) {
			$video = $this->api_model_video->get_admin_video($id);

			$this->api_model_video->deleteVideo($id);

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
