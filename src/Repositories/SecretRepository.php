<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Collections\SecretCollection;

class SecretRepository extends Repository
{
	protected $uri = 'secrets';

	protected function createCollection($response)
	{
		return new SecretCollection($response);
	}
}
