<?php

use Zalmanzhao\Kubernetes\Models\ConfigMap;

class ConfigMapTest extends TestCase
{
	public function test_get_schema()
	{
		$configMap = new ConfigMap;

		$schema = $configMap->getSchema();
		$fixture = $this->getFixture('config-maps/empty.json');

		$this->assertEquals($schema, $fixture);
	}

	public function test_get_metadata()
	{
		$configMap = new ConfigMap([
			'metadata' => [
				'name' => 'test',
			],
		]);

		$metadata = $configMap->getMetadata('name');

		$this->assertEquals($metadata, 'test');
	}
}
