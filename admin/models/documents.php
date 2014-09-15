<?php
/**
* @version $Id: $
* @package	Joomla
* @subpackage Publications
*/

//no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class PublicationsModelDocuments extends JModel
{
    private $_data = null;
    private $_pagination = null;
    private $_total = null;

	function __construct()
	{
        parent::__construct();

        $mainframe = JFactory::getApplication();
		$option = JRequest::getCmd('option');

        // Get pagination request variables
        $limit = $mainframe->getUserStateFromRequest($option.'.pub.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.'.pub.limitstart', 'limitstart', JRequest::getInt('limitstart'), 'int');
        //$limitstart = JRequest::getVar('limitstart', 0, '', 'int');

        // In case limit has been changed, adjust it
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
	}

    function _buildQuery()
    {
        //Get the WHERE and ORDER BY clauses for the query
        $where	 = $this->_buildContentWhere();
        $orderby = $this->_buildContentOrderBy();

        $query  = 'SELECT  d.*, t.type, f.format'
                . ' FROM #__pub_documents AS d'
				. ' LEFT JOIN #__pub_types AS t ON d.type_id = t.id'
				. ' LEFT JOIN #__pub_formats AS f ON d.format_id = f.id'
                . $where
                . $orderby
                ;
        return $query;
	}

    function getTotal()
    {
        if(!$this->_total) {
            $query = $this->_buildQuery();
            $this->_total = $this->_getListCount($query);
        }

        return $this->_total;
	}

    function &getPagination()
    {
		if(!$this->_pagination) {
			jimport('joomla.html.pagination');
			$mainframe = JFactory::getApplication();
			$option = JRequest::getCMD('option');
			$this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));
        }

        return $this->_pagination;
    }

	function &getData()
    {
        if (empty($this->_data)) {
            $query = $this->_buildQuery();
            $this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
        }

        return $this->_data;
    }

    /**
     * Build the order clause
     *
     * @access private
     * @return string
     */
	function _buildContentOrderBy()
    {
        $mainframe = JFactory::getApplication();
        $option = JRequest::getCMD('option');

        $filter_order		= $mainframe->getUserStateFromRequest( $option.'.pub.filter_order', 'filter_order', 'title', 'cmd' );
        $filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'.pub.filter_order_Dir', 'filter_order_Dir', '', 'word' );

        $orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir.'';

        return $orderby;
    }

	/**
	 * Build the where clause
	 *
	 * @access private
	 * @return string
	 */
    function _buildContentWhere()
    {
        $mainframe = JFactory::getApplication();
        $option = JRequest::getCMD('option');

		$filter_state = $mainframe->getUserStateFromRequest( $option.'.pub.filter_state', 'filter_state', '', 'word' );
		$filter       = $mainframe->getUserStateFromRequest( $option.'.pub.filter', 'filter', '', 'int' );
		$search       = $mainframe->getUserStateFromRequest( $option.'.pub.search', 'search', '', 'string' );
		$search       = $this->_db->getEscaped( trim(JString::strtolower( $search ) ) );

		$where = array();

		if ($filter_state) {
            switch ($filter_state) {
                case 'P':
                    $where[] = 'published = 1';
                    break;

                case 'U':
                    $where[] = 'published = 0';
                    break;

				default:
                    //anything else - no filter
            }
        }

		if ($search && $filter == 1) {
			$where[] = ' LOWER(title) LIKE \'%'.$search.'%\' ';
        }

        if ($search && $filter == 2) {
            $where[] = ' LOWER(description) LIKE \'%'.$search.'%\' ';
        }

        $where = ( count( $where )) ? ' WHERE ' . implode( ' AND ', $where ) : '' ;

		return $where;
	}
}
