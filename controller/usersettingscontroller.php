<?php

/**
* ownCloud - News
*
* @author Alessandro Cosentino
* @author Bernhard Posselt
* @copyright 2012 Alessandro Cosentino cosenal@gmail.com
* @copyright 2012 Bernhard Posselt dev@bernhard-posselt.com
*
* This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
* License as published by the Free Software Foundation; either
* version 3 of the License, or any later version.
*
* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU AFFERO GENERAL PUBLIC LICENSE for more details.
*
* You should have received a copy of the GNU Affero General Public
* License along with this library.  If not, see <http://www.gnu.org/licenses/>.
*
*/

namespace OCA\News\Controller;

use \OCP\IRequest;
use \OCP\AppFramework\Controller;
use \OCP\AppFramework\Http\JSONResponse;

use \OCA\News\Core\API;

class UserSettingsController extends Controller {

	private $api;

	public function __construct(API $api, IRequest $request){
		parent::__construct($api->getAppName(), $request);
		$this->api = $api;
	}


	/**
	 * @NoAdminRequired
	 */
	public function read(){
		$showAll = $this->api->getUserValue('showAll');
		$params = array(
			'showAll' => $showAll === '1'
		);

		return new JSONResponse($params);
	}


	/**
	 * @NoAdminRequired
	 */
	public function show(){
		$this->api->setUserValue('showAll', true);

		return new JSONResponse();
	}


	/**
	 * @NoAdminRequired
	 */
	public function hide(){
		$this->api->setUserValue('showAll', false);

		return new JSONResponse();
	}


	/**
	 * @NoAdminRequired
	 */
	public function getLanguage(){
		$language = $this->api->getTrans()->findLanguage();

		$params = array(
			'language' => $language
		);
		return new JSONResponse($params);
	}


	/**
	 * @NoAdminRequired
	 */
	public function isCompactView(){
		$compact = $this->api->getUserValue('compact');
		$params = array(
			'compact' => $compact === '1'
		);
		return new JSONResponse($params);
	}


	/**
	 * @NoAdminRequired
	 */
	public function setCompactView(){
		$isCompact = $this->params('compact');
		$this->api->setUserValue('compact', $isCompact);

		return new JSONResponse();
	}


}