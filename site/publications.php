<?php
/**
 * Joomla! 1.5 component statepages
 *
 * @version $Id:$
 * @author
 * @package Joomla
 * @subpackage publications
 * @license Copyright (c) 2009 - All Rights Reserved
 *
 * Publications Component for NRCYD
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

// Initialize the controller
$controller = new PublicationsController();
$controller->execute( JRequest::getCmd('task') );

// Redirect if set by the controller
$controller->redirect();
?>