<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Render {
    public static function json($object) {
		$ci =& get_instance();

		echo $ci->input->get_post("callback") . "(" . json_encode($object) . ")";	
	}
}

/* End of file Someclass.php */
