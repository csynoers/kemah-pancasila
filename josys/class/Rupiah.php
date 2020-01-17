<?php
class Rupiah {

    public function koma_nol($value) {
        $angka              = $value;
        $jumlah_desimal     = "2";
        $pemisah_desimal    = ",";
        $pemisah_ribuan     = ".";

        $result = "Rp. ".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
        return $result;
        //hasil : Rp 1.300.000,00
    }

    public function titik_nol($value) {
        $angka              = $value;
        $jumlah_desimal     = "2";
        $pemisah_desimal    = ".";
        $pemisah_ribuan     = ",";

        $result =  "Rp. ".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
        return $result;
        //hasil : Rp 1,300,000.00
    }

    public function koma_strip($value) {
        $angka              = $value;
        $jumlah_desimal     = "0";
        $pemisah_desimal    = ",";
        $pemisah_ribuan     = ".";

        $result = "Rp. ".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan).", -";
        return $result;
        //hasil : Rp 1.300.000,-
    }

    public function tanpa_nol($value) {
        $angka              = $value;
        $jumlah_desimal     = "0";
        $pemisah_desimal    = ",";
        $pemisah_ribuan     = ".";

        $result = "Rp. ".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
        return $result;
        //hasil : Rp 1.300.000
    }
}
