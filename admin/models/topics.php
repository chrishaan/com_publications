<?php
/**
* @version $Id: $
* @package	Joomla
* @subpackage Publications
*/

//no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class PublicationsModelTopics extends JModel
{
    //private $_data = null;
	private $_topics = null;
	private $_alltopics = null;
	private $_allformats = null;

    function buildSearch()
    {
        //Get the WHERE and ORDER BY clauses for the query
        $id = JRequest::getVar('cid', array());
		$id = $id[0];
        $query  = 'SELECT *, d.description'
                . ' FROM #__pub_documents AS d'
				. ' LEFT JOIN #__pub_types AS t ON d.type_id = t.id'
				. ' LEFT JOIN #__pub_formats AS f ON d.format_id = f.id'
                . ' WHERE d.id = ' . $id
                ;
        return $query;
	}

    function &getAllTopics()
    {
		$db = JFactory::getDBO();
		$query = 'SELECT * '
			   . ' FROM #__pub_topics'
			   . ' ORDER BY topic ASC'
		       ;
		$db->setQuery( $query );
        $this->_alltopics = $db->loadAssocList();
        return $this->_alltopics;
	}

	function &getAllTypes()
	{
		$db =JFactory::getDBO();
		$query = 'SELECT id, type, description '
			   . ' FROM #__pub_types'
			   . ' ORDER BY type ASC'
			   ;
		$db->setQuery( $query );
        $this->_alltypes = $db->loadAssocList();
		return $this->_alltypes;
	}

	function &getAllFormats()
	{
		$db =JFactory::getDBO();
		$query = 'SELECT id, format, description, mime_type, viewer_url '
			   . ' FROM #__pub_formats'
			   . ' ORDER BY format ASC'
			   ;
		$db->setQuery( $query );
        $this->_allformats = $db->loadAssocList();
		return $this->_allformats;
	}

}
