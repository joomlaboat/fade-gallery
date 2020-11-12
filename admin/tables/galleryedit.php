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

// Include library dependencies
jimport('joomla.filter.input');

class TableGalleryEdit extends JTable
{

	var $id = null;
	var $galleryname = null;
	var $folder = null;
	var $filelist = null;
	var $width = null;
	var $height = null;
	var $interval = null;
	var $fadetime = null;
	var $fadestep = null;
	var $align=null;
	var $padding=null;
	var $cssstyle=null;
	var $thelink=null;
	var $linktarger=null;
	
	function TableGalleryEdit(& $db)
	{
		parent::__construct('#__fadegallery', 'id', $db);
	}

}
