<?php
/**
 *
 * @version $Id:  $
 * @package Joomla
 * @subpackage publications
 *
 * Publications Component for NRCYD
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.controller' );
//require_once( JPATH_COMPONENT.DS.'helpers'.DS.'helper.php' );

/**
 * statepages Controller
 *
 * @package Joomla
 * @subpackage statepages
 */
class PublicationsControllerDocument extends JController
{
    /**
     * Constructor
     * @access private
     * @subpackage publications
     */
    function __construct($config = array())
    {
        parent::__construct($config);

        $this->registerTask('unpublish', 'publish');
        $this->registerTask('apply', 'save');
    }

	function removetopic()
	{
		$option = JRequest::getVar('option', '');
		$doc_id = JRequest::getInt('doc_id', 0);
		$topic_id = JRequest::getInt('topic_id', 0);
		if ($doc_id + $topic_id < 2) {
			return;
		}
		$db = JFactory::getDBO();
		$query = 'DELETE FROM #__pub_document_topics WHERE doc_id = ' . $doc_id . ' AND topic_id = ' . $topic_id;
		$db->setQuery( $query );
		$msg = ($db->query()) ? 'Topic removed from document.' : 'Failed to remove topic from document';

		$this->setRedirect('index.php?option=' . $option . '&view=document&cid[]=' . $doc_id , $msg);
	}

	function addtopic()
	{
	    $option = JRequest::getVar('option', '');
		$doc_id = JRequest::getInt('doc_id', 0);
		$topic_id = JRequest::getInt('topic_id', 0);
		if ($doc_id + $topic_id < 2) {
			return;
		}
		$db = JFactory::getDBO();
		$query = 'INSERT INTO #__pub_document_topics ( doc_id, topic_id ) VALUES (' . $doc_id . ', ' . $topic_id . ')';
		$db->setQuery( $query );
		$msg = ($db->query()) ? 'Topic added to document.' : 'Failed to add topic to document';
		
		$this->setRedirect('index.php?option=' . $option . '&view=document&cid[]=' . $doc_id , $msg);
		//$this->save();
	}

	function save()
	{      
		$row =& JTable::getInstance('documents', 'Table');

		$row->id = JRequest::getInt('id', 0);
        $title = JRequest::getString('title', '');
		$row->title = (empty($title)) ? '-- title missing --' : $title;
        $description = JRequest::getVar( 'description', '', 'post', '', JREQUEST_ALLOWHTML );
		$row->description = (empty($description)) ? '-- description missing --' : $description;
		$row->date = JRequest::getString( 'date', '0000-00-00' );
		$row->type_id = JRequest::getInt( 'type', '');
		$row->format_id = JRequest::getint( 'format', '' );
		$row->file_name = JRequest::getString( 'file_name', '' );
		$row->image_name = JRequest::getString( 'image_name', '' );
		$row->published = (empty($title) || empty($description)) ? 0 : JRequest::getInt( 'published', 0 );

		if (!$row->store()) {
			JError::raiseError( 500, $row->getError() );
        }

		$option = JRequest::getVar('option', '');             
		if (JRequest::getVar('task', '') == 'apply'){
			$this->setRedirect( 'index.php?option=' . $option . '&view=document&cid[]=' . $row->id, 'Document information saved.' );
		} else {
			$this->setRedirect( 'index.php?option=' . $option . '&view=documents', 'Document information saved.' );
		}
	}

    function display()
    {
        $view = JRequest::getVar('view');

        if (!$view) {
            JRequest::setVar('view', 'default');
        }

        parent::display();
    }
}
?>