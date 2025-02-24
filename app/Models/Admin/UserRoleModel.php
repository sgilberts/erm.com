<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoleModel extends Model
{
    use HasFactory;

    protected $table = 'userroletbl';

    static public function getRecord() {

        return self::select('userroletbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'userroletbl.user_id')
                ->where('userroletbl.is_deleted', '=', 0)
                // ->orderBy('userroletbl.id', 'desc')
                ->get();
                // ->paginate(2);

    }


    // static public function getRecordCounts() {

    //     $wordlist = self::where('is_deleted', '=', 0)
    //             ->where('status', '=', 1)
    //             ->get();

    //     $wordCount = $wordlist->count();

    //     return $wordCount;

    // }


    
    // static public function getRecordFirst($id) {

    //     $wordlist = self::select('userroletbl.*', 'departments_tbl.name AS dep_name')
    //             ->join('departments_tbl', 'departments_tbl.id', '=', 'userroletbl.department_id')
    //             ->where('userroletbl.id', '=', $id)
    //             ->first();

    //     return $wordlist;

    // }


    
    // public function getDepartments() {

    //     $getSize = $this->hasMany(ProductSizeModel::class, "department_id");
        
    //     return $getSize;

    // }


        
    // static public function getSingle($id) {

    //     return self::find($id);

    // }

}
