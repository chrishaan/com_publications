<?php
/**
* @version $Id: $
* @package	Joomla
* @subpackage Publications
*/

//no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class PublicationsModelDocument extends JModel
{
    private $_data = null;
	private $_topics = null;
	private $_alltopics = null;
	private $_allformats = null;

    function buildSearch()
    {
        //Get the WHERE and ORDER BY clauses for the query
        $id = JRequest::getVar('cid', array());
		$id = $id[0];
        $query  = 'SELECT *'
                . ' FROM #__pub_documents'
                . ' WHERE id = ' . $id
                ;        
        return $query;
	}

    function &getTopics()
    {
		$db = JFactory::getDBO();
        $id = JRequest::getVar( 'cid', array() );
		$id = $id[0];
		$query = 'SELECT t.id, t.topic '
			   . ' FROM #__pub_document_topics AS dt'
		       . ' LEFT JOIN #__pub_topics AS t ON dt.topic_id = t.id'
			   . ' WHERE dt.doc_id = ' . $id
			   . ' ORDER BY topic ASC'
		       ;
		$db->setQuery( $query );
        $this->_topics = $db->loadAssocList();
        return $this->_topics;
	}

    function &getAllTopics()
    {
		$db = JFactory::getDBO();
		$query = 'SELECT id, topic '
			   . ' FROM #__pub_topics'
			   . ' ORDER BY topic ASC'
		       ;
		$db->setQuery( $query );
        $this->_alltopics = array_merge( array( array( 'id' => '0', 'topic' => '-- select topic --' ) ), $db->loadAssocList() );
        return $this->_alltopics;
	}

	function &getAllTypes()
	{
		$db =JFactory::getDBO();
		$query = 'SELECT id, type '
			   . ' FROM #__pub_types'
			   . ' ORDER BY type ASC'
			   ;
		$db->setQuery( $query );
        $this->_alltypes = array_merge( array( array( 'id' => '0', 'type' => '-- select type --' ) ), $db->loadAssocList() );
		return $this->_alltypes;
	}

	function &getAllFormats()
	{
		$db =JFactory::getDBO();
		$query = 'SELECT id, description as format '
			   . ' FROM #__pub_formats'
		       . ' WHERE description != ""'
			   . ' ORDER BY format ASC'
			   ;
		$db->setQuery( $query );
        $this->_allformats = array_merge( array( array( 'id' => '0', 'format' => '-- select format --' ) ), $db->loadAssocList() );
		return $this->_allformats;
	}

	function &getData()
    {
        if (empty($this->_data)) {

			$db = JFactory::getDBO();
            $query = $this->buildSearch();
			$db->setQuery($query);
            $this->_data = $db->loadObject();
        }

        return $this->_data;
    }
}
