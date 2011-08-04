<?php

class App extends CI_Model {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

		$this->load->database();
	}
    
    public function get($token)
    {
		$results = $this->db->get_where("apps", array("token"=>$token))->result();
		if(count($results)) {
			$result = new stdClass();
			$result->name = $results[0]->name;
			return $result;
		}
    }

	public function set($token, $name)
	{
		$result = $this->db->where("token", $token)->update("apps", array("name" => $name));
		return $result;

	}

}
