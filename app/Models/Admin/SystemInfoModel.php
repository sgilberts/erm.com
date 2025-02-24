<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemInfoModel extends Model
{
    use HasFactory;


    protected $table = 'system_info_tbl';

    static public function getRecord() {

        return self::select('system_info_tbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'system_info_tbl.user_id')
                ->where('system_info_tbl.is_deleted', '=', 0)
                // ->orderBy('system_info_tbl.id', 'desc')
                ->get();
                // ->paginate(2);

    }


    
    public function getLightLogo() {
        
        if (!empty($this->image_name_light) && file_exists('public/uploads/system/'.$this->image_name_light)) {
            
            return url('public/uploads/system/'.$this->image_name_light);
        } else {
            return url('public/uploads/system/logo.jpg');
        }

    }

        
    public function getDarkLogo() {
        
        if (!empty($this->image_name_dark) && file_exists('public/uploads/system/'.$this->image_name_dark)) {
            
            return url('public/uploads/system/'.$this->image_name_dark);
        } else {
            return url('public/uploads/system/logo.jpg');
        }

    }

    public function getBackGround() {
        
        if (!empty($this->image_name_dark) && file_exists('public/uploads/system/'.$this->image_name_dark)) {
            
            return url('public/uploads/system/'.$this->image_name_dark);
        } else {
            return url('public/uploads/system/logo.jpg');
        }

    }

    public function getFavicon() {
        
        if (!empty($this->favicon) && file_exists('public/uploads/system/'.$this->favicon)) {
            
            return url('public/uploads/system/'.$this->favicon);
        } else {
            return url('public/uploads/system/logo.jpg');
        }

    }

}
