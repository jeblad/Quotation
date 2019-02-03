<?php

namespace Quotation;

/**
 * Hook handlers for the Quotation extension
 *
 * @ingroup Extensions
 */

class Hooks {

	/**
	 * Register the magic word
	 * @todo It is not clear why this is used. For now it is removed from the extension setup.
	 * @param string[] &$aCustomVariableIds
	 */
	public static function onMagicWordwgVariableIDs( array &$aCustomVariableIds ) {
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
	 * Register the quote tag function
	 * @param Parser $parser
	 */
	public static function onParserFirstCallInit( \Parser $parser ) {
		$parser->setHook( 'quote', 'Quotation\\Quote::handler' );
		return true;
	}
}
