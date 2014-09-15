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
class PublicationsController extends JController
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