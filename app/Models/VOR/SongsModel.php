<?php

namespace App\Models\VOR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SongsModel extends Model
{
    use HasFactory;

    protected $table = 'songstbl';

    static public function getAllSongs() {

        return self::select('songstbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'songstbl.user_id')
                // ->where('songstbl.is_deleted', '=', 0)
                ->orderBy('songstbl.id', 'desc')
                ->get();
                // ->paginate(2);

    }


    static public function getFavSong($mYValues) {

        return self::select('songstbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'songstbl.user_id')
                // ->where('songstbl.is_deleted', '=', 0)
                ->orderBy('songstbl.'.$mYValues, 'desc')
                ->get();
                // ->paginate(2);

    }

    
    static public function getDistinctArtiste() {

        return self::select('songstbl.artiste')
        ->orderBy('songstbl.artiste', 'asc')
        ->distinct()
        ->get();

    }

    static public function getFirstArtisteInfo($artiste) {

        $wordlist = self::select('songstbl.*')
        ->where('songstbl.artiste', '=', $artiste)
        ->limit(1)
        ->first();
     
        return $wordlist;
    }

    static public function getAllSongsByArtiste($artiste) {

        $wordlist = self::select('songstbl.*')
        ->where('songstbl.artiste', '=', $artiste)
        ->orderBy('songstbl.songTitle', 'asc')
        ->get();
     
        return $wordlist;
    }


    static public function getSongById($id) {

        return self::select('songstbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'songstbl.user_id')
                ->where('songstbl.id', '=', $id)
                ->first();

    }

               
    static public function songExists($songTitle, $artiste) {

        return self::select('songstbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'songstbl.user_id')
                ->where('songstbl.songTitle', '=', $songTitle)
                ->where('songstbl.artiste', '=', $artiste)
                ->first();

    }


    public function getSongFile() {

        if (!empty($this->file_names) && file_exists('public/vor/songs/'.$this->file_names)) {
            
            return url('public/vor/songs/'.$this->file_names);
        } else {
            return null;
        }

    }

    public function getSongImage() {

        if (!empty($this->cover_image) && file_exists('public/vor/songimg/'.$this->cover_image)) {
            
            return url('public/vor/songimg/'.$this->cover_image);
        } else {
            return null;
        }

    }


}
