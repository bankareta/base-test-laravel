<?php
namespace App\Libraries;

use App\Models\Design\Acara;
use Carbon\Carbon;

class Helpers
{
    public static function upload_file($file, $folder='default'){
		$result    = '';
		$file_name = '';

    	if($file){
			$file_name = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$date      = date('H:i:s');
	    	$result = $file->storeAs('public/'.$folder, md5($file_name . $date).'.'.$extension);
    	}

    	$data = [
			'url'       => str_replace('public/', '', $result),
			'file_name' => $file_name
    	];

    	return $data;
    }

    public static function convertfilesize($induction = null)
    {
        $size = ini_get('upload_max_filesize');

        switch(substr($size, -1))
        {
            case 'G': $return = (int)rtrim($size,substr($size, -1)).'000000000';
            break;
            case 'M': $return = (int)rtrim($size,substr($size, -1)).'000000';
            break;
            default : $return = (int)$size;
            break;
        }

        return $return;
    }

    public static function changeNumber($telp)
    {
        $nomorhp = trim($telp);
        $nomorhp = strip_tags($nomorhp);     
        $nomorhp= str_replace(" ","",$nomorhp);
        $nomorhp= str_replace("(","",$nomorhp);
        $nomorhp= str_replace(".","",$nomorhp); 
        if(!preg_match('/[^+0-9]/',trim($nomorhp))){
            if(substr(trim($nomorhp), 0, 3)=='+62'){
                $nomorhp= trim($nomorhp);
            }
            elseif(substr($nomorhp, 0, 1)=='0'){
                $nomorhp= '+62'.substr($nomorhp, 1);
            }
        }
        return str_replace(str_split('+- '), '', $nomorhp);
    }
    
    public static function nummonth($j)
    {
        switch($j)
        {
            case 1: return 'jan';
            break;
            case 2: return 'feb';
            break;
            case 3: return 'mar';
            break;
            case 4: return 'apr';
            break;
            case 5: return 'may';
            break;
            case 6: return 'jun';
            break;
            case 7: return 'jul';
            break;
            case 8: return 'aug';
            break;
            case 9: return 'sep';
            break;
            case 10: return 'oct';
            break;
            case 11: return 'nov';
            break;
            case 12: return 'dec';
            break;
        }
    }

    public static function DateToStringAbb($date) {
        if(!$date)
        {
            return '-';
        }
        $date = \Carbon\Carbon::parse($date)->format('Y-m-d');
        $pecah = explode("-", $date);
        $thnStr = $pecah[0];
        $tglStr = $pecah[2].",";
        $blnStr = "";
        switch ($pecah[1])
        {
            case '01': $blnStr = 'Jan';
            break;
            case '02': $blnStr = 'Feb';
            break;
            case '03': $blnStr = 'Mar';
            break;
            case '04': $blnStr = 'Apr';
            break;
            case '05': $blnStr = 'Mei';
            break;
            case '06': $blnStr = 'Jun';
            break;
            case '07': $blnStr = 'Jul';
            break;
            case '08': $blnStr = 'Aug';
            break;
            case '09': $blnStr = 'Sept';
            break;
            case '10': $blnStr = 'Oct';
            break;
            case '11': $blnStr = 'Nov';
            break;
            case '12': $blnStr = 'Dec';
            break;
        }
        return $tglStr." ".$blnStr." ".$thnStr;
    }

    public static function DateToStringAcc($date) {
        if(!$date)
        {
            return '-';
        }
        $date = \Carbon\Carbon::parse($date)->format('Y-m-d');
        $pecah = explode("-", $date);
        $thnStr = $pecah[0];
        $tglStr = $pecah[2].",";
        $blnStr = "";
        switch ($pecah[1])
        {
            case '01': $blnStr = 'January';
            break;
            case '02': $blnStr = 'February';
            break;
            case '03': $blnStr = 'March';
            break;
            case '04': $blnStr = 'April';
            break;
            case '05': $blnStr = 'May';
            break;
            case '06': $blnStr = 'June';
            break;
            case '07': $blnStr = 'July';
            break;
            case '08': $blnStr = 'August';
            break;
            case '09': $blnStr = 'September';
            break;
            case '10': $blnStr = 'October';
            break;
            case '11': $blnStr = 'November';
            break;
            case '12': $blnStr = 'December';
            break;
        }
        return $tglStr." ".$blnStr.",".$thnStr;
    }

    public static function detail_news($value, $maxLength = 150, $id, $link = '#')
    {
        $return = Helpers::textarea($value);
        if (strlen($value) > $maxLength) {
            $return = substr(Helpers::textarea($value), 0, $maxLength);
            $readmore = substr(Helpers::textarea($value), $maxLength);

            $return .= '<a href="'.$link.'" class="read-more text-info">&nbsp;&nbsp;Read More...</a>';
        }else{
        	 $return .= '<a href="'.$link.'" class="read-more text-info">&nbsp;&nbsp;Read More...</a>';
        }
        return $return;
    }

    public static function textarea($text)
	{
		$new = '';

		$new = str_replace("\n", "<br>", $text);

		return $new;
	}

    public static function download_file($path, $filename = ''){
        switch (pathinfo(base64_decode($path), PATHINFO_EXTENSION)) {
            case 'pdf':
                return response()->make(file_get_contents(asset('storage/'.base64_decode($path))), 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="'.$filename.'"'
                    ]);
            break;

            case 'gif':
                return response()->make(file_get_contents(asset('storage/'.base64_decode($path))), 200, [
                    'Content-Type' => 'image/gif',
                    'Content-Disposition' => 'inline; filename="'.$filename.'"'
                    ]);
            break;
            case 'png':
                return response()->make(file_get_contents(asset('storage/'.base64_decode($path))), 200, [
                    'Content-Type' => 'image/png',
                    'Content-Disposition' => 'inline; filename="'.$filename.'"'
                    ]);
            break;
            case 'jpeg':
                return response()->make(file_get_contents(asset('storage/'.base64_decode($path))), 200, [
                    'Content-Type' => 'image/jpeg',
                    'Content-Disposition' => 'inline; filename="'.$filename.'"'
                    ]);
            break;
            case 'jpg':
                return response()->make(file_get_contents(asset('storage/'.base64_decode($path))), 200, [
                    'Content-Type' => 'image/jpg',
                    'Content-Disposition' => 'inline; filename="'.$filename.'"'
                    ]);
            break;
            case 'svg':
                return response()->make(file_get_contents(asset('storage/'.base64_decode($path))), 200, [
                    'Content-Type' => 'image/svg+xml',
                    'Content-Disposition' => 'inline; filename="'.$filename.'"'
                    ]);
            break;

            default:
                return response()->download(storage_path().'/app/public/'.base64_decode($path),$filename);
            break;
        }
    }

    public static function formatDateToMysql($date)
    {
    	return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }

    public static function trelloLog($msg)
    {
        $msg = date('Y-m-d H:i:s') . ' ' . $msg;

        $fp = fopen(storage_path('logs/trello.log'), 'a');
        fwrite($fp, $msg);
        fwrite($fp, "\n\n");
        fclose($fp);
    }

    public static function DateTimeToSql($date) {
        if($date != NULL)
        {
            $pecah = explode(" ", $date);
            $tglStr = str_replace(",", "", $pecah[1]);
            if(strlen($tglStr) == 1)
            {
                $tglStr = "0".$tglStr;
            }
            $thnStr = $pecah[2];
            $blnStr = "";
            switch ($pecah[0])
            {
                case 'January': $blnStr = '01';
                break;
                case 'February': $blnStr = '02';
                break;
                case 'March': $blnStr = '03';
                break;
                case 'April': $blnStr = '04';
                break;
                case 'May': $blnStr = '05';
                break;
                case 'June': $blnStr = '06';
                break;
                case 'July': $blnStr = '07';
                break;
                case 'August': $blnStr = '08';
                break;
                case 'September': $blnStr = '09';
                break;
                case 'October': $blnStr = '10';
                break;
                case 'November': $blnStr = '11';
                break;
                case 'December': $blnStr = '12';
                break;
            }
            return $thnStr."-".$blnStr."-".$tglStr." ".$pecah[3].":00";
        }else{
            return NULL;
        }
    }

    public static function DateToString($date) {
        if(!isset($date) || $date == '-')
        {
            return '-';
        }

        $tgl = $date->format('Y-m-d');
        $pecah = explode("-", $tgl);
        $thnStr = $pecah[0];
        $tglStr = $pecah[2].",";
        $blnStr = "";
        switch ($pecah[1])
        {
            case '01': $blnStr = 'January';
            break;
            case '02': $blnStr = 'February';
            break;
            case '03': $blnStr = 'March';
            break;
            case '04': $blnStr = 'April';
            break;
            case '05': $blnStr = 'May';
            break;
            case '06': $blnStr = 'June';
            break;
            case '07': $blnStr = 'July';
            break;
            case '08': $blnStr = 'August';
            break;
            case '09': $blnStr = 'September';
            break;
            case '10': $blnStr = 'October';
            break;
            case '11': $blnStr = 'November';
            break;
            case '12': $blnStr = 'December';
            break;
        }
        return $blnStr." ".$tglStr." ".$thnStr;
    }

    public static function DateToStringWtime($date) {
        if(!isset($date))
        {
            return '-';
        }
        $date = Carbon::parse($date);
        $tgl = $date->format('Y-m-d');
        $pecah = explode("-", $tgl);
        $thnStr = $pecah[0];
        $tglStr = $pecah[2].",";
        $blnStr = "";
        switch ($pecah[1])
        {
            case '01': $blnStr = 'January';
            break;
            case '02': $blnStr = 'February';
            break;
            case '03': $blnStr = 'March';
            break;
            case '04': $blnStr = 'April';
            break;
            case '05': $blnStr = 'May';
            break;
            case '06': $blnStr = 'June';
            break;
            case '07': $blnStr = 'July';
            break;
            case '08': $blnStr = 'August';
            break;
            case '09': $blnStr = 'September';
            break;
            case '10': $blnStr = 'October';
            break;
            case '11': $blnStr = 'November';
            break;
            case '12': $blnStr = 'December';
            break;
        }
        return $blnStr." ".$tglStr." ".$thnStr." - ".$date->format('H:i:s');
    }

    public static function DateToStringWtimeIndo($date) {
        if(!isset($date))
        {
            return '-';
        }
        $date = Carbon::parse($date);
        $tgl = $date->format('Y-m-d');
        $pecah = explode("-", $tgl);
        $thnStr = $pecah[0];
        $tglStr = $pecah[2].",";
        $blnStr = "";
        switch ($pecah[1])
        {
            case '01': $blnStr = 'Januari';
            break;
            case '02': $blnStr = 'Februari';
            break;
            case '03': $blnStr = 'Maret';
            break;
            case '04': $blnStr = 'April';
            break;
            case '05': $blnStr = 'Mei';
            break;
            case '06': $blnStr = 'Juni';
            break;
            case '07': $blnStr = 'Juli';
            break;
            case '08': $blnStr = 'Agustus';
            break;
            case '09': $blnStr = 'September';
            break;
            case '10': $blnStr = 'Oktober';
            break;
            case '11': $blnStr = 'November';
            break;
            case '12': $blnStr = 'Desember';
            break;
        }
        return str_replace(',','',$tglStr)." ".$blnStr." ".$thnStr." - ".$date->format('H:i');
    }

    public static function DateParse($date) {
        if(!$date)
        {
            return '-';
        }
        $pecah = explode("-", $date);
        $thnStr = $pecah[0];
        $tglStr = $pecah[2].",";
        $blnStr = "";
        switch ($pecah[1])
        {
            case '01': $blnStr = 'January';
            break;
            case '02': $blnStr = 'February';
            break;
            case '03': $blnStr = 'March';
            break;
            case '04': $blnStr = 'April';
            break;
            case '05': $blnStr = 'May';
            break;
            case '06': $blnStr = 'June';
            break;
            case '07': $blnStr = 'July';
            break;
            case '08': $blnStr = 'August';
            break;
            case '09': $blnStr = 'September';
            break;
            case '10': $blnStr = 'October';
            break;
            case '11': $blnStr = 'November';
            break;
            case '12': $blnStr = 'December';
            break;
        }
        return $blnStr." ".$tglStr." ".$thnStr;
    }

    public static function DateToStringWday($date) {
        if(!$date)
        {
            return '-';
        }
        $tgl = $date->format('Y-m-d');
        $pecah = explode("-", $tgl);
        $thnStr = $pecah[0];
        $tglStr = $pecah[2].",";
        $blnStr = "";
        switch ($pecah[1])
        {
            case '01': $blnStr = 'January';
            break;
            case '02': $blnStr = 'February';
            break;
            case '03': $blnStr = 'March';
            break;
            case '04': $blnStr = 'April';
            break;
            case '05': $blnStr = 'May';
            break;
            case '06': $blnStr = 'June';
            break;
            case '07': $blnStr = 'July';
            break;
            case '08': $blnStr = 'August';
            break;
            case '09': $blnStr = 'September';
            break;
            case '10': $blnStr = 'October';
            break;
            case '11': $blnStr = 'November';
            break;
            case '12': $blnStr = 'December';
            break;
        }
        return DayOf($date)." / ".$blnStr." ".$tglStr." ".$thnStr;
    }

    public static function DateToSql($date) {
        if($date != NULL)
        {
            $pecah = explode(" ", $date);
            $tglStr = str_replace(",", "", $pecah[1]);
            if(strlen($tglStr) == 1)
            {
                $tglStr = "0".$tglStr;
            }
            $thnStr = $pecah[2];
            $blnStr = "";
            switch ($pecah[0])
            {
                case 'January': $blnStr = '01';
                break;
                case 'February': $blnStr = '02';
                break;
                case 'March': $blnStr = '03';
                break;
                case 'April': $blnStr = '04';
                break;
                case 'May': $blnStr = '05';
                break;
                case 'June': $blnStr = '06';
                break;
                case 'July': $blnStr = '07';
                break;
                case 'August': $blnStr = '08';
                break;
                case 'September': $blnStr = '09';
                break;
                case 'October': $blnStr = '10';
                break;
                case 'November': $blnStr = '11';
                break;
                case 'December': $blnStr = '12';
                break;
            }
            return $thnStr."-".$blnStr."-".$tglStr;
        }else{
            return NULL;
        }
    }

    public static function formatEnMonth($bulan) {
        $blnInt = 0;
        switch ($bulan)
        {
            case 'January': $blnInt = 'January';
            break;
            case 'February': $blnInt = 'February';
            break;
            case 'March': $blnInt = 'March';
            break;
            case 'April': $blnInt = 'April';
            break;
            case 'May': $blnInt = 'May';
            break;
            case 'June': $blnInt = 'June';
            break;
            case 'July': $blnInt = 'July';
            break;
            case 'August': $blnInt = 'August';
            break;
            case 'September': $blnInt = 'September';
            break;
            case 'October': $blnInt = 'October';
            break;
            case 'November': $blnInt = 'November';
            break;
            case 'December': $blnInt = 'December';
            break;
        }

        return $blnInt;
    }

      public static function formatNumMonth($bulan) {
        $blnInt = 0;
        switch ($bulan)
        {
            case '1': $blnInt = 'January';
            break;
            case '2': $blnInt = 'February';
            break;
            case '3': $blnInt = 'March';
            break;
            case '4': $blnInt = 'April';
            break;
            case '5': $blnInt = 'May';
            break;
            case '6': $blnInt = 'June';
            break;
            case '7': $blnInt = 'July';
            break;
            case '8': $blnInt = 'August';
            break;
            case '9': $blnInt = 'September';
            break;
            case '10': $blnInt = 'October';
            break;
            case '11': $blnInt = 'November';
            break;
            case '12': $blnInt = 'December';
            break;
            case '13': $blnInt = 'Year To Date';
            break;
        }

        return $blnInt;
    }

    public static function DiffMnY($bulan, $tahun) {
        $start = Carbon::parse('first day of '.$bulan.' '.$tahun);
        $end = Carbon::parse('last day of '.$bulan.' '.$tahun);

        return $start->diffInDays($end);
    }

    public static function DateToStringNow($date) {
        if(!isset($date))
        {
            return '-';
        }
        $tgl = $date;
        $pecah = explode("-", $tgl);
        $thnStr = $pecah[0];
        $tglStr = $pecah[2].",";
        $blnStr = "";
        switch ($pecah[1])
        {
            case '01': $blnStr = 'January';
            break;
            case '02': $blnStr = 'February';
            break;
            case '03': $blnStr = 'March';
            break;
            case '04': $blnStr = 'April';
            break;
            case '05': $blnStr = 'May';
            break;
            case '06': $blnStr = 'June';
            break;
            case '07': $blnStr = 'July';
            break;
            case '08': $blnStr = 'August';
            break;
            case '09': $blnStr = 'September';
            break;
            case '10': $blnStr = 'October';
            break;
            case '11': $blnStr = 'November';
            break;
            case '12': $blnStr = 'December';
            break;
        }
        return $blnStr." ".$tglStr." ".$thnStr;
    }

    public static function formatManPowerMonth($bulan) {
        $blnInt = '-';
        switch ($bulan)
        {
            case '1': $blnInt = 'jan';
            break;
            case '2': $blnInt = 'feb';
            break;
            case '3': $blnInt = 'mar';
            break;
            case '4': $blnInt = 'apr';
            break;
            case '5': $blnInt = 'may';
            break;
            case '6': $blnInt = 'jun';
            break;
            case '7': $blnInt = 'jul';
            break;
            case '8': $blnInt = 'aug';
            break;
            case '9': $blnInt = 'sep';
            break;
            case '10': $blnInt = 'oct';
            break;
            case '11': $blnInt = 'nov';
            break;
            case '12': $blnInt = 'dec';
            break;
        }

        return $blnInt;
    }

    public static function changeNumberToMoney($number){
        return $hasil_rupiah = number_format($number,0,',','.');

    }
    public static function colorIndikator($num) {
        if($num != NULL)
        {
            $hex = "";
            switch ($num)
            {
                case '1': $hex = '#034f84';
                break;
                case '2': $hex = '#4CAF50';
                break;
                case '3': $hex = '#6b5b95';
                break;
                case '4': $hex = '#f7786b';
                break;
                case '5': $hex = '#ff7b25';
                break;
                case '6': $hex = '#b1cbbb';
                break;
                case '7': $hex = '#eea29a';
                break;
                case '8': $hex = '#c94c4c';
                break;
                case '9': $hex = '#3e4444';
                break;
                case '10': $hex = '#80ced6';
                break;
                case '11': $hex = '#4040a1';
                break;
                case '12': $hex = '#838060';
                break;
                case '13': $hex = '#ffef96';
                break;
                case '14': $hex = '#50394c';
                break;
                case '15': $hex = '#c83349';
                break;
                case '16': $hex = '#588c7e';
                break;
                case '17': $hex = '#ffcc5c';
                break;
                case '18': $hex = '#618685';
                break;
                case '19': $hex = '#36486b';
                break;
                case '20': $hex = '#4040a1';
                break;
                case '21': $hex = '#b2b2b2';
                break;
                case '22': $hex = '#f4e1d2';
                break;
                case '23': $hex = '#f7cac9';
                break;
                case '24': $hex = '#bc5a45';
                break;
                case '25': $hex = '#c8c3cc';
                break;
                case '26': $hex = '#563f46';
                break;
                case '27': $hex = '#8ca3a3';
                break;
                case '28': $hex = '#484f4f';
                break;
                case '29': $hex = '#e0e2e4';
                break;
                case '30': $hex = '#c6bcb6';
                break;
                case '31': $hex = '#96897f';
                break;
                case '32': $hex = '#625750';
                break;
                case '33': $hex = '#7e4a35';
                break;
                case '34': $hex = '#cab577';
                break;
                case '35': $hex = '#dbceb0';
                break;
                case '36': $hex = '#838060';
                break;
                case '37': $hex = '#686256';
                break;
                case '38': $hex = '#c1502e';
                break;
                case '39': $hex = '#587e76';
                break;
                case '40': $hex = '#a96e5b';
                break;
                case '41': $hex = '#bccad6';
                break;
                case '42': $hex = '#8d9db6';
                break;
                case '43': $hex = '#667292';
                break;
                case '44': $hex = '#f1e3dd';
                break;
                case '45': $hex = '#cfe0e8';
                break;
                case '46': $hex = '#b7d7e8';
                break;
                case '47': $hex = '#87bdd8';
                break;
                case '48': $hex = '#daebe8';
                break;
                case '49': $hex = '#f4a688';
                break;
                case '50': $hex = '#e0876a';
                break;


            }
            return $hex;
        }else{
            return '';
        }
    }

    public static function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public static function checkExtFile($file,$param = null){
        $ext = [
            "ase","art","bmp","blp","cd5","cit","cpt","cr2","cut","dds","dib","djvu","egt","exif","gif","gpl",
            "grf","icns","ico","iff","jng","jpeg","jpg","jfif","jp2","jps","lbm","max","miff","mng","msp","nitf",
            "ota","pbm","pc1","pc2","pc3","pcf","pcx","pdn","pgm","PI1","PI2","PI3","pict","pct","pnm","pns","ppm",
            "psb","psd","pdd","psp","px","pxm","pxr","qfx","raw","rle","sct","sgi","rgb","int","bw","tga","tiff","tif",
            "vtf","xbm","xcf","xpm","3dv","amf","ai","awg","cgm","cdr","cmx","dxf","e2d","egt","eps","fs","gbr","odg",
            "svg","stl","vrml","x3d","sxd","v2d","vnd","wmf","emf","art","xar","png","webp","jxr","hdp","wdp","cur","ecw","iff",
            "lbm","liff","nrrd","pam","pcx","pgf","sgi","rgb","rgba","bw","int","inta","sid","ras","sun","tga"
        ];
        $ret = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if(!$param){
            if (in_array($ret, $ext)) {
                return url('storage/'.$file);
            } else {
                return url('img/no-images.png');
            }
        }else{
            if (in_array($ret, $ext)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function showImgExtension($fileMasuk = '',$param= null){
        $music = ['aif','cda','mid','midi','mp3','mpa','ogg','wav','wma','wpl'];
        $archieve = ['7z','arj','deb','pkg','rar','rpm','tarz','zip'];
        $disc = ['bin','dmg','iso','toast','vcd'];
        $db = ['csv','dat','db','dbf','log','mdb','sav','sql','tar','xml'];
        $file = ['apk','bat','bin','cgi','pl','com','exe','gadget','py','wsf'];
        $font = ['fnt','fon','otf','ttf'];
        $img = ['ai','bmp','gif','ico','jpeg','jpg','png','ps','psd','svg','tif','tiff'];
        $internet = ['asp','aspx','cer','cfm','cgi','pl','css','htm','html','js','jsp','part','php','py','rss','xhtml'];
        $ppt = ['key','odp','pps','ppt','pptx'];
        $xls = ['ods','xlr','xls','xlsx'];
        $ext = ['bak','cab','cfg','cpl','cur','dll','dmp','drv','icns','ico','ini','lnk','msi','sys','tmp'];
        $film = ['3g2','3gp','avi','flv','h264','m4v','mkv','mov','mp4','mpg','mpeg','rm','swf','vob','wmv'];
        $doc = ['doc','docx','wks','wpswpd'];
        $pdf = ['pdf'];
        $textFile = ['odt','rtf','tex','txt'];

        $ret = strtolower(pathinfo($fileMasuk, PATHINFO_EXTENSION));

        if(in_array($ret, $music)){
            return url('img/extension/music.png');
        }else if(in_array($ret, $archieve)){
            return url('img/extension/archive.png');
        }else if(in_array($ret, $disc)){
            return url('img/extension/disc.png');
        }else if(in_array($ret, $db)){
            return url('img/extension/db.png');
        }else if(in_array($ret, $file)){
            return url('img/extension/file.png');
        }else if(in_array($ret, $font)){
            return url('img/extension/font.png');
        }else if(in_array($ret, $img)){
            if($param){
                return url('storage/'.$fileMasuk);
            }else{
                return url('img/extension/img.png');
            }
        }else if(in_array($ret, $internet)){
            return url('img/extension/internet.png');
        }else if(in_array($ret, $ppt)){
            return url('img/extension/ppt.png');
        }else if(in_array($ret, $xls)){
            return url('img/extension/xls.png');
        }else if(in_array($ret, $ext)){
            return url('img/extension/dll.jpg');
        }else if(in_array($ret, $film)){
            if($param){
                return url('storage/'.$fileMasuk);
            }else{
                return url('img/extension/film.png');
            }
        }else if(in_array($ret, $doc)){
            return url('img/extension/doc.png');
        }else if(in_array($ret, $pdf)){
            return url('img/extension/pdf.png');
        }else if(in_array($ret, $textFile)){
            return url('img/extension/textFile.png');
        }else{
            return url('img/extension/file-blank.jpg');
        }
    }
    
    public static function showImgExtensionPrint($fileMasuk = '',$param= null){
        $music = ['aif','cda','mid','midi','mp3','mpa','ogg','wav','wma','wpl'];
        $archieve = ['7z','arj','deb','pkg','rar','rpm','tarz','zip'];
        $disc = ['bin','dmg','iso','toast','vcd'];
        $db = ['csv','dat','db','dbf','log','mdb','sav','sql','tar','xml'];
        $file = ['apk','bat','bin','cgi','pl','com','exe','gadget','py','wsf'];
        $font = ['fnt','fon','otf','ttf'];
        $img = ['gif','jpeg','jpg','png'];
        $internet = ['asp','aspx','cer','cfm','cgi','pl','css','htm','html','js','jsp','part','php','py','rss','xhtml'];
        $ppt = ['key','odp','pps','ppt','pptx'];
        $xls = ['ods','xlr','xls','xlsx'];
        $ext = ['bak','cab','cfg','cpl','cur','dll','dmp','drv','icns','ico','ini','lnk','msi','sys','tmp'];
        $film = ['3g2','3gp','avi','flv','h264','m4v','mkv','mov','mp4','mpg','mpeg','rm','swf','vob','wmv'];
        $doc = ['doc','docx','wks','wpswpd'];
        $pdf = ['pdf'];
        $textFile = ['odt','rtf','tex','txt'];

        $ret = strtolower(pathinfo($fileMasuk, PATHINFO_EXTENSION));

        if(in_array($ret, $music)){
            return public_path('img/extension/music.png');
        }else if(in_array($ret, $archieve)){
            return public_path('img/extension/archive.png');
        }else if(in_array($ret, $disc)){
            return public_path('img/extension/disc.png');
        }else if(in_array($ret, $db)){
            return public_path('img/extension/db.png');
        }else if(in_array($ret, $file)){
            return public_path('img/extension/file.png');
        }else if(in_array($ret, $font)){
            return public_path('img/extension/font.png');
        }else if(in_array($ret, $img)){
            if($param){
                return public_path('storage/'.$fileMasuk);
            }else{
                return public_path('img/extension/img.png');
            }
        }else if(in_array($ret, $internet)){
            return public_path('img/extension/internet.png');
        }else if(in_array($ret, $ppt)){
            return public_path('img/extension/ppt.png');
        }else if(in_array($ret, $xls)){
            return public_path('img/extension/xls.png');
        }else if(in_array($ret, $ext)){
            return public_path('img/extension/dll.jpg');
        }else if(in_array($ret, $film)){
            if($param){
                return public_path('storage/'.$fileMasuk);
            }else{
                return public_path('img/extension/film.png');
            }
        }else if(in_array($ret, $doc)){
            return public_path('img/extension/doc.png');
        }else if(in_array($ret, $pdf)){
            return public_path('img/extension/pdf.png');
        }else if(in_array($ret, $textFile)){
            return public_path('img/extension/textFile.png');
        }else{
            return public_path('img/extension/file-blank.jpg');
        }
    }

    public static function showFileExtension($fileMasuk = '',$param= null){
        $music = ['aif','cda','mid','midi','mp3','mpa','ogg','wav','wma','wpl'];
        $archieve = ['7z','arj','deb','pkg','rar','rpm','tarz','zip'];
        $disc = ['bin','dmg','iso','toast','vcd'];
        $db = ['csv','dat','db','dbf','log','mdb','sav','sql','tar','xml'];
        $file = ['apk','bat','bin','cgi','pl','com','exe','gadget','py','wsf'];
        $font = ['fnt','fon','otf','ttf'];
        $img = ['ai','bmp','gif','ico','jpeg','jpg','png','ps','psd','svg','tif','tiff'];
        $internet = ['asp','aspx','cer','cfm','cgi','pl','css','htm','html','js','jsp','part','php','py','rss','xhtml'];
        $ppt = ['key','odp','pps','ppt','pptx'];
        $xls = ['ods','xlr','xls','xlsx'];
        $ext = ['bak','cab','cfg','cpl','cur','dll','dmp','drv','icns','ico','ini','lnk','msi','sys','tmp'];
        $film = ['3g2','3gp','avi','flv','h264','m4v','mkv','mov','mp4','mpg','mpeg','rm','swf','vob','wmv'];
        $doc = ['doc','docx','wks','wpswpd'];
        $pdf = ['pdf'];
        $textFile = ['odt','rtf','tex','txt'];

        $ret = strtolower(pathinfo($fileMasuk, PATHINFO_EXTENSION));

        if(in_array($ret, $music)){
            return 'music';
        }else if(in_array($ret, $archieve)){
            return 'archieve';
        }else if(in_array($ret, $disc)){
            return 'disc';
        }else if(in_array($ret, $db)){
            return 'db';
        }else if(in_array($ret, $file)){
            return 'file';
        }else if(in_array($ret, $font)){
            return 'font';
        }else if(in_array($ret, $img)){
            return 'img';
        }else if(in_array($ret, $internet)){
            return 'internet';
        }else if(in_array($ret, $ppt)){
            return 'ppt';
        }else if(in_array($ret, $xls)){
            return 'xls';
        }else if(in_array($ret, $ext)){
            return 'ext';
        }else if(in_array($ret, $film)){
            return 'film';
        }else if(in_array($ret, $doc)){
            return 'doc';
        }else if(in_array($ret, $pdf)){
            return 'pdf';
        }else if(in_array($ret, $textFile)){
            return 'textFile';
        }else{
            return ;
        }
    }

    public static function IconNotif($type) {
        $compilaces = ['communication','bulletin','policy'];
        $communication = ['she-meeting','hira'];
        $reporting = ['accident','hnmr'];
        $monitoring = ['inspection_record','inspection_action','inspection_monitoring','equipment'];
        $master = ['training'];
        if($type != NULL)
        {
            if(in_array($type, $compilaces)){
                return 'laptop';
            }else if(in_array($type, $communication)){
                return 'volume up';
            }else if(in_array($type, $reporting)){
                return 'warning';
            }else if(in_array($type, $monitoring)){
                return 'calendar check';
            }else if(in_array($type, $master)){
                return 'database';
            }else{
                return 'bell';
            }
        }
    }

    public static function getTotalObs($data,$category,$site,$startDate,$endDate){
        $record = with (clone $data);
        switch ($category) {
            case 'Personal Protective Equipment':
                if($record->ppe){
                    $search = $record->whereHas('ppe', function($q)use($site,$startDate,$endDate){
                        $q->where('site_id',$site)->whereBetween('date',[Helpers::DateToSql($startDate),Helpers::DateToSql($endDate)]);
                    })->get();
                    $return = $search->count();
                }else{
                    $return = 0;
                }
                break;
            case 'Position of People':
                if($record->position){
                    $search = $record->position->where('site_id',$site)->whereBetween('date',[Helpers::DateToSql($startDate),Helpers::DateToSql($endDate)])->get();
                    $return = $search->count();
                }else{
                    $return = 0;
                }
                break;
            case 'Procedures or Training':
                if($record->procedure){
                    $search = $record->procedure->where('site_id',$site)->whereBetween('date',[Helpers::DateToSql($startDate),Helpers::DateToSql($endDate)])->get();
                    $return = $search->count();
                }else{
                    $return = 0;
                }
                break;
            case 'Tools & Equipment':
                if($record->tools){
                    $search = $record->tools->where('site_id',$site)->whereBetween('date',[Helpers::DateToSql($startDate),Helpers::DateToSql($endDate)])->get();
                    $return = $search->count();
                }else{
                    $return = 0;
                }
                break;
            case 'Environmental Compliances':
                if($record->env){
                    $search = $record->env->where('site_id',$site)->whereBetween('date',[Helpers::DateToSql($startDate),Helpers::DateToSql($endDate)])->get();
                    $return = $search->count();
                }else{
                    $return = 0;
                }
                break;
            case 'Others':
                if($record->others){
                    $search = $record->others->where('site_id',$site)->whereBetween('date',[Helpers::DateToSql($startDate),Helpers::DateToSql($endDate)])->get();
                    $return = $search->count();
                }else{
                    $return = 0;
                }
                break;
                                                    
            default:
                $return = 0;
                break;
        }
        return $return;
    }
    
    public static function getMessageWhatsapp($tamu){
        $record = Acara::get()->first();
        $tamuRegx = str_replace(' ','%20',$tamu);
        $date = Helpers::DateToStringWtimeIndo($record->wedding_date);
        $date = explode(' - ',$date);
        $text = 
'Yth. Bapak/Ibu/Saudara/i
'.$tamu.'
Di Tempat
-----------------------

Dengan segala kerendahan hati, kami mengundang Bapak/Ibu/Saudara/i dan teman-teman untuk menghadiri acara,

=======================
The Wedding of *'.explode(' ',$record->cpp)[0].' & '.explode(' ',$record->cpw)[0].'*
=======================

Link undangan bisa diakses lengkap di:
'.url('/mengundang').'?sdr='.$tamuRegx.'

Merupakan suatu kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan untuk hadir di acara kami
Mohon maaf perihal undangan hanya di bagikan melalui pesan ini
Terima kasih banyak atas perhatiannya
Wassalammualaikum Wr.Wb.';
            return $text;
    }
    
    public static function getMessageWhatsappFemale($tamu){
        $record = Acara::get()->first();
        $tamuRegx = str_replace(' ','%20',$tamu);
        $date = Helpers::DateToStringWtimeIndo($record->wedding_date);
        $date = explode(' - ',$date);
        $text = 
'Yth. Bapak/Ibu/Saudara/i
'.$tamu.'
Di Tempat
-----------------------

Dengan segala kerendahan hati, kami mengundang Bapak/Ibu/Saudara/i dan teman-teman untuk menghadiri acara,

=======================
The Wedding of *'.explode(' ',$record->cpp)[0].' & '.explode(' ',$record->cpw)[0].'*
=======================

Link undangan bisa diakses lengkap di:
'.url('/kami-mengundang').'?sdr='.$tamuRegx.'

Merupakan suatu kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan untuk hadir di acara kami
Mohon maaf perihal undangan hanya di bagikan melalui pesan ini
Terima kasih banyak atas perhatiannya
Wassalammualaikum Wr.Wb.';
            return $text;
    }
}
