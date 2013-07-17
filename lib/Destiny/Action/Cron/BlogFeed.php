<?php
namespace Destiny\Action\Cron;

use Destiny\Common\Application;
use Destiny\Common\Config;
use Destiny\Common\Service\CommonApiService;
use Psr\Log\LoggerInterface;

class BlogFeed {

	public function execute(LoggerInterface $log) {
		$response = CommonApiService::instance ()->getBlogPosts ()->getResponse ();
		$app = Application::instance ();
		$app->getCacheDriver ()->save ( 'recentblog', $response );
	}

}