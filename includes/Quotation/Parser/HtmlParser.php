<?php

namespace Quotation\Parser;

/**
 * Parser for stripping off all tagging from a HTML page.
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
 * @ingroup Quotation
 *
 * @licence GNU GPL v2+
 * @author John Erling Blad < jeblad@gmail.com >
 */
class HtmlParser implements IParser {

	/**
	 * @see IParser::filter
	 */
	public function filter( mixed $data, array $opts = [] ) {
		if ( array_key_exists( 'xpath', $opts ) ) {
			$xml = new \SimpleXMLElement( $data );
			$data = array_map(
				function( \SimpleXMLElement $node ) {
					return $node->asXML();
				},
				$xml->xpath( $opts['xpath'] )
			);
		}

		if ( is_string( $data ) ) {
			$data = [ $data ];
		}

		$data = preg_replace( '!<(head|script|style)[^>]*>.*?</\\1>!is', '', $data );
		$data = preg_replace( '/<[^>]*>/s', '', $data );
		$data = preg_replace( '/\s+/s', ' ', $data );

		return $data;
	}
}
