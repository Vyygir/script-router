<?php
class PluginTest extends WP_UnitTestCase {
	function test_plugin_activated() {
		$this->assertTrue(is_plugin_active(PLUGIN_PATH));
	}
}