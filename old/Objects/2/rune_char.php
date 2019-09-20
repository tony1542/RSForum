<?php

class runescape_user{

    public $gear2 = '';
    public $str2 = '';
    public $def2 = '';
    public $user2 = '';

    public function __construct($gear2, $str2, $def2, $user2) {

        $this->gear2 = $gear2;
        $this->str2 = $str2;
        $this->def2 = $def2;
        $this->user2 = $user2;
    }
    public function print_item2(){
        $gear2 = strtolower($this->gear2);
        $user2 = $this->user2;
        $gp2 = null;
        $can_buy2 = null;

        if($gear2 === 'dragon' && $user2 === 'Kize') {
            $gp2 = 96151880;
            $can_buy2 = 'X!, wtf way more than bandos';

        }
        if ($gear2 ==='iron' && $user2 === 'Kize'){
            $gp2 = 3746;
            $can_buy2 ="✓";
        }
        if ($gear2 === 'bronzet' && $user2 === 'Kize'){
            $gp2 = 23999;
            $can_buy2 = '✓';
        }
        echo "<h5>Gp Cost: $" . number_format($gp2, 2 ,'.', ',') . "</h5>";
        echo "<h5>Can Kize Buy this?: " . $can_buy2 . "</h5>";
    }
    public function help_kize_print_data(){
        echo "<h5>Gear : " . $this->gear2 . "</h5>";
        echo "<h5>Strength: " . $this->str2 . "</h5>";
        echo "<h5>Defence: " . $this->def2 . "</h5>";
    }
}


























