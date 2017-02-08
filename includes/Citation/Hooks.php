<?php

namespace Citation;

/**
 * Hook handlers for the Citation extension
 *
 * @ingroup Extensions
 */

class Hooks {

	/**
	 * Register the magic word.
	 */
	public static function onMagicWordwgVariableIDs( &$aCustomVariableIds ) {
		$aCustomVariableIds[] = 'quote';
		return true;
	}

	/**
	 * Setup for the extension
	 */
	public static function onExtensionSetup() {
		global $wgDebugComments;

		// turn on comments while in development
		$wgDebugComments = true;
	}

	/**
	 * @param string[] $files
	 */
	public static function onUnitTestsList( array &$files ) {
		$files[] = __DIR__ . '/../tests/phpunit/';
	}

	/**
	 * @param string[] $files
	 */
	public static function onParserFirstCallInit( &$parser ) {
		$parser->setFunctionHook( 'quote', '\Citation\Quote::handler' ); // , SFH_NO_HASH );
		return true;
	}
}
