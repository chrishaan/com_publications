<?php
/**
* @version $Id: $
* @package	Joomla
* @subpackage Publications
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

JToolBarHelper::title(JText::_( 'Topics, Types, and Formats' ), 'generic.png');
JToolBarHelper::back();

JHTML::script('com_publications.js', 'administrator/components/com_publications/assets/' );
JHTML::script('com_publications_topics.js', 'administrator/components/com_publications/assets/' );

jimport('joomla.html.pane');

$pane =& JPane::getInstance('tabs', array('startOffset'=>$this->tab));
?>

<style type="text/css">
	.cmenu { width: 100%; margin-bottom: 10px;  }
    input[type=button]:hover { color: #000000; background-color: #aaaaaa; text-decoration: none;}
</style>

<script type="text/javascript">
	var topic_array = eval ( <?php echo $this->topics_json; ?> );
	var type_array = eval ( <?php echo $this->types_json; ?> );
	var format_array = eval ( <?php echo $this->formats_json; ?> );
</script>
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" id="token" />
<?php

echo $pane->startPane( 'pane' );
echo $pane->startPanel( 'Topics', 'panel1' );
?>

<table>
	<tr>
		<td style="vertical-align: top;">
<div style="border: 1px solid black; width: 300px; padding: 10px; margin-right: 20px;">
	<div class="cmenu">
		<input type="button" value="Edit" onClick="edit_entry('topic')" />
		<input type="button" value="New" onClick="new_entry('topic')" />
		<input type="button" value="Delete" onClick="delete_entry('topic')" />
	</div>
	<select size="15" style="width: 100%; height: 200px;" id="topic_select" onClick="populate_form('topic')">
		<option value="">Javascript error</option>
	</select>
</div>
		</td>
		<td style="vertical-align: top;">
<div style="border: 1px solid black; width: 300px; padding: 10px; display: none; vertical-align: top;" id="topic_form">
	<div class="cmenu">
		<input type="button" value="Save" onClick="save_entry('topic')" />
		<input type="button" value="Cancel" onClick="$('topic_form').setStyle('display','none')" />
	</div>
	<label for="topic_id">ID</label><br />
	<input type="text" size="4" disabled="disabled" value="" id="topic_id" name="topic_id" /><br />
	<label for="topic_topic">Topic</label><br />
	<input type="text" style="width: 100%" name="topic_topic" id="topic_topic" value="" /><br />
	<label for="description">Description</label><br />
	<input type="text" style="width: 100%" name="topic_description" id="topic_description" value="" />
</div>
		</td>
	</tr>
</table>

<?php 
echo $pane->endPanel();
echo $pane->startPanel( 'Types', 'panel2' );
?>

<table>
	<tr>
		<td style="vertical-align: top;">
<div style="border: 1px solid black; width: 300px; padding: 10px; margin-right: 20px;">
	<div class="cmenu">
		<input type="button" value="Edit" onClick="edit_entry('type')" />
		<input type="button" value="New" onClick="new_entry('type')" />
		<input type="button" value="Delete" onClick="delete_entry('type')" />
	</div>
	<select size="15" style="width: 100%; height: 200px;" id="type_select" onClick="populate_form('type')">
		<option value="">Javascript error</option>
	</select>
</div>
		</td>
		<td style="vertical-align: top;">
<div style="border: 1px solid black; width: 300px; padding: 10px; display: none; vertical-align: top;" id="type_form">
	<div class="cmenu">
		<input type="button" value="Save" onClick="save_entry('type')" />
		<input type="button" value="Cancel" onClick="$('type_form').setStyle('display','none')" />
	</div>
	<label for="type_id">ID</label><br />
	<input type="text" size="4" disabled="disabled" value="" id="type_id" name="type_id" /><br />
	<label for="type_type">Type</label><br />
	<input type="text" style="width: 100%" name="topic_type" id="type_type" value="" /><br />
	<label for="type_description">Description</label><br />
	<input type="text" style="width: 100%" name="type_description" id="type_description" value="" />
</div>
		</td>
	</tr>
</table>

<?php
echo $pane->endPanel();
echo $pane->startPanel( 'Formats', 'panel3' );
?>

<table>
	<tr>
		<td style="vertical-align: top;">
<div style="border: 1px solid black; width: 300px; padding: 10px; margin-right: 20px;">
	<div class="cmenu">
		<input type="button" value="Edit" onClick="edit_entry('format')" />
		<input type="button" value="New" onClick="new_entry('format')" />
		<input type="button" value="Delete" onClick="delete_entry('format')" />
	</div>
	<select size="15" style="width: 100%; height: 200px;" id="format_select" onClick="populate_form('format')">
		<option value="">Javascript error</option>
	</select>
</div>
		</td>
		<td style="vertical-align: top;">
<div style="border: 1px solid black; width: 300px; padding: 10px; display: none; vertical-align: top;" id="format_form">
	<div class="cmenu">
		<input type="button" value="Save" onClick="save_entry('format')" />
		<input type="button" value="Cancel" onClick="$('format_form').setStyle('display','none')" />
	</div>
	<label for="format_id">ID</label><br />
	<input type="text" size="4" disabled="disabled" value="" id="format_id" name="format_id" /><br />
	<label for="format_format">Format</label><br />
	<input type="text" style="width: 100%" name="format_format" id="format_format" value="" /><br />
	<label for="format_mime_type">MIME Type</label><br />
	<input type="text" style="width: 100%" name="format_mime_type" id="format_mime_type" value="" /><br />
	<label for="format_viewer_url">Viewer URL</label><br />
	<input type="text" style="width: 100%" name="format_viewer_url" id="format_viewer_url" value="" /><br />
	<label for="format_description">Description</label><br />
	<input type="text" style="width: 100%" name="format_description" id="format_description" value="" />
</div>
		</td>
	</tr>
</table>

<?php
echo $pane->endPanel();
echo $pane->endPane();

?>
