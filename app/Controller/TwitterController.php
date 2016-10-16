<?php
/**
 * Created by PhpStorm.
 * User: h_shirai
 * Date: 15/09/23
 * Time: 16:42
 */

App::uses('AppController', 'Controller');


class TwitterController extends AppController
{

	public $components = array(//		'Common',
	);
	public $uses = array();


	public function get_image()
	{

		$this->autoRender = false;

		require APP . "/Vendor/vendor/abraham/twitteroauth.php";

		$consumer_key = Configure::read('api.twitter.consumer_key');
		$consumer_secret = Configure::read('api.twitter.consumer_secret');
		$connection = new TwitterOAuth($consumer_key, $consumer_secret);
		$tweet = $connection->get("search/tweets", array("q" => "#今日のコーデ",
														 'count' => 10));

		foreach ($tweet->statuses as $tw) {
			$id_str = $tw->id_str;

			if (!empty($tw->entities->media[0])) {
				$media_url = $tw->entities->media[0]->media_url;
				debug($media_url);
			}


		}


	}


}