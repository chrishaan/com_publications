<?php
/**
 *
 * @version $Id:  $
 * @package Joomla
 * @subpackage statepages
 *
 * Publications Component for NRCYD
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include library dependencies
jimport('joomla.filter.input');

/**
* Table class
*
* @package          Joomla
* @subpackage		publications
*/
class TableDocuments extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	public $id = null;
	public $title = null;
	public $description = null;
	public $date = null;
	public $type_id = null;
	public $format_id = null;
	public $doc_url = null;
	public $img_url = null;
	public $hits = null;
	public $published = null;

    /**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	function __construct(& $db)
    {
        parent::__construct('#__pub_documents', 'id', $db);
    }

	/**
	 * Overloaded check method to ensure data integrity
	 *
	 * @access public
	 * @return boolean True on success
	 */
	function check() {
		return true;
	}

}
?>