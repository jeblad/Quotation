<?php

/**
 * Class registration file for the Citation extension.
 *
 * @since 0.1
 *
 * @file
 * @ingroup Citation
 *
 * @licence GNU GPL v2+
 * @author John Erling Blad < jeblad@gmail.com >
 */
return call_user_func( function() {

	// PSR-0 compliant :)

	$classes = array(
		'Citation\Job\ValidationJob',
		'Citation\Job\Validation',
		'Citation\ParserFunction',
		'Citation\Parser\IParser',
		'Citation\Parser\HtmlParser',
		'Citation\Decorator',
		'Citation\Quote',
	);

	$paths = array();

	foreach ( $classes as $class ) {
		$path = 'includes/' . str_replace( '\\', '/', $class ) . '.php';

		$paths[$class] = $path;
	}

	return $paths;

} );

