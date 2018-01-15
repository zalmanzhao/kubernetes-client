<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Collections\CronJobCollection;

class CronJobRepository extends Repository
{
	protected $uri = 'cronjobs';

	protected function createCollection($response)
	{
		return new CronJobCollection($response);
	}
}
