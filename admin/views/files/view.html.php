<?php
/**
 * @version: $Id $
 *
 */

defined('_JEXEC') or die('Restricted Access ');

jimport( 'joomla.application.component.view');
class PublicationsViewFiles extends JView
{
    function display($tpl = null)
	{
		$this->assignRef('files', json_encode( $this->get( 'filelist')) );
		parent::display($tpl);
	}
}