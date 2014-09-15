<?php
/**
 * @version: $Id $
 * 
 */

defined('_JEXEC') or die('Restricted Access ');

jimport( 'joomla.application.component.view');
class PublicationsViewDocuments extends JView
{
    function display($tpl = null)
    {
        $mainframe = JFactory::getApplication();
        $option = JRequest::getCmd('option');

        $db = & JFactory::getDBO();

        $rows =& $this->get('data');
        $pagination =& $this->get('pagination');

        //get vars
        $filter_order	  = $mainframe->getUserStateFromRequest( $option.'.pub.filter_order', 'filter_order', 'title', 'cmd' );
        $filter_order_Dir = $mainframe->getUserStateFromRequest( $option.'.pub.filter_order_Dir', 'filter_order_Dir', '', 'word' );
        $filter_state 	  = $mainframe->getUserStateFromRequest( $option.'.pub.filter_state', 'filter_state', '*', 'word' );
        $filter           = $mainframe->getUserStateFromRequest( $option.'.pub.filter', 'filter', '', 'int' );
        $search           = $mainframe->getUserStateFromRequest( $option.'.pub.search', 'search', '', 'string' );
        $search           = $db->getEscaped( trim(JString::strtolower( $search ) ) );

        //publish unpublished filter
        $publish = array();
	  	$publish[] = JHTML::_('select.option', 'A', 'All' );
	  	$publish[] = JHTML::_('select.option', 'P', JText::_( 'Published' ) );
	  	$publish[] = JHTML::_('select.option', 'U', JText::_( 'Unpublished' ) );
        $lists['state']	= JHTML::_('select.genericlist', $publish, 'filter_state', 'size="1" class="inputbox" onchange="submitform();"', 'value', 'text', $filter_state );


        // table ordering
        $lists['order_Dir'] = $filter_order_Dir;
        $lists['order'] = $filter_order;

        //search filter
        $filters = array();
        $filters[] = JHTML::_('select.option', '1', JText::_( 'Title' ) );
        $filters[] = JHTML::_('select.option', '2', JText::_( 'Description' ) );
        $lists['filter'] = JHTML::_('select.genericlist', $filters, 'filter', 'size="1" class="inputbox"', 'value', 'text', $filter );

        // search filter
        $lists['search']= $search;

        //assign data to template
        $this->assignRef('lists', $lists);

        $this->assignRef('rows', $rows);
        $this->assignRef('pagination', $pagination);
        $this->assignRef('lists', $lists );

        parent::display($tpl);
    }
}
?>
