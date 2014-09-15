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
 * Publications Controller
 *
 * @package Joomla
 * @subpackage publications
 */
class PublicationsControllerDocuments extends JController
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
		$this->registerTask('edit', 'add');
    }

    function add()
    {
        JRequest::setVar('view', 'document');
        $this->display();
    }

    function display()
    {
        $view = JRequest::getVar('view');

        if (!$view) {
            JRequest::setVar('view', 'default');
        }

        parent::display();
    }

	function remove()
	{
        JRequest::checkToken() or jexit('Invalid Token');
        $option = JRequest::getCMD('option');

		$cid = JRequest::getVar('cid', array());
		if(count($cid) > 1) {
			JError::raiseWarning(500, "Sorry, you can only delete one document at a time.");
		}

		$cid = $cid[0];

		$row =& JTable::getInstance('documents', 'Table');
		if(!$row->delete($cid)) {
			JError::raiseError(500, $row->getError() );
        }

        $msg = 'Document';
        $msg .= (count($cid) > 1) ? 's ' : ' ';
        $msg .= 'removed';

        $this->setRedirect('index.php?option=' . $option . '&view=documents', $msg);
	}

    function publish()
    {
        JRequest::checkToken() or jexit('Invalid Token');
        $option = JRequest::getCMD('option');

        $cid = JRequest::getVar('cid', array());

        $row =& JTable::getInstance('documents', 'Table');

        $publish = ($this->getTask() == 'publish') ? 1 : 0;

        if(!$row->publish($cid, $publish)) {
			JError::raiseError(500, $row->getError() );
        }

        $msg = 'Document';
        $msg .= (count($cid) > 1) ? 's ' : ' ';
        $msg .= $this->getTask() . 'ed';

        $this->setRedirect('index.php?option=' . $option . '&view=documents', $msg);

    }

}
?>