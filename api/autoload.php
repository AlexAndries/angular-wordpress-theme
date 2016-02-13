<?php

/**
 * Build it to load Angular API
 * Created by PhpStorm.
 * User: Alexandru
 * Date: 2/13/2016
 * Time: 12:44 PM
 * @todo create documentation for api naming files
 */
class AngularAPIs {
	private $files = array();
	private $functions = array();

	public function __construct(){
	}

	public function addAPI($name){
		$this->files[] = 'api.' . $name . '.php';
		return $this;
	}

	public function registerAPIs(){
		if(!empty($this->files)){
			foreach($this->files as $file){
				require_once('main/' . $file);
			}
		}
		return $this;
	}
	public function addFunctions($name){
		$this->functions[] = $name . '.php';
		return $this;
	}
	public function registerFunctions(){
		if(!empty($this->functions)){
			foreach($this->functions as $file){
				require_once('functions/' . $file);
			}
		}
		return $this;
	}
}