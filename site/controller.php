<?php
/**
 * Joomla! 1.5 component statepages
 *
 * @version $Id: $
 * @author
 * @package Joomla
 * @subpackage publications
 *
 * Publications Component for NRCYD
 *
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

/**
 * statepages Component Controller
 */
class PublicationsController extends JController {

	function __construct()
	{
		parent::__construct();
	}

	function download()
	{
		$id = JRequest::getInt('id', 0);
		if($id == 0){
			return; //no doc id in request
		}
		$db = JFactory::getDBO();
		$query = "SELECT d.file_name, f.mime_type from #__pub_documents AS d LEFT JOIN #__pub_formats AS f ON format_id = f.id WHERE d.id = {$id}";
		$db->setQuery( $query );
		$row = $db->loadAssoc();

		$publications_base_dir = "/var/www/html/nrcyd/publication-db";
		$document_dir = $publications_base_dir . DS . "documents" . DS;

		$filename = $document_dir . DS . $row['file_name'];
		$ctype = $row['mime_type'];

		header( "Pragma: public" ); // required
		header( "Expires: 0" );
		header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
		header( "Cache-Control: private", false ); // required for certain browsers
		header( "Content-Type: $ctype" );
		header( "Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
		header( "Content-Transfer-Encoding: binary" );
		header( "Content-Length: ".filesize($filename) );
		readfile( "$filename" );
		exit();
	}

	function display()
	{
     // Make sure we have a default view
     if( !JRequest::getVar( 'view' )) {
	      JRequest::setVar('view', 'search' );
     }
	   parent::display();
	}
}
?>