<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Collections\DaemonSetCollection;

class DaemonSetRepository extends Repository
{
	protected $uri = 'daemonsets';

	protected function createCollection($response)
	{
		return new DaemonSetCollection($response);
	}
}
