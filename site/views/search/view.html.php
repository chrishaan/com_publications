<?php
/**
 * Joomla! 1.5 component statepages
 *
 * @version $Id:  $
 * @author
 * @package Joomla
 * @subpackage Publications
 *
 * Publications Component for NRCYD
 *
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the publications component
 */
class PublicationsViewSearch extends JView
{
	function display($tpl = null)
    {
        $mainframe = JFactory::getApplication();
        $option = JRequest::getCmd('option');
		$mypage = JFactory::getDocument();
		$mypage->setMetaData("EXPIRES", DATE( DATE_RFC1123, (time() + 86400 )), true);
		$mypage->setMetaData("pragma", "no-cache", false);

		//get all topics, create select and assign to view
		$alltopics = JHTML::_('select.genericlist', $this->get('alltopics'), 'topic', 'style="width: 225px"', $key='id', $text='topic', JRequest::getString('topic', 'All'));
		$this->assignRef('alltopics', $alltopics);

		// get types, create select and assign to view
		$type = JHTML::_('select.genericlist', $this->get('alltypes'), 'type', 'style="width: 125px"', $key='id', $text='type', JRequest::getString('type', 'All'));
		$this->assignRef('types', $type);

		// get dates(years), create select and assign to view
		$years = JHTML::_('select.genericlist', $this->get('years'), 'year', 'style="width: 75px"', $key='id', $text='year', JRequest::getInt('year', 0));
		$this->assignRef('years', $years);

		$this->assign('query', $this->get('query'));
        $this->assignRef('rows', $this->get( 'data' ));
		$this->assign('search', JRequest::getString('search', ''));

		$this->assignRef('pagination', $this->get('pagination'));
		
		$layout = JRequest::getVar('layout');
		if(!$layout) {
			JRequest::setVar('layout', 'default');
		}

        parent::display($tpl);
    }
}
?>