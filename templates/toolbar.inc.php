<?php
$userservice =& ServiceFactory::getServiceInstance('UserService');
if ($userservice->isLoggedOn()) {
    $cUser = $userservice->getCurrentUser();
    $cUsername = $cUser[$userservice->getFieldName('username')];
?>

    <ul id="navigation">
 	<li><a href="http://brunn.ee">Bitikas</a></li>
	<li><a href="<?php echo 'https://github.com/brunn/bmarklet'; ?>" target="_blank">Github</a></li>
        <li><a href="<?php echo createURL('bookmarks', $cUsername); ?>"><?php echo T_('järjehoidjad'); ?></a></li>
        <li><a href="<?php echo createURL('watchlist', $cUsername); ?>"><?php echo T_('nimekiri'); ?></a></li>
        <li><a href="<?php echo createURL('bookmarks', $cUsername . '?action=add'); ?>"><?php echo T_('Lisa'); ?></a></li>
 	<li><a href="<?php echo createURL('populartags'); ?>"><?php echo T_('sildid'); ?></a></li>
 	<li><a href="<?php echo createURL('profile', $cUsername); ?>"><?php echo T_('profiil'); ?></a></li>
        <li><a href="<?php echo $GLOBALS['root']; ?>?action=logout"><?php echo T_('välju'); ?></a></li>
    </ul>

<?php
} else {
?>

    <ul id="navigation">
     <!---   <li><a href="<?php echo createURL('about'); ?>"><?php echo T_('lehest'); ?></a></li>--->

 	<li><a href="<?php #echo 'http://brunn.ee'; ?>"><?php #echo 'Bitikas'; ?></a></li>
	<li><a href="<?php #echo 'https://github.com/brunn/bmarklet'; ?>" target="_blank"><?php #echo 'Github'; ?></a></li>
        <li><a href="<?php echo createURL('populartags'); ?>"><?php echo T_('sildid'); ?></a></li>
        <li><a href="<?php echo createURL('login'); ?>"><?php echo T_('sisene'); ?></a></li>
        <li><a href="<?php #echo createURL('register'); ?>"><?php #echo T_('registreeru'); ?></a></li>
    </ul>

<?php
}
?>
