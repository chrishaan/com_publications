<?php

/**
 * @version: $Id $
 *
 */

defined('_JEXEC') or die('Restricted Access ');

jimport( 'joomla.application.component.view');
class PublicationsViewTopics extends JView
{
    function display($tpl = null)
    {
		
		$this->assignRef( 'topics_json', json_encode( $this->get('alltopics')) );
		$this->assignRef( 'types_json', json_encode( $this->get('alltypes')) );
		$this->assignRef( 'formats_json', json_encode( $this->get('allformats')) );
		$tabs = Array('topic'=>0, 'type'=>1, 'format'=>2);
		$tab_name = JRequest::getString('tab', 'topics');
		$this->assignRef( 'tab', $tabs[ $tab_name ] );

        parent::display($tpl);
    }
}
?>
