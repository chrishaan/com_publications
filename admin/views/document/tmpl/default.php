<?php
/**
* @version $Id: $
* @package	Joomla
* @subpackage Publications
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

JToolBarHelper::title(JText::_( 'Manage Publications' ), 'generic.png');

JToolBarHelper::save();
JToolBarHelper::apply();
JToolBarHelper::back();

JHTML::_('behavior.calendar');
JHTML::script( 'com_publications.js', 'administrator/components/com_publications/assets/' );
JHTML::script( 'modal.js', 'administrator/components/com_publications/assets/' );
JHTML::stylesheet( 'modal.css', 'administrator/components/com_publications/assets/' );
?>

<div id="dm"></div>
<form action="index.php" method="post" name="adminForm">
	<table class="admintable">
		<tr>
			<td class="key">ID</td>
			<td><?php echo $this->doc->id; ?></td>
		</tr>
		<tr>
			<td class="key">Title</td>
			<td><input type="text" style="width: 580px" name="title" id="title" value="<?php echo stripslashes($this->doc->title); ?>" /></td>
		</tr>
		<tr>
			<td class="key">Description</td>
			<td><?php echo $this->editor->display( 'description', $this->doc->description, '100%', '150', '40', '5' ) ; ?></td>
		</tr>
		<tr>
			<td class="key">Date</td>
			<td><?php echo $this->date; ?></td>
		</tr>
		<tr>
			<td class="key">Type</td>
			<td><?php echo $this->type; ?></td>
		</tr>
		<tr>
			<td class="key">Format</td>
			<td><?php echo $this->format; ?></td>
		</tr>
		<tr>
			<td class="key">File Name or URL</td>
			<td><input type="text" name="file_name" id="file_name" style="width: 500px" value="<?php echo $this->doc->file_name; ?>" />
			<input type="button" value="select document" onClick="createWindow('index.php?option=com_publications&view=files&tmpl=component&type=doc','file_name', 500, 300)" />
			</td>
		</tr>
		<tr>
			<td class="key">Image Name</td>
			<td><input type="text" name="image_name" id="image_name" style="width: 500px" value="<?php echo $this->doc->image_name; ?>" />
			<input type="button" value="select thumbnail" onClick="createWindow('index.php?option=com_publications&view=files&tmpl=component&type=img','image_name', 500, 300)" />
			</td>
		</tr>
		<?php if ($this->doc->id) : ?>
		<tr>
			<td class="key">Topics</td>
			<td>
				<fieldset>
					<?php echo $this->alltopics; ?>&nbsp;
					<input type="button" value="Add" onClick="addtopic( <?php echo $this->doc->id; ?> )" />
					<br /><br />
					<div id="topics">
					<?php foreach($this->topics as $topic): ?>
					<?php $link = 'index.php?option=' . $option . '&controller=document&task=removetopic&doc_id=' . $this->doc->id . '&topic_id=' . $topic['id']; ?>
					<?php echo '<a style="color: red;" href="' . $link . '">[X]</a> ' . $topic['topic'] ; ?><br />
					<?php endforeach; ?>
					</div>
				</fieldset>
			</td>
		</tr>
		<?php endif ?>
		<tr>
			<td class="key">Published</td>
			<td>
				<?php echo $this->published; ?>
			</td>
		</tr>
	</table>

<?php echo JHTML::_('form.token'); ?>
<input type="hidden" name="id" value="<?php echo $this->doc->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="controller" value="document" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="documents" />
<input type="hidden" name="boxchecked" value="0" />
</form>
