<?php
/**
 * Created by PhpStorm.
 * User: h_shirai
 * Date: 15/09/23
 * Time: 16:42
 */

App::uses('AppController', 'Controller');


class TagController extends AppController {

	public $components = array(
		'Common',
	);
	public $uses = array(
	);


	/*
	 * View
	 */
	public function index()
	{

//		$this->layout = '';
		$this->autoRender = false;



	}



}