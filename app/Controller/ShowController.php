<?php
/**
 * Created by PhpStorm.
 * User: h_shirai
 * Date: 15/09/23
 * Time: 16:42
 */

App::uses('AppController', 'Controller');


class ShowController extends AppController {

	public $components = array(
//		'Common',
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
		$options = array(
			'fields' => array(),
			'conditions' => array(
			)
		);

		$results = $this->Show->find('all', $options);
		foreach($results as $result){
			$array[]=array(
				'twitter_id'=>$result['Show']['twitter_id'],
				'media_url'=>$result['Show']['media_url'],
				);

		}
		echo json_encode(($array));

	}



}