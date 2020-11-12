<?php
/**
 * FadeGallery Joomla! 2.5 Native Component
 * @author Ivan komlev <support@joomlaboat.com>
 * @link http://www.joomlaboat.com
 * @copyright Copyright (C) 2018-2020. All Rights Reserved
 * @license GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view'); //Important to get menu parameters
class FadeGalleryViewGallery extends JView {

	function display($tpl = null)
	{
		
		//$params = &JComponentHelper::getParams( 'com_fadegallery' );
		$app		= JFactory::getApplication();
		$params=$app->getParams();
			
		$this->assignRef('params',$params);
		
				
        parent::display($tpl);
	}
	
}
