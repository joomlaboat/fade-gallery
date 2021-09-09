<?php
/**
 * Fade Javascript Image Gallery Joomla! 2.5 Native Component
 * @author Ivan komlev <support@joomlaboat.com>
 * @link http://www.joomlaboat.com
 * @copyright Copyright (C) 2018-2020. All Rights Reserved
 * @license GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('_JEXEC') or die('Restricted access');

// Import Joomla! libraries
jimport( 'joomla.application.component.view');
class FadeGalleryViewGalleryEdit extends JView
{
    function display($tpl = null)
    {
		$mainframe = JFactory::getApplication();
		

		$this->row = $this->get('Data');

		$this->tableid = $row->id;
		
		
		$this->isNew = ($row->id < 1);
		
		$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		
		JToolBarHelper::title(JText::_( 'Fade Gallery').': <small><small>[ '. $text.' ]</small></small>', 'generic.png' );
		
		
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		JHTML::_('behavior.tooltip');


		$this->Model = $this->getModel();
		
        parent::display($tpl);
    }
}
