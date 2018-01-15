<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Collections\JobCollection;

class JobRepository extends Repository
{
	protected $uri = 'jobs';

	protected function createCollection($response)
	{
		return new JobCollection($response);
	}
}
