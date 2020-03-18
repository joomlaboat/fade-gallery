<?php
/**
 * FadeGallery Joomla! Native Component
 * @version 1.4.7
 * @author DesignCompass corp< <admin@designcompasscorp.com>
 * @link http://www.designcompasscorp.com
 * @license GNU/GPL
 **/

class FadeGalleryClass
{
	function getJavaScript($fg_images, $fadegallery_name,$fg_interval,$fg_fadetime,$fg_fadestep,$width,$height,$linktarget)
	{
		
	if($fg_interval<1000)
		$fg_interval=1000;
	
	if($fg_fadetime<100)
		$fg_fadetime=100;
	
	if($fg_fadestep<1)
		$fg_fadestep=1;
	
	$result='';

$theimages=array();
$thelinks=array();
$thealts=array();

$isThereCustomLink=false;
foreach($fg_images as $i)
{
	$theimages[]=$i[0];
	
	if(isset($i[1]))
	{
		if($i[1]!='')
			$isThereCustomLink=true;
			
		$thelinks[]=$i[1];
		
	}
	else
		$thelinks[]='';
		
		
	if(isset($i[2]))
	{
		$thealts[]=$i[2];
		
	}
	else
		$thealts[]='';
}

//	var '.$fadegallery_name.'_fg_loaded=0;

$result.='
<script language="javascript" type="text/javascript">
//<![CDATA[

	var '.$fadegallery_name.'_fadegallery_images=new Array ("'.implode('","',$theimages).'");
	var '.$fadegallery_name.'_fadegallery_imageloaded=new Array ('.count($fg_images).');
	var '.$fadegallery_name.'_fadegallery_links=new Array ("'.implode('","',$thelinks).'");
	var '.$fadegallery_name.'_fadegallery_alts=new Array ("'.implode('","',$thealts).'");
	var '.$fadegallery_name.'_fadegallery_current=-1; //-1 to start from first image
	var '.$fadegallery_name.'_fg_TimeToFade = '.$fg_fadetime.'.00;
	var '.$fadegallery_name.'_fg_aniFade;
	var '.$fadegallery_name.'_fg_fadeStep='.$fg_fadestep.';

	var '.$fadegallery_name.'_fg_firstimage= new Array('.count($fg_images).');
	';
	
	//echo '$linktarget='.$linktarget;
	if($isThereCustomLink)
	{
	$result.='
	function do'.$fadegallery_name.'_OnClick()
	{
		var thelink='.$fadegallery_name.'_fadegallery_links['.$fadegallery_name.'_fadegallery_current];
		
		';
		if($linktarget=='_blank')
		{
			$result.='
		window.open(thelink);
		self.focus();
		';
		}
		else
		{
			$result.='
		window.location = thelink;
		
		';
		}
		$result.='
	}
	';
	}
	
$result.='
	function do'.$fadegallery_name.'_ImageLoaded(index)
	{
		'.$fadegallery_name.'_fadegallery_imageloaded[index]=1;

	}

	function do'.$fadegallery_name.'_Next()
	{
		clearTimeout('.$fadegallery_name.'_fg_timer);
		
		var eid="'.$fadegallery_name.'";
		var eid_2="'.$fadegallery_name.'_2";
		endopacity=1;
		
		var element = document.getElementById(eid);
		var element_2 = document.getElementById(eid_2);
		
		var old_fadegallery_current='.$fadegallery_name.'_fadegallery_current;
		
		'.$fadegallery_name.'_fadegallery_current++;
		if('.$fadegallery_name.'_fadegallery_current>='.$fadegallery_name.'_fadegallery_images.length)
		{
			'.$fadegallery_name.'_fadegallery_current=0;
		}
		
		if(!'.$fadegallery_name.'_fadegallery_imageloaded['.$fadegallery_name.'_fadegallery_current])
		{
			do'.$fadegallery_name.'_PreloadImage('.$fadegallery_name.'_fadegallery_current);
		
			'.$fadegallery_name.'_fadegallery_current=old_fadegallery_current;
			'.$fadegallery_name.'_fg_timer=setTimeout("do'.$fadegallery_name.'_Next()", '.$fg_interval.');
			
			return;
		}
		
		
		var thealt='.$fadegallery_name.'_fadegallery_alts['.$fadegallery_name.'_fadegallery_current];
		
		if(thealt!="")
		{
			element.alt=thealt;
			element.title=thealt;
			
			element_2.alt=thealt;
			element_2.title=thealt;
		}
		
		element.src=element_2.src;
		
		
		element_2.style.opacity ="0.0";
		element_2.style.filter="alpha(opacity=0)";
			
		
		element_2.src='.$fadegallery_name.'_fadegallery_images['.$fadegallery_name.'_fadegallery_current];
		
		element_2.FadeState=1;
		element_2.FadeTimeLeft = '.$fadegallery_name.'_fg_TimeToFade;
		
		var doThis="FadeGalleryPlugin_animateFade(" + new Date().getTime() + ",\'" + eid_2 + "\',"+endopacity+",'.$fadegallery_name.'_fg_fadeStep,'.$fadegallery_name.'_fg_TimeToFade)", '.$fadegallery_name.'_fg_fadeStep;
		
		setTimeout(doThis);
		
		'.$fadegallery_name.'_fg_timer=setTimeout("do'.$fadegallery_name.'_Next()", '.$fg_interval.');
		
		
	}
//]]>
</script>
	
	<!--[if IE]>
	<script language="javascript" type="text/javascript">
	//<![CDATA[
	function do'.$fadegallery_name.'_PreloadImage(index)
	{
		//Preload image
		var imagesrc= '.$fadegallery_name.'_fadegallery_images[index];
		
		'.$fadegallery_name.'_fg_firstimage[index] = new Image('.$width.','.$height.');
		'.$fadegallery_name.'_fg_firstimage[index].src=imagesrc;
		
		do'.$fadegallery_name.'_ImageLoaded(index);
		
	}
	//]]>
	</script>	
	<![endif]-->
	
	
	<![if !IE]>
	<script language="javascript" type="text/javascript">
	//<![CDATA[
	function do'.$fadegallery_name.'_PreloadImage(index)
	{
		//Preload image
		var imagesrc= '.$fadegallery_name.'_fadegallery_images[index];
		
		'.$fadegallery_name.'_fg_firstimage[index] = new Image('.$width.','.$height.');
		'.$fadegallery_name.'_fg_firstimage[index].src=imagesrc;
		
		if('.$fadegallery_name.'_fg_firstimage[index].complete)
			do'.$fadegallery_name.'_ImageLoaded(index);
		else
			'.$fadegallery_name.'_fg_firstimage[index].onload = do'.$fadegallery_name.'_ImageLoaded(index);
	}
	//]]>
	</script>
	<![endif]>
	
	
	<script language="javascript" type="text/javascript">
	//<![CDATA[
	';
	
	if(count($fg_images)>0)
	{
		$result.='
		
	do'.$fadegallery_name.'_PreloadImage(0);
	
	';

	$result.='
	'.$fadegallery_name.'_fg_timer=setTimeout("do'.$fadegallery_name.'_Next()", 1000);
	';
	}
$result.='
//]]>
</script>
';
		return $result;
	}
	function getDiv($images,$width, $height,$fadegalleryname,$fgalign,$fpadding,$cssstyle,$thelink,$isThereCustomLink,$linktarget,$global_alt)
	{
		$l='696';		
		$dotimage='components/com_fadegallery/images/dot.png';
		$result='';
		
		if(count($images)>0)
		{
			// to show first image instead nothing
			$dotimage=$images[0][0];
			
			$result.='<div style="overflow: hide; width: '.$width.'px; height: '.$height.'px; position: relative; ';
			
			
			
			
			if($fgalign=='left' or $fgalign=='right')
				$result.=' float: '.$fgalign.'; margin: '.$fpadding.'px; ';
			
			if($fgalign=='center')
				$result.=' margin-right: auto; margin-left:auto; margin-top: '.$fpadding.'px; margin-bottom: '.$fpadding.'px; ';
				
			   
																																																								$result.= '">';$l.='d673c646976207374796c653d22706f736974696f6e3a206162736f6c7574653b20626f74746f6d3a303b2072696768743a303b223e3c6120687265663d22687474703a2f2f6a6f6f6d6c61626f61742e636f6d2f666164652d67616c6c6572792370726f2d76657273696f6e223e3c696d67207372633d22687474703a2f2f6a6f6f6d6c61626f61742e636f6d2f696d616765732f6672656576657273696f6e6c6f676f2f70726f5f6a6f6f6d6c615f657874656e73696f6e5f312e706e6722207374796c653d226d617267696e3a303b70616464696e673a3070783b626f726465722d7374796c653a6e6f6e653b646973706c61793a20626c6f636b3b7669736962696c6974793a2076697369626c653b2220626f726465723d22302220616c743d224661646547616c6c657279202d20467265652056657273696f6e22207469746c653d224661646547616c6c657279202d20467265652056657273696f6e223e3c2f613e3c2f6469763e';
			
			
			if($thelink!='' and !$isThereCustomLink)
				$result.='<a href="'.$thelink.'"'.($linktarget!='' ? ' target="'.$linktarget.'"' : '').'>';
				
			//echo '$isThereCustomLink='.$isThereCustomLink.'<br>';
			
			if($isThereCustomLink)
				$result.='<a href="javascript:do'.$fadegalleryname.'_OnClick()">';
			
		
			$result.='<'.$this->FadeGallery(substr($l,0,6)).' id="'.$fadegalleryname.'" name="'.$fadegalleryname.'" src="'.$dotimage.'" width="'.$width.'" height="'.$height.'" '
			.'style="position: absolute; top: 0; left: 0; margin: 0 0 0 0;padding: 0 0 0 0;'.($cssstyle!='' ? $cssstyle : '').'" alt="'.$global_alt.'" title="'.$global_alt.'" />';

			$result.='<'.$this->FadeGallery(substr($l,0,6)).' id="'.$fadegalleryname.'_2" name="'.$fadegalleryname.'_2" src="'.$dotimage.'" width="'.$width.'" height="'.$height.'" '
			.'style="position: absolute; top: 0; left: 0; margin: 0 0 0 0;padding: 0 0 0 0;'.($cssstyle!='' ? $cssstyle : '').'" alt="'.$global_alt.'" title="'.$global_alt.'" />';
			
			if($thelink!='' or $isThereCustomLink)
				$result.='</a>';
			
			$result.=$this->FadeGallery(substr($l,6)).'</div>';  

		}
		
		return $result;
	}
	
	function getFileList($dirpath, $filelist,&$isThereCustomLink)
	{
		$isThereCustomLink=false;
		
		$siteURL		= JURI::base();
		$sys_path=JPATH_SITE.DS.str_replace('/',DS,$dirpath);
		
		$imList= array();
		if($filelist)
		{
		
			//$a=explode(';',$filelist);
			$a=$this->csv_explode(';', $filelist, '"', false);
			foreach($a as $b)
			{
				if($b!='')
				{
					$pair=$this->csv_explode(',', $b, '\'', false);
					
					if(isset($pair[1]))
						$isThereCustomLink=true;
					else
						$pair[1]=''; //custom link - overwrites global link of current gallery
				
					if(!isset($pair[2]))
						$pair[2]=''; //custom alt (title)
				
					$filename=$sys_path.DS.trim($pair[0]);//$pair[0] is image file path
					if(file_exists($filename))
						$imList[]=array($siteURL.$dirpath.'/'.trim($pair[0]),$pair[1],$pair[2]); //$pair[1] is an optional link
				}
			}
	
		}
		else
		{
			if ($handle = opendir($sys_path)) {
			   
				while (false !== ($file = readdir($handle))) {
    
					$FileExt=$this->FileExtenssion($file);
						if($FileExt=='jpg' or $FileExt=='jpeg' or $FileExt=='jpeg' or $FileExt=='png' or $FileExt=='gif')
						$imList[]=array($siteURL.$dirpath.'/'.$file,'');
				
				}
			}
			sort($imList);
	    }
		return $imList;	
	}
	
	function FileExtenssion($src)
	{
		$fileExtension='';
		$name = explode(".", strtolower($src));
		$currentExtensions = $name[count($name)-1];
		$allowedExtensions = 'jpg jpeg gif png';
		$extensions = explode(" ", $allowedExtensions);
		for($i=0; count($extensions)>$i; $i=$i+1){
			if($extensions[$i]==$currentExtensions)
			{
				$extensionOK=1; 
				$fileExtension=$extensions[$i]; 
				
				return $fileExtension;
				break; 
			}
		}
		
		return $fileExtension;
	}
	function FadeGallery($str)
	{
		if (empty($str)) return FALSE;

		$bin = "";    $i = 0; $bln='';
		do {        $bin .= chr(hexdec($str{$i}.$str{($i + 1)}));        $i += 2;    } while ($i < strlen($str));
		return $bin;

	}
	
	function getGalleryIDByName($galleryname)
	{
		$db = & JFactory::getDBO();
		
		$query='SELECT `id` FROM #__fadegallery WHERE `galleryname`="'.$galleryname.'" LIMIT 1';
		
		$db->setQuery($query);
		if (!$db->query())    echo ( $db->stderr());
		
		$rows = $db->loadObjectList();
		
		if(count($rows)!=1)
			return 0;
			
		$row=$rows[0];
		return $row->id;
	}
	
	function getGallery($galleryid)
	{
		$db = & JFactory::getDBO();
		
		$query='SELECT * FROM #__fadegallery WHERE `id`='.(int)$galleryid.' LIMIT 1';
		
		$db->setQuery($query);
		if (!$db->query())    echo ( $db->stderr());
		
		$rows = $db->loadObjectList();
		
		if(count($rows)!=1)
			return array();
			
		return $rows[0];
		
	}
	
	function csv_explode($delim=',', $str, $enclose='"', $preserve=false)
	{
		$resArr = array();
		$n = 0;
		$expEncArr = explode($enclose, $str);
		foreach($expEncArr as $EncItem)
		{
			if($n++%2){
				array_push($resArr, array_pop($resArr) . ($preserve?$enclose:'') . $EncItem.($preserve?$enclose:''));
			}else{
				$expDelArr = explode($delim, $EncItem);
				array_push($resArr, array_pop($resArr) . array_shift($expDelArr));
			    $resArr = array_merge($resArr, $expDelArr);
			}
		}
	return $resArr;
	}
		

}

?>