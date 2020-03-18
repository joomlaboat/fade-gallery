<?php
/**
 * FadeGallery Joomla! 2.5 Native Component
 * @version 1.4.7
 * @author DesignCompass corp< <admin@designcompasscorp.com>
 * @link http://www.designcompasscorp.com
 * @license GNU/GPL
 **/


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');


class JFormFieldFadeGalleryOptional extends JFormFieldList
{
	/**
	 * Element name: fadegalleryoptional
	 *
	 * @access	protected
	 * @var		string
	 *  
	 */
	protected $type = 'fadegalleryoptional';
	
	protected function getOptions()
	{
        $db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,galleryname');
        $query->from('#__fadegallery');
        $db->setQuery((string)$query);
        $messages = $db->loadObjectList();
        $options = array();
		
		$options[] = JHtml::_('select.option', '0', '- Not set');
		
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
