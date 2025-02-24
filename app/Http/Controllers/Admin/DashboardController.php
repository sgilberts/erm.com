<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ChurchAttendanceModel;
use App\Models\Admin\FirstTimersModel;
use App\Models\Admin\MembersModel;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    //
    public function dashboard() {

        $currentUser = Auth::user();
        
        $data['getRecord'] = User::getAllUsers();
        $data['getBirthdates'] = MembersModel::getBirthDates();
        $db_bd_page = MembersModel::getBirthDates();

        $data['getNewBD'] = $db_bd_page;
        $data['getAttChartYears'] = ChurchAttendanceModel::getDistinctYears();

        $groupName = '';
                        
        if ($currentUser->user_role == 1) {
            $groupName = 'admin';
        }

        if ($currentUser->user_role == 2) {
            $groupName = 'member';
        }

        if ($currentUser->user_role == 3) {
            $groupName = 'vor_admin';
        }

        if ($currentUser->user_role == 4) {
            $groupName = 'evangelism';
        }

        if ($currentUser->user_role == 5) {
            $groupName = 'it_media';
        }

        if ($currentUser->user_role == 6) {
            $groupName = 'guest';
        }

        return view($groupName.'.dashboard.dashboard', $data);
    }


    public function fetch_birthdates(Request $request) {

        // dd($request->all());
        $currentUser = Auth::user();

        $data = MembersModel::getBirthDates();

        $heta = '';

        foreach ($data as $row) {

          $bd = $this->getCalcBirthdayNoti($row->bdate);
          
          $heta .=  '<tr>
                        <td><h6 class="mb-0">'.$row->first_name.' '.$row->last_name.'</h6></td>
                        <td><div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-'.$bd['btn_color'].' align-middle me-2"></i>'.$row->mem_id.'</div></td>
                        <td>
                        '.$bd['b_status'].'
                        </td>
                        <td>
                        '.getRealShortDate($row->bdate).'
                        </td>
                    </tr>';
        }

        $notification = array(
            'title' => 'New Soul Update!',
            'message' => 'New soul could not be updated. Please contact Amin.',
            'links' => $data->links(),
            'data' => $heta
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }

    
    public function getPaginate($items, $perPage =2, $page = null) {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage;
        $itemstoshow = array_slice($items, $offset, $perPage);
        return new LengthAwarePaginator($itemstoshow, $total, $perPage);
    }


        
    public function getCalcBirthdayNoti($bdate) {

        $tz_object = new DateTimeZone('Africa/Accra');

        $dating = new DateTime("now", $tz_object );
        $curr_full_date = $dating->format('m-d');

        $date = new DateTime("now", $tz_object );
        $curr_date_time = $date->format('m-d');

        $curr_day = $date->format('d');


        $txt_days_left = '';
        $txt_days_ago = '';
        $btn_color = '';
        $text_info_status = '';

        $dates = new DateTime($bdate, $tz_object );
        $my_bd_form = $dates->format('m-d');

        $days_left_form = $dates->format('d');

        $days_left = $days_left_form - $curr_day;
        $days_ago = $curr_day - $days_left_form;

        
        if($days_left == 1) {
            $txt_days_left = '|| A day more';
        } else {
            $txt_days_left = ' || '.$days_left. ' days more';
        }

        if($days_ago == 1) {
            $txt_days_ago = '|| A day ago';
        } else {
            $txt_days_ago = ' || '.$days_ago. ' days ago';
        }


        if ($my_bd_form > $curr_date_time) {
            $b_status = '<span class="badge bg-warning">Pending. '.$txt_days_left.'</span>';

            $btn_color = 'warning';
            $text_info_status = 'Pending. '.$txt_days_left.'';
            
          } elseif ($my_bd_form == $curr_date_time) {
            $b_status = '<span class="badge bg-success">Happening Today</span> <span class="spinner-grow text-success m-1" role="status"></span>';

            $btn_color = 'success';
            $text_info_status = 'Happening Today';

          } elseif ($my_bd_form < $curr_date_time) {
            $b_status = '<span class="badge bg-danger">It is Over '.$txt_days_ago.'</span>';

            $btn_color = 'danger';
            $text_info_status = 'It is Over '.$txt_days_ago.'';
            
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


    public function paginationAjax(Request $request): View
    {
        
        // dd($request->ajax());
        $currentUser = Auth::user();
        
        $data['getRecord'] = User::getAllUsers();
        $data['getBirthdates'] = MembersModel::getBirthDates();
        // $db_bd = MembersModel::getRecord()->toArray();
        $db_bd_page = MembersModel::getBirthDatePage();

        // $bd = $this->getPaginate($db_bd, 3);

        $data['getNewBD'] = $db_bd_page;

        if($request->page > 0)
        {
         
            return view('admin.dashboard._birthday', $data);
        } else {
            return view('admin.dashboard.dashboard', $data);
        }
    }
 

    
    public function get_dashboard_items(Request $request) {

        // dd($request->all());
        $currentUser = Auth::user();

        $year = $request->year;
        $pre_year = $request->pre_year;

        $currentYear = date("Y");
       
                $totalUsers = User::getTotalCounts("is_deleted", 0)->count();
                $active_users = User::getTotalCounts("status", 1)->count();
                $de_active_users = User::getTotalCounts("status", 0)->count();
                $verified_users = User::getTotalCounts("verified", 1)->count();
                $un_verified_users = User::getTotalCounts("verified", 0)->count();
                $total_ft = FirstTimersModel::getRecord($year)->count();
                $total_pre_yr_ft = FirstTimersModel::getRecord($pre_year)->count();
                $total_members =  MembersModel::getRecord('')->count();
                $total_members_now =  MembersModel::getRecord($year)->count();
                $total_members_pre =  MembersModel::getRecord($pre_year)->count();
                $attendance_last =  ChurchAttendanceModel::get_last_row();
                $attendance_record =  ChurchAttendanceModel::get_att_record('');
                $att_now_record =  ChurchAttendanceModel::get_att_record($year);
                $att_pre_record =  ChurchAttendanceModel::get_att_record($pre_year);

        $notification = array(
            'title' => 'Church Attendance',
            'message' => 'New soul could not be updated. Please contact Amin.',
            'success' => 'success',
            'total_users' => $totalUsers,
            'active_users' => $active_users,
            'de_active_users' => $de_active_users,
            'verified_users' => $verified_users,
            'un_verified_users' => $un_verified_users,
            'total_members' => $total_members,
            'total_ft' => $total_ft,
            'attendance_last' => $attendance_last,
            'attendance_record' => $attendance_record,
            'total_pre_yr_ft' => $total_pre_yr_ft,
            'att_now_record' => $att_now_record,
            'att_pre_record' => $att_pre_record,
            'total_members_now' => $total_members_now,
            'total_members_pre' => $total_members_pre,
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }




}




    function getRealBirthDates( $datenow ) {
         $created_date = date( 'D d M', strtotime( $datenow ) );
    
        return $created_date;
    }
  
    function getRealDate( $datenow ) {
        $created_date = date( 'D d M Y, h:i A', strtotime( $datenow ) );
    
        return $created_date;
    }
  
    function getRealShortDate( $datenow ) {
    $created_date = date( 'M d', strtotime( $datenow ) );
    
        return $created_date;
    }
    