<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Name extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->get();
	}
	
	/**
	 * Gets the current App name with a given token.
	 */
	public function get() {
		$this->load->model("app");
		
		$this->_render($this->app->get($this->input->get_post("token")));
	}

	/**
	 * Sets a new App name for the given token.
	 */
	public function set() {
		$this->load->model("app");
		
		//$this->load->library("FirePHPCore/fb");
		//$fp = FirePHP::getInstance(true);
		//$fp->warn('$token', $token);
		
		$result = $this->app->set(
			$this->input->get_post("token"),
			$this->input->get_post("name")
		);

		$this->_render($result);
	}

	public function _remap($method, $params = array()) {
		if($this->input->get_post("token") != null) {
			return call_user_func_array(array($this, $method), $params);
		} else {
			$this->_missing_token();
		}
	}

	public function _missing_token() {
		$error = new stdClass();
		$error->error = "token_missing";
		$error->reason = "There was no App Token included in your request.";
		
		$this->output->set_status_header(401);

		$this->_render($error);
	}

	private function _render($object) {
		echo json_encode($object);	
	}
}

