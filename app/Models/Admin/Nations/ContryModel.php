<?php

namespace App\Models\Admin\Nations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContryModel extends Model
{
    use HasFactory;

    protected $table = 'countries_tbl';

    static public function getRecord() {

        return self::select('countries_tbl.*')
                ->get();
                // ->paginate(2);

    }
}
