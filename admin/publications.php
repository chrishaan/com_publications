<?php
/**
 *
 * @version $Id: $
 * @package Joomla
 * @subpackage publications
 *
 * publications Component for NRCYD
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/*
 * Define constants for all pages
 */

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

//require_once JPATH_COMPONENT.DS.'helpers'.DS.'helper.php';

// Require specific controller if requested
$controller = JRequest::getVar('controller', '');
if (!empty($controller)) {
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
    if (file_exists($path)) {
        require_once $path;
    }
}

//Create the controller
$classname  = 'PublicationsController'.$controller;
$controller = new $classname();

// Perform the Request task
$controller->execute( JRequest::getCmd('task'));
$controller->redirect();
?>
