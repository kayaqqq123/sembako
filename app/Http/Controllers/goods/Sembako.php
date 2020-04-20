<?php

namespace App\Http\Controllers\goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\goods;
use DateTime;
use Carbon\Carbon;
use function GuzzleHttp\json_encode;

class sembako extends Controller
{
    public function index($input){

        $input_sebelum_dirubah = $input;
        //dd($kondisi_sebelum_dirubah);
        $inputs = $this->input($input)[0];
        $input = $this->input($input)[1];
        $sembakos = $this->input($input)[2];
        return view('sembako.index')->with([
            'sembakos' => $sembakos,
            'input' => $input,
            'input_sebelum_dirubah' => $input_sebelum_dirubah
        ]);
    }

    public function input($input){
        $inputs =[
            ['input' => 'semua'],
            ['input' => '3 hari lagi']

        ];
        $input = str_replace("_"," ",$input);
        $inputs = json_decode(json_encode($inputs));
        $inputs = collect($inputs);
        $inputs = $inputs->where('input', $input)->isEmpty();
        if($inputs){
            return abort(404);
        }else if($input == '3 hari lagi'){
            $sembakos = $this->expired_date();
        }else if($input == 'semua'){
            $sembakos = $this->semua();
        }
        return [$inputs,$input,$sembakos];
    }

    public function semua(){
        $sembakos = $this->messageBarang();
        return collect($sembakos)->sortBy('name');
    }

    public function expired_date(){
        $sembakos = $this->messageBarang();
        return collect($sembakos)->sortBy('name')->sortBy('expired_date');
    }

    public function messageBarang(){
        $sembakos = goods::all();
        foreach($sembakos as $sembako){
            $today = Carbon::now()->setTime(0,0,0);
            //$hari_ini = Carbon::createFromFormat('Y-m-d','2020-04-07');
            $expired = Carbon::parse($sembako->expired_date);
            //$exp = Carbon::createFromFormat('Y-m-d','2020-04-07');
            $diff_in_days = $today->diffInDays($expired);
            if( $diff_in_days <= '3'){
                if($today == $expired){
                    $sembako['message'] = "hari ini barang sudah kadaluarsa";
                    $sembako['bg_alert'] = "btn-danger";
                }
                else if($today > $expired){
                    $sembako['message'] = "barang ini sudah kadaluarsa";
                    $sembako['bg_alert'] = "btn-dark";
                }
                else{
                    $sembako['message'] = "barang ini akan kadaluarsa $diff_in_days hari lagi";
                    $sembako['bg_alert'] = "btn-info";
                }
            }else{
                $sembako['message'] = "barang belum kadaluarsa";
                $sembako['bg_alert'] = "btn-success";
            }
        }
        return $sembakos;
    }

    public function create(){
        return view('sembako.tambah');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'stock' => 'required',
            'expired_date' => 'required|date'
        ]);

        try{
            $sembako = goods::create([
                'name' => $request->name,
                'stock' => $request->stock,
                'expired_date' => $request->expired_date
            ]);
            return back()->with('sukses','barang berhasil di simpan');
        }catch(Exception $e){
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
    }

    public function edit($id,$input){
        //dd($kondisi);
        $this->input($input); // memanggil pengecakan untuk kondisi ada atau tidak di dalama array
        $sembako = goods::findOrfail($id);
        return view('sembako.edit')->with([
            'sembako' => $sembako,
            'input' => $input
        ]);
    }

    public function update(Request $request,$id,$input){
        $this->validate($request,[
            'name' => 'required',
            'stock' => 'required',
            'expired_date' => 'required|date'
        ]);

        $this->input($input);
        try{
            $sembako = goods::findOrfail($id);
            $sembako->update([
                'name' => $request->name,
                'stock' => $request->stock,
                'expired_date' => $request->expired_date
            ]);
            return redirect(route('sembako.index',$input))->with('sukses','data berhasil di UPDATE');
        }catch(Exception $e){
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
    }

    public function destroy($id){
        try{
            $sembako = goods::destroy($id);
            return back()->with('sukses','data berhasil di hapus');
        }catch(Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }
}
