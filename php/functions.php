<?php
    function cleanString($string) {
        $badWords = array('SELECT','select' ,'DROP','drop','TABLE','table','INSERT','insert','GROUP BY','group by');
        return trim(preg_replace('/[^A-Za-zà-úÀ-Ú0-9\@\#\.\,\s]/', '', str_replace($badWords, '', $string)));
    }

    function cleanNumber($string) {
        return preg_replace('/[^0-9\.\,]/', '', $string);
    }
