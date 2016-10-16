<?php
/**
 * Created by PhpStorm.
 * User: h_shirai
 * Date: 15/09/23
 * Time: 16:42
 */

App::uses('AppController', 'Controller');


class LikeController extends AppController {

	public $components = array(
//		'Common',
	);
	public $uses = array(
		'Like',
	);


	/*
	 * View
	 */
	public function add($show_id)
	{

		$this->autoRender = false;
//		$this->layout = '';
		$options = array(
			'fields' => array(),
			'conditions' => array(
				'show_id'=>$show_id
			)
		);

		$results = $this->Like->find('first', $options);
		$current_count=($results['Like']['count']);
		$current_count++;

		header("Access-Control-Allow-Origin: *");
		if(!empty($results)){
			echo 'きてる';
			$like_data = array('Like' => array(
				'id'=>$results['Like']['id'],
				'count' => $current_count,
			));
			$like_fields = array(
				'count',
			);

			$this->Like->save($like_data , false, $like_fields);

		}


//		echo json_encode(($array));




	}



}