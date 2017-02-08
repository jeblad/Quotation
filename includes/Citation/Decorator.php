<?php

namespace Citation;

use Html;

/**
 * Decorator object for formatting strings.
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
class Decorator {

	public function format( array $params, array $valids = [] ) {
		$slices = [];
		$allValidated = array_key_exists( 'quote', $params )
			&& ( count( $params['quote']->getQuotes() ) === count( $valids ) );
		$attributes = [ 'lang' => 'auto' ];

		if ( array_key_exists( 'format', $params ) ) {
			switch ( $params['format'] ) {
				case 'block':
					$tag = 'blockquote';
					break;
				case 'inline':
					$tag = 'q';
					break;
				default:
					$tag = 'div';
			}
		} else {
			$tag = 'div';
		}

		reset( $valids );
		wfDebugLog( __CLASS__,
			__FUNCTION__ . ": quotes\n" . print_r( $params['quote']->getQuotes(), true ) );
		wfDebugLog( __CLASS__,
			__FUNCTION__ . ": valids\n" . print_r( $valids, true ) );
		foreach ( $params['quote']->getQuotes() as $quote ) {
			if ( $allValidated ) {
				list( , $valid ) = each( $valids );
				wfDebugLog( __CLASS__,
					__FUNCTION__ . ": valid\n" . print_r( $valid, true ) . "\n" );
				$attr = array_merge(
					$attributes,
					[
						'class' => $valid === false ? 'quote-invalid' : 'quote-valid',
						'title' => $valid === false ? '' : htmlspecialchars( $valid ),
					]
				);
			}
			$slices[] = \Html::element(
				$tag,
				isset( $attr ) ? $attr : $attributes,
				htmlspecialchars( $quote )
			);
		}

		return implode( '', $slices );
	}

}
