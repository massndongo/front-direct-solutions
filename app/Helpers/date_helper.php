<?php


function date_en2fr($date,$type): string
{
    if(!isset($date) || empty($date)){
        return '';
    }
    switch ($type){
        case 1: // Date initial format "YYYY-MM-DD"
            $_tabs = explode('-',$date);
            $finalDate = $_tabs[2].'/'.$_tabs[1].'/'.$_tabs[0];
            break;
        case 2: // Date initial format "YYYY-MM-DD HH:II:SS"
            $_tabs = explode('-',$date);
            $_tab  = explode(" ",$_tabs[2]);
            $finalDate = $_tab[0].'/'.$_tabs[1].'/'.$_tabs[0]." ".$_tab[1];
            break;
        case 3: // Date initial format "YYYY-MM-DD HH:II:SS"
            $_tabs = explode('-',$date);
            $_tab  = explode(" ",$_tabs[2]);
            $finalDate = $_tab[0].' '.months_abr($_tabs[1]).', '.$_tabs[0]." à ". substr($_tab[1], 0, 5);
            break;
        case 4: // Date initial format "YYYY-MM-DD"
            $_tabs = explode('-',$date);
            $finalDate = $_tabs[2].' '.months_abr($_tabs[1]).', '.$_tabs[0];
            break;
        default:
            $finalDate = "";
    }
    return $finalDate;
}



function date_fr2en($date,$type): string
{
    if(!isset($date) || empty($date)){
        return '';
    }
    switch ($type){
        case 1: // Date initial format "DD/MM/YYYY"
            $_tabs = explode('/',$date);
            $finalDate = $_tabs[2].'-'.$_tabs[1].'-'.$_tabs[0];
            break;
        case 2: // Date initial format "DD/MM/YYYY HH:II:SS"
            $_tabs = explode('/',$date);
            $_tab  = explode(" ",$_tabs[2]);
            $finalDate = $_tab[0].'-'.$_tabs[1].'-'.$_tabs[0]." ".$_tab[1];
            break;
        default:
            $finalDate = "";
    }
    return $finalDate;
}

/* Abreviation des mois */
if(!function_exists('month')) {
    function month($month, $unit = false)
    {
        $months = array(
            '01' => "Janvier",
            '02' => "Fevrier",
            '03' => "Mars",
            '04' => "Avril",
            '05' => "Mai",
            '06' => "Juin",
            '07' => "Juillet",
            '08' => "Août",
            '09' => "Septembre",
            '10' => "Octobre",
            '11' => "Novembre",
            '12' => "Décembre"
        );

        if (!$unit) {
            $index = str_pad($month, 2, '0', STR_PAD_LEFT);
            if (isset($months[$index]))
                $month = $months[$index];
            else
                $month = '';
            return $month;
        }
        else{
            return $months;
        }
    }
}

/* Abreviation des mois */
if(!function_exists('months_abr')) {
    function months_abr($month)
    {
        $months = array(
            '01' => "JAN",
            '02' => "FEV",
            '03' => "MAR",
            '04' => "AVR",
            '05' => "MAI",
            '06' => "JUI",
            '07' => "JUIL",
            '08' => "AOU",
            '09' => "SEP",
            '10' => "OCT",
            '11' => "NOV",
            '12' => "DÉC"
        );

        $index = str_pad($month, 2, '0', STR_PAD_LEFT);
        if (isset($months[$index]))
            $month = $months[$index];
        else
            $month = '';

        return $month;
    }
}
/**
 * @param $currentDate: Date au format "YYYY-MM-DD HH:MM:SS"
 * @return array : currentMonth(YYYY-MM), lastMonth(YYYY-MM)
 */
if(!function_exists('last_month')){
    function last_month($currentDate){ // currentDate : '
        $date = new DateTime($currentDate);
        $_date = $date->modify("-1 month");
        $lastDate = $_date->format('Y-m-d');
        return ['currentMonth'=>substr($currentDate,0,7),'lastMonth'=>substr($lastDate,0,7)];
    }
}

if(!function_exists('convert_years')){
    function convert_years($years){
        $_currentTime = time();
        $_yearsTime   = $_currentTime+($years*365*24*60*60);
        $_currentDate = date_create(date('Y-m-d',$_currentTime));
        $_yearsDate   = date_create(date('Y-m-d',$_yearsTime));
        $diff = date_diff($_yearsDate,$_currentDate);
        return $diff->format('%y ans %m mois %d jours');
    }
}
if(!function_exists('convert_timestamp')){
    function convert_timestamp($date,$type=1){
        $source = DateTime::createFromFormat((int)$type=== 1 ? "Y-m-d":"Y-m-d H:i:s",$date,new DateTimeZone('UTC'));
        return $source!= false ? $source->getTimestamp():0;
    }
}
if(!function_exists('serviceIsValid')){
    function serviceIsValid($toDay,$dateCompare,$type=1){
        $_toDay = convert_timestamp($toDay,$type);
        $_dateCompare = convert_timestamp($dateCompare,$type);
        return $_toDay<$_dateCompare ? true:false;
    }
}

if(!function_exists('convert_milliseconds')){
    function convert_milliseconds($date){
        $source = new DateTime($date);
        return $source->format('Uv');
    }
}