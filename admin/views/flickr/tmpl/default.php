<?php
/**
 * View template com_socialpromoter
 *
 * @version  1.1
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-29 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<h1>Flickr</h1>
<p class='lead'>This list contains your images that haven't been posted yet.</p>
<div id="social_promoter_alert"></div>
        <table class="table table-striped" id="articleList">
            <thead>
                <tr class="sortable">
                    <th width="1%" class="nowrap hidden-phone">
                        <?php echo JText::_('userid'); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JText::_('username'); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JText::_('friend'); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JText::_('button'); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JText::_('button'); ?>
                    </th>
                </tr>
            </thead>
        <?php $i=0; ?>
        <?php foreach ($this->items as $item) : ?>
                <tr id="row<?php echo $i; ?>">
                    <td>
                        <?php echo $item->nsid; ?>
                    </td>
                    <td>
                        <?php echo $item->username; ?>
                    </td>
                    <td>
                        <?php $userinfo = $this->model->getUserInfo($item->nsid); ?>
                        <?php print $userinfo->person->revcontact; ?>
                    </td>
                    <td>
                        <form id="unfollow<?php echo $i; ?>" name="unfollow<?php echo $i; ?>" action="">
                            <input type="hidden" name="option" value="com_followers" />
                            <input type="hidden" name="task" value="unfollow" />
                            <input type="hidden" name="format" value="raw" />
                            <input type="hidden" name="view" value="flickr" />
                            <input type="hidden" name="row" value="row<?php echo $i; ?>" />
                            <input type="hidden" name="nsid" value="<?php echo $item->nsid; ?>" />
                            <?php echo JHtml::_( 'form.token' ); ?>
                            <button type="submit" class="btn">Unfollow</button>
                        </form>
                    </td>
                    <td>
                        <form id="hideme<?php echo $i; ?>" name="hideme<?php echo $i; ?>" action="">
                            <input type="hidden" name="option" value="com_socialpromoter" />
                            <input type="hidden" name="task" value="hide" />
                            <input type="hidden" name="format" value="raw" />
                            <input type="hidden" name="view" value="queues" />
                            <input type="hidden" name="row" value="row<?php echo $i++; ?>" />
                            <?php echo JHtml::_( 'form.token' ); ?>
                            <button type="submit" class="btn">Hide</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
                </table>