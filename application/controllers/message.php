
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->get();
	}
	
	/**
	 * Gets messages from the last hour (default) or since any time you specify.
	 */
	public function get() {
		$this->load->model("message_model");
		
		$results = $this->message_model->get(
			$this->input->get_post("token"),
			$this->input->get_post("since")
		);
		Render::json($results);
	}

	/**
	 * Sends a message.
	 */
	public function send() {
		$this->load->model("message_model");
		
		$result = $this->message_model->send(
			$this->input->get_post("token"),
			$this->input->get_post("message"),
			$this->input->get_post("username")
		);

		Render::json($result);
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

		Render::json($error);
	}
}

