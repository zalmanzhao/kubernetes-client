<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Collections\DeploymentCollection;

class DeploymentRepository extends Repository
{
	protected $uri = 'deployments';

	protected function createCollection($response)
	{
		return new DeploymentCollection($response);
	}
}
