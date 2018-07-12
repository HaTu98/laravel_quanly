<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Product;
use App\User;
use App\times;
use DB;
class ExcelExports implements FromCollection
{
    public function collection()
    {	
    	$data =times::join('users','users.user_id','=','times.user_id')
    		->where('times.user_id',\Auth::user()->user_id)
    		->whereYear('date',date('Y',strtotime(now())))
    		->whereMonth('date',date('m',strtotime(now())))
    		->select('users.user_id','name','start','finish','time_per_day','all_time','date')
    		->orderBy('date','desc')->get();

        return $data;
    }
}
