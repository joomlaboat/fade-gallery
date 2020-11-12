<?php
/**
 * Fade Javascript Image Gallery Joomla! 2.5 Native Component
 * @author Ivan komlev <support@joomlaboat.com>
 * @link http://www.joomlaboat.com
 * @copyright Copyright (C) 2018-2020. All Rights Reserved
 * @license GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');
class FadeGalleryViewDocs extends JView
{
    function display($tpl = null)
    {
		JToolBarHelper::title(JText::_('Fade Gallery - Documentation'), 'generic.png');
		
		parent::display($tpl);
    }
}
