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

$jinput = JFactory::getApplication()->input;
$controllerName = $jinput->getCmd( 'controller', 'galleries' );


switch($controllerName)
{
	
	case 'docs';

		JSubMenuHelper::addEntry(JText::_('COM_FADEGALLERY_GALLERIES'), 'index.php?option=com_fadegallery&controller=galleries', false);
		JSubMenuHelper::addEntry(JText::_('COM_FADEGALLERY_DOCS'), 'index.php?option=com_fadegallery&controller=docs', true);
		break;
	default:
	
		JSubMenuHelper::addEntry(JText::_('COM_FADEGALLERY_GALLERIES'), 'index.php?option=com_fadegallery&controller=galleries', true);
		JSubMenuHelper::addEntry(JText::_('COM_FADEGALLERY_DOCS'), 'index.php?option=com_fadegallery&controller=docs', false);
		break;
}
require_once( JPATH_COMPONENT.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php' );


$controllerName = 'FadeGalleryController'.$controllerName;
$controller	= new $controllerName( );


// Perform the Request task
$controller->execute( JRequest::getCmd('task'));
$controller->redirect();
?>