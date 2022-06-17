<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use DB;

class TransaksiController extends Controller
{
    public function index(Request $req)
    {
        $historyTransaksi = Transaksi::join('users', 'users.kode', 'transaksis.kode_rumah')->where('users.kode', Auth::id())->get();

        return view('pages.home', compact('data'));
    }
    
    public function index_dashboard(Request $req)
    {
        $bulan = $req->bulan;
        $tahun = $req->tahun;
        $status = $req->status;
        $area = $req->area;

        if(!$bulan){
            $bulan = date('m');
        }
        
        if(!$tahun){
            $tahun = date('Y');
        }

        $filter = "";

        if($status){
            if($status == 'all' ){
                $filter = "";
            }else if($status == 'no'){
                $filter = " WHERE transaksis.status IS NULL ";
            }else{
                $filter = " WHERE transaksis.status = '$status' ";
            }
        }

        if($area){
            // cek
            if($area != 'all'){
                if(str_contains($filter,'WHERE')){
                    $filter .= " AND users.kode LIKE '$area%' ";
                }else{
                    $filter .= " WHERE users.kode LIKE '$area%' ";
                }
            }
        }


        $datas = DB::select(DB::raw("select users.kode, transaksis.status from `users` LEFT join `transaksis` on `transaksis`.`kode_rumah` = `users`.`kode` 
        AND year(transaksis.tgl_bayar) = $tahun and month(transaksis.tgl_bayar) = $bulan $filter"));            

        return view('pages.dashboard', compact('datas','area','tahun','bulan','status'));
    }

    public function index_transaksi(Request $req)
    {
        $datas = Transaksi::paginate(5)->withQueryString();;

        return view('pages.transaksi',compact('datas'));
    }

    public function store(Request $req)
    {
        try {
            $image = base64_encode(file_get_contents($req->file('bukti')));

            DB::table('transaksis')->insert([
                'kode_rumah' => $req->kode,
                'tgl_bayar' => Carbon::now(),
                'bukti' => $image, 
                'status' => 'pending'
            ]);

            return redirect()->to('/home')->with('message', json_encode(['pesan' => 'Data Berhasil ditambah']));;

        }catch (\Throwable $th) {
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

    

    
}
