<?php
if (!function_exists('locChuCai')) {
    function locChuCai($chuoi)
    {
        $chuoiLoc = preg_replace('/([aeiou])y([aeiou])/', '$1$2', $chuoi);
        $chuoiLoc1 = preg_replace('/([aeiou])[y]/', 'y', $chuoiLoc);
        $chuoiLoc2 = preg_replace('/[y]([aeiou])/', 'y', $chuoiLoc1);
        $kyTuNguyenAm = preg_replace('/[^aeiouy]/', '-', $chuoiLoc2);
        $ketQuaCuoiCung = preg_replace('/-{3,}/', '-', $kyTuNguyenAm);
        $ketQuaCuoiCung = trim($ketQuaCuoiCung, '-');
        return $ketQuaCuoiCung;
    }
    if (!function_exists('tinhtong')) {
        function tinhtong($chuoiLoc, $anhXaChuCaiVaSo)
        {
            $tong = 0;
            foreach (str_split($chuoiLoc) as $chuoi) {
                if (array_key_exists($chuoi, $anhXaChuCaiVaSo)) {
                    $tong += intval($anhXaChuCaiVaSo[$chuoi]);
                }
            }
            while ($tong >= 10 && $tong != 11 && $tong != 22 && $tong != 33) {
                $chuoiTong = strval($tong);
                $tong = 0;
                foreach (str_split($chuoiTong) as $chuSo) {
                    $tong += intval($chuSo);
                }
            }
            return $tong;
        }
    }
    if (!function_exists('tinhtong1')) {
        function tinhtong1($chuoiLoc, $anhXaChuCaiVaSo)
        {
            $tong = 0;
            foreach (str_split($chuoiLoc) as $chuoi) {
                if (array_key_exists($chuoi, $anhXaChuCaiVaSo)) {
                    $tong += intval($anhXaChuCaiVaSo[$chuoi]);
                }
            }
            while ($tong >= 10) {
                $chuoiTong = strval($tong);
                $tong = 0;
                foreach (str_split($chuoiTong) as $chuSo) {
                    $tong += intval($chuSo);
                }
            }
            return $tong;
        }
    }
    if (!function_exists('phuam')) {
        function phuam($chuoi)
        {
            $chuoiLoc = preg_replace('/[aeiou]y[aeiou]/i', 'y', $chuoi);
            $chuoiLoc1 = preg_replace('/([aeiou])[y]/', '$1$2', $chuoiLoc);
            $chuoiLoc2 = preg_replace('/[y]([aeiou])/', '$1$2', $chuoiLoc1);
            $chuoi1 = preg_replace('/[aeiou]/', '', $chuoiLoc2);

            return $chuoi1;
        }
    }
    if (!function_exists('tongso')) {
        function tongso($number)
        {
            $tongso = array_sum(str_split($number));
            while ($tongso >= 10 && $tongso != 11 && $tongso != 22 && $tongso != 33) {
                $chuSoMoi = array_sum(str_split($tongso));
                $tongso = $chuSoMoi;
            }
            return $tongso;
        }
    }
    if (!function_exists('tiemthuc')) {
        function tiemthuc($chuoiLoc, $anhXaChuCaiVaSo)
        {
            $ket_qua = [];
            $so_tu_1_den_9 = range(1, 9);

            foreach (str_split($chuoiLoc) as $ky_tu) {
                $ky_tu = strtolower($ky_tu);
                if (array_key_exists($ky_tu, $anhXaChuCaiVaSo)) {
                    $ket_qua[] = $anhXaChuCaiVaSo[$ky_tu];
                } else {
                    $ket_qua[] = $ky_tu;
                }
            }
            $so_khong_xuat_hien = array_diff($so_tu_1_den_9, $ket_qua);

            return 9 - count($so_khong_xuat_hien);
        }
    }
    if (!function_exists('tuduylitri')) {
        function tuduylitri($chuoiLoc, $anhXaChuCaiVaSo, $ngaysinh)
        {
            $tong = 0;
            foreach (str_split($chuoiLoc) as $chuoi) {
                if (array_key_exists($chuoi, $anhXaChuCaiVaSo)) {
                    $tong += intval($anhXaChuCaiVaSo[$chuoi]);
                }
            }
            while ($tong >= 10) {
                $chuoiTong = strval($tong);
                $tong = 0;
                foreach (str_split($chuoiTong) as $chuSo) {
                    $tong += intval($chuSo);
                }
            }
            $tongso1 = array_sum(str_split($ngaysinh));
            while ($tongso1 >= 10) {
                $chuSoMoi = array_sum(str_split($tongso1));
                $tongso1 = $chuSoMoi;
            }
            $ketqua = $tong + $tongso1;
            while ($ketqua > 9) {
                $chuoiKetQua = strval($ketqua);
                $ketqua = 0;
                foreach (str_split($chuoiKetQua) as $chuSo) {
                    $ketqua += intval($chuSo);
                }
            }
            return $ketqua;
        }
    }
    if (!function_exists('chisothang')) {
        function chisothang($thang, $chisonam)
        {
            $ketqua = $thang;
            while ($ketqua > 9) {
                $chuoiKetQua = strval($ketqua);
                $ketqua = 0;
                foreach (str_split($chuoiKetQua) as $chuSo) {
                    $ketqua += intval($chuSo);
                }
            }
            $ketqua += $chisonam;
            while ($ketqua > 9) {
                $chuoiKetQua = strval($ketqua);
                $ketqua = 0;

                foreach (str_split($chuoiKetQua) as $chuSo) {
                    $ketqua += intval($chuSo);
                }
            }
            return $ketqua;
        }
    }
    if (!function_exists('thieu')) {
        function thieu($chuoiLoc, $anhXaChuCaiVaSo)
        {
            $ket_qua = [];
            $so_tu_1_den_9 = range(1, 9);

            foreach (str_split($chuoiLoc) as $ky_tu) {
                $ky_tu = strtolower($ky_tu);
                if (array_key_exists($ky_tu, $anhXaChuCaiVaSo)) {
                    $ket_qua[] = $anhXaChuCaiVaSo[$ky_tu];
                } else {
                    $ket_qua[] = $ky_tu;
                }
            }
            $so_khong_xuat_hien = array_diff($so_tu_1_den_9, $ket_qua);
            return array_values($so_khong_xuat_hien);
        }
    }
    if (!function_exists('damme')) {
        function damme($chuoiLoc, $anhXaChuCaiVaSo)
        {
            $ket_qua = [];


            foreach (str_split($chuoiLoc) as $ky_tu) {
                $ky_tu = strtolower($ky_tu);
                if (array_key_exists($ky_tu, $anhXaChuCaiVaSo)) {
                    $ket_qua[] = $anhXaChuCaiVaSo[$ky_tu];
                } else {
                    $ket_qua[] = $ky_tu;
                }
            }
            $tansuat = array_count_values($ket_qua);
            $soXuatHienNhieuNhat = array_search(max($tansuat), $tansuat);
            return $soXuatHienNhieuNhat;
        }
    }
}
