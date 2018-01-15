<?php

use Zalmanzhao\Kubernetes\Collections\EndpointCollection;

class EndpointCollectionTest extends TestCase
{
	protected $items = [
		[],
		[],
		[],
	];

	protected function getEndpointCollection()
	{
		$nodeCollection = new EndpointCollection([
			'items' => $this->items,
		]);

		return $nodeCollection;
	}

	public function test_get_items()
	{
		$nodeCollection = $this->getEndpointCollection();
		$items = $nodeCollection->toArray();

		$this->assertTrue(is_array($items));
		$this->assertEquals(3, count($items));
	}
}
