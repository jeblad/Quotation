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
		// print_r($filtered);
		$this->assertEquals(
			$expected,
			$filtered,
			'Filtering the html did not produce the expected result'
		);
	}

	public static function provideHtml() {
		return [
				// test empty content
				[
					"",
					[],
					[ "" ]
				],
				// remove tags and content
				[
					"<head></head>",
					[],
					[ "" ]
				],
				[
					"<HEAD some='thing'>\nfoo\n</head>",
					[],
					[ "" ]
				],
				// remove tags, keep content
				[
					"<body></body>",
					[],
					[ "" ]
				],
				[
					"<BODY some='thing'>\nfoo\n</body>",
					[],
					[ " foo " ]
				],
				// remove within angular brackets
				[
					"<!--\nfoo\n-->",
					[],
					[ "" ]
				],
				[
					"<ping>",
					[],
					[ "" ]
				],
				[
					"</pOng\n>",
					[],
					[ "" ]
				],
				// merge spaces
				[
					"  \n\t\n\n  ",
					[],
					[ " " ]
				],
				// full test
				[
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
					[],
					[ " bar " ]
				],
				// full test with xpath
				[
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
					[ 'xpath' => '/html/body/p' ],
					[ 'foo', 'bar' ]
				],
		];
	}

}
