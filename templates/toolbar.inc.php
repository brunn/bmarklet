<?php
$userservice =& ServiceFactory::getServiceInstance('UserService');
if ($userservice->isLoggedOn()) {
    $cUser = $userservice->getCurrentUser();
    $cUsername = $cUser[$userservice->getFieldName('username')];
?>

    <ul id="navigation">
        <li><a href="<?php echo createURL('bookmarks', $cUsername); ?>"><?php echo T_('järjehoidjad'); ?></a></li>
        <li><a href="<?php echo createURL('watchlist', $cUsername); ?>"><?php echo T_('nimekiri'); ?></a></li>
        <li><a href="<?php echo createURL('bookmarks', $cUsername . '?action=add'); ?>"><?php echo T_('Lisa järjehoidja'); ?></a></li>
        <li class="access"><a href="<?php echo $GLOBALS['root']; ?>?action=logout"><?php echo T_('Välju'); ?></a></li>
    </ul>

<?php
} else {
?>

    <ul id="navigation">
        <li><a href="<?php echo createURL('about'); ?>"><?php echo T_('lehest'); ?></a></li>
        <li class="access"><a href="<?php echo createURL('login'); ?>"><?php echo T_('logi sisse'); ?></a></li>
        <li class="access"><a href="<?php echo createURL('register'); ?>"><?php echo T_('registreeru'); ?></a></li>
    </ul>

<?php
}
?>
