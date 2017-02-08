<?php

if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'Citation', __DIR__ . '/extension.json' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['Citation'] = __DIR__ . '/i18n';

	$wgExtensionMessagesFiles['CitationMagic'] = __DIR__ . '/Citation.i18n.magic.php';
	wfWarn(
		'Deprecated PHP entry point used for Citation extension. Please use wfLoadExtension ' .
		'instead, see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return true;
} else {
	die( 'This version of the Citation extension requires MediaWiki 1.25+' );
}