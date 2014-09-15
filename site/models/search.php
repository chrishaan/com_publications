<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

/**
 * Publications Component publications Model
 *
 * @package		Joomla
 * @subpackage	publications
 * @since 1.5
 */
class PublicationsModelSearch extends JModel {

	public $state = null;
	protected $_data = null;
	protected $_total = null;
	protected $_pagination = null;
	protected $_query = null;
	protected $_years = null;
	
	function __construct()
        {
            $mainframe = JFactory::getApplication();
            parent::__construct();
            $this->state = JRequest::getVar('state', '');
            $limit = $mainframe->getUserStateFromRequest('com_publications.list.limit', 'limit', 10, 'int');
            $limitstart = JRequest::getVar('limitstart', 0, '', 'int');

		// In case limit has been changed, adjust it
            $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

            $this->setState('limit', $limit);
            $this->setState('limitstart', $limitstart);
    }

    function &getAllTopics()
    {
		$db = JFactory::getDBO();
		$query = 'SELECT DISTINCT t.topic as id, t.topic'
			   . ' FROM #__pub_document_topics AS dt'
		       . ' LEFT JOIN #__pub_documents AS d ON d.id = dt.doc_id'
		       . ' LEFT JOIN #__pub_topics AS t ON t.id = dt.topic_id'
		       . ' WHERE d.published = 1'
		       . ' ORDER BY topic ASC';
		$db->setQuery( $query );
        $this->_alltopics = array_merge( array( array( 'id' => 'All', 'topic' => '-- All Topics --' ) ), $db->loadAssocList() );
        return $this->_alltopics;
	}

	function &getAllTypes()
	{
		$db =JFactory::getDBO();
		$query = 'SELECT DISTINCT t.type as id, t.type'
			   . ' FROM #__pub_documents AS d'
		       . ' LEFT JOIN #__pub_types AS t ON t.id = d.type_id'
			   . ' WHERE d.published = 1'
			   . ' AND type_id != 0' // protect against published docs without a set type
		       . ' ORDER BY type ASC';
		$db->setQuery( $query );
        $this->_alltypes = array_merge( array( array( 'id' => 'All', 'type' => '-- All Types --' ) ), $db->loadAssocList() );
		return $this->_alltypes;
	}

	function &getYears()
	{
		$db = JFactory::getDBO();
		$query = 'SELECT DISTINCT YEAR(date) AS id, YEAR(date) AS year'
		       . ' FROM #__pub_documents'
			   . ' WHERE YEAR(date) != 0 AND published = 1'
		       . ' ORDER BY year ASC';
		$db->setQuery( $query );
		$this->_years = array_merge( array( array( 'id' => '0', 'year' => '-- All --' ) ), $db->loadAssocList() );
		return $this->_years;
	}

    function _buildContentOrderBy()
    {
        $mainframe = JFactory::getApplication();
        $option = JRequest::getCmd('option');

        $orderby = '';
        $filter_order     = $mainframe->getUserStateFromRequest( $option.'publications.filter_order', 'filter_order', 'sponsor_id', 'cmd' );
        $filter_order_Dir = $mainframe->getUserStateFromRequest( $option.'publications.filter_order_Dir', 'filter_order_Dir', 'asc', 'word' );

        /* Error handling is never a bad thing*/
        if(!empty($filter_order) && !empty($filter_order_Dir) ){
			$orderby = ' ORDER BY ' . $filter_order . ' ' . $filter_order_Dir;
        }

        return $orderby;
    }

    function _buildContentWhere()
    {
		$db = JFactory::getDBO();

		$topic  = JRequest::getString( 'topic', 'All' );
		$type   = JRequest::getString( 'type', 'All' );
		$format = JRequest::getInt( 'format', 0 );
		$year = JRequest::getInt( 'year', 0 );
		$search = strtolower( JRequest::getString( 'search', '' ) );
        $search = $db->getEscaped( trim( JString::strtolower( $search ) ) );

        $where = array();

		$where[] = " d.published = 1 ";

		if($year) {
			$where[] = " YEAR(d.date) = {$year} ";
		}

		if($type != 'All'){
			$db->setQuery( 'SELECT id FROM #__pub_types WHERE type = "' . $type . '"' );
			$type = $db->loadResult();
			$where[] = " d.type_id = {$type} ";
		}

		if($topic != 'All'){
			$db->setQuery( 'SELECT id FROM #__pub_topics WHERE topic = "' . $topic . '"' );
			$topic = $db->loadResult();
			$where[] = " d.id IN ( SELECT doc_id FROM #__pub_document_topics WHERE topic_id = {$topic} ) ";
		}

		if ($search) {
			$where[] = ' (LOWER(d.title) LIKE \'%'.$search.'%\' OR LOWER(d.description) LIKE \'%'.$search.'%\' '
			         . ' OR d.id IN ( SELECT dt.doc_id FROM #__pub_document_topics AS dt LEFT JOIN #__pub_topics as t ON dt.topic_id = t.id WHERE t.topic LIKE \'%'.$search.'%\' )) ';
		}

        $where = ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );

        return $where;
  }

    function getTotal()
    {
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query = $this->_buildQuery();
            $this->_total = $this->_getListCount($query);
        }

        return $this->_total;
    }

    function getPagination()
    {
        // Load the content if it doesn't already exist
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            $mainframe = JFactory::getApplication();
            $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
			//$this->_pagination = new JPagination($this->getTotal(), JRequest::getVar('limitstart', 0), JRequest::getVar('limit', 10 ));
        }

        return $this->_pagination;
    }

    function _buildQuery()
    {
        $this->_query = "SELECT d.id, d.file_name, d.image_name, d.title, d.description, YEAR( d.date) as year, t.type, f.format, f.viewer_url "
					  . "FROM #__pub_documents AS d "
					  . "LEFT JOIN #__pub_types AS t on t.id = d.type_id "
					  . "LEFT JOIN #__pub_formats AS f on f.id = d.format_id ";
        $this->_query .= $this->_buildContentWhere();
        //$this->_query .= $this->_buildContentOrderBy();
		$this->_query .= " ORDER BY d.title ASC";
        return $this->_query;
    }

    function getQuery()
    {
            if(!$this->_query){
                $this->_buildQuery();
            }
            return $this->_query;
    }

    function getData()
    {
        if (empty($this->_data)) {
            $this->_query = $this->_buildQuery();
			$this->_data = $this->_getList($this->_query, $this->getState('limitstart'), $this->getState('limit'));
        }

        return $this->_data;
    }



}
?>