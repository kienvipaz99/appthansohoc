<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DataUserController extends Controller
{
    public function xuLyDuLieu(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birth_day' => 'required|date',
        ]);
        $hoTen = $validatedData['name'];
        $namHienTai = date("Y");
        $thangHienTai = date("m");

        $ngaySinh = $validatedData['birth_day'];
        $ngayThangNam = explode('-', $ngaySinh);
        $nam = $ngayThangNam[0];
        $thang = $ngayThangNam[1];
        $ngay = $ngayThangNam[2];
        $chisongaysinh = tongso($ngay);
        $chisonam = tongso($ngay . $thang . $namHienTai);
        $duongdoi = tongso($ngay . $thang . $nam);
        $anhXaChuCaiVaSo = [
            'a' => 1, 'j' => 1, 's' => 1,
            'b' => 2, 'k' => 2, 't' => 2,
            'c' => 3, 'l' => 3, 'u' => 3,
            'd' => 4, 'm' => 4, 'v' => 4,
            'e' => 5, 'n' => 5, 'w' => 5,
            'f' => 6, 'o' => 6, 'x' => 6,
            'g' => 7, 'p' => 7, 'y' => 7,
            'h' => 8, 'q' => 8, 'z' => 8,
            'i' => 9, 'r' => 9,
        ];
        $tenChuanHoa = Str::slug($hoTen);
        $tiemthuc = tiemthuc($tenChuanHoa, $anhXaChuCaiVaSo);
        $mangChuoi = explode("-", $tenChuanHoa);
        $ten = end($mangChuoi);
        $sumenh = tinhtong($tenChuanHoa, $anhXaChuCaiVaSo);
        $chuoiLoc = locChuCai($tenChuanHoa);
        $linhhon = tinhtong($chuoiLoc, $anhXaChuCaiVaSo);
        $phuam = phuam($tenChuanHoa);
        $nhancach = tinhtong($phuam, $anhXaChuCaiVaSo);
        $tuduylitri = tuduylitri($ten, $anhXaChuCaiVaSo, $ngay);
        $chisothang = chisothang($thangHienTai, $chisonam);
        $chang1 = tongso(tongso($ngay) + tongso($thang));
        $chang2 = tongso(tongso($ngay) + tongso($nam));
        $tt1 = abs(tongso($thang) - tongso($ngay));
        $tt2 = abs(tongso($ngay) - tongso($nam));
        $tt3 = abs($tt1 - $tt2);
        $tt4 = abs(tongso($thang) - tongso($nam));

        $data = [
            'name' => $hoTen,
            'birth_day' => $ngaySinh,
            'duong_doi' => $duongdoi,
            'su_menh' => $sumenh,
            'linh_hon' => $linhhon,
            'nhan_cach' => $nhancach,
            'chisongaysinh' => $chisongaysinh,
            'chisonam' => $chisonam,
            'sucmanhtiemthuc' => $tiemthuc,
            'tuduylitri' => $tuduylitri,
            'chisothang' => $chisothang,
            'sothieu' => thieu($tenChuanHoa, $anhXaChuCaiVaSo),
            'dam_me' => damme($tenChuanHoa, $anhXaChuCaiVaSo),
            'truongthanh' => tongso($duongdoi + $sumenh),
            'dd_sm' => abs($duongdoi - $sumenh),
            'lh_nc' => abs($linhhon - $nhancach),
            'chang' => [
                'chang1' => $chang1,
                'chang2' => $chang2,
                'chang3' => tongso($chang1 + $chang2),
                'chang4' => tongso(tongso($thang) + tongso($nam))
            ],
            'thachthuc' => [
                'tt1' => $tt1,
                'tt2' => $tt2,
                'tt3' => $tt3,
                'tt4' => $tt4
            ]
        ];

        return response()->json($data);
    }
}
