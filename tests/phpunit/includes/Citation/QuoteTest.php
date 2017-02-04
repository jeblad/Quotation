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
	public function testBuildArgArrays( $args, $expected) {
		$this->assertEquals( $expected, Quote::buildArgArrays( $args ) );
	}

	public static function provideArgArrays() {
		return array(
			array( # 0
				array(),
				array(
					'quote' => new \Citation\Quote(),
					'format' => 'block', 'signature' => ''
				)
			),
			array( # 1
				array( "foo" ),
				array(
					'quote' => new \Citation\Quote( array( "foo" ) ),
					'format' => 'block', 'signature' => ''
				)
			),
			array( # 2
				array( "block" ),
				array(
					'quote' => new \Citation\Quote(),
					'format' => 'block', 'signature' => ''
				)
			),
			array( # 3
				array( "inline" ),
				array(
					'quote' => new \Citation\Quote(),
					'format' => 'inline', 'signature' => ''
				)
			),
			array( # 4
				array( "href=foo" ),
				array(
					'quote' => new \Citation\Quote(),
					'href' => 'foo', 'format' => 'block', 'signature' => ''
				)
			),
			array( # 5
				array( "src=foo" ),
				array(
					'quote' => new \Citation\Quote(),
					'href' => 'foo', 'src' => 'foo', 'format' => 'block', 'signature' => ''
				)
			),
			array( # 6
				array( "src=foo", "href=bar", "block", "ping", "pong" ),
				array(
					'quote' => new \Citation\Quote( array( "ping", "pong" ) ),
					'href' => 'bar', 'src' => 'foo', 'format' => 'block', 'signature' => ''
				)
			)
		);
	}

	/**
	 * @dataProvider provideValidate
	 */
	public function testValidate( $quote, $text, $opts, $expected ) {
		$quote = new Quote( $quote );
		$this->assertEquals( $expected, $quote->validate( $text, $opts ) );
	}

	public static function provideValidate() {
		return array(
				array( # 0
					array( "" ),
					array( "" ),
					array( 'initial' => 0, 'final' => 0 ),
					null
				),
				array( # 1
					array( "" ),
					array( "foobar" ),
					array( 'initial' => 0, 'final' => 0 ),
					null
				),
				array( # 2
					array( "[something]" ),
					array( "foobar" ),
					array( 'initial' => 0, 'final' => 0 ),
					null
				),
				array( # 3
					array( "test" ),
					array( "" ),
					array( 'initial' => 0, 'final' => 0 ),
					array( false )
				),
				array( # 4
					array( "test" ),
					array( "foobar" ),
					array( 'initial' => 0, 'final' => 0 ),
					array( false )
				),
				array( # 5
					array( "test" ),
					array( "footestbar" ),
					array( 'initial' => 0, 'final' => 0 ),
					array( "test" )
				),
				array( # 6
					array( "this is a [complex] test" ),
					array( "foo this is a test bar" ),
					array( 'initial' => 0, 'final' => 0 ),
					array( "this is a test" )
				),
				array( # 7
					array( "[T]his [are] a [complex] test" ),
					array( "foo this is a test bar" ),
					array( 'initial' => 3, 'final' => 0 ),
					array( "o this is a test" )
				),
				array( # 8
					array( "This [are] a [complex] test!" ),
					array( "foo This is a test? bar" ),
					array( 'initial' => 3, 'final' => 0 ),
					array( "oo This is a test" )
				),
				array( # 9
					array( "one", "two", "three", "four", "five" ),
					array( "foo one two three four five bar" ),
					array( 'initial' => 4, 'final' => 4 ),
					array( "foo one two" )
				),
				array( # 9
					array( "one", "two", "three", "four", "five" ),
					array( "foo one bar", "foo two bar", "foo three bar", "foo four bar", "foo five bar" ),
					array( 'initial' => 0, 'final' => 0 ),
					array( "one", "two", "three", "four", "five" )
				),
				array( # 10
					array( "foo" ),
					array( "foo test", "test foo", "bar" ),
					array( 'initial' => 0, 'final' => 0 ),
					array( "foo", "foo", false )
				),
		);
	}

}
