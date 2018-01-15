<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Collections\ServiceCollection;

class ServiceRepository extends Repository
{
	protected $uri = 'services';

	protected function createCollection($response)
	{
		return new ServiceCollection($response);
	}
}
