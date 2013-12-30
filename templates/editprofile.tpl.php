<?php
$this->includeTemplate($GLOBALS['top_include']);
?>

<form action="<?php echo $formaction; ?>" method="post">

<h3><?php echo T_('Konto detailid'); ?></h3>

<table class="profile">
<tr>
    <th align="left"><?php echo T_('Kasutajanimi'); ?></th>
    <td><?php echo $user; ?></td>
    <td></td>
</tr>
<tr>
    <th align="left"><?php echo T_('Uus parool'); ?></th>
    <td><input type="password" name="pPass" size="20" /></td>
    <td></td>
</tr>
<tr>
    <th align="left"><?php echo T_('Korda parooli'); ?></th>
    <td><input type="password" name="pPassConf" size="20" /></td>
    <td></td>
</tr>
<tr>
    <th align="left"><?php echo T_('E-mail'); ?></th>
    <td><input type="text" name="pMail" size="75" value="<?php echo filter($row['email'], 'xml'); ?>" /></td>
    <td>&larr; <?php echo T_('Vajalik'); ?></td>
</tr>
</table>

<h3><?php echo T_('Personaalne info'); ?></h3>

<table class="profile">
<tr>
    <th align="left"><?php echo T_('Nimi'); ?></th>
    <td><input type="text" name="pName" size="75" value="<?php echo filter($row['name'], 'xml'); ?>" /></td>
</tr>
<tr>
    <th align="left"><?php echo T_('Koduleht'); ?></th>
    <td><input type="text" name="pPage" size="75" value="<?php echo filter($row['homepage'], 'xml'); ?>" /></td>
</tr>
<tr>
    <th align="left"><?php echo T_('Kirjeldus'); ?></th>
    <td><textarea name="pDesc" cols="75" rows="10"><?php echo $row['uContent']; ?></textarea></td>
</tr>
<tr>
    <th></th>
    <td><input type="submit" name="submitted" value="<?php echo T_('Salvesta muudatused'); ?>" /></td>
</tr>
</table>
</form>

<?php
$this->includeTemplate($GLOBALS['bottom_include']);
?>
