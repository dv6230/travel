<?php

class backstage
{

    protected $bkary = array();

    function __construct()
    {
        $bkary[] = array('center', 'profile/profile_center.php', '0');
        $bkary[] = array('order', 'profile/profile_order.php', '0');
        $bkary[] = array('history', 'profile/profile_history.php', '0');
        $bkary[] = array('else', 'profile/profile_else.php', '1');
        $bkary[] = array('person', 'profile/profile_person.php', '0');
    }

    function getbackstage($type, $auth)
    {
        $go_web = 'profile/profile_center.php';
        //(重要) 類別內的方法，如果要取用 CLASS 內的 參數 ， 需要用 $this->參數名稱
        foreach ($this->bkary as $value) {

            if ($type == 'else' && $auth < 1) break;
            if (in_array($type, $value)) {
                $go_web = $value[1];
            }
        }
        return $go_web;
    }
}
