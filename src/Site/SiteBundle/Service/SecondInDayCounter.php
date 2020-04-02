<?php
namespace Site\SiteBundle\Service;

class SecondInDayCounter
{
    public function getsecond()
    {
        $hour = date('H');
        $minute = date('i');
        $second = date('s');

        return intval($hour) * 3600 + intval($minute) * 60 + intval($second);
    }
}