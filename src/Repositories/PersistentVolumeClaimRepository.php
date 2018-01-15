<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Collections\PersistentVolumeClaimCollection;

class PersistentVolumeClaimRepository extends Repository
{
	protected $uri = 'persistentvolumeclaims';

	protected function createCollection($response)
	{
		return new PersistentVolumeClaimCollection($response);
	}
}
