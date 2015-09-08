<?php
/**
 * Description of com_followers
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2015-sep-06 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 * 
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * 
 * This file is part of followers.
 * 
 * com_followers is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * com_followers is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with com_followers.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 
if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}

JHTML::addIncludePath(JPATH_COMPONENT.DS.'helpers');
JLoader::register('FollowersImporter', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_followers'.DS.'helpers'.DS.'importer.php');
FollowersImporter::importHelpers();
FollowersImporter::importLibrary();

JHTML::addIncludePath(JPATH_COMPONENT.DS.'helpers');
require_once JPATH_COMPONENT.DS.'controller.php';
$controllerName = JRequest::getWord('view');

if ( $controllerName) { 
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php';
    if ( file_exists($path)) {
        require_once $path;
    } else {       
        $controllerName = '';	   
    }
}
$classname    = 'FollowersController'.$controllerName;
$controller   = new $classname();

// Perform the Request task
$controller->execute(JRequest::getCmd('task', 'display'));
 
// Redirect if set by the controller
$controller->redirect();