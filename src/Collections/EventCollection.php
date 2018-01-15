<?php namespace Zalmanzhao\Kubernetes\Collections;

use Zalmanzhao\Kubernetes\Models\Event;

class EventCollection extends Collection
{
	/**
	 * The constructor.
	 *
	 * @param array $data
	 */
	public function __construct(array $data)
	{
		parent::__construct($this->getEvents(isset($data['items']) ? $data['items'] : []));
	}

	/**
	 * Get an array of nodes.
	 *
	 * @param  array  $items
	 * @return array
	 */
	protected function getEvents(array $items)
	{
		foreach ($items as &$item) {
			$item = new Event($item);
		}

		return $items;
	}
}
