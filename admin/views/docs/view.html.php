<?php
/**
* Fade Javascript Image Gallery Joomla! 2.5 Native Component
* @version 1.4.7
* @author DesignCompass corp <admin@designcompasscorp.com>
* @link http://www.designcompasscorp.com
* @license GNU/GPL **/


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
?>