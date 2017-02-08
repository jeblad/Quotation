<?php

namespace Citation\Test;

use Citation\Quote;

/**
 * Test Citation\Quote.
 *
 * @file
 * @since 0.1
 *
 * @ingroup QuoteTest
 * @ingroup Test
 *
 * @group Citation
 * @group CitationQuote
 *
 * @licence GNU GPL v2+
 * @author John Erling Blad < jeblad@gmail.com >
 *
 */
class QuoteTest extends \MediaWikiTestCase {

	/**
	 * @dataProvider provideArgArrays
	 */
	public function testBuildArgArrays( $args, $expected ) {
		$this->assertEquals( $expected, Quote::buildArgArrays( $args ) );
	}

	public static function provideArgArrays() {
		return [
			[ # 0
				[],
				[
					'quote' => new \Citation\Quote(),
					'format' => 'block', 'signature' => ''
				]
			],
			[ # 1
				[ "foo" ],
				[
					'quote' => new \Citation\Quote( [ "foo" ] ),
					'format' => 'block', 'signature' => ''
				]
			],
			[ # 2
				[ "block" ],
				[
					'quote' => new \Citation\Quote(),
					'format' => 'block', 'signature' => ''
				]
			],
			[ # 3
				[ "inline" ],
				[
					'quote' => new \Citation\Quote(),
					'format' => 'inline', 'signature' => ''
				]
			],
			[ # 4
				[ "href=foo" ],
				[
					'quote' => new \Citation\Quote(),
					'href' => 'foo', 'format' => 'block', 'signature' => ''
				]
			],
			[ # 5
				[ "src=foo" ],
				[
					'quote' => new \Citation\Quote(),
					'href' => 'foo', 'src' => 'foo', 'format' => 'block', 'signature' => ''
				]
			],
			[ # 6
				[ "src=foo", "href=bar", "block", "ping", "pong" ],
				[
					'quote' => new \Citation\Quote( [ "ping", "pong" ] ),
					'href' => 'bar', 'src' => 'foo', 'format' => 'block', 'signature' => ''
				]
			]
		];
	}

	/**
	 * @dataProvider provideValidate
	 */
	public function testValidate( $quote, $text, $opts, $expected ) {
		$quote = new Quote( $quote );
		$this->assertEquals( $expected, $quote->validate( $text, $opts ) );
	}

	public static function provideValidate() {
		return [
				[ # 0
					[ "" ],
					[ "" ],
					[ 'initial' => 0, 'final' => 0 ],
					null
				],
				[ # 1
					[ "" ],
					[ "foobar" ],
					[ 'initial' => 0, 'final' => 0 ],
					null
				],
				[ # 2
					[ "[something]" ],
					[ "foobar" ],
					[ 'initial' => 0, 'final' => 0 ],
					null
				],
				[ # 3
					[ "test" ],
					[ "" ],
					[ 'initial' => 0, 'final' => 0 ],
					[ false ]
				],
				[ # 4
					[ "test" ],
					[ "foobar" ],
					[ 'initial' => 0, 'final' => 0 ],
					[ false ]
				],
				[ # 5
					[ "test" ],
					[ "footestbar" ],
					[ 'initial' => 0, 'final' => 0 ],
					[ "test" ]
				],
				[ # 6
					[ "this is a [complex] test" ],
					[ "foo this is a test bar" ],
					[ 'initial' => 0, 'final' => 0 ],
					[ "this is a test" ]
				],
				[ # 7
					[ "[T]his [are] a [complex] test" ],
					[ "foo this is a test bar" ],
					[ 'initial' => 3, 'final' => 0 ],
					[ "o this is a test" ]
				],
				[ # 8
					[ "This [are] a [complex] test!" ],
					[ "foo This is a test? bar" ],
					[ 'initial' => 3, 'final' => 0 ],
					[ "oo This is a test" ]
				],
				[ # 9
					[ "one", "two", "three", "four", "five" ],
					[ "foo one two three four five bar" ],
					[ 'initial' => 4, 'final' => 4 ],
					[ "foo one two" ]
				],
				[ # 9
					[ "one", "two", "three", "four", "five" ],
					[ "foo one bar", "foo two bar", "foo three bar", "foo four bar", "foo five bar" ],
					[ 'initial' => 0, 'final' => 0 ],
					[ "one", "two", "three", "four", "five" ]
				],
				[ # 10
					[ "foo" ],
					[ "foo test", "test foo", "bar" ],
					[ 'initial' => 0, 'final' => 0 ],
					[ "foo", "foo", false ]
				],
		];
	}

}
