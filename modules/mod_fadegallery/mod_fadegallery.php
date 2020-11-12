<?php
/**
 * Fade Javascript Image Gallery Joomla! 2.5 Native Component
 * @author Ivan komlev <support@joomlaboat.com>
 * @link http://www.joomlaboat.com
 * @copyright Copyright (C) 2018-2020. All Rights Reserved
 * @license GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('_JEXEC') or die('Restricted access');

require_once(JPATH_SITE.DS.'components'.DS.'com_fadegallery'.DS.'includes'.DS.'fadegalleryclass.php');


$fg=new FadeGalleryClass;

$galleryid=(int)$params->get( 'galleryid' );


$isThereCustomLink=false;

if($galleryid!=0)
{
	$galleryrow=$fg->getGallery($galleryid);
	
	$fg_images=$fg->getFileList($galleryrow->folder, $galleryrow->filelist,$isThereCustomLink);
		
	if(count($fg_images)>0)
	{
		if($galleryrow->randomize)
			shuffle($fg_images);
	
		$fg_interval=(int)$galleryrow->interval;
		$fg_fadetime=(int)$galleryrow->fadetime;
		$fg_fadestep=(int)$galleryrow->fadestep;
		
		$width=(int)$galleryrow->width;
		$height=(int)$galleryrow->height;
		
		$linktarget=$galleryrow->linktarget;
		
		if($width<1)			$width=400;

		if($height<1)			$height=200;

		if($fg_interval==0)		$fg_interval=6000;
		if($fg_interval<1000)	$fg_interval=1000;
	
		if($fg_fadetime==0)		$fg_fadetime=2000;
		if($fg_fadetime<100)	$fg_fadetime=100;
		
		if($fg_fadestep==0)		$fg_fadestep=20;
		if($fg_fadestep<1)		$fg_fadestep=1;
		
		
		$fgpadding=(int)$galleryrow->padding;
		
	
	
		$objectname='modfadegalleryid_'.$module->id;
		$global_alt=$galleryrow->galleryname;
	
		echo $fg->getDiv($fg_images, $width, $height, $objectname, $galleryrow->align, $fgpadding, $galleryrow->cssstyle, $galleryrow->thelink, $isThereCustomLink, $linktarget, $global_alt);
		
		echo $fg->getJavaScript($fg_images, $objectname, $fg_interval, $fg_fadetime, $fg_fadestep, $galleryrow->width, $galleryrow->height, $linktarget);
		
		require_once(JPATH_SITE.DS.'components'.DS.'com_fadegallery'.DS.'includes'.DS.'fadegalleryani.php');

		
	}//if(count($fg_images)>0)
}
else
{
	$fg_images=$fg->getFileList($params->get( 'folder' ), $params->get( 'filelist' ),$isThereCustomLink);

	if($params->get( 'randomize' ))
		shuffle($fg_images);
		
	if($params->get( 'linktarget' ))
		$linktarget=$params->get( 'linktarget' );
	else
		$linktarget='_top';

	$fgalign='';
	$fpadding='';

	$objectname='fdmodule'.$module->id;
	$global_alt=$module->title;

	echo $fg->getDiv($fg_images,$params->get( 'width' ), $params->get( 'height' ),$objectname,$fgalign,$fpadding,$params->get( 'cssstyle' ),$params->get( 'thelink' ),$isThereCustomLink,$linktarget,$global_alt);

	if(count($fg_images)>0)
	{
		require_once(JPATH_SITE.DS.'components'.DS.'com_fadegallery'.DS.'includes'.DS.'fadegalleryani.php');
	
		$fg_interval=(int)$params->get( 'interval' );
		$fg_fadetime=(int)$params->get( 'fadetime' );
		$fg_fadestep=(int)$params->get( 'fadestep' );
	
		echo $fg->getJavaScript($fg_images, $objectname,$fg_interval,$fg_fadetime,$fg_fadestep,$params->get( 'width' ),$params->get( 'height' ),$linktarget);
	
	}
}
