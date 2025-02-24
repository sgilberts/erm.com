<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;

class MembersModel extends Model
{
    use HasFactory;

    protected $table = 'membertbl';

    static public function getRecord($myYear)
    {

        $mySql =  self::select(
            'membertbl.*',
            'users.fname AS created_by_fname',
            'users.lname AS created_by_lname',
            'branchestbl.branchName AS branchName',
            'chaptertbl.chapter_name AS chapter_name',
            'countries_tbl.name AS country_name',
            'states_tbl.name AS state_name'
        )
            ->join('users', 'users.id', '=', 'membertbl.user_id')
            ->join('branchestbl', 'branchestbl.id', '=', 'membertbl.branch_id')
            ->join('chaptertbl', 'chaptertbl.id', '=', 'membertbl.chapter_id')
            ->join('countries_tbl', 'countries_tbl.id', '=', 'membertbl.nationality_id')
            ->join('states_tbl', 'states_tbl.id', '=', 'membertbl.state_county_id')
            ->where('membertbl.is_deleted', '=', 0);


        if ($myYear != '' || $myYear != null) {
            // $mySql = $mySql->whereYear('first_timers.created_at', '=', '2021');
            // $mySql = $mySql->whereRaw('YEAR(first_timers.created_at) = 2021');
            $mySql = $mySql->where(DB::raw('YEAR(membertbl.created_at)'), $myYear);
        }

        $mySql = $mySql->orderBy('membertbl.id', 'desc')
            ->get();

        return $mySql;
    }

    // static public function getSingle($id) {

    //     return self::find($id); chapter_id

    // }

    static public function getSingle($id)
    {

        return self::select(
            'membertbl.*',
            'users.fname AS created_by_fname',
            'users.lname AS created_by_lname',
            'branchestbl.branchName AS branchName',
            'chaptertbl.chapter_name AS chapter_name',
            'countries_tbl.name AS country_name',
            'states_tbl.name AS state_name'
        )
            ->join('users', 'users.id', '=', 'membertbl.user_id')
            ->join('branchestbl', 'branchestbl.id', '=', 'membertbl.branch_id')
            ->join('chaptertbl', 'chaptertbl.id', '=', 'membertbl.chapter_id')
            ->join('countries_tbl', 'countries_tbl.id', '=', 'membertbl.nationality_id')
            ->join('states_tbl', 'states_tbl.id', '=', 'membertbl.state_county_id')
            ->where('membertbl.id', '=', $id)
            ->first();
    }


    static public function getRecycleRecord()
    {

        return self::select('membertbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname', 'branchestbl.branchName AS branchName')
            ->join('users', 'users.id', '=', 'membertbl.user_id')
            ->join('branchestbl', 'branchestbl.id', '=', 'membertbl.branch_id')
            ->where('membertbl.is_deleted', '=', 1)
            ->orderBy('membertbl.id', 'desc')
            ->get();
        // ->paginate(2);

    }


    static public function getMembersInChapter($chapter_id)
    {

        return self::select('membertbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname', 'branchestbl.branchName AS branchName')
            ->join('users', 'users.id', '=', 'membertbl.user_id')
            ->join('branchestbl', 'branchestbl.id', '=', 'membertbl.branch_id')
            ->where('membertbl.chapter_id', '=', $chapter_id)
            ->where('membertbl.is_deleted', '=', 0)
            ->orderBy('membertbl.id', 'desc')
            ->get();
        // ->paginate(2);

    }

    static public function getSelecetdItems()
    {

        $wordlist = self::select('membertbl.*');

        if (!empty(Request::get('values'))) {

            $member_id = rtrim(Request::get('values'), ',');
            $member_id_array = explode(",", $member_id);

            $wordlist = $wordlist->whereIn('membertbl.id', $member_id_array);
        }

        $wordlist = $wordlist->get();

        return $wordlist;
    }


    static public function get_last_member_id()
    {

        $wordlist = self::select('membertbl.*')
            ->orderBy('membertbl.id', 'desc')
            ->limit(1)
            ->first();

        return $wordlist;
    }


    public function getMemberImage()
    {

        if (!empty($this->mem_img_name) && file_exists('public/uploads/mem_img/' . $this->mem_img_name)) {

            return url('public/uploads/mem_img/' . $this->mem_img_name);
        } else {
            return url('public/uploads/mem_img/user.jpg');
        }
    }


    static public function getBirthDates()
    {

        $wordlist = self::select(
            'membertbl.*',
            'users.fname AS created_by_fname',
            'users.lname AS created_by_lname',
            'branchestbl.branchName AS branchName',
            'chaptertbl.chapter_name AS chapter_name',
            'countries_tbl.name AS country_name',
            'states_tbl.name AS state_name'
        )
            ->join('users', 'users.id', '=', 'membertbl.user_id')
            ->join('branchestbl', 'branchestbl.id', '=', 'membertbl.branch_id')
            ->join('chaptertbl', 'chaptertbl.id', '=', 'membertbl.chapter_id')
            ->join('countries_tbl', 'countries_tbl.id', '=', 'membertbl.nationality_id')
            ->join('states_tbl', 'states_tbl.id', '=', 'membertbl.state_county_id')
            ->where('membertbl.is_deleted', '=', 0)
            ->whereRaw('WEEK(`bdate`,2) = WEEK(CURDATE(),2)')
            ->orderBy('membertbl.id', 'desc')
            ->get();



        // ->whereRaw("(WEEK(CURDATE()) - WEEK(DATE_FORMAT(`bdate`,'%Y-%m-01')))+1")
        // self::select('membertbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname', 'branchestbl.branchName AS branchName', 'chaptertbl.chapter_name AS chapter_name',
        //         'countries_tbl.name AS country_name', 'states_tbl.name AS state_name')
        //         ->join('users', 'users.id', '=', 'membertbl.user_id')
        //         ->join('branchestbl', 'branchestbl.id', '=', 'membertbl.branch_id')
        //         ->join('chaptertbl', 'chaptertbl.id', '=', 'membertbl.chapter_id')
        //         ->join('countries_tbl', 'countries_tbl.id', '=', 'membertbl.nationality_id')
        //         ->join('states_tbl', 'states_tbl.id', '=', 'membertbl.state_county_id')
        //         ->where('membertbl.is_deleted', '=', 0)
        //         // ->whereBetween('membertbl.bdate', 

        //         //     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
        // ->whereRaw('WEEK(`bdate`,5) - WEEK(DATE_SUB(`bdate`, INTERVAL DAYOFMONTH(`bdate`) - 1 DAY),5) + 1 = WEEK(CURDATE(),5) - WEEK(DATE_SUB(CURDATE(), INTERVAL DAYOFMONTH(CURDATE()) - 1 DAY),5) + 1')
        //         // )
        //         // ->whereBetween('membertbl.bdate', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])
        //         // ->whereBetween('membertbl.bdate', [
        //         //     Carbon::parse('last sunday')->startOfDay(),
        //         //     Carbon::parse('next saturday')->endOfDay(),
        //         // ])
        //         // ->whereBetween('membertbl.bdate', [
        //         //     now()->locale('en')->startOfWeek(),
        //         //     now()->locale('en')->endOfWeek(),
        //         // ])
        //         // ->where(DB::raw('week(membertbl.bdate)'), '=', Carbon::today()->week)
        //         // ->where(getWeekNum('membertbl.bdate'), '<=', $hh)
        //         // ->where(getWeekNum('membertbl.bdate'), '>=', $hh)
        //         ->orderBy('membertbl.id', 'desc');

        return $wordlist;
    }

    // static public function getWeekNum($curDate) {

    //     // $newDate = $curDate->format('Y-m-d');

    //     $ddate = $curDate;
    //     $duedt = explode("-", $ddate);
    //     $date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
    //     $week  = (int)date('W', $date);
    //     // echo "Weeknummer: " . $week;

    //     // $dateTime = new DateTime($curDate);
    //     // $week = $dateTime->format("W"); 

    //     return $week;
    // }

    static public function getBirthDatePage()
    {

        // if (!empty(Request::get('q'))) {
        //     $wordlist = $wordlist->where('products_tbl.title', 'like', '%'.Request::get('q').'%');

        // }

        $wordlist = self::select(
            'membertbl.*',
            'users.fname AS created_by_fname',
            'users.lname AS created_by_lname',
            'branchestbl.branchName AS branchName',
            'chaptertbl.chapter_name AS chapter_name',
            'countries_tbl.name AS country_name',
            'states_tbl.name AS state_name'
        )
            ->join('users', 'users.id', '=', 'membertbl.user_id')
            ->join('branchestbl', 'branchestbl.id', '=', 'membertbl.branch_id')
            ->join('chaptertbl', 'chaptertbl.id', '=', 'membertbl.chapter_id')
            ->join('countries_tbl', 'countries_tbl.id', '=', 'membertbl.nationality_id')
            ->join('states_tbl', 'states_tbl.id', '=', 'membertbl.state_county_id')
            ->where('membertbl.is_deleted', '=', 0)
            ->orderBy('membertbl.id', 'desc')
            ->paginate(2);

        return $wordlist;
    }


    static public function getCalcBirthdayNoti($bdate)
    {

        $tz_object = new DateTimeZone('Africa/Accra');

        $dating = new DateTime("now", $tz_object);
        $curr_full_date = $dating->format('m-d');

        $date = new DateTime("now", $tz_object);
        $curr_date_time = $date->format('m-d');

        $curr_day = $date->format('d');


        $txt_days_left = '';
        $txt_days_ago = '';
        $btn_color = '';
        $text_info_status = '';

        $dates = new DateTime($bdate, $tz_object);
        $my_bd_form = $dates->format('m-d');

        $days_left_form = $dates->format('d');

        $days_left = $days_left_form - $curr_day;
        $days_ago = $curr_day - $days_left_form;


        if ($days_left == 1) {
            $txt_days_left = '|| A day more';
        } else {
            $txt_days_left = ' || ' . $days_left . ' days more';
        }

        if ($days_ago == 1) {
            $txt_days_ago = '|| A day ago';
        } else {
            $txt_days_ago = ' || ' . $days_ago . ' days ago';
        }


        if ($my_bd_form > $curr_date_time) {
            $b_status = '<span class="badge bg-warning">Pending. ' . $txt_days_left . '</span>';

            $btn_color = 'warning';
            $text_info_status = 'Pending. ' . $txt_days_left . '';
        } elseif ($my_bd_form == $curr_date_time) {
            $b_status = '<span class="badge bg-success">Happening Today</span> <span class="spinner-grow text-success m-1" role="status"></span>';

            $btn_color = 'success';
            $text_info_status = 'Happening Today';
        } elseif ($my_bd_form < $curr_date_time) {
            $b_status = '<span class="badge bg-danger">It is Over ' . $txt_days_ago . '</span>';

            $btn_color = 'danger';
            $text_info_status = 'It is Over ' . $txt_days_ago . '';
        }

        $birthInfo = array(
            'title' => 'New Soul Update!',
            'days_left' => $days_left,
            'days_ago' => $days_ago,
            'b_status' => $b_status,
            'btn_color' => $btn_color,
            'curr_full_date' => $curr_full_date,
            'success' => 'success',
            'text_info_status' => $text_info_status
        );

        return $birthInfo;
    }

    // public function getManyChapter() {

    //     $getSize = $this->hasMany(ChapterModel::class, "chapter_id");

    //     return $getSize;

    // }

}


function getWeekNum($curDate)
{

    // $newDate = $curDate->format('Y-m-d');

    $ddate = $curDate;
    $duedt = explode("-", $ddate);
    $date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
    $week  = (int)date('W', $date);
    // echo "Weeknummer: " . $week;

    // $dateTime = new DateTime($curDate);
    // $week = $dateTime->format("W"); 

    return $week;
}
