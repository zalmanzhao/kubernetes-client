<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Collections\EndpointCollection;

class EndpointRepository extends Repository
{
	protected $uri = 'endpoints';

	protected function createCollection($response)
	{
		return new EndpointCollection($response);
	}
}
