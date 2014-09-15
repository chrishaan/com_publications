<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model' );

class PublicationsModelFiles extends JModel
{
	function getFileList(){
		$filelist = array();
		if( JRequest::getString( 'type' ) == 'doc'){
			$base_dir = "/var/www/html/nrcyd/publication-db/documents";
		} else {
			$base_dir = "/var/www/html/nrcyd/publication-db/thumbs";
		}
		$slice_begin = count( split( DS, $base_dir )) - 1;
		$this->read_dir( $base_dir, $filelist );
		$hash = array();
		foreach ( $filelist as $file ){
			$segments = split( DS, $file);
			$last_segment_index = count( $segments ) - 1;
			$filename = $segments[ $last_segment_index  ];
			$hash[] = array( 'id' => $filename, 'file' => $filename );
	    }
		return $hash;
	}

	function read_dir( $base_dir, &$filelist) {
		//echo "entering read_dir<br />";
		$dir = dir( $base_dir );
		while(false !== ($entry = $dir->read())){
			//echo $base_dir . DS . $entry."<br />";
			if( substr( $entry, 0, 1 ) == "." ){
				continue;
			}
			if ( is_dir( $base_dir . DS . $entry ) ){
				$this->read_dir( $base_dir . DS . $entry, $filelist );
			} else if ( is_file( $base_dir . DS . $entry ) && $entry != "index.html") {
				$filelist[] = $base_dir . DS . $entry;
			}
		}
	}

}
?>
