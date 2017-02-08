<?php

namespace Citation\Job;

use Html;
use Job;

/**
 * Validation of Quote objects.
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
class Validation {

	/**
	 * Execute the job
	 *
	 * @return bool
	 */
	public function execute( \Title $title, $params = [], $id = 1 ) {
		global $wgMemc;
		wfDebugLog( __CLASS__, __FUNCTION__ . ": handling request " . $title->getText() );

		$parser = new \Citation\Parser\HtmlParser();
		if ( array_key_exists( 'src', $params ) ) {
			$srcPage = \Http::get( $params['src'] );
			// TODO: should do some verification
			$fragments = $parser->filter( $srcPage );
			wfDebugLog( __CLASS__, __FUNCTION__ . ": reporting " . print_r( $fragments, true ) );
		}

		$valid = [];
		if ( array_key_exists( 'quote', $params ) ) {
			if ( array_key_exists( 'quote', $params ) ) {
				$valid = $params['quote']->validate( $fragments );
			}
		}

		if ( array_key_exists( 'signature', $params ) ) {
			// $key = wfMemcKey( $this->params );
			$wgMemc->set(
				$params['signature'],
				$valid,
				10 // 60 * 15
			);
		}

		$title->purgeSquid();
	}

	/**
	 * Save validation results in the page_props table
	 *
	 * @return
	 */
	public function save() {

	}
}
