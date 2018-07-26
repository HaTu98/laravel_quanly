<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Product;
use App\User;
use App\times;
use DB;
class ExcelExports implements FromView
{   
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('export.export', [
            'data' => $this->data
        ]);
    }



    /**
    *option1: export excel by headings and body
    **/
    // public function collection()
    // {	
    // 	$data =times::join('users','users.user_id','=','times.user_id')
    // 		->where('times.user_id',\Auth::user()->user_id)
    // 		->whereYear('date',date('Y',strtotime(now())))
    // 		->whereMonth('date',date('m',strtotime(now())))
    // 		->select('users.user_id','name','start','finish','time_per_day','all_time','date')
    // 		->orderBy('date','desc')->get();

    //     return $data;
    // }

    // public function headings(): array {
    //     return [
    //         "User id",
    //         "Name",
    //         "Time Start",
    //         "Time Finish",
    //         "Time Per Day",
    //         "All Time",
    //         "Date",
    //     ];
    // }

    


}
