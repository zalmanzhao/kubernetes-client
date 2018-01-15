<?php namespace Zalmanzhao\Kubernetes\Collections;

use Zalmanzhao\Kubernetes\Models\Pod;

class PodCollection extends Collection
{
	/**
	 * The constructor.
	 *
	 * @param array $data
	 */
	public function __construct(array $data)
	{
		parent::__construct($this->getPods(isset($data['items']) ? $data['items'] : []));
	}

	/**
	 * Get an array of pods.
	 *
	 * @param  array  $items
	 * @return array
	 */
	protected function getPods(array $items)
	{
		foreach ($items as &$item) {
			$item = new Pod($item);
		}

		return $items;
	}
}
