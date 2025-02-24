<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    static public function getSingleEmail($email) {

        return User::select('users.*', 'userroletbl.role_name AS role_name')
        ->join('userroletbl', 'userroletbl.id', '=', 'users.user_role')
        ->where('users.email', '=', $email)
        ->where('users.is_deleted', '=', 0)
        ->first();

    }

    static public function getSingleUser($token) {

        return User::select('users.*', 'userroletbl.role_name AS role_name')
        ->join('userroletbl', 'userroletbl.id', '=', 'users.user_role')
        ->where('users.remember_token', '=', $token)
        ->where('users.is_deleted', '=', 0)
        ->first();

    }

    static public function getSingle($id) {

        return User::find($id);

    }


    static public function getAdminUsers() {

        return User::select('users.*')
                // ->where('user_role', '=', 1)
                ->where('is_deleted', '=', 0)
                ->orderBy('id', 'desc')
                ->get();

    }

        static public function getAllUsers() {

        return User::select('users.*');

    }


    public function getUserRoles() {

        $getSize = $this->hasMany(UserRoleModel::class, "id");
        
        return $getSize;

    }

    static public function getRecord() {

        return self::select('users.*', 'users.fname AS created_by_fname', 'userroletbl.role_name AS role_name', 'chaptertbl.chapter_name AS chapter_name')
                ->join('userroletbl', 'userroletbl.id', '=', 'users.user_role')
                ->join('chaptertbl', 'chaptertbl.id', '=', 'users.chapter_id')
                ->where('users.is_deleted', '=', 0)
                ->orderBy('users.id', 'asc')
                ->get();
                // ->paginate(2);

    }


    static public function getRecycleRecord() {

        return self::select('users.*', 'users.fname AS created_by_fname', 'userroletbl.role_name AS role_name', 'chaptertbl.chapter_name AS chapter_name')
                ->join('userroletbl', 'userroletbl.id', '=', 'users.user_role')
                ->join('chaptertbl', 'chaptertbl.id', '=', 'users.chapter_id')
                ->where('users.is_deleted', '=', 1)
                ->orderBy('users.id', 'asc')
                ->get();
                // ->paginate(2);

    }

    public function isOnline() {

        $line = Cache::has('user-is-online-' . $this->id);

        return $line;
    }

    
    static public function myOnline($id) {

        $line = Cache::has('user-is-online-' . $id);

        return $line;
    }


    
    public function getAdminImage() {

        if (!empty($this->img_name) && file_exists('public/uploads/user_img/'.$this->img_name)) {
            
            return url('public/uploads/user_img/'.$this->img_name);
        } else {
            return url('public/uploads/user_img/user.jpg');
        }

    }


    // public function getUserChapter() {

    //     $getSize = $this->hasMany(ChapterModel::class, "chapter_id");
        
    //     return $getSize;

    // }

    
    static public function getUserByEmail($email) {

        return self::select('users.*')
                ->where('users.email', '=', $email)
                ->first();

    }


    static public function getTotalCounts($column, $data) {

        // $column = "is_deleted";
        // $data = 0;

        return self::select('users.*', 'users.fname AS created_by_fname', 'userroletbl.role_name AS role_name', 'chaptertbl.chapter_name AS chapter_name')
                ->join('userroletbl', 'userroletbl.id', '=', 'users.user_role')
                ->join('chaptertbl', 'chaptertbl.id', '=', 'users.chapter_id')
                ->where("users.".$column, '=', $data)
                ->orderBy('users.id', 'asc')
                ->get();
                // ->paginate(2);

    }

}
