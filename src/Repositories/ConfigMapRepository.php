<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Collections\ConfigMapCollection;

class ConfigMapRepository extends Repository
{
	protected $uri = 'configmaps';

	protected function createCollection($response)
	{
		return new ConfigMapCollection($response);
	}
}
