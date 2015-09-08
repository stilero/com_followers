<?php
/**
 * Importer Class
 * A quick way to import entire folders with classes. All classes must be named accordinggly:
 * the_filename.php => ClassprefixThe_filename
 * For example
 * posttypes.php must have the class name FollowersPosttypes
 *
 * @version  1.0
 * @package Stilero
 * @subpackage com_followers
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-26 Stilero Webdesign (http://www.stilero.com)
 * @license	GNU General Public License version 2 or later.
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 
if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}
define('PATH_FOLLOWERS', dirname(__FILE__).DS);
define('PATH_FOLLOWERS_LIBRARY', PATH_FOLLOWERS.'library'.DS);
define('PATH_FOLLOWERS_HELPERS', PATH_FOLLOWERS.'helpers'.DS);

class FollowersImporter{
    
    const FOLLOWERS_CLASSPREFIX = 'Followers';
    
    /**
     * Imports all classes from the library folder
     */
    public static function importLibrary(){
        JLoader::discover(self::FOLLOWERS_CLASSPREFIX, PATH_FOLLOWERS_LIBRARY);
    }
    
    /**
     * Imports all helper classes
     */
    public static function importHelpers(){
        JLoader::discover(self::FOLLOWERS_CLASSPREFIX, PATH_FOLLOWERS_HELPERS);
    }
}
