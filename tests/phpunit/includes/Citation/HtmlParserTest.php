<?php

namespace Citation\Test;

use Citation\HtmlParser;

/**
 * Test Quote\Parser.
 *
 * @file
 * @since 0.1
 *
 * @ingroup CitationTest
 * @ingroup Test
 *
 * @group Citation
 * @group CitationParser
 *
 * @licence GNU GPL v2+
 * @author John Erling Blad < jeblad@gmail.com >
 *
 */
class HtmlParserTest extends \MediaWikiTestCase {

	/**
	 * @dataProvider provideHtml
	 */
	public function testFilter( $html, $opts, $expected ) {
		$parser = new \Citation\Parser\HtmlParser();
		$filtered = $parser->filter( $html, $opts );
		//print_r($filtered);
		$this->assertEquals( $expected, $filtered, 'Filtering the html did not produce the expected result' );
	}

	public static function provideHtml() {
		return array(
				array(
					"",
					array(),
					array( "" )
				),
				// remove tags and content
				array(
					"<head></head>",
					array(),
					array( "" )
				),
				array(
					"<HEAD some='thing'>\nfoo\n</head>",
					array(),
					array( "" )
				),
				// remove tags, keep content
				array(
					"<body></body>",
					array(),
					array( "" )
				),
				array(
					"<BODY some='thing'>\nfoo\n</body>",
					array(),
					array( " foo " )
				),
				// remove within angular brackets
				array(
					"<!--\nfoo\n-->",
					array(),
					array( "" )
				),
				array(
					"<ping>",
					array(),
					array( "" )
				),
				array(
					"</pOng\n>",
					array(),
					array( "" )
				),
				// merge spaces
				array(
					"  \n\t\n\n  ",
					array(),
					array( " " )
				),
				// full test
				array(
					"<html>"
					. "<head>"
					. "<style>\nfoo\n</style>"
					. "<title>\nfoo\n</title>"
					. "</head>"
					. "<body>"
					. "<script>\nfoo\n</script>"
					. "<!--\nfoo\n-->"
					. "\t\t\tbar\n\n\n"
					. "</body>"
					. "</html>",
					array(),
					array( " bar " )
				),
				// full test with xpath
				array(
					"<html>"
					. "<head>"
					. "<style>\nfoo\n</style>"
					. "<title>\nfoo\n</title>"
					. "</head>"
					. "<body>"
					. "<script>\nfoo\n</script>"
					. "<p>foo</p>"
					. "<p>bar</p>"
					. "</body>"
					. "</html>",
					array( 'xpath' => '/html/body/p' ),
					array( 'foo', 'bar' )
				),
		);
	}

}
