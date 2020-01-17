<?php
class Tanggal {
    function indo($value) {
        $tanggal    = substr($value,8,2);
		$bulan      = $this->BulanIndo(substr($value,5,2));
		$tahun      = substr($value,0,4);
		return $tanggal.' '.$bulan.' '.$tahun;
    }

    function BulanIndo($bln) {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }

    function english($value) {
        $tanggal    = $this->TanggalEnglish(substr($value,8,2));
		$bulan      = $this->BulanEnglish(substr($value,5,2));
		$tahun      = substr($value,0,4);
		return $bulan.' '.$tanggal.', '.$tahun;
    }

    function BulanEnglish($bln) {
		switch ($bln) {
			case 1:
			    return "Jan";
			    break;
			case 2:
				return "Feb";
				break;
			case 3:
				return "Mar";
				break;
			case 4:
				return "Apr";
				break;
			case 5:
				return "May";
				break;
			case 6:
				return "Jun";
				break;
			case 7:
				return "Jul";
				break;
			case 8:
				return "Aug";
				break;
			case 9:
				return "Sep";
				break;
			case 10:
				return "Oct";
				break;
			case 11:
				return "Nov";
				break;
			case 12:
				return "Dec";
				break;
		}
	}

    function TanggalEnglish($tgl) {
		switch ($tgl) {
			case 1:
				return "1st";
				break;
			case 2:
				return "2nd";
				break;
			case 3:
				return "3rd";
				break;
			case 4:
				return "4th";
				break;
		    case 5:
				return "5th";
				break;
			case 6:
				return "6th";
				break;
			case 7:
				return "7th";
				break;
			case 8:
				return "8th";
				break;
			case 9:
				return "9th";
				break;
			case 10:
				return "10th";
				break;
			case 11:
				return "11th";
				break;
			case 12:
				return "12th";
				break;
			case 13:
				return "13th";
				break;
			case 14:
				return "14th";
				break;
			case 15:
				return "15th";
				break;
			case 16:
				return "16th";
				break;
			case 17:
				return "17th";
				break;
			case 18:
				return "18th";
				break;
			case 19:
				return "19th";
				break;
			case 20:
				return "20th";
                case 21:
				break;
				return "21st";
				break;
			case 22:
				return "22nd";
				break;
			case 23:
				return "23rd";
				break;
			case 24:
				return "24th";
				break;
			case 25:
				return "25th";
				break;
			case 26:
				return "26th";
				break;
			case 27:
				return "27th";
				break;
			case 28:
				return "28th";
				break;
			case 29:
				return "29th";
				break;
			case 30:
				return "30th";
				break;
			case 31:
				return "31st";
				break;
		}
	}
}
