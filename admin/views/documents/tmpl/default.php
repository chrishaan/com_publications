<?php
/**
* @version $Id: $
* @package	Joomla
* @subpackage publication db
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

JToolBarHelper::title(JText::_( 'Manage Publications' ), 'generic.png');
JToolBarHelper::publishList();
JToolBarHelper::unpublishList();
JToolBarHelper::addNew();
JToolBarHelper::editList();
JToolBarHelper::deleteList('Are you certain you want to delete the publication?');

$publications_base_dir = "/var/www/html/nrcyd/publication-db";
$document_dir = $publications_base_dir . DS . "documents" . DS;
$thumbnail_dir = "/publication-db" . DS . "thumbs" . DS;

?>
<form action="index.php" method="post" name="adminForm">
	<table class="adminform">
		<tr>
			<td width="100%">
				<?php
				echo JText::_( 'SEARCH' );
				echo $this->lists['filter'];
				?>
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search']; ?>" class="text_area" onChange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				<button onclick="this.form.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
			</td>
			<td nowrap="nowrap">
				<?php echo $this->lists['state'];	?>
			</td>
		</tr>
	</table>
<table class="adminlist">
  <thead>
    <tr>
      <th width="20">
        <input type="checkbox" name="toggle"
             value="" onclick="checkAll(<?php echo
             count( $this->rows ); ?>);" />
      </th>
<!--	  <th>Image</th>  -->
      <th class="title"><?php echo JHTML::_('grid.sort', 'Title', 'title', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
      <th class="title"><?php echo JHTML::_('grid.sort', 'Type', 'type', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
      <th class="title"><?php echo JHTML::_('grid.sort', 'Date', 'date', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
      <th class="title"><?php echo JHTML::_('grid.sort', 'Format', 'format', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
      <th width="10%"><?php echo JHTML::_('grid.sort', 'Published', 'published', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
    </tr>
  </thead>

  <?php
  jimport('joomla.filter.output');
  $k = 0;
  for ($i=0, $n=count( $this->rows ); $i < $n; $i++)
  {
    $row = &$this->rows[$i];
    $checked = JHTML::_('grid.id', $i, $row->id );
    $published = JHTML::_('grid.published', $row, $i );
	$link = JFilterOutput::ampReplace( 'index.php?option=' . $option . '&view=document&cid[]='. $row->id );
    ?>
    <tr class="<?php echo "row$k"; ?>">

      <td>
        <?php echo $checked; ?>
      </td>
	<!--  <td style="text-align: center; vertical-align: middle;">
			<img src="<?php echo $thumbnail_dir . $row->image_name; ?>" />
	  </td>  -->
      <td>
        <a href="<?php echo $link; ?>"><?php echo stripslashes($row->title); ?></a>
      </td>
      <td>
        <?php echo $row->type; ?>
      </td>
      <td align="center">
        <?php echo ($row->date == "0000-00-00") ? "" : JHTML::Date($row->date); ?>
      </td>
      <td>
        <?php echo $row->format; ?>
      </td>
      <td align="center">
        <?php echo $published; ?>
      </td>
    </tr>
    <?php
    $k = 1 - $k;
  }
  ?>
  <tfoot>
  	<tr>
  		<td colspan="6"><?php echo $this->pagination->getListFooter(); ?></td>
  	</tr>
  </tfoot>
</table>
<?php echo JHTML::_('form.token'); ?>
<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="controller" value="documents" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="view" value="documents" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="" />
</form>