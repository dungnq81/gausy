<?php

namespace Addons\Optimizer;

use Addons\Base\Singleton;

use Addons\Optimizer\Attached_Media_Cleaner\Attached_Media_Cleaner;
use Addons\Optimizer\Heartbeat\Heartbeat;
use Addons\Optimizer\SVG\SVG;

\defined( 'ABSPATH' ) || die;

/**
 * Optimizer Class
 *
 * @author Gaudev
 */
final class Optimizer {

	use Singleton;

	// ------------------------------------------------------

	private function init(): void {

		( Attached_Media_Cleaner::get_instance() );
		( Heartbeat::get_instance() );
		( SVG::get_instance() );
	}
}
