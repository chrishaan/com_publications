<?php
/**
* @version $Id: $
* @package	Joomla
* @subpackage publications
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::script('com_publications.js', 'components/com_publications/assets/');

?>

<h1 class="rbbn section10">Publications</h1>
<!-- <form action="/docs-test" method="get"> -->
<form action="<?php echo JRoute::_('index.php?option=com_publications'); ?>" method="get" id="docsearch">
	<p style="font-size: 12px; color: #000000; margin-bottom: 0;">Search Options</p>
	<table class="searchform">
		<tr>
			<td>
				<label>
					Topic:<br /><?php echo $this->alltopics; ?>
				</label>
			</td>
			<td>
				<label>
					Type:<br /><?php echo $this->types; ?>
				</label>
			</td>
			<td>
				<label>
					Year:<br /><?php echo $this->years; ?>
				</label>
			</td>
			<td>
				<label>
					Keywords:<br /><input type="text" name="search" id="search" value="<?php echo $this->search; ?>" />
				</label>
			</td>
			<td>&nbsp;<br />
				<input type="submit" value="Go" id="submit" />
			</td>
		</tr>
	</table>



<table style="margin: 0 25px; width: 636px;" class="contentpaneopen">
<?php
$k = 0;
foreach( $this->rows as $row ) :
$style = ($k) ? 'style="background: #dbe5ed"' : '';
$publications_base_dir = "/var/www/html/nrcyd/publication-db";
$document_dir = "/publication-db" . DS . "documents" . DS;
$thumbnail_dir = "thumbs";

if( $row->format == 'html' ){
	$link = "http://" . $row->file_name;
} else {
	$link = $document_dir . $row->file_name;
}

?>

	<tr  <?php echo $style; ?>>
		<td class="pub_thumb">
			<a href="<?php echo $link; ?>" target="_blank" >
				<?php
				if ($row->image_name != ''){
					echo "<img src=\"/publication-db" . DS . $thumbnail_dir . DS . $row->image_name . "\" alt=\"$row->title\" />";
				} else {
					if( file_exists( $publications_base_dir . DS . $thumbnail_dir . DS . $row->file_name . ".png" )) {
						echo "<img src=\"/publication-db" . DS . $thumbnail_dir . DS . $row->file_name . ".png" . "\" alt=\"$row->title\" />";
					}
				}
				?>
			</a>
		</td>
		<td class="pub_summary">
			<h3>
			<?php echo ucwords($row->type); ?>&nbsp;
			<?php
			if($row->year){
				echo $row->year;
			}
			?>
			</h3>
			<a href="<?php echo $link; ?>" target="_blank">
				<?php echo stripslashes($row->title); ?>
			</a><br />
			<?php echo $row->description; ?><br />


			<div style="text-align: left">
			<?php
			   $download_link = "index.php?option=com_publications&task=download&id={$row->id}";
			?>
			<a href="<?php echo $link; ?>" style="text-decoration:none;" target="_blank" >
			<?php if ($row->format != "html"): ?>
			<img src="administrator/components/com_media/images/mime-icon-16/<?php echo $row->format; ?>.png" style="vertical-align:middle;" alt="<?php echo $row->format . ' icon'; ?>" />
			<?php endif; ?>
				<span style="font-size: 10px; font-weight: normal;">
					View File
				</span>
			</a>

			<?php if ($row->format != "html"): ?> |

			<a href="<?php echo $download_link; ?>" style="text-decoration:none;">
			<img src="administrator/components/com_media/images/mime-icon-16/<?php echo $row->format; ?>.png" style="vertical-align:middle;" alt="<?php echo $row->format . ' icon'; ?>" />
				<span style="font-size: 10px; font-weight: normal;">
					Download File
				</span>
			</a> |

			<a href="http://<?php echo $row->viewer_url; ?>" style="text-decoration:none;" target="_blank">
			<img src="administrator/components/com_media/images/mime-icon-16/<?php echo $row->format; ?>.png" style="vertical-align:middle;" alt="<?php echo $row->format . ' viewer'; ?>" />
				<span style="font-size: 10px; font-weight: normal;">
					Download Viewer
				</span>
			</a>
			<?php endif; ?>
			</div>
		</td>
			


	</tr>
<?php
$k = 1 - $k;
endforeach; 
	
if(count($this->rows) == 0){
	echo "<tr><td style='font-weight: bold;'>There are no publications that match your search criteria.  Try broadening your search by setting fewer filters or search words.</td></tr>";
}
?>
</table>

<?php echo $this->pagination->getlistFooter( ); ?>

</form>
<br />
<!-- <?php echo $this->query; ?> -->

