<?php
/**
 * Description of com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-29 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 * 
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
JLoader::register('FollowersMenuhelper', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_followers'.DS.'helpers'.DS.'menuhelper.php'); 

 
/**
 * HTML View class for the HelloWorld Component
 */
class FollowersViewQueues extends JViewLegacy{
    
    /*
    function display($tpl = null) {
        JToolBarHelper::title(JText::_('Queue'), 'queue');
        JToolBarHelper::deleteList();
        //JToolBarHelper::editListX();
        //JToolBarHelper::addNewX();
        SocialpromoterMenuhelper::addSubmenu('queue');
        $model = $this->getModel('queue');
        $items = $model->getItems();
        $this->assignRef('items', $items);
        parent::display($tpl);
    }
    
    function edit($id) {
        JToolBarHelper::title(JText::_('Com_socialpromoter Queue: [<small>Edit</small>]', 'generic.png'));
        JToolBarHelper::save();
        JToolBarHelper::cancel('cancel', 'Close');
        $model = $this->getModel();
        $item = $model->getItem( $id );
        $this->assignRef('item', $item);
        parent::display();
    }
    */
    function unfollow(){
        //JToolBarHelper::title( JText::_('Com_socialpromoter Queue')
                //. ': [<small>Add</small>]' );
        //JToolBarHelper::save();
        //JToolBarHelper::cancel();
        SocialpromoterMenuhelper::addSubmenu('unfollow');
        JSession::checkToken('get') or die( 'Invalid Token' );
        $model = $this->getModel();
        $app = JFactory::getApplication();
        $path = $app->input->getString('nsid');
        $result = $model->add($path);
        $this->assignRef('result', $result);
        $this->setLayout('raw');
        parent::display();
    }
    function delete($id){
        //JToolBarHelper::title( JText::_('Com_socialpromoter Queue')
                //. ': [<small>Add</small>]' );
        //JToolBarHelper::save();
        //JToolBarHelper::cancel();
        SocialpromoterMenuhelper::addSubmenu('queue');
        JSession::checkToken('get') or die( 'Invalid Token' );
        $model = $this->getModel();
        $result = $model->delete($id);
        $this->assignRef('result', $result);
        $this->setLayout('delete');
        parent::display();
    }
}
