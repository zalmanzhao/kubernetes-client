<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Collections\ReplicaSetCollection;

class ReplicaSetRepository extends Repository
{
	protected $uri = 'replicasets';

	protected function createCollection($response)
	{
		return new ReplicaSetCollection($response);
	}
}
