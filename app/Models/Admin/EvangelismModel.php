<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class EvangelismModel extends Model
{
    use HasFactory;
    
    protected $table = 'evangelism_souls_tbl';

    static public function getRecord() {

        return self::select('evangelism_souls_tbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname', 'branchestbl.branchName AS branchName')
                ->join('users', 'users.id', '=', 'evangelism_souls_tbl.user_id')
                ->join('branchestbl', 'branchestbl.id', '=', 'evangelism_souls_tbl.branch_id')
                ->where('evangelism_souls_tbl.is_deleted', '=', 0)
                ->orderBy('evangelism_souls_tbl.id', 'desc')
                ->get();
                // ->paginate(2);

    }

    // static public function getSingle($id) {

    //     return self::find($id);

    // }

    static public function getSingle($id) {

        return self::select('evangelism_souls_tbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname', 'branchestbl.branchName AS branchName')
        ->join('users', 'users.id', '=', 'evangelism_souls_tbl.user_id')
        ->join('branchestbl', 'branchestbl.id', '=', 'evangelism_souls_tbl.branch_id')
        ->where('evangelism_souls_tbl.id', '=', $id)
        ->first();

    }

    
    static public function getRecycleRecord() {

        return self::select('evangelism_souls_tbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname', 'branchestbl.branchName AS branchName')
                ->join('users', 'users.id', '=', 'evangelism_souls_tbl.user_id')
                ->join('branchestbl', 'branchestbl.id', '=', 'evangelism_souls_tbl.branch_id')
                ->where('evangelism_souls_tbl.is_deleted', '=', 1)
                ->orderBy('evangelism_souls_tbl.id', 'desc')
                ->get();
                // ->paginate(2);

    }


    static public function getSelecetdItems() {

        $wordlist = self::select('evangelism_souls_tbl.*');
     
        if (!empty(Request::get('values'))) {

            $ft_id = rtrim(Request::get('values'), ',');
            $ft_id_array = explode(",", $ft_id);

            $wordlist = $wordlist->whereIn('evangelism_souls_tbl.id', $ft_id_array);
        }

            $wordlist = $wordlist->get();
        
        return $wordlist;
    }
}
