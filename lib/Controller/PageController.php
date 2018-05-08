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
use OCA\Activity\CurrentUser;
use OCP\AppFramework\Http\TemplateResponse;

class PageController extends Controller {

  /** @var \OCP\IConfig */
  protected $config;

  /** @var string */
  protected $user;

  /**
   * Constructor of the controller
   *
   * @param string $appName
   * @param IRequest $request
   * @param IConfig $config
   * @param CurrentUser $currentUser
   */
	public function __construct($appName,
	                            IRequest $request,
                              IConfig $config,
	                            CurrentUser $currentUser) {
		parent::__construct($appName, $request);
    $this->config = $config;
    $this->user   = (string) $currentUser->getUID();
	}

	/**
	 * CAUTION: the @Stuff turns off security checks; for this page no admin is
	 *          required and no CSRF check. If you don't know what CSRF is, read
	 *          it up in the docs or you might create a security hole. This is
	 *          basically the only required method to add this exemption, don't
	 *          add it to any other method if you don't exactly know what it does
	 *
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function index($viewtype = 'all') {
	  $viewtype = (in_array($viewtype, array('all', 'files', 'folders'))?$viewtype:'none');

    $shareListSQL = "SELECT `*PREFIX*filecache`.path," .
                      "`*PREFIX*share`.*," .
                      "IFNULL(owner_user.displayname, owner_user.uid) AS displayname_owner," .
                      "IFNULL(initiator_user.displayname, initiator_user.uid) AS displayname_initiator," .
                      "IFNULL(share_with_user.displayname, `*PREFIX*share`.share_with) AS displayname_share_with " .
                    "FROM `*PREFIX*share` " .
                    "INNER JOIN `*PREFIX*filecache` ON (`*PREFIX*filecache`.fileid = `*PREFIX*share`.file_source) " .
                    "INNER JOIN `*PREFIX*users` owner_user ON (owner_user.uid = `*PREFIX*share`.uid_owner) " .
                    "INNER JOIN `*PREFIX*users` initiator_user ON (initiator_user.uid = `*PREFIX*share`.uid_initiator) " .
                    "LEFT JOIN `*PREFIX*users` share_with_user ON (share_with_user.uid = `*PREFIX*share`.share_with) " .
                    "WHERE " . ($viewtype === 'files'?"`*PREFIX*share`.item_type = 'file'":($viewtype === 'folders'?"`*PREFIX*share`.item_type = 'folder'":($viewtype === 'all'?"TRUE":"FALSE"))) . " " .
                      "AND (`*PREFIX*share`.expiration IS NULL OR `*PREFIX*share`.expiration >= NOW()) ";

    if (!\OC_User::isAdminUser($this->user)) {
      $shareListSQL .= "AND (";

      if ($this->config->getAppValue('shareviewer', 'visibility') === 'all') {
        $shareListSQL .= "TRUE";
      } elseif ($this->config->getAppValue('shareviewer', 'visibility') === 'owned' ||
                $this->config->getAppValue('shareviewer', 'visibility') === 'ownedandshared') {
        /**
         * Show shares of owned objects and own shares
         */
        $shareListSQL .= "`*PREFIX*share`.uid_owner = :userid " .
                         "OR `*PREFIX*share`.uid_initiator = :userid ";
 
        if ($this->config->getAppValue('shareviewer', 'visibility') == 'ownedandshared') {
          /**
           * Show shares of objects that have been shared with the user
           * directly by name or via group membership
           */
          $shareListSQL .= "OR EXISTS (SELECT 1 " .
                                      "FROM `*PREFIX*share` sh1 " .
                                      "INNER JOIN `*PREFIX*filecache` fc1 ON (fc1.fileid = sh1.file_source) " .
                                      "WHERE `*PREFIX*filecache`.path LIKE CONCAT(fc1.path, '%') " .
                                        "AND sh1.uid_owner = `*PREFIX*share`.uid_owner " .
                                        "AND (sh1.share_with = :userid " .
                                             "OR sh1.share_with IN (SELECT gu1.gid " .
                                                                   "FROM `*PREFIX*group_user` gu1 " .
                                                                   "WHERE gu1.uid = :userid))) ";
        } // if ($this->config->getAppValue('shareviewer', 'visibility') == 'ownedandshared')

      } elseif ($this->config->getAppValue('shareviewer', 'visibility', 'none') === 'none') {
        $shareListSQL .= "FALSE";
      } else {
        $shareListSQL .= "FALSE";
      } // if ($this->config->getAppValue('shareviewer', 'visibility') === 'all')

      $shareListSQL .= ") ";
    } // if (!\OC_User::isAdminUser($this->userId))

    $shareListSQL .= "ORDER BY `*PREFIX*filecache`.path ASC;";

    /**
     * Prepare and execute statement
     */
    $shareListStatement = \OC::$server->getDatabaseConnection()->prepare($shareListSQL);
    $shareListStatement->execute(array(':userid' => $this->user));

    $shareListResultSet = array();
    while ($shareListRow = $shareListStatement->fetch()) {
      $shareListResultSet[] = array('id'                     => $shareListRow['id'],
                                    'path'                   => (substr($shareListRow['path'], 0, 6) == 'files/'?substr($shareListRow['path'], 6):$shareListRow['path']),
                                    'item_type'              => $shareListRow['item_type'],
                                    'token'                  => $shareListRow['token'],
                                    'displayname_owner'      => $shareListRow['displayname_owner'],
                                    'displayname_initiator'  => $shareListRow['displayname_initiator'],
                                    'displayname_share_with' => $shareListRow['displayname_share_with'],
                                    'expiration'             => (!is_null($shareListRow['expiration'])?date('d-m-Y', strtotime($shareListRow['expiration'])):''));
    } // while ($shareListRow = $shareListStatement->fetch()) {

    $params = ['viewtype'  => $viewtype,
               'resultset' => serialize($shareListResultSet)];

    return new TemplateResponse('shareviewer', 'index', $params);  // templates/index.php
	}
}