<?php
$userservice     =& ServiceFactory::getServiceInstance('UserService');
$bookmarkservice =& ServiceFactory::getServiceInstance('BookmarkService');

$logged_on_userid = $userservice->getCurrentUserId();
$this->includeTemplate($GLOBALS['top_include']);

include 'search.inc.php';
if (count($bookmarks) > 0) {
?>
<!---
<p id="sort">
  <?php #echo T_("sorteeri:"); ?>
  <a href="?sort=date_desc"><?php #echo T_("Kuupäev"); ?></a><span> / </span>
  <a href="?sort=title_asc"><?php #echo T_("Tiitel"); ?></a><span> / </span>
  <?php #if (!isset($hash)): ?>
    <a href="?sort=url_asc"><?php #echo T_("URL"); ?></a>
  <?php #endif; ?>
</p>
--->
<ol<?php echo ($start > 0 ? ' start="'. ++$start .'"' : ''); ?> id="bookmarks">

    <?php
    foreach(array_keys($bookmarks) as $key) {
        $row =& $bookmarks[$key];
        switch ($row['bStatus']) {
            case 0:
                $access = '';
                break;
            case 1:
                $access = ' shared';
                break;
            case 2:
                $access = ' private';
                break;
        }
/*ut8 teema*/
        $cats = '';
        $tags = $row['tags'];
        foreach(array_keys($tags) as $key) {
            $tag =& $tags[$key];
          $cats .= '<a class="sildid" href="'. sprintf($cat_url, filter($user, 'url'), filter($tag, 'url')) .'" rel="tag">'. filter($tag) .'</a>, ';
  #         $cats .= '<a class="sildid" href="'. sprintf($cat_url, filter($user, 'url'), filter($tag, 'url')) .'" rel="tag">'. $cat_url.'#'. $user.'#'. $tag.'</a>, ';
  
       }
        $cats = substr($cats, 0, -2);
        if ($cats != '') {
            $cats = '&nbsp;'. $cats;
        }

        // Edit and delete links
        $edit = '';
        if ($bookmarkservice->editAllowed($row['bId'])) {
            $edit = ' - <a href="'. createURL('edit', $row['bId']) .'">'. T_('muuda') .'</a><script type="text/javascript">document.write(" - <a href=\"#\" onclick=\"deleteBookmark(this, '. $row['bId'] .'); return false;\">'. T_('kustuta') .'<\/a>");</script>';
        }

        // User attribution
        $copy = '';
        if (!isset($user) || isset($watched)) {
            #$copy = ' '. T_('lisaja') .' <a href="'. createURL('bookmarks', $row['username']) .'">'. $row['username'] .'</a>';
        }

        // Udders!
        if (!isset($hash)) {
            $others = $bookmarkservice->countOthers($row['bAddress']);
            $ostart = '<a href="'. createURL('history', $row['bHash']) .'">';
            $oend = '</a>';
            switch ($others) {
                case 0:
                    break;
                case 1:
                    $copy .= sprintf(T_(' and %s1 other%s'), $ostart, $oend);
                    break;
                default:
                    $copy .= sprintf(T_(' and %2$s%1$s others%3$s'), $others, $ostart, $oend);
            }
        }

        // Copy link
        if ($userservice->isLoggedOn() && ($logged_on_userid != $row['uId'])) {
            // Get the username of the current user
            $currentUser = $userservice->getCurrentUser();
            $currentUsername = $currentUser[$userservice->getFieldName('username')];
            $copy .= ' - <a href="'. createURL('bookmarks', $currentUsername .'?action=add&amp;address='. urlencode($row['bAddress']) .'&amp;title='. urlencode($row['bTitle'])) .'">'. T_('Copy') .'</a>';   
        }

        // Nofollow option
        $rel = '';
        if ($GLOBALS['nofollow']) {
            $rel = ' rel="nofollow"';
        }

        $address = filter($row['bAddress']);
        
        // Redirection option
        if ($GLOBALS['useredir']) {
            $address = $GLOBALS['url_redir'] . $address;
        }
        
        // Output
        echo '<li class="xfolkentry'. $access .'">'."\n";
        echo '<div class="link"><a href="'. $address .'"'. $rel .' class="taggedlink">'. filter($row['bTitle']) ."</a></div>\n";
        if ($row['bDescription'] != '') {
            echo '<div class="lingiadre">'. filter($row['bAddress']) ."</div>\n";
	 echo '<div class="description">'. filter($row['bDescription']) ."</div>\n";
        }
       echo '<div class="meta">'. $cats . $copy . $edit ."</div>";
     #  echo '<div class="meta">'. date($GLOBALS['shortdate'], strtotime($row['bDatetime'])) . $cats . $copy . $edit ."</div>\n";
        echo "</li>\n";
    }
    ?>

</ol>

    <?php
    // PAGINATION
    
    // Ordering
    $sortOrder = '';
    if (isset($_GET['sort'])) {
        $sortOrder = 'sort='. $_GET['sort'];
    }
    
    $sortAmp = (($sortOrder) ? '&amp;'. $sortOrder : '');
    $sortQue = (($sortOrder) ? '?'. $sortOrder : '');
    
    // Previous
    $perpage = getPerPageCount();
    if (!$page || $page < 2) {
        $page = 1;
        $start = 0;
      #  $bfirst = '<span class="disable">'. T_('esimene') .'</span>';
       # $bprev = '<span class="disable">'. T_('viimane') .'</span>';
    } else {
        $prev = $page - 1;
        $prev = 'page='. $prev;
        $start = ($page - 1) * $perpage;
        $bfirst= '<a href="'. sprintf($nav_url, $user, $currenttag, '') . $sortQue .'">'. T_('esimene') .'</a>';
        $bprev = '<a href="'. sprintf($nav_url, $user, $currenttag, '?') . $prev . $sortAmp .'">'. T_('teine') .'</a>';
    }
    
    // Next
    $next = $page + 1;
    $totalpages = ceil($total / $perpage);
    if (count($bookmarks) < $perpage || $perpage * $page == $total) {
      #  $bnext = '<span class="disable">'. T_('edasi') .'</span>';
      # $blast = '<span class="disable">'. T_('tagasi') .'</span>';
       $bnext=  '<a href="'. sprintf($nav_url, $user, $currenttag, '?page=') . $next . $sortAmp .'">'. T_('kolmas') .'</a>';
       $blast=  '<a href="'. sprintf($nav_url, $user, $currenttag, '?page=') . $totalpages . $sortAmp .'">'. T_('neljas') .'</a>';

    } else {
        $bnext = '<a class="lehelingid" href="'. sprintf($nav_url, $user, $currenttag, '?page=') . $next . $sortAmp .'">'. T_('viies') .'</a>';
        $blast = '<a class="lehelingid"  href="'. sprintf($nav_url, $user, $currenttag, '?page=') . $totalpages . $sortAmp .'">'. T_('kuues') .'</a>';
    }
    echo '<p class="paging">'. $bfirst .'<span> / </span>'. $bprev .'<span> / </span>'. $bnext .'<span> / </span>'. $blast .'<span> / </span>'. sprintf(T_('Lehekülg %d / %d'), $page, $totalpages) .'</p>';
} else {
?>

    <p class="error"><?php echo T_('Aadresse pole'); ?>.</p>

<?php
}
$this->includeTemplate('sidebar.tpl');
$this->includeTemplate($GLOBALS['bottom_include']);
?>
