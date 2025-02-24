<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class FirstTimersModel extends Model
{
    use HasFactory;

    protected $table = 'first_timers';

    static public function getRecord($myYear) {

// print_r($myYear);

        $mySql = self::select('first_timers.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname', 'branchestbl.branchName AS branchName')
                ->join('users', 'users.id', '=', 'first_timers.user_id')
                ->join('branchestbl', 'branchestbl.id', '=', 'first_timers.branch_id');
                

                if ($myYear != '' || $myYear != null) {
                    // $mySql = $mySql->whereYear('first_timers.created_at', '=', '2021');
                    // $mySql = $mySql->whereRaw('YEAR(first_timers.created_at) = 2021');
                    $mySql = $mySql->where(DB::raw('YEAR(first_timers.created_at)'), $myYear);
                }

                $mySql = $mySql->where('first_timers.is_deleted', '=', 0)
                ->orderBy('first_timers.id', 'desc')
                ->get();
                // ->paginate(2);

                return $mySql;
    }

    // static public function getSingle($id) {

    //     return self::find($id);

    // }

    static public function getSingle($id) {

        return self::select('first_timers.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname', 'branchestbl.branchName AS branchName')
        ->join('users', 'users.id', '=', 'first_timers.user_id')
        ->join('branchestbl', 'branchestbl.id', '=', 'first_timers.branch_id')
        ->where('first_timers.id', '=', $id)
        ->first();

    }

    
    static public function getRecycleRecord() {

        return self::select('first_timers.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname', 'branchestbl.branchName AS branchName')
                ->join('users', 'users.id', '=', 'first_timers.user_id')
                ->join('branchestbl', 'branchestbl.id', '=', 'first_timers.branch_id')
                ->where('first_timers.is_deleted', '=', 1)
                ->orderBy('first_timers.id', 'desc')
                ->get();
                // ->paginate(2);

    }


    static public function getSelecetdItems() {

        $wordlist = self::select('first_timers.*');
     
        if (!empty(Request::get('values'))) {

            $ft_id = rtrim(Request::get('values'), ',');
            $ft_id_array = explode(",", $ft_id);

            $wordlist = $wordlist->whereIn('first_timers.id', $ft_id_array);
        }

            $wordlist = $wordlist->get();
        
        return $wordlist;
    }

}
