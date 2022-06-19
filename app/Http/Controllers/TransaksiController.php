<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index(Request $req)
    {
        $historyTransaksi = Transaksi::join('users', 'users.kode', 'transaksis.kode_rumah')
            ->where('users.kode', Auth::id())
            ->orderBy('transaksis.tgl_bayar', 'desc')
            ->paginate(8)->withQueryString();

        $latestTransaksi = Transaksi::join('users', 'users.kode', 'transaksis.kode_rumah')
            ->where('users.kode', Auth::id())
            ->orderBy('transaksis.tgl_bayar', 'desc')
            ->first();

        return view('pages.home', compact('historyTransaksi', 'latestTransaksi'));
    }

    public function index_dashboard(Request $req)
    {
        $bulan = $req->bulan;
        $tahun = $req->tahun;
        $status = $req->status;
        $area = $req->area;

        if (!$bulan) {
            $bulan = date('m');
        }

        if (!$tahun) {
            $tahun = date('Y');
        }

        $filter = "";

        if ($status) {
            if ($status == 'all') {
                $filter = "";
            } else if ($status == 'no') {
                $filter = " WHERE transaksis.status IS NULL ";
            } else {
                $filter = " WHERE transaksis.status = '$status' ";
            }
        }

        if ($area) {
            // cek
            if ($area != 'all') {
                if (str_contains($filter, 'WHERE')) {
                    $filter .= " AND users.kode LIKE '$area%' ";
                } else {
                    $filter .= " WHERE users.kode LIKE '$area%' ";
                }
            }
        }

        // mysql
        // $datas = DB::select(DB::raw("select users.kode, transaksis.status from users LEFT join transaksis on transaksis.kode_rumah = users.kode 
        // AND year(transaksis.tgl_bayar) = $tahun and month(transaksis.tgl_bayar) = $bulan $filter"));

        // postgre
        $datas = DB::select(DB::raw("select users.kode, transaksis.status from users LEFT join transaksis on transaksis.kode_rumah = users.kode 
        AND EXTRACT(YEAR FROM transaksis.tgl_bayar) = $tahun and EXTRACT(MONTH FROM transaksis.tgl_bayar) = $bulan $filter"));

        return view('pages.dashboard', compact('datas', 'area', 'tahun', 'bulan', 'status'));
    }

    public function index_transaksi(Request $req)
    {
        $bulan = $req->bulan;
        $tahun = $req->tahun;
        $status = $req->status;
        $area = $req->area;

        if (!$bulan) {
            $bulan = date('m');
        }

        if (!$tahun) {
            $tahun = date('Y');
        }

        if ($bulan == '00') {
            $datas = Transaksi::whereYear('transaksis.tgl_bayar', '=', $tahun);
        } else {
            $datas = Transaksi::whereMonth('transaksis.tgl_bayar', '=', $bulan)->whereYear('transaksis.tgl_bayar', '=', $tahun);
        }

        if ($status) {
            if ($status != 'all') {
                $datas = $datas->where('transaksis.status', $status);
            }
        }

        if ($area) {
            if ($area != 'all') {
                $datas = $datas->where('transaksis.kode_rumah', 'LIKE', "$area%");
            }
        }

        $datas = $datas->paginate(5)->withQueryString();
        $all_users = User::all();

        return view('pages.transaksi', compact('all_users', 'datas', 'tahun', 'bulan', 'status', 'area'));
    }

    public function store_from_admin(Request $req)
    {
        try {
            $validate = Validator::make($req->all(), [
                'bukti' => 'required',
            ]);

            if ($validate->fails()) {
                return redirect()->to('/transaksi')->with('error', 'form bukti kosong');
            }

            $getSameMonthTransaksi = Transaksi::where('kode_rumah', $req->kode)->whereMonth('tgl_bayar', date('m', strtotime($req->tgl_bayar)))->first();

            if ($getSameMonthTransaksi) {
                return redirect()->back()->with('error', 'Data bulan ' . date('m', strtotime($req->tgl_bayar)) . ' sudah ada untuk kode rumah ' . $req->kode);;
            }

            $image = base64_encode(file_get_contents($req->file('bukti')));

            DB::table('transaksis')->insert([
                'kode_rumah' => $req->kode,
                'tgl_bayar' => $req->tgl_bayar,
                'bukti' => $image,
                'status' => 'pending',
                'created_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('message', json_encode(['pesan' => 'Data Berhasil ditambah']));;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Data gagal ditambah');;
        }
    }

    public function store(Request $req)
    {
        try {
            $validate = Validator::make($req->all(), [
                'bukti' => 'required',
            ]);

            if ($validate->fails()) {
                return redirect()->to('/home')->with('error', 'form bukti kosong');;
            }


            $image = base64_encode(file_get_contents($req->file('bukti')));

            if (isset($req->id)) {
                DB::table('transaksis')->where('id', $req->id)->update([
                    'kode_rumah' => $req->kode,
                    'tgl_bayar' => $req->tgl_bayar,
                    'bukti' => $image,
                    'status' => 'pending',
                    'updated_at' => Carbon::now(),
                ]);
            } else {
                DB::table('transaksis')->insert([
                    'kode_rumah' => $req->kode,
                    'tgl_bayar' => $req->tgl_bayar,
                    'bukti' => $image,
                    'status' => 'pending',
                    'created_at' => Carbon::now(),
                ]);
            }



            return redirect()->to('/home')->with('message', json_encode(['pesan' => 'Data Berhasil ditambah']));;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/home')->with('error', 'Data gagal ditambah');;
        }
    }

    public function reject(Request $req)
    {
        try {
            DB::table('transaksis')->where('id', $req->id)->update([
                'status' => 'reject',
                'desc' => $req->desc
            ]);

            return redirect()->to('/transaksi')->with('message', json_encode(['pesan' => 'Data Berhasil direject']));;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/transaksi')->with('error', 'Data gagal direject');;
        }
    }

    public function approve(Request $req)
    {
        try {
            DB::table('transaksis')->where('id', $req->id)->update([
                'status' => 'approve',
            ]);

            return redirect()->to('/transaksi')->with('message', json_encode(['pesan' => 'Data Berhasil diapprove']));;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/transaksi')->with('error', 'Data gagal diapprove');;
        }
    }

    public function cetak_all(Request $request)
    {
        $filter = "";

        if ($request->status) {
            if ($request->status == 'all') {
                $filter = "";
            } else if ($request->status == 'no') {
                $filter = " WHERE transaksis.status IS NULL ";
            } else {
                $filter = " WHERE transaksis.status = '$request->status' ";
            }
        }

        if ($request->area) {
            if ($request->area != 'all') {
                if (str_contains($filter, 'WHERE')) {
                    $filter .= " AND users.kode LIKE '$request->area%' ";
                } else {
                    $filter .= " WHERE users.kode LIKE '$request->area%' ";
                }
            }
        }

        //mysql
        // $datas = DB::select(DB::raw("select users.kode AS Kode_Rumah, users.nama,transaksis.status, transaksis.tgl_bayar, transaksis.created_at AS tanggal_upload from users LEFT join transaksis on transaksis.kode_rumah = users.kode 
        // AND year(transaksis.tgl_bayar) = $request->tahun and month(transaksis.tgl_bayar) = $request->bulan $filter"));

        //postgre
        $datas = DB::select(DB::raw("select users.kode AS Kode_Rumah, users.nama,transaksis.status, transaksis.tgl_bayar, transaksis.created_at AS tanggal_upload from users LEFT join transaksis on transaksis.kode_rumah = users.kode 
        AND EXTRACT(YEAR FROM transaksis.tgl_bayar) = $request->tahun and EXTRACT(MONTH FROM transaksis.tgl_bayar) = $request->bulan $filter"));

        return $datas;
    }
}
