<?php

/**
 * MediaWiki setup for the Citation extension.
 * The extension should be included via the main entry point, Ask.php.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @since 0.1
 *
 * @file
 * @ingroup Citation
 *
 * @licence GNU GPL v2+
 * @author John Erling Blad < jeblad@gmail.com >
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

global $wgExtensionCredits, $wgExtensionMessagesFiles, $wgAutoloadClasses, $wgHooks;

$wgExtensionCredits['other'][] = include( __DIR__ . '/Citation.credits.php' );

$wgExtensionMessagesFiles['CitationExtension'] = __DIR__ . '/Citation.i18n.php';
$wgExtensionMessagesFiles['CitationExtensionMagic'] = __DIR__ . '/Citation.i18n.magic.php';


// Autoloading
foreach ( include( __DIR__ . '/Citation.classes.php' ) as $class => $file ) {
	$wgAutoloadClasses[$class] = __DIR__ . '/' . $file;
}

if ( defined( 'MW_PHPUNIT_TEST' ) ) {
	$wgAutoloadClasses['Citation\Tests\QuoteTestCase']
		= __DIR__ . '/tests/phpunit/QuoteTestCase.php';
}

// Register the parser function.
$wgHooks['ParserFirstCallInit'][] = function ( &$parser ) {
	$parser->setFunctionHook( 'quote', '\Citation\Quote::handler', SFH_NO_HASH );
	return true;
};

// Register the magic word.
$wgHooks['MagicWordwgVariableIDs'][] = function ( &$aCustomVariableIds ) {
	$aCustomVariableIds[] = 'quote';
	return true;
};

// Apply the magic word.'
/*
$wgHooks['ParserGetVariableValueSwitch'][] = function ( &$parser, &$cache, &$magicWordId, &$ret ) {
	if( $magicWordId == 'quote' ) {
		ParserFunction::quoteHandler( $parser, '*' );
	}
	return true;
};
*/
// The key is your job identifier (from the Job constructor), the value is your class name
$wgJobClasses['Validation'] = 'Citation\ValidationJob';
//$wgJobClasses['ChangeNotification'] = 'Wikibase\ChangeNotificationJob';

/**
 * Hook to add PHPUnit test cases.
 * @see https://www.mediawiki.org/wiki/Manual:Hooks/UnitTestsList
 *
 * @since 0.1
 *
 * @param array $files
 *
 * @return boolean
 */
$wgHooks['UnitTestsList'][]	= function( array &$files ) {
	// @codeCoverageIgnoreStart
	$testFiles = array(
		'Citation/HtmlParser',
		'Citation/Quote'
	);

	foreach ( $testFiles as $file ) {
		$files[] = __DIR__ . '/tests/phpunit/includes/' . $file . 'Test.php';
	}

	return true;
	// @codeCoverageIgnoreEnd
};
