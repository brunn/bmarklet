<?php $this->includeTemplate($GLOBALS['top_include']); ?>

<form action="<?php echo $formaction; ?>" method="post">
    <div><input type="hidden" name="query" value="<?php echo $querystring; ?>" /></div>
    <table>
    <tr>
        <th align="left"><label for="username"><?php echo T_('Kasutajanimi'); ?></label></th>
        <td><input type="text" id="username" name="username" size="20" value="<?php echo htmlentities($_POST['username']); ?>" /></td>
        <td></td>
    </tr>
    <tr>
        <th align="left"><label for="password"><?php echo T_('Parool'); ?></label></th>
        <td><input type="password" id="password" name="password" size="20" /></td>
        <td><label><input type="checkbox" name="keeppass" value="yes" /> <?php echo T_("Ära küsi minult parooli 2 nädalat"); ?>.</label></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="submitted" value="<?php echo T_('Logi sisse'); ?>" /></td>
        <td></td>
    </tr>
    </table>
    <p>&raquo; <a href="<?php echo $GLOBALS['root'] ?>password.php"><?php echo T_('Unustasid parooli?') ?></p>
</form>
<script type="text/javascript">
$(function() {
  $("#username").focus();
});
</script>

<?php $this->includeTemplate($GLOBALS['bottom_include']); ?>
