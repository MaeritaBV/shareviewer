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

namespace OCA\ShareViewer\AppInfo;

//use OC\Files\View;
//use OCA\Activity\Capabilities;
//use OCA\Activity\Consumer;
//use OCA\Activity\Controller\Activities;
//use OCA\Activity\Controller\APIv1;
//use OCA\Activity\Controller\APIv2;
//use OCA\Activity\Controller\Feed;
//use OCA\Activity\Controller\RemoteActivity;
//use OCA\Activity\Controller\Settings;
//use OCA\Activity\FilesHooksStatic;
//use OCA\Activity\Hooks;
use OCP\AppFramework\App;
//use OCP\IL10N;
//use OCP\Util;

class Application extends App {

  public function __construct (array $urlParams=array()) {
    parent::__construct('shareviewer', $urlParams);

    $container = $this->getContainer();

//    \OC_App::registerAdmin('shareviewer', 'admin');

    //$container->registerAlias('SettingsController', Settings::class);
    //$this->registerAdmin('shareviewer', 'admin');
  }
}