<?php namespace Zalmanzhao\Kubernetes\Repositories;

use Zalmanzhao\Kubernetes\Models\Model;
use Zalmanzhao\Kubernetes\Models\DeleteOptions;

abstract class Repository
{
	/**
	 * The client.
	 *
	 * @var \Zalmanzhao\Kubernetes\Client
	 */
	protected $client;

	/**
	 * Include the namespace in the requests.
	 *
	 * @var boolean
	 */
	protected $namespace = true;

	/**
	 * The api version to use for requests.
	 *
	 * @var null
	 */
	protected $apiVersion;

	/**
	 * The label selector.
	 *
	 * @var array
	 */
	protected $labelSelector = [];

	/**
	 * The field selector.
	 *
	 * @var array
	 */
	protected $fieldSelector = [];

	/**
	 * The constructor.
	 *
	 * @param \Zalmanzhao\Kubernetes\Client $client
	 */
	public function __construct($client)
	{
		$this->client = $client;
	}

	/**
	 * Send a request.
	 *
	 * @param  string  $method
	 * @param  string  $uri
	 * @param  array   $query
	 * @param  mixed   $body
	 * @param  boolean $namespace
	 * @return array
	 */
	protected function sendRequest($method, $uri, $query = [], $body = [], $namespace = true)
	{
		$apiVersion = $this->getApiVersion();
		if ($apiVersion == 'v1') {
			$apiVersion = null;
		}

		return $this->client->sendRequest($method, $uri, $query, $body, $namespace, $apiVersion);
	}

	/**
	 * Get the api version from the model.
	 *
	 * @return string
	 */
	protected function getApiVersion()
	{
		if ($this->apiVersion) {
			return $this->apiVersion;
		}

		$className = str_replace('Repository', '', class_basename($this));
		$classPath = 'Zalmanzhao\Kubernetes\Models\\' . $className;

		if (!class_exists($classPath)) {
			return;
		}

		$this->apiVersion = (new $classPath)->getApiVersion();

		return $this->apiVersion;
	}

	/**
	 * Create a new model.
	 *
	 * @param  \Zalmanzhao\Kubernetes\Models\Model $model
	 * @return boolean
	 */
	public function create(Model $model)
	{
		$this->sendRequest('POST', '/' . $this->uri, null, $model->getSchema(), $this->namespace);
		return true;
	}

	/**
	 * Update a model.
	 *
	 * @param  \Zalmanzhao\Kubernetes\Models\Model $model
	 * @return boolean
	 */
	public function update(Model $model)
	{
		$this->sendRequest('PUT', '/' . $this->uri . '/' . $model->getMetadata('name'), null, $model->getSchema(), $this->namespace);
		return true;
	}

	/**
	 * Delete a model.
	 *
	 * @param  \Zalmanzhao\Kubernetes\Models\Model         $model
	 * @param  \Zalmanzhao\Kubernetes\Models\DeleteOptions $options
	 * @return boolean
	 */
	public function delete(Model $model, DeleteOptions $options = null)
	{
		return $this->deleteByName($model->getMetadata('name'), $options);
	}

	/**
	 * Delete a model by name.
	 *
	 * @param  string                                  $name
	 * @param  \Zalmanzhao\Kubernetes\Models\DeleteOptions $options
	 * @return boolean
	 */
	public function deleteByName($name, DeleteOptions $options = null)
	{
		$body = $options ? $options->getSchema() : null;
		$this->sendRequest('DELETE', '/' . $this->uri . '/' . $name, null, $body, $this->namespace);
		return true;
	}

	/**
	 * Set the label selector.
	 *
	 * @param  array $labelSelector
	 * @return \Zalmanzhao\Kubernetes\Repositories\Repository
	 */
	public function setLabelSelector(array $labelSelector)
	{
		$this->labelSelector = $labelSelector;
		return $this;
	}

	/**
	 * Get the label selector query.
	 *
	 * @return string
	 */
	protected function getLabelSelectorQuery()
	{
		$parts = [];
		foreach ($this->labelSelector as $key => $value) {
			$parts[] = $key . '=' . $value;
		}
		return implode(',', $parts);
	}

	/**
	 * Set the field selector.
	 *
	 * @param  array $fieldSelector
	 * @return \Zalmanzhao\Kubernetes\Repositories\Repository
	 */
	public function setFieldSelector(array $fieldSelector)
	{
		$this->fieldSelector = $fieldSelector;
		return $this;
	}

	/**
	 * Get the field selector query.
	 *
	 * @return string
	 */
	protected function getFieldSelectorQuery()
	{
		$parts = [];
		foreach ($this->fieldSelector as $key => $value) {
			$parts[] = $key . '=' . $value;
		}
		return implode(',', $parts);
	}

	/**
	 * Reset the parameters.
	 *
	 * @return void
	 */
	protected function resetParameters()
	{
		$this->labelSelector = [];
		$this->fieldSelector = [];
	}

	/**
	 * Get a collection of items.
	 *
	 * @return \Zalmanzhao\Kubernetes\Collections\Collection
	 */
	public function find()
	{
		$query = array_filter([
			'labelSelector' => $this->getLabelSelectorQuery(),
			'fieldSelector' => $this->getFieldSelectorQuery(),
		]);

		$response = $this->sendRequest('GET', '/' . $this->uri, $query, null, $this->namespace);

		$this->resetParameters();

		return $this->createCollection($response);
	}

	/**
	 * Find the first item.
	 *
	 * @return \Zalmanzhao\Kubernetes\Models\Model|null
	 */
	public function first()
	{
		return $this->find()->first();
	}

	/**
	 * Check if an item exists by name.
	 *
	 * @param  string $name
	 * @return boolean
	 */
	public function exists($name)
	{
		$this->resetParameters();
		return !is_null($this->setFieldSelector(['metadata.name' => $name])->first());
	}

	abstract protected function createCollection($response);
}
