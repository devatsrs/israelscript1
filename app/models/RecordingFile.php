<?php

/**
 * Created by PhpStorm.
 * User: DEVEN
 * Date: 29-11-2018
 * Time: 04:24 PM
 */
class RecordingFile
{

    // /var/spool/asterisk/monitor/${year}/${month}/day/hour/recordingfile

    public  static function get_full_path($date, $filename){

        $year = date('Y',strtotime($date));
        $month = date('m',strtotime($date));
        $day = date('d',strtotime($date));
        $hour = date('H',strtotime($date));

        $find = ["{year}" , "{month}" , "{day}" , "{hour}"];
        $replace = [$year , $month , $day , $hour];

        $full_path = getenv("RECORDING_FILE_LOCATION2") . '/' . $filename;
        return str_replace($find,$replace,$full_path);

    }

}