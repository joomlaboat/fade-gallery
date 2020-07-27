<?php
/**
* Fade Javascript Image Gallery Joomla! 3.0/2.5 Native Component
* @version 1.5.3
* @author Ivan Komlev <support@joomlaboat.com>
* @link http://www.joomlaboat.com
* @license GNU/GPL **/

defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
//$mainframe->registerEvent('onPrepareContent', 'plgContentFadeGallery');

class plgContentFadeGallery extends JPlugin
{

	public function onContentPrepare($context, &$article, &$params, $limitstart=0)
	{
		$count=0;
		$count+=$this->plgFadeGallery($article->text, $params);
		$count+=$this->plgFadeGalleryID($article->text, $params);
	}
	
	
	
	function plgFadeGallery(&$text_original, &$params)
	{
		$text=$this->strip_html_tags_textarea($text_original);
		
		$options=array();
		$fList=$this->getListToReplace('fadegallery',$options,$text);
	
		for($i=0; $i<count($fList);$i++)
		{
			$replaceWith=$this->getFadeGallery($options[$i],$i);
			$text_original=str_replace($fList[$i],$replaceWith,$text_original);
		}
	
		return count($fList);
	}

	function plgFadeGalleryID(&$text_original, &$params)
	{
		$text=$this->strip_html_tags_textarea($text_original);
	
		$options=array();
		$fList=$this->getListToReplace('fadegalleryid',$options,$text);
	
		for($i=0; $i<count($fList);$i++)
		{
			$replaceWith=$this->getFadeGalleryByID($options[$i],$i);
			$text_original=str_replace($fList[$i],$replaceWith,$text_original);
		}
	
		return count($fList);
	}

	function getFadeGalleryByID($galleryparams,$count)
	{
			
		require_once(JPATH_SITE.DS.'components'.DS.'com_fadegallery'.DS.'includes'.DS.'fadegalleryclass.php');
		$result='';
		
		$fg=new FadeGalleryClass;
		$galleryrow=$fg->getGallery((int)$galleryparams);
	
		if($galleryrow->folder!='')
		{
		
			$isThereCustomLink=false;
			$fg_images=$fg->getFileList($galleryrow->folder, $galleryrow->filelist,$isThereCustomLink);
			if(count($fg_images)==0)
				return $result;
			
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
	
			$objectname='fadegalleryid_'.$count;
			$global_alt=$galleryrow->galleryname;
	
	
			require_once(JPATH_SITE.DS.'components'.DS.'com_fadegallery'.DS.'includes'.DS.'fadegalleryani.php');
	
			$result.=$fg->getDiv($fg_images, $width, $height,$objectname, $galleryrow->align, $fgpadding, $galleryrow->cssstyle, $galleryrow->thelink, $isThereCustomLink, $linktarget, $global_alt);
			$result.=$fg->getJavaScript($fg_images, $objectname,$fg_interval, $fg_fadetime, $fg_fadestep, $galleryrow->width, $galleryrow->height, $linktarget);
		
		}
		else
			return '<p class="error">Gallery ID: "'.$galleryparams.'" not found.</p>';
		return $result;
	
	}

function getFadeGallery($galleryparams,$count)
{
	
	
	require_once(JPATH_SITE.DS.'components'.DS.'com_fadegallery'.DS.'includes'.DS.'fadegalleryclass.php');
	$fg=new FadeGalleryClass;

	$opt=$fg->csv_explode(',', $galleryparams, '"', true);

	if(count($opt)<1)
		return '';

	if(count($opt)==1)
	{
		//Maybe it link to existing gallery
		if(!file_exists($opt[0]))
		{
			$galleryid=$fg->getGalleryIDByName($opt[0]);
			
			return $this->getFadeGalleryByID($galleryid,$count);
			
		}
	}

	// 1 - Folder
	// 2 - Interval
	
	$folder=$opt[0];
	
	$width=400;			if(count($opt)>1)	$width=(int)$opt[1];
	$height=200;		if(count($opt)>2)	$height=(int)$opt[2];
	$fg_interval=6000;	if(count($opt)>3)	$fg_interval=(int)$opt[3];
	$fg_fadetime=2000;	if(count($opt)>4)	$fg_fadetime=(int)$opt[4];
	$fg_fadestep=20;	if(count($opt)>5)	$fg_fadestep=(int)$opt[5];
	$filelist='';		if(count($opt)>6)	$filelist=$opt[6];
	
	$fgalign='';		if(count($opt)>7)	$fgalign=$opt[7];
	$fgpadding=0;		if(count($opt)>8)	$fgpadding=(int)$opt[8];
	$linktarget='';		if(count($opt)>9)	$fgpadding=$opt[9];
	
	$divName='fadegalleryplg_'.$count;

	$isThereCustomLink=false;
	$fg_images=$fg->getFileList($folder, $filelist,$isThereCustomLink);
	
	if(count($fg_images)<1)
		return '';

	$mydoc = JFactory::getDocument();
	$global_alt=$mydoc->getTitle();

	require_once(JPATH_SITE.DS.'components'.DS.'com_fadegallery'.DS.'includes'.DS.'fadegalleryani.php');
	
	$result=$fg->getDiv($fg_images,$width, $height,$divName,$fgalign,$fgpadding,'','',$isThereCustomLink,$linktarget, $global_alt);
	$result.=$fg->getJavaScript($fg_images, $divName,$fg_interval,$fg_fadetime,$fg_fadestep,$width,$height,$linktarget);
	
	return $result;
}



function getListToReplace($par,&$options,&$text)
	{
		$fList=array();
		$l=strlen($par)+2;
	
		$offset=0;
		do{
			if($offset>=strlen($text))
				break;
		
			$ps=strpos($text, '{'.$par.'=', $offset);
			if($ps===false)
				break;
		
		
			if($ps+$l>=strlen($text))
				break;
		
		$pe=strpos($text, '}', $ps+$l);
				
		if($pe===false)
			break;
		
		$notestr=substr($text,$ps,$pe-$ps+1);

			$options[]=substr($text,$ps+$l,$pe-$ps-$l);
			$fList[]=$notestr;
			

		$offset=$ps+$l;
		
			
		}while(!($pe===false));
		
		return $fList;
	}
	
	
	
	function strip_html_tags_textarea( $text )
	{
	    $text = preg_replace(
        array(
          // Remove invisible content
            '@<textarea[^>]*?>.*?</textarea>@siu',
        ),
        array(
            ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',"$0", "$0", "$0", "$0", "$0", "$0","$0", "$0",), $text );
     
		return $text ;
	}
}
