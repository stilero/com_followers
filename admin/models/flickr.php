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
 * This file is part of flickr.
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

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
jimport( 'joomla.plugin.helper' );

 
class FollowersModelFlickr extends JModelItem{
    protected $Flickr;
    protected $api_key;
    protected $api_secret;
    protected $auth_token;
    protected $_table;
    protected $_defaultSortColumn = 'default_column_name';
    static private $_tableName = '#__com_followers_flickrs';
    
    public function __construct($config = array()) {
        //Change the column_name1,2,3 to the column names you want sortable
        
        $config['filter_fields'] = array(
            'column_name_1',
            'column_name_2',
            'column_name_3'
            );
        $dispatcher = JDispatcher::getInstance();
        JPluginHelper::importPlugin("socialpromoter", "stilerospflickr", false);
        $className = 'plgSocialpromoter'.ucfirst('Stilerospflickr');
        $pluginClass = new $className($dispatcher, array());
        $plg = JPluginHelper::getPlugin('socialpromoter', 'stilerospflickr');
        $plg_params = new JRegistry();
        $plg_params->loadString($plg->params);
        $this->api_key = $plg_params->def('api_key');
        $this->api_secret = $plg_params->def('api_secret');
        $this->auth_token = $plg_params->def('auth_token');
        $this->Flickr = new StileroFlickr($this->api_key, $this->api_secret);
        $this->Flickr->setAccessToken($this->auth_token);
        $this->Flickr->init();
        parent::__construct($config);
    }
    /**
     * Get all the users you are currently following
     * @return type
     */
    public function getFollowing(){
        $json = $this->Flickr->Contacts->getList(1, 20); 
        $decoded = json_decode($json);
        return $decoded->contacts->contact;
    }
    
    public function getUserInfo($flickr_userid){
        $json = $this->Flickr->People->getInfoFromId($flickr_userid);
        $decoded = json_decode($json);
        return $decoded;
    }
}