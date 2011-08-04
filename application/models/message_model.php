<?php

class Message_Model extends CI_Model {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

		$this->load->database();
	}
    
    public function get($token, $since = null)
    {

		$since = $since ? strtotime($since) : strtotime("-1 hour");	
		$since = date("Y-m-d H:i:s", $since);
		
		$results = $this->db->get_where("messages", array("timestamp >"=>$since))->result();
		return $results;	
    }

	public function send($token, $message, $username = null)
	{
		$apps = $this->db->get_where("apps", array("token"=>$token))->result();
		$app_id = $apps[0]->id;
		$result = $this->db->insert("messages", array("app" => $app_id, "message"=>$message, "username"=>$username));
		return $result;
	}

}
