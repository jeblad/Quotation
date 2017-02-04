<?php

namespace Citation\Job;
use Html, Job;

/**
 * Job for validation of Quote objects.
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
class ValidationJob extends Job {

	public function __construct( \Title $title, $params = false, $id = 1 ) {
		wfDebugLog( __CLASS__, __FUNCTION__ . ": create job title " . $title->getFullText() );
		parent::__construct( 'Validation', $title, $params, $id );
		$this->removeDuplicates = true; // job is expensive
	}

	/**
	 * Execute the job
	 *
	 * @return bool
	 */
	public function run() {
		wfDebugLog( __CLASS__, __FUNCTION__ . ': running...' );
		$worker = new \Citation\Validation();
		$worker->execute( $title, $params );
		return true;
	}
}