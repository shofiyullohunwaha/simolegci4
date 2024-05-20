<?php
    function enkripsi($ps){
        return base64_encode(openssl_encrypt($ps, "AES-256-CBC", kunciSSL, 0, "0123456789abcdef"));
	}

    function dekripsi($ps){
		return openssl_decrypt(base64_decode($ps), "AES-256-CBC", kunciSSL, 0, "0123456789abcdef");
	}

    function kodeotomatis1(){
        $dateString = date("Y-m-d H:i:s");
        return DateTime::createFromFormat("Y-m-d H:i:s", $dateString)->getTimestamp();
    }

    function kodeotomatis2(){return floor(microtime(true) * 1000);}

    function IdLogin(){
        $encrypter = \Config\Services::encrypter();
        $session = \Config\Services::session();
        $ayy = dekripsi($encrypter->decrypt(base64_decode($session->get(S3si))));
        $dtl = explode("|", $ayy);
        return $dtl[0];
    }
    
    function IdLogin2(){
        $encrypter = \Config\Services::encrypter();
        $session = \Config\Services::session();
        if(!isset($_SESSION[S3si])){
            return "";
        }else{
            $ayy = dekripsi($encrypter->decrypt(base64_decode($session->get(S3si))));
            $dtl = explode("|", $ayy);
            return $dtl;
        }
    }

    function TerjemahBulan($bulan){
        $terjemah = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        return $terjemah[intval($bulan)];
    }

    function antiSQLi($x){
        return trim(str_replace("'", "''", $x));
    }

    function ribuan($x){
        return number_format($x, 0,",",".");
    }

    function terjemahstatus($x){
        $d = ["Draft","Terkirim","Proses","Terverifikasi Boleh","Terverifikasi Dengan Perbaikan","Terverifikasi di Tolak","Baru Di Revisi"];
        return $d[$x];
    }

    function terjemahsumberdana($x){
        $d = ["","APBD/DAU Yang Tidak di Tentukan","DAU yang di Tentukan","DAK Fisik","DAK Non Fisik","DBHCHT","DID/Insentif Fiskal","Lain-Lain"];
        return $d[$x];
    }

    function tglindo($xy){
        $tgl = substr($xy, 8, 2);
        $thn = substr($xy, 0, 4);
        switch(substr($xy, 5, 2)){
            case "01":
                $bln = "Jan";
                break;
            case "02":
                $bln = "Feb";
                break;
            case "03":
                $bln = "Mar";
                break;
            case "04":
                $bln = "Apr";
                break;
            case "05":
                $bln = "Mei";
                break;
            case "06":
                $bln = "Jun";
                break;
            case "07":
                $bln = "Jul";
                break;
            case "08":
                $bln = "Agu";
                break;
            case "09":
                $bln = "Sep";
                break;
            case "10":
                $bln = "Okt";
                break;
            case "11":
                $bln = "Nov";
                break;
            default:
                $bln = "Des";
                break;
        }
        return $tgl. " ".$bln." ".$thn;
    }

    function tglindo2($xy){
        $tgl = substr($xy, 8, 2);
        $thn = substr($xy, 0, 4);
        $bln = substr($xy, 5, 2);
        return $tgl. " ".TerjemahBulan($bln)." ".$thn;
    }

    function tgljamindo($xy){
        $arr = explode(" ", $xy);
        $tgl = substr($arr[0], 8, 2);
        $thn = substr($arr[0], 0, 4);
        switch(substr($arr[0], 5, 2)){
            case "01":
                $bln = "Jan";
                break;
            case "02":
                $bln = "Feb";
                break;
            case "03":
                $bln = "Mar";
                break;
            case "04":
                $bln = "Apr";
                break;
            case "05":
                $bln = "Mei";
                break;
            case "06":
                $bln = "Jun";
                break;
            case "07":
                $bln = "Jul";
                break;
            case "08":
                $bln = "Agu";
                break;
            case "09":
                $bln = "Sep";
                break;
            case "10":
                $bln = "Okt";
                break;
            case "11":
                $bln = "Nov";
                break;
            default:
                $bln = "Des";
                break;
        }
        return $tgl. " ".$bln." ".$thn." ".$arr[1];
    }
?>