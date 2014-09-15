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
class PublicationsControllerTopics extends JController
{
    /**
     * Constructor
     * @access private
     * @subpackage publications
     */
    function __construct($config = array())
    {
        parent::__construct($config);

        //$this->registerTask('unpublish', 'publish');
        //$this->registerTask('apply', 'save');
    }

	function save_topic()
	{
		JRequest::checkToken('get') or die( 'Invalid Token' );
		$option = JRequest::getVar('option', '');
		$topic_id = JRequest::getInt('topic_id', 0);
		$topic_topic = addslashes(JRequest::getString('topic_topic', '--error--'));
		$topic_description = JRequest::getString('topic_description', '');
		$tab = JRequest::getString('tab', 'topics');
		$db = JFactory::getDBO();
		if( $topic_id > 0 ) {
			$query = 'UPDATE #__pub_topics SET topic = "' . $topic_topic . '", description = "' . $topic_description . '" WHERE id = ' . $topic_id;
		} else {
			$query = 'INSERT INTO #__pub_topics ( topic, description ) VALUES ( "' . $topic_topic . '", "' . $topic_description . '")';
		}
		$db->setQuery( $query );
		$msg = ($db->query()) ? 'Topic saved' : 'Failed to save topic';

		$this->setRedirect('index.php?option=' . $option . '&view=topics&tab=' . $tab , $msg );
	}

	function save_type()
	{
		JRequest::checkToken('get') or die( 'Invalid Token' );
		$option = JRequest::getVar('option', '');
		$type_id = JRequest::getInt('type_id', 0);
		$type_type = JRequest::getString('type_type', '--error--');
		$type_description = JRequest::getString('type_description', '');
		$tab = JRequest::getString('tab', 'topics');
		$db = JFactory::getDBO();
		if( $type_id > 0 ) {
			$query = 'UPDATE #__pub_types SET type = "' . $type_type . '", description = "' . $type_description . '" WHERE id = ' . $type_id;
		} else {
			$query = 'INSERT INTO #__pub_types ( type, description ) VALUES ( "' . $type_type . '", "' . $type_description . '")';
		}
		$db->setQuery( $query );
		$msg = ($db->query()) ? 'Type saved' : 'Failed to save type';

		$this->setRedirect('index.php?option=' . $option . '&view=topics&tab=' . $tab , $msg );
	}

	function save_format()
	{
		JRequest::checkToken('get') or die( 'Invalid Token' );
		$option = JRequest::getVar('option', '');
		$format_id = JRequest::getInt('format_id', 0);
		$format_format = JRequest::getString('format_format', '--error--');
		$format_mime_type = JRequest::getString('format_mime_type', '');
		$format_viewer_url = JRequest::getString('format_viewer_url', '');
		$format_description = JRequest::getString('format_description', '');
		$tab = JRequest::getString('tab', 'topics');
		$db = JFactory::getDBO();
		if( $format_id > 0 ) {
			$query = 'UPDATE #__pub_formats SET format = "' . $format_format . '", description = "' . $format_description . '", mime_type = "' . $format_mime_type . '", viewer_url = "' . $format_viewer_url . '" WHERE id = ' . $format_id;
		} else {
			$query = 'INSERT INTO #__pub_formats ( format, description ) VALUES ( "' . $format_format . '", "' . $format_description . '")';
		}
		$db->setQuery( $query );
		$msg = ($db->query()) ? 'Format saved' : 'Failed to save format';

		$this->setRedirect('index.php?option=' . $option . '&view=topics&tab=' . $tab , $msg );
	}

	function delete_topic()
	{
		JRequest::checkToken('get') or die( 'Invalid Token' );
		$option = JRequest::getVar('option', '');
		$topic_id = JRequest::getInt('topic_id', 0);
		$tab = JRequest::getString('tab', 'topics');
		if( $topic_id > 0 ) {
			$db = JFactory::getDBO();
			$query = 'DELETE FROM #__pub_topics WHERE id = ' . $topic_id;
			$db->setQuery( $query );
			$msg = ($db->query()) ? 'Topic deleted' : 'Failed to delete topic';
		} else {
			$msg = 'No topic selected.';
		}

		$this->setRedirect('index.php?option=' . $option . '&view=topics&tab=' . $tab , $msg );
	}

	function delete_type()
	{
		JRequest::checkToken('get') or die( 'Invalid Token' );
		$option = JRequest::getVar('option', '');
		$type_id = JRequest::getInt('type_id', 0);
		$tab = JRequest::getString('tab', 'types');
		if( $type_id > 0 ) {
			$db = JFactory::getDBO();
			$query = 'DELETE FROM #__pub_types WHERE id = ' . $type_id;
			$db->setQuery( $query );
			$msg = ($db->query()) ? 'Type deleted' : 'Failed to delete type';
		} else {
			$msg = 'No type selected.';
		}

		$this->setRedirect('index.php?option=' . $option . '&view=topics&tab=' . $tab , $msg );
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