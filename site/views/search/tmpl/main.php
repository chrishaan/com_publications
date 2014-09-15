<?php
/**
* @version $Id: $
* @package	Joomla
* @subpackage publications
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::script('com_publications.js', 'components/com_publications/assets/');

?>

<h1 class="rbbn section10">Publications</h1>
<div class="section10">
<h3>Search for Publications</h3>
<form action="<?php echo JRoute::_('index.php?option=com_publications'); ?>" method="get" id="docsearch">
    <p style="font-size: 12px; color: #000000; margin-bottom: 0;">Search Options</p>
    <table class="searchform">
	<tr>
            <td>
                <label>
                        Topic:<br /><?php echo $this->alltopics; ?>
                </label>
            </td>
            <td>
                <label>
                        Type:<br /><?php echo $this->types; ?>
                </label>
            </td>
            <td>
                <label>
                        Year:<br /><?php echo $this->years; ?>
                </label>
            </td>
            <td>
                <label>
                        Keywords:<br /><input type="text" name="search" id="search" value="<?php echo $this->search; ?>" />
                </label>
            </td>
            <td>&nbsp;<br />
                <input type="submit" value="Go" id="submit" />
            </td>
        </tr>
    </table>
    <input type="hidden" name="layout" value="default" />
</form>

<h3>Looking for more information on these topics?</h3>
<p>The <a href="http://www.childwelfare.gov/" target="_blank">Child Welfare Information Gateway</a> provides comprehensive information and resources to help protect children and strengthen families. The Gateway features the latest on topics from prevention to permanency, including child abuse and neglect, foster care, and adoption.</p>
<h3>Looking for the latest child welfare news and resources?</h3>
<p>The Gateway offers <a href="http://www.childwelfare.gov/admin/subscribe/#page=subscriptions">free subscriptions</a> to such services as:</p>
<p><strong>Child Welfare in the News</strong> - Each day you receive a listing of news items of interest to child welfare workers, administrators, and related professionals.</p>

<p><strong>My Child Welfare Librarian</strong> - Provides emails once a month with publications and/or websites from the Information Gateway library based on topical selections that you select.</p>
<p><strong>Child Welfare Information Gateway E-lert! </strong><br />Highlights new publications and resources, distributed by the Gateway or featured on the Gateway website, on a variety of topics such as child abuse and neglect, prevention, and adoption. The monthly Child Welfare Information Gateway E-lert! includes the title of each new publication or resource, a descriptive summary, ordering information, and how to access it through the web.</p>
</div>
<br />
