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
 * This file is part of view.html.
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
 
// import Joomla view library
jimport('joomla.application.component.view');
JLoader::import('joomla.application.component.model');
JLoader::register('FollowersMenuhelper', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_followers'.DS.'helpers'.DS.'menuhelper.php'); 
JModelLegacy::addIncludePath (JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_media' . DS . 'models');

/**
 * HTML View class for the HelloWorld Component
 */
class FollowersViewFlickr extends JViewLegacy{
    
    public function display($tpl=null) {
        JToolBarHelper::title(JText::_('Flickr'), 'flickr');
        FollowersMenuhelper::addSubmenu('flickr');
        $js = JUri::root().'administrator/components/com_followers/assets/js/queue.js';
        JHTML::script('https://code.jquery.com/jquery.js');
        JHTML::script($js);
        $model = $this->getModel();
        $followings=$model->getFollowing();
        $this->assignRef('items', $followings);
         $this->assignRef('model', $model);
        parent::display($tpl);
    }
    

    
}
