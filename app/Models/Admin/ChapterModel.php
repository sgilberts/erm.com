<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterModel extends Model
{
    use HasFactory;

    protected $table = 'chaptertbl';


    static public function getRecords() {

        return self::select('chaptertbl.*')
                ->where('chaptertbl.status', '=', 1)
                ->where('chaptertbl.is_deleted', '=', 0)
                ->orderBy('chaptertbl.id', 'asc')
                ->get();
                // ->paginate(2);

    }

    static public function getChapter($chapter_id) {

        return self::select('chaptertbl.*')
                ->where('chaptertbl.id', '=', $chapter_id)
                ->get();
                // ->paginate(2);

    }

    static public function getMembersInChapter($chapter_id) {

        return self::select('chaptertbl.*',)
                ->join('membertbl', 'membertbl.id', '=', 'membertbl.chapter_id')
                ->where('membertbl.chapter_id', '=', $chapter_id)
                ->where('membertbl.is_deleted', '=', 0)
                ->get();
                
    }

    public function getManyChapter() {

        $getSize = $this->hasMany(MembersModel::class, "chapter_id");
        
        return $getSize;

    }
}
