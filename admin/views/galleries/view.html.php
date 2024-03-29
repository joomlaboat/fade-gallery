<?php
/**
 * Fade Gallery Javascript Image Gallery Joomla! 2.5 Native Component
 * @author Ivan komlev <support@joomlaboat.com>
 * @link http://www.joomlaboat.com
 * @copyright Copyright (C) 2018-2020. All Rights Reserved
 * @license GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');
class FadeGalleryViewGalleries extends JView
{
    function display($tpl = null)
    {
		$mainframe = JFactory::getApplication();

		JToolBarHelper::title(JText::_('COM_FADEGALLERY_GALLERYLIST'), 'generic.png');
		
		
		JToolBarHelper::addNewX('newItem');
		
		JToolBarHelper::customX( 'copyItem', 'copy.png', 'copy_f2.png', 'Copy', true);
		JToolBarHelper::deleteListX();

		JHTML::_('behavior.tooltip');

		$db = & JFactory::getDBO();

		$context			= 'com_fadegallery.galleries.';

		$filter_order		= $mainframe->getUserStateFromRequest( $context.'filter_order',		'filter_order',		's.id',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',	'filter_order_Dir',	'',			'word' );
		
		$search				= $mainframe->getUserStateFromRequest( $context.'search',			'search',			'',			'string' );
		
		$limit		= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );

		$where = array();

		if ($search)
		{
			$where[] = 'LOWER(s.galleryname) LIKE '.$db->Quote( '%'.$db->getEscaped($search,true).'%', false );

		}

		$where		= count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '';
		
		$orderby	= 'ORDER BY '. $filter_order .' '. $filter_order_Dir ;
		
		$query = 'SELECT COUNT(*)'
		. ' FROM #__fadegallery AS s '
		. $where
		;
		$db->setQuery( $query );

		$total = $db->loadResult();
		
		jimport('joomla.html.pagination');
		$this->pagination = new JPagination( $total, $limitstart, $limit );

		$query = 'SELECT s.* FROM #__fadegallery AS s '
		. $where 
		. $orderby
		;

		
		$db->setQuery($query, $this->pagination->limitstart, $this->pagination->limit );

		$this->items = $db->loadObjectList();

		$javascript		= 'onchange="document.adminForm.submit();"';

		$lists['order_Dir']	= $filter_order_Dir;
		$lists['order']		= $filter_order;

		$this->lists['search']= $search;

		parent::display($tpl);
    }
}
