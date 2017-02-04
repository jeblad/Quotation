<?php

/**
 * Initialization file for the Citation library.
 *
 * Documentation:	 		https://www.mediawiki.org/wiki/Extension:Citation
 * Support					https://www.mediawiki.org/wiki/Extension_talk:Citation
 * Source code:				https://gerrit.wikimedia.org/r/gitweb?p=mediawiki/extensions/Citation.git
 *
 * @file
 * @ingroup Citation
 *
 * @licence GNU GPL v2+
 * @author John Erling Blad < jeblad@gmail.com >
 */

/**
 * This documentation group collects source code files belonging to Citation.
 *
 * @defgroup Citation Citation
 */

call_user_func( function() {
	global $wgHooks;

	// Hooks
	$wgHooks['ParserFirstCallInit'][] = function( &$parser ) {
		$parser->setFunctionHook( 'quote', '\Citation\Quote::handler');//, SFH_NO_HASH );
		return true;
	};
} );

/**
 * Tests part of the Citation extension.
 *
 * @defgroup CitationTests CitationTest
 * @ingroup Citation
 * @ingroup Test
 */

define( 'Citation_VERSION', '0.1 alpha' );

// @codeCoverageIgnoreStart
call_user_func( function() {
	require_once __DIR__ . '/Citation.mw.php';
} );
// @codeCoverageIgnoreEnd
