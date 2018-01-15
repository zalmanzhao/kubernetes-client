<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Collections\ReplicationControllerCollection;

class ReplicationControllerRepository extends Repository
{
	protected $uri = 'replicationcontrollers';

	protected function createCollection($response)
	{
		return new ReplicationControllerCollection($response);
	}
}
