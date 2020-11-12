<?php
/**
 * Fade Javascript Image Gallery Joomla! 2.5 Native Component
 * @author Ivan komlev <support@joomlaboat.com>
 * @link http://www.joomlaboat.com
 * @copyright Copyright (C) 2018-2020. All Rights Reserved
 * @license GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.controller');


class FadeGalleryControllerGalleries extends JController
{
	/**
	 * New option item wizard
	 */
	function display()
	{
		JRequest::setVar( 'view', 'galleries');
		
		parent::display();
	}


	function newItem()
	{
		JRequest::setVar( 'view', 'galleryedit');
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);
		parent::display();
	}

	function edit()
	{
		
		JRequest::setVar( 'view', 'galleryedit');
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);
		parent::display();
	}

	/**
	 * Saves a option item
	 */
	
	function save()
	{
		// get our model
		$model = &$this->getModel('galleryedit');
		// attempt to store, update user accordingly
		
		//if($this->_task == 'save')
		//{
			$link 	= 'index.php?option=com_fadegallery&controller=galleries';
		//}
		
		
		if ($model->store())
		{
			$msg = JText::_( 'COM_FADEGALLERY_GALLERY_SAVED_SUCCESSFULLY' );
			$this->setRedirect($link, $msg);
		}
		else
		{
			$msg = JText::_( 'COM_FADEGALLERY_GALLERY_WAS_UNABLE_TO_SAVE');
			$this->setRedirect($link, $msg, 'error');
		}
			
	}

	/**
	* Cancels an edit operation
	*/
	function cancelItem()
	{

		$model = $this->getModel('item');
		$model->checkin();

		$this->setRedirect( 'index.php?option=com_fadegallery&controller=galleries');
	}

	/**
	* Cancels an edit operation
	*/
	function cancel()
	{
		$this->setRedirect( 'index.php?option=com_fadegallery&controller=galleries');
	}

	/**
	* Form for copying item(s) to a specific option
	*/
	

	



	function remove()
	{
		
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		
		$model =& $this->getModel('galleryedit');
		
		$model->ConfirmRemove();
	}
	
	function remove_confirmed()
	{
		

		// Get some variables from the request
		
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (!count($cid)) {
			$this->setRedirect( 'index.php?option=com_fadegallery&controller=galleries', JText::_('NO GALLERIES SELECTED') );
			return false;
		}

		$model =& $this->getModel('galleryedit');
		if ($n = $model->delete($cid)) {
			$msg = JText::sprintf( 'COM_FADEGALLERY_GALLERY_S_DELETED', $n );
			$this->setRedirect( 'index.php?option=com_fadegallery&controller=galleries', $msg );
		} else {
			$msg = $model->getError();
			$this->setRedirect( 'index.php?option=com_fadegallery&controller=galleries', $msg,'error' );
		}
		
	}

	
	function copyItem()
	{
	    $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
	    
	    
	    
	    $model = $this->getModel('galleryedit');
	    
	    
	    if($model->copyItem($cid))
	    {
			$msg = JText::_( 'COM_FADEGALLERY_GALLERY_S_COPIED_SUCCESSFULLY' );
			$link 	= 'index.php?option=com_fadegallery&controller=galleries';
			$this->setRedirect($link, $msg);
	    }
	    else
	    {
			$msg = JText::_( 'COM_FADEGALLERY_GALLERY_S_WAS_UNABLE_TO_COPY' );
			$link 	= 'index.php?option=com_fadegallery&controller=galleries';
			$this->setRedirect($link, $msg,'error');
	    }
	    
	    
	    
	}


	
}
