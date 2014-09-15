<?php
/**
* @version $Id: $
* @package	Joomla
* @subpackage Registrations
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::script('com_publications.js', 'administrator/components/com_publications/assets/' );
JHTML::script('modal.js', 'administrator/components/com_publications/assets/' );

?>

<script type="text/javascript">
var file_array = eval ( <?php echo $this->files; ?> );

function sort_these_things(a, b){
	//alert( a.file + ' > ' + b.file +' '+ (a.file > b.file) );
	return (a.file.toLowerCase() > b.file.toLowerCase() ) ? 1 : -1;
}

file_array.sort( sort_these_things );

window.addEvent('domready', function(){
	load_select_opts( 'file', file_array);
    $('file_select').focus();
})

</script>

Choose a file:<br />
<select size="12" name="file_select" id="file_select" style="width: 100%;" onChange="getUrl()" >
</select>
<table><tr>
<td>
File:</td><td> <input name="url" id="url" style="width: 400px; margin: 5px 0;" /></td></tr>
</table><br />
<input type="button" value="Insert" onclick="returnUrl( getQueryHash('target') )" style="float: right;" />
<input type="button" value="Cancel" onclick="parent.closeWindow();" style="float: right;" />