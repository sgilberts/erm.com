<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchModel extends Model
{
    use HasFactory;

    protected $table = 'branchestbl';

    static public function getRecords() {

        return self::select('branchestbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'branchestbl.user_id')
                ->where('branchestbl.is_deleted', '=', 0)
                ->orderBy('branchestbl.id', 'asc')
                ->get();
                // ->paginate(2);

    }

}
