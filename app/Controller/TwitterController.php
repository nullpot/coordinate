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
	public $uses = array(
		'Show',
		'Like',
		'Tag',
	);


	public function get_image()
	{

		$this->autoRender = false;

		require APP . "/Vendor/vendor/abraham/twitteroauth.php";

		$consumer_key = Configure::read('api.twitter.consumer_key');
		$consumer_secret = Configure::read('api.twitter.consumer_secret');
		$connection = new TwitterOAuth($consumer_key, $consumer_secret);
		$tweet = $connection->get("search/tweets", array("q" => "#今日のコーデ",
														 'count' => 100));

		foreach ($tweet->statuses as $tw) {
			$id_str = $tw->id_str;


			$options = array(
				'fields' => array(),
				'conditions' => array(
					'twitter_id' => $id_str
				)
			);

			$result = $this->Show->find('first', $options);
			if (empty($result)) {
// 登録画像がなければ

				if (!empty($tw->entities->media[0])) {
					// そのツイートに画像があれば
					$media_url = $tw->entities->media[0]->media_url;

					$data = array('Show' => array(
						'twitter_id' => $id_str,
						'media_url' => $media_url,
						));
					$fields = array(
						'twitter_id',
						'media_url',
					);
					$this->Show->save($data, false, $fields);
					$this->Show->create();

					$latest_id=$this->Show->getLastInsertID();




					$like_data = array('Like' => array(
						'show_id' => $latest_id,
					));
					$like_fields = array(
						'show_id',
					);

					$this->Like->save($like_data , false, $like_fields);
					$this->Like->create();

				}

			}




		}


	}


}