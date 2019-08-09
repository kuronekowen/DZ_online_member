<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {	
    exit('Access Denied');	
}

global $_G;
loadcache('onlinerecord');
$onlinerecord = explode("\t", $_G['cache']['onlinerecord']);
$onlinenum = $onlinerecord[0];
$onlinedate = dgmdate($onlinerecord[1], 'Y-m-d');

if (submitcheck('ly_submit')) {

    $onlinenum = intval($_GET['pcu']);
    $onlinetime = intval(strtotime($_GET['onlinedate'])) + mt_rand(0,86400);
    $onlinerecord = "$onlinenum\t".$onlinetime;
    savecache('onlinerecord', $onlinerecord);
    C::t('common_setting')->update('onlinerecord', $onlinerecord);
    cpmsg(lang('plugin/pin_pcu', 'ly_tips_succeed'), cpurl(false), 'succeed');
    
}

showformheader('plugins&operation=config&do=' . $pluginid . '&identifier=' . $_GET['identifier'] . '&pmod=' . $_GET['pmod'], '', 'lysubmit');
showtableheader(lang('plugin/pin_pcu', 'ly_set'));
showsetting(lang('plugin/pin_pcu', 'ly_pcu'), 'pcu', $onlinenum, 'number', 0, 0,lang('plugin/pin_pcu', 'ly_pcutips'));
echo '<script src="static/js/calendar.js"></script>';
showsetting(lang('plugin/pin_pcu', 'ly_pcudate'), 'onlinedate', $onlinedate, 'calendar', 0, 0,lang('plugin/pin_pcu', 'ly_pcudatetips'));
showsubmit('ly_submit',lang('plugin/pin_pcu', 'ly_pcusub'));
showtablefooter();
showformfooter();



?>