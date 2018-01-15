<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Models\Pod;
use Zalmanzhao\Kubernetes\Collections\PodCollection;

class PodRepository extends Repository
{
	protected $uri = 'pods';

	protected function createCollection($response)
	{
		return new PodCollection($response);
	}

	/**
	 * Get the logs for a pod.
	 *
	 * @param  \Zalmanzhao\Kubernetes\Models\Pod $pod
	 * @param  array $options
	 * @return string
	 */
	public function logs(Pod $pod, array $options = [])
	{
		$response = $this->client->sendRequest('GET', '/' . $this->uri . '/' . $pod->getMetadata('name') . '/log', $options);

		return $response;
	}
	
	/**
	 * Execute a command on a pod.
	 *
	 * @param  \Zalmanzhao\Kubernetes\Models\Pod $pod
	 * @param  array $options
	 * @return string
	 */
	public function exec(Pod $pod, array $options = [])
	{
		$response = $this->client->sendRequest('POST', '/' . $this->uri . '/' . $pod->getMetadata('name') . '/exec', $options);

		return $response;
	}
}
