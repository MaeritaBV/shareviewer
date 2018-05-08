<?php
/**
 *
 * @copyright Copyright (c) 2018, Erwin Beukhof (e.beukhof@maerita.nl)
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\ShareViewer\Controller;

use OCP\AppFramework\Controller;
use OCP\IRequest;
use OCP\IConfig;
use OCA\Activity\UserSettings;
use OCP\IL10N;
use OCA\Activity\CurrentUser;
use OCP\AppFramework\Http\DataResponse;

class SettingsController extends Controller {

  /** @var \OCP\IConfig */
  protected $config;

  /** @var \OCA\Activity\UserSettings */
  protected $userSettings;

  /** @var \OCP\IL10N */
  protected $l10n;

  /** @var string */
  protected $user;

  /**
   * constructor of the controller
   *
   * @param string $appName
   * @param IRequest $request
   * @param IConfig $config
   * @param UserSettings $userSettings
   * @param IL10N $l10n
   * @param CurrentUser $currentUser
   */
  public function __construct($appName,
                              IRequest $request,
                              IConfig $config,
                              UserSettings $userSettings,
                              IL10N $l10n,
                              CurrentUser $currentUser) {
    parent::__construct($appName, $request);
    $this->config = $config;
    $this->userSettings = $userSettings;
    $this->l10n = $l10n;
    $this->user = (string) $currentUser->getUID();
  }

  /**
   * @param string $shareviewer_visibility
   * @return DataResponse
   */
  public function admin() {

    $this->config->setAppValue(
      'shareviewer',
      'visibility',
      $this->request->getParam('shareviewer_visibility', false)
    );

    return new DataResponse(array(
      'data'    => array(
        'message'  => (string) $this->l10n->t('Settings have been updated'),
      ),
    ));
  }

}