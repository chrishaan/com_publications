<?php
/**
 * @version: $Id $
 *
 */

defined('_JEXEC') or die('Restricted Access ');

jimport( 'joomla.application.component.view');
class PublicationsViewDocument extends JView
{
    function display($tpl = null)
    {
        $mainframe = JFactory::getApplication();
        $option = JRequest::getCmd('option');

		// get doc info to view
        $doc =& $this->get('data');
        $this->assignRef('doc', $doc);

		//get all topics, create select and assign to view
		$alltopics = JHTML::_('select.genericlist', $this->get('alltopics'), 'topic', '', $key='id', $text='topic');
		$this->assignRef('alltopics', $alltopics);

        //get and assign document topics to view
		$topics =& $this->get('topics');
		$this->assignRef('topics', $topics);

		// get types, create select and assign to view
		$type = JHTML::_('select.genericlist', $this->get('alltypes'), 'type', '', $key='id', $text='type', $this->doc->type_id);
		$this->assignRef('type', $type);

		// get formats, create select and assign to view
		$format = JHTML::_('select.genericlist', $this->get('allformats'), 'format', '', $key='id', $text='format', $this->doc->format_id);
		$this->assignRef('format', $format);

		//if $this->doc->id is not zero, use the actual published state, otherwise (new doc) set to published
		$this->assignRef('published', JHTML::_('select.booleanlist', 'published', '', ($this->doc->id) ? $this->doc->published : 1 , 'Yes', 'No'));
		$this->assignRef('date', JHTML::_('calendar', $this->doc->date, 'date', 'date'));
        $this->assignRef('editor', JFactory::getEditor());

        parent::display($tpl);
    }
}
?>
