<?php

namespace Mdm\Gymfinity;

class Activator extends \Mdm\Gymfinity {

	public static function activate() {
		global $wp_rewrite;
		// // Create databasie table
		// \Mdm\AdsManager\Database::createTables();
		// // Register Ad Units
		// \Mdm\AdsManager\Posts\AdUnits::register();
		// // Register Ad Groups
		// \Mdm\AdsManager\Taxonomies\AdGroups::register();
		// Flush permalinks
		$wp_rewrite->init();
		$wp_rewrite->flush_rules();
	}
}