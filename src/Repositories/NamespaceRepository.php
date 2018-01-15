<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Collections\NamespaceCollection;

class NamespaceRepository extends Repository
{
	protected $uri = 'namespaces';
    protected $namespace = false;

	protected function createCollection($response)
	{
		return new NamespaceCollection($response);
	}
}
