<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use mysqli;

class ChurchAttendanceModel extends Model
{
    use HasFactory;

    protected $table = 'church_attendace_tbl';



    static public function getData() {

        $mySql =  self::select('church_attendace_tbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'church_attendace_tbl.user_id')
                ->orderBy('church_attendace_tbl.id', 'desc')
                ->get();
                

        return $mySql;

    }

    static public function getRecord($myDate) {

        $mySql =  self::select('church_attendace_tbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'church_attendace_tbl.user_id');
                if (!empty($myDate)) {
                   
                    $mySql = $mySql->where(DB::raw('YEAR(event_datetime)'), $myDate);
                }
               
                $mySql = $mySql->orderBy('church_attendace_tbl.event_datetime', 'asc')
                ->get();
                

        return $mySql;

    }

    static public function getDistinctYears() {

        return self::select(DB::raw('YEAR(event_datetime) as year'))
        ->orderBy('church_attendace_tbl.event_datetime', 'desc')
        ->distinct()
        ->get();

    }



    static public function getEventDatesById($id) {

        $mySql =  self::select('church_attendace_tbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'church_attendace_tbl.user_id')
                ->where('church_attendace_tbl.event_title_id', '=', $id)
                ->orderBy('church_attendace_tbl.event_datetime', 'desc')
                ->get();
                

        return $mySql;

    }


    static public function checkRecordExists($event_title, $event_date) {

        $mySql =  self::select('church_attendace_tbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'church_attendace_tbl.user_id')
                ->where('church_attendace_tbl.event_title', '=', $event_title)
                ->where('church_attendace_tbl.event_datetime', '=', $event_date)
                ->first();
                

        return $mySql;

    }


    
    private $mySqls;

    static public function getDistinctMonth($myYear, $myMonth, $mySendPeriod, $myId) {

        $d = $myYear.'-'.$myMonth.'-01';

        // dd($myYear);
        // $formatted_date = $d->format('Y-m-d');
        // $date = date_create_from_format("m-d-Y", "10-16-2003")->format("Y-m-d");

        // $ddd = new date('y', 'format');


        if ($myId == 'month_chart') {

            $mySqls = self::select('church_attendace_tbl.*')
            ->where(DB::raw('YEAR(event_datetime)'), $myYear)
            ->where(DB::raw('MONTH(event_datetime)'), $myMonth)
            // ->WHERE('YEAR(event_datetime)= 2023')
            // ->WHERE('MONTH(event_datetime)= December')
            ->orderBy('church_attendace_tbl.event_datetime', 'asc')
            ->get();
    
    


        } else if (!empty($mySendPeriod)) {
         
         
            if ($mySendPeriod == 'MONTH') {
                // dd('gggggggg');
                $mySqls =  self::select(
                    DB::raw('SUM(males) AS `males`'), 
                    DB::raw('SUM(females) AS `females`'), 
                    DB::raw('SUM(children) AS `children`'), 
                    DB::raw('SUM(first_timers) AS `first_timers`'), 
                    DB::raw("DATE_FORMAT(event_datetime, '%Y-%m') new_date"),
                    // DB::raw('YEAR(event_datetime) year, MONTH(event_datetime) month')
                    )
                    ->where(DB::raw('YEAR(event_datetime)'), $myYear)
                    // ->where(DB::raw('MONTH(event_datetime)'), $myMonth)
                    ->groupby('new_date')
                    ->get();

            } else if ($mySendPeriod == 'WEEK') {

                $mySqls =  self::select(
                    DB::raw('SUM(males) AS `males`'), 
                    DB::raw('SUM(females) AS `females`'), 
                    DB::raw('SUM(children) AS `children`'), 
                    DB::raw('SUM(first_timers) AS `first_timers`'), 
                    DB::raw('MAX(event_datetime) AS `new_date`'),
                    // DB::raw("DATE_FORMAT(event_datetime, '%Y-%m-%d') new_date"),
                    DB::raw("DATE_FORMAT(event_datetime, '%U') new_week"),
                    )
                    ->where(DB::raw('YEAR(event_datetime)'), $myYear)
                    // ->where(DB::raw('MONTH(event_datetime)'), $myMonth)
                    // ->whereRaw('WEEK(`event_datetime`,2) = WEEK(CURDATE(),2)')
                    ->groupby('new_week')
                    // ->orderBy('new_date', 'asc')
                    ->get();
            }
            

        }


        return $mySqls;

    }

    static public function getAreaChart() {
        
        $ddd = Date('Y');

        $mySqls = self::select('church_attendace_tbl.*')
        ->where(DB::raw('YEAR(event_datetime)'), $ddd)
        // ->WHERE('YEAR(event_datetime)= 2023')
        // ->WHERE('MONTH(event_datetime)= December')
        ->orderBy('church_attendace_tbl.event_datetime', 'asc')
        ->get();

        return $mySqls;
    }

    static public function getSingle($id) {

        return self::select('church_attendace_tbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
        ->join('users', 'users.id', '=', 'church_attendace_tbl.user_id')
        ->where('church_attendace_tbl.id', '=', $id)
        ->first();

    }

    
    static public function getRecycleRecord() {

        return self::select('church_attendace_tbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname', 'branchestbl.branchName AS branchName')
                ->join('users', 'users.id', '=', 'church_attendace_tbl.user_id')
                ->join('branchestbl', 'branchestbl.id', '=', 'church_attendace_tbl.branch_id')
                ->where('church_attendace_tbl.is_deleted', '=', 1)
                ->orderBy('church_attendace_tbl.id', 'desc')
                ->get();
                // ->paginate(2);

    }


    static public function getMembersInChapter($chapter_id) {

        return self::select('church_attendace_tbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname', 'branchestbl.branchName AS branchName')
                ->join('users', 'users.id', '=', 'church_attendace_tbl.user_id')
                ->join('branchestbl', 'branchestbl.id', '=', 'church_attendace_tbl.branch_id')
                ->where('church_attendace_tbl.chapter_id', '=', $chapter_id)
                ->where('church_attendace_tbl.is_deleted', '=', 0)
                ->orderBy('church_attendace_tbl.id', 'desc')
                ->get();
                // ->paginate(2);

    }

    static public function getSelecetdItems() {

        $wordlist = self::select('church_attendace_tbl.*');
     
        if (!empty(Request::get('values'))) {

            $member_id = rtrim(Request::get('values'), ',');
            $member_id_array = explode(",", $member_id);

            $wordlist = $wordlist->whereIn('church_attendace_tbl.id', $member_id_array);
        }

            $wordlist = $wordlist->get();
        
        return $wordlist;
    }


    static public function get_last_row() {

        $wordlist = self::select('church_attendace_tbl.*')
        ->orderBy('church_attendace_tbl.id', 'desc')
        // ->limit(1)
        ->get();
     
        return $wordlist;
    }

    static public function get_att_record($myYear) {

        $mySql = self::select('church_attendace_tbl.*');
        if ($myYear != '' || $myYear != null) {
            // $mySql = $mySql->whereYear('first_timers.created_at', '=', '2021');
            // $mySql = $mySql->whereRaw('YEAR(first_timers.created_at) = 2021');
            $mySql = $mySql->where(DB::raw('YEAR(church_attendace_tbl.event_datetime)'), $myYear);
        }
        $mySql = $mySql->orderBy('church_attendace_tbl.id', 'desc')
        ->get();
     
        return $mySql;
    }
    
    
    public function getMemberImage() {

        if (!empty($this->mem_img_name) && file_exists('public/uploads/mem_img/'.$this->mem_img_name)) {
            
            return url('public/uploads/mem_img/'.$this->mem_img_name);
        } else {
            return url('public/uploads/mem_img/user.jpg');
        }

    }


    static public function getBirthDates() {

        $wordlist = self::select('church_attendace_tbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname', 'branchestbl.branchName AS branchName', 'chaptertbl.chapter_name AS chapter_name',
        'countries_tbl.name AS country_name', 'states_tbl.name AS state_name')
        ->join('users', 'users.id', '=', 'church_attendace_tbl.user_id')
        ->join('branchestbl', 'branchestbl.id', '=', 'church_attendace_tbl.branch_id')
        ->join('chaptertbl', 'chaptertbl.id', '=', 'church_attendace_tbl.chapter_id')
        ->join('countries_tbl', 'countries_tbl.id', '=', 'church_attendace_tbl.nationality_id')
        ->join('states_tbl', 'states_tbl.id', '=', 'church_attendace_tbl.state_county_id')
        ->where('church_attendace_tbl.is_deleted', '=', 0)
        ->whereRaw('WEEK(`bdate`,2) = WEEK(CURDATE(),2)')
        ->orderBy('church_attendace_tbl.id', 'desc')
        ->get();
        
        
        
        // ->whereRaw("(WEEK(CURDATE()) - WEEK(DATE_FORMAT(`bdate`,'%Y-%m-01')))+1")
        // self::select('church_attendace_tbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname', 'branchestbl.branchName AS branchName', 'chaptertbl.chapter_name AS chapter_name',
        //         'countries_tbl.name AS country_name', 'states_tbl.name AS state_name')
        //         ->join('users', 'users.id', '=', 'church_attendace_tbl.user_id')
        //         ->join('branchestbl', 'branchestbl.id', '=', 'church_attendace_tbl.branch_id')
        //         ->join('chaptertbl', 'chaptertbl.id', '=', 'church_attendace_tbl.chapter_id')
        //         ->join('countries_tbl', 'countries_tbl.id', '=', 'church_attendace_tbl.nationality_id')
        //         ->join('states_tbl', 'states_tbl.id', '=', 'church_attendace_tbl.state_county_id')
        //         ->where('church_attendace_tbl.is_deleted', '=', 0)
        //         // ->whereBetween('church_attendace_tbl.bdate', 

        //         //     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
        // ->whereRaw('WEEK(`bdate`,5) - WEEK(DATE_SUB(`bdate`, INTERVAL DAYOFMONTH(`bdate`) - 1 DAY),5) + 1 = WEEK(CURDATE(),5) - WEEK(DATE_SUB(CURDATE(), INTERVAL DAYOFMONTH(CURDATE()) - 1 DAY),5) + 1')
        //         // )
        //         // ->whereBetween('church_attendace_tbl.bdate', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])
        //         // ->whereBetween('church_attendace_tbl.bdate', [
        //         //     Carbon::parse('last sunday')->startOfDay(),
        //         //     Carbon::parse('next saturday')->endOfDay(),
        //         // ])
        //         // ->whereBetween('church_attendace_tbl.bdate', [
        //         //     now()->locale('en')->startOfWeek(),
        //         //     now()->locale('en')->endOfWeek(),
        //         // ])
        //         // ->where(DB::raw('week(church_attendace_tbl.bdate)'), '=', Carbon::today()->week)
        //         // ->where(getWeekNum('church_attendace_tbl.bdate'), '<=', $hh)
        //         // ->where(getWeekNum('church_attendace_tbl.bdate'), '>=', $hh)
        //         ->orderBy('church_attendace_tbl.id', 'desc');
                    
                return $wordlist;

    }



    // static public funrow {

    //     $wordlist = self::select('membertbl.*')
    //     ->orderBy('membertbl.id', 'desc')
    //     ->limit(1)
    //     ->first();
     
    //     return $wordlist;
    // }
}
