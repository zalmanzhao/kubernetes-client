<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Collections\IngressCollection;

class IngressRepository extends Repository
{
	protected $uri = 'ingresses';

	protected function createCollection($response)
	{
		return new IngressCollection($response);
	}
}
