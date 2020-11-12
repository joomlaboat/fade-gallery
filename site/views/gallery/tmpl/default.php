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

require_once(JPATH_SITE.DS.'components'.DS.'com_fadegallery'.DS.'includes'.DS.'fadegalleryclass.php');
  
$fg=new FadeGalleryClass;

$galleryrow=$fg->getGallery($this->params->get( 'galleryid' ));
if($galleryrow->folder!='')
{

	$isThereCustomLink=false;
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

		if($width<1)			$width=400;

		if($height<1)			$height=300;

		if($fg_interval==0)		$fg_interval=6000;
		if($fg_interval<1000)	$fg_interval=1000;
	
		if($fg_fadetime==0)		$fg_fadetime=2000;
		if($fg_fadetime<100)	$fg_fadetime=100;
	
		if($fg_fadestep==0)		$fg_fadestep=20;
		if($fg_fadestep<1)		$fg_fadestep=1;
	
	
		$objectname='fadegallerycom';
		$global_alt=$galleryrow->galleryname;

		echo $fg->getDiv($fg_images,$width, $height,$objectname,$galleryrow->align,$galleryrow->padding,$galleryrow->cssstyle,$galleryrow->thelink,$isThereCustomLink,$linktarget,$global_alt);

		require_once(JPATH_SITE.DS.'components'.DS.'com_fadegallery'.DS.'includes'.DS.'fadegalleryani.php');
	
		echo $fg->getJavaScript($fg_images, $objectname,$fg_interval,$fg_fadetime,$fg_fadestep,$galleryrow->width,$galleryrow->height,$linktarget);
	
	}
}
