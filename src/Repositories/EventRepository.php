<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Collections\EventCollection;

class EventRepository extends Repository
{
	protected $uri = 'events';

	protected function createCollection($response)
	{
		return new EventCollection($response);
	}
}
