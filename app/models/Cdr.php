<?php


class Cdr extends \Eloquent  {


	protected $table = 'cdr';

	public static function get_by_did($did,$rangeDate1,$rangeDate2){

		if (!empty($did) ) {

				if (!empty($rangeDate1) && empty($rangeDate2)) {

				$recordingfile = Cdr::where('did',  $did)->whereRaw("date(calldate) = '" .  $rangeDate1 . "'");

			} else if (!empty($rangeDate1) && !empty($rangeDate2)) {

				$recordingfile = Cdr::where('did', $did)->whereRaw("calldate >= '" . $rangeDate1 . "'")->whereRaw("calldate <= '". $rangeDate2 . "'");

			}

			return $recordingfile->select(['recordingfile', 'calldate'])->get();
		}

		return false;
	}
}
