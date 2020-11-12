<?php
/**
 * FadeGallery Joomla! 2.5 Native Component
 * @author Ivan komlev <support@joomlaboat.com>
 * @link http://www.joomlaboat.com
 * @copyright Copyright (C) 2018-2020. All Rights Reserved
 * @license GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');


class JFormFieldFadeGallery extends JFormFieldList
{
	/**
	 * Element name:	fadegallery
	 *
	 * @access	protected
	 * @var		string
	 *  
	 */
	protected $type = 'fadegallery';
	
	protected function getOptions()//$name, $value, &$node, $control_name)
	{
        $db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,galleryname');
        $query->from('#__fadegallery');
        $db->setQuery((string)$query);
        $messages = $db->loadObjectList();
        $options = array();
        if ($messages)
        {
            foreach($messages as $message) 
            {
                $options[] = JHtml::_('select.option', $message->id, $message->galleryname);
                                
            }
        }
        $options = array_merge(parent::getOptions(), $options);
        return $options;


	}
}
