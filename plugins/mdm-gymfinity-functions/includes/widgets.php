<?php

namespace Mdm\Gymfinity;

class Widgets extends \Mdm\Gymfinity {

	public function register() {
	register_widget( '\\Mdm\\Gymfinity\\Widgets\\ContentBlocks' );
	}
}