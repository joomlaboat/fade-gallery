<?php
/**
* Fade Javascript Image Gallery Joomla! 2.5 Native Component
* @version 1.4.7
* @author DesignCompass corp <admin@designcompasscorp.com>
* @link http://www.designcompasscorp.com
* @license GNU/GPL **/


defined('_JEXEC') or die('Restricted access');


?>


<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}

		// do field validation
		if (trim(form.galleryname.value) == "") {
			alert( "<?php echo JText::_( 'You Must Provide a Gallery Name.', true ); ?>" );
		}
		else {
			submitform( pressbutton );
		}
	}
</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div>
	
	<fieldset class="adminform">
		<div style="position: relative;">
		<div style="position: absolute; right:0">
		
		<a href="http://extensions.designcompasscorp.com/index.php/fade-gallery" target="_blank"><img src="../components/com_fadegallery/images/compasslogo.png" border="0" align="right"></a>
		
		</div>
		<legend><?php echo JText::_( 'COM_FADEGALLERY_DETAILS' ); ?></legend>
			<table class="admintable" cellspacing="1" width="100%">

				<?php if($this->row->id!=0):?>
				<tr>
					<td width="150" class="key">
						<label for="id">
							<?php echo JText::_( 'ID' ); ?>
							
						</label><br>
					</td>
					<td>
						<?php echo $this->row->id; ?>
					</td>
				</tr>
				<?php endif; ?>
				<tr>
					<td width="150" class="key">
						<label for="galleryname">
							<?php echo JText::_( 'COM_FADEGALLERY_FIELD_GALLERY_NAME_LABLE' ); ?>
							
						</label><br>
					</td>
					<td>
						<input type="text" name="galleryname" id="galleryname" class="inputbox" size="40" value="<?php echo $this->row->galleryname; ?>" />
					</td>
				</tr>
				
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="folder">
							<?php echo JText::_( 'COM_FADEGALLERY_FIELD_FOLDER_LABLE' ); ?>
							
						</label><br>
					</td>
					<td>
						<input type="text" name="folder" id="folder" class="inputbox" size="40" value="<?php echo $this->row->folder; ?>" />
					</td>
				</tr>
				<tr>
					<td width="150" class="key" align="right"><?php echo JText::_( 'COM_FADEGALLERY_OR' ); ?></td>
						<td></td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="filelist">
							<?php echo JText::_( 'COM_FADEGALLERY_FIELD_FILELIST_LABEL' ); ?>
							
						</label><br><?php echo JText::_( 'COM_FADEGALLERY_OPTIONAL' ); ?>
					</td>
					<td>
						<textarea name="filelist" id="filelist" cols="200" rows="5"><?php echo $this->row->filelist; ?></textarea>
						
						<p><?php echo JText::_( 'COM_FADEGALLERY_FIELD_FILELIST_DESC2' ); ?></p>
						
						
						<p><?php echo JText::_( 'COM_FADEGALLERY_FIELD_FILELIST_DESC' ); ?></p>
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				
								
				<tr>
					<td width="150" class="key">
						<label for="width">
							<?php echo JText::_( 'COM_FADEGALLERY_FIELD_WIDTH_LABLE' ); ?>
							
						</label><br>
					</td>
					<td>
						<input type="text" name="width" id="width" class="inputbox" size="40" value="<?php echo $this->row->width; ?>" />
						px
					</td>
				</tr>
				
				<tr>
					<td width="150" class="key">
						<label for="height">
							<?php echo JText::_( 'COM_FADEGALLERY_FIELD_HEIGHT_LABLE' ); ?>
							
						</label><br>
					</td>
					<td>
						<input type="text" name="height" id="height" class="inputbox" size="40" value="<?php echo $this->row->height; ?>" />
						px
					</td>
				</tr>
				
				<tr>
					<td width="150" class="key">
						<label for="interval">
							<?php echo JText::_( 'COM_FADEGALLERY_FIELD_INTERVAL_LABLE' ); ?>
							
						</label>
						
					</td>
					<td>
						<input type="text" name="interval" id="interval" class="inputbox" size="40" value="<?php echo $this->row->interval; ?>" />
						<p><?php echo JText::_( 'COM_FADEGALLERY_IN_MILSEC' ); ?>
						(<?php echo JText::_( 'COM_FADEGALLERY_DEFAULT' ).' 6000'; ?>)</p>
						
						<p><?php echo JText::_( 'COM_FADEGALLERY_FIELD_INTERVAL_DESC' ); ?></p>
					</td>
				</tr>
				
				<tr>
					<td width="150" class="key">
						<label for="fadetime">
							<?php echo JText::_( 'COM_FADEGALLERY_FIELD_FADE_TIME_LABLE' ); ?>
							
						</label><br>
					</td>
					<td>
						<input type="text" name="fadetime" id="fadetime" class="inputbox" size="40" value="<?php echo $this->row->fadetime; ?>" />
						<?php echo JText::_( 'COM_FADEGALLERY_IN_MILSEC' ); ?>
						(<?php echo JText::_( 'COM_FADEGALLERY_DEFAULT' ).' 2000'; ?>)
					</td>
				</tr>
				
				<tr>
					<td width="150" class="key">
						<label for="fadestep">
							<?php echo JText::_( 'COM_FADEGALLERY_FIELD_FADESTEP_LABLE' ); ?>
							
						</label>
						
					</td>
					<td>
						<input type="text" name="fadestep" id="fadestep" class="inputbox" size="40" value="<?php echo $this->row->fadestep; ?>" />
						<p><?php echo JText::_( 'COM_FADEGALLERY_IN_MILSEC' ); ?>
						(<?php echo JText::_( 'COM_FADEGALLERY_DEFAULT' ).' 20'; ?>)</p>
						
						<p><?php echo JText::_( 'COM_FADEGALLERY_FIELD_FADESTEP_DESC' ); ?></p>
					</td>
				</tr>
		

				
				<tr>
					<td width="150" class="key">
						<label for="align">
							<?php echo JText::_( 'COM_FADEGALLERY_FIELD_ALIGN_LABLE' ); ?>
							
						</label><br>
					</td>
					<td>
						<?php
							$alignlist=array();
							$alignlist[]=array(name=>JText::_( 'COM_FADEGALLERY_LEFT' ), value=>"left");
							$alignlist[]=array(name=>JText::_( 'COM_FADEGALLERY_CENTER' ), value=>"center");
							$alignlist[]=array(name=>JText::_( 'COM_FADEGALLERY_RIGHT' ), value=>"right");
							
							
							echo JHTML::_('select.genericlist', $alignlist, 'align', '' ,'value','name', $this->row->align);
						 ?>
						
					</td>
				</tr>
				
				<tr>
					<td width="150" class="key">
						<label for="padding">
							<?php echo JText::_( 'COM_FADEGALLERY_FIELD_PADDING_LABLE' ); ?>
							
						</label>
					</td>
					<td>
						<input type="text" name="padding" id="padding" class="inputbox" size="40" value="<?php echo $this->row->padding; ?>" />
						px
					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="cssstyle">
							<?php echo JText::_( 'COM_FADEGALLERY_FIELD_CSS_STYLE_LABEL' ); ?>
							
						</label>
					</td>
					<td>
						<textarea cols="60" rows="5" name="cssstyle" id="cssstyle" class="inputbox" ><?php echo $this->row->cssstyle; ?></textarea>
						<br>
						<?php echo JText::_( 'COM_FADEGALLERY_FIELD_CSS_STYLE_DESC' ); ?>
						
					</td>
				</tr>
				
				
				<tr>
					<td width="150" class="key">
						<label for="randomize">
							<?php echo JText::_( 'COM_FADEGALLERY_FIELD_RANDOMIZE_LABLE' ); ?>
							
						</label>
					</td>
					<td>
						<div><input type="radio" name="randomize" class="inputbox" value="1" <?php echo ($this->row->randomize==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'COM_FADEGALLERY_YES' ); ?></div>
						<br>
						<div><input type="radio" name="randomize" class="inputbox" value="0" <?php echo ($this->row->randomize==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'COM_FADEGALLERY_NO' ); ?></div>
				
						<br>
						<?php echo JText::_( 'COM_FADEGALLERY_FIELD_RANDOMIZE_DESC' ); ?>

					</td>
				</tr>
								<tr>
					<td colspan="2"><hr></td>
				</tr>
				
				<tr>
					<td width="150" class="key">
						<label for="thelink">
							<?php echo JText::_( 'COM_FADEGALLERY_FIELD_THELINK_LABLE' ); ?>
							
						</label>
					</td>
					<td>
						<input type="text" name="thelink" id="thelink" class="inputbox" size="40" value="<?php echo $this->row->thelink; ?>" />
				

						<?php echo JText::_( 'COM_FADEGALLERY_FIELD_THELINK_DESC' ); ?>

					</td>
				</tr>
				
				
								
				
				<tr>
					<td width="150" class="key">
						<label for="linktarget">
							<?php echo JText::_( 'COM_FADEGALLERY_FIELD_LINKTARGET_LABLE' ); ?>
							
						</label><br>
					</td>
					<td>
						<?php
							$linktarget=array();
							$linktarget[]=array(name=>JText::_( 'COM_FADEGALLERY_FIELD_LINKTARGET_TOP' ), value=>"_top");
							$linktarget[]=array(name=>JText::_( 'COM_FADEGALLERY_FIELD_LINKTARGET_BLANK' ), value=>"_blank");

							echo JHTML::_('select.genericlist', $linktarget, 'linktarget', '' ,'value','name', $this->row->linktarget);
						 ?>
						
					</td>
				</tr>
				
		
				
			</table>
			
			
		</div>
		
	</fieldset>
	<p style="text-align: left;"><a href="http://extensions.designcompasscorp.com/index.php/fade-gallery/logo-free-fade-gallery" target="_blank">
	<?php echo JText::_( 'COM_FADEGALLERY_TAKE_LOGO_OFF' ); ?>
	
	</a></p>
</div>
	<input type="hidden" name="option" value="com_fadegallery" />
	<input type="hidden" name="controller" value="galleries" />
	
	<input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
	<input type="hidden" name="task" value="" />


</form>