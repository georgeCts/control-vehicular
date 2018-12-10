<?php

namespace App\Library;

use App\Library\Encryption;

class Prefix {
	
	private $prefix = "";

	function __construct($prefix = "") {
		$this->setPrefix($prefix);
	}

	public function setPrefix($prefix) {
		
		
		$verification = [' '];
		$validation = true;

	    if(trim($prefix) == "") {
	    	$validation = false;
	    }

	    for($i=0; $i < sizeof($verification) && $validation; $i++) {
	    	$needle = strpos($prefix, $verification[$i]);
	    	if($needle != false) {
	    		$validation = false;
	    		break;
	    	}
	    }

	    if(!$validation) {
	    	$encrypt = new Encryption();
	    	$prefix = $encrypt->uid();
	    }

	    $this->prefix = $prefix;
	}

	public function getPrefix() {
		return $this->prefix;
	}

	public function concat($value) {
	    
	    return $this->prefix . '_' . $value;
	}

}













































/*
namespace App\Library;

//use App\Library\Encryption;

class Prefix {

	
	private $prefix = "";

	function __construct($prefix = "") {

		$this->setPrefix($prefix);
	    
	}

	public setPrefix($prefix) {
		$verification = [' '];
		$validation = true;

	    if(trim($pefix) == "") {
	    	$validation = false;
	    }

	    for($i=0; $i < sizeof($verification) && $validation; $i++) {
	    	$needle = strpos($prefix, $verification[$i]);
	    	if($needle == false) {
	    		$validation = false;
	    		break;
	    	}
	    }

	    if(!$validation) {
	    	$encrypt = new Encryption();
	    	$prefix = $encrypt->uid();
	    }

	    $this->prefix = $prefix;
	}

	public function concat($value) {
	    
	    return $this->prefix . '_' . $value;
	}

}
*/

?>