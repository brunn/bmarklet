<?php
$this->includeTemplate($GLOBALS['top_include']);
?>

<form action="<?= $formaction ?>" method="post">
<p><?php echo T_('Oled sa kindel?'); ?></p>
<p>
    <input type="submit" name="confirm" value="<?php echo T_('Jah'); ?>" />
    <input type="submit" name="cancel" value="<?php echo T_('Ei'); ?>" />
</p>

<?php if (isset($referrer)): ?>
<div><input type="hidden" name="referrer" value="<?php echo $referrer; ?>" /></div>
<?php endif; ?>

</form>

<?php
$this->includeTemplate($GLOBALS['bottom_include']); 
?>
