<?php

namespace App\Models\VOR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadSongModel extends Model
{
    use HasFactory;
    
    protected $table = 'downloadstbl';

    static public function getSongById($id) {

        return self::select('songstbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'songstbl.user_id')
                ->where('songstbl.id', '=', $id)
                ->first();
                // ->paginate(2);

    }

}
