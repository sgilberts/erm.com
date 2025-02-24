<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CalendarModel;
use App\Models\Admin\CalEventTitleModel;
use App\Models\Admin\ChurchAttendanceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChurchAttendanceController extends Controller
{
    //
    public $myData;

    public function list()
    {
        $currentUser = Auth::user();

        $data['getRecord'] = ChurchAttendanceModel::getData();
        $data['getTitleRecord'] = CalEventTitleModel::getRecord();

        return view('admin.attendance.list', $data);

    }

    public function fetch_church_attendance(Request $request) {

        // dd($request->all());
        $currentUser = Auth::user();

        $myId = $request->id;
        $myYear = $request->send_year;
        $myMonth = $request->send_monthly;
        $mySendPeriod = $request->send_period;

        // dd($request->all());

        if ($myId == 'month_chart') {
                     
            
            $this->myData = ChurchAttendanceModel::getDistinctMonth($myYear, $myMonth, $mySendPeriod, $myId);


        } else {
            if (!empty($mySendPeriod)) {

                if ($mySendPeriod == 'DAY') {
                    $this->myData = ChurchAttendanceModel::getRecord($myYear);
                } else {
                    $this->myData = ChurchAttendanceModel::getDistinctMonth($myYear, $myMonth, $mySendPeriod, $myId);
                }
                
            } else {
                $this->myData = ChurchAttendanceModel::getRecord($myYear);
            }

        }
        

        
        
        // $data['getRecord'] = User::getAllUsers();
        // $data = ChurchAttendanceModel::getRecord($myYear);
        
        $notification = array(
            'title' => 'Church Attendance',
            'message' => 'New soul could not be updated. Please contact Amin.',
            'success' => 'success',
            'data' => $this->myData
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }

    public function add_event_date_cal(Request $request) {

        // dd($request->all());

        $myEvent_name = $request->event_name;
        $myEvent_date = $request->event_date;

        $dataExists = ChurchAttendanceModel::checkRecordExists($myEvent_name, $myEvent_date);

        // dd($dataExists);

        if (!empty($dataExists)) {
                     
            
            $notification = array(
                'title' => 'Church Attendance',
                'message' => 'Records already exists!',
                'success' => 'exists',
            );
    
            $selected_item = response()->json($notification);
    
            return $selected_item;


        } else {

            $chc_attendance = new ChurchAttendanceModel();

            $chc_attendance->event_title           = trim($request->event_name);
            $chc_attendance->event_datetime        = trim($request->event_date);
            $chc_attendance->event_title_id        = trim($request->event_name_id);
            $chc_attendance->user_id               = Auth::user()->id;
            $is_success                            = $chc_attendance->save();


            if (!empty($is_success)) {
                $notification = array(
                    'title' => 'Church Attendance',
                    'message' => 'New soul could not be updated. Please contact Amin.',
                    'success' => 'success',
                );
        
                $selected_item = response()->json($notification);
        
                return $selected_item;
            }
    
        }
        

        
        
        // $data['getRecord'] = User::getAllUsers();
        // $data = ChurchAttendanceModel::getRecord($myYear);
        
 
    }


    public function fetch_event_date_cal(Request $request) {

        $myId = $request->id;
       
        // dd($request->all());
     
        $this->myData = CalendarModel::getEventDatesById($myId);
       
        $notification = array(
            'title' => 'Church Attendance',
            'message' => 'New soul could not be updated. Please contact Amin.',
            'success' => 'success',
            'data' => $this->myData
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }

    public function getSingleAttendance(Request $request) {

        $myId = $request->id;
       
        // dd($request->all());
     
        $this->myData = ChurchAttendanceModel::getSingle($myId);
       
        $notification = array(
            'title' => 'Church Attendance',
            'message' => 'New soul could not be updated. Please contact Amin.',
            'success' => 'success',
            'data' => $this->myData
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }


    public function update_single_attendance_data(Request $request) {

        $myId = $request->id;
       
        // dd($request->all());
     
        $cal_event = ChurchAttendanceModel::getSingle($myId);

            $cal_event->males                 = trim($request->males);
            $cal_event->females               = trim($request->females);
            $cal_event->children              = trim($request->children);
            $cal_event->first_timers          = trim($request->first_timers);
            $is_success                       = $cal_event->update();
       
            if (!empty($is_success)) {


                $notification = array(
                    'title' => 'Church Calendar',
                    'message' => 'New soul could not be updated. Please contact Amin.',
                    'success' => 'success',
                );
    
                $selected_item = response()->json($notification);
    
                return $selected_item;
            }
    }

    public function fetch_curhch_attendance_page() {

        // dd($request->all());
        $currentUser = Auth::user();


        $this->myData = ChurchAttendanceModel::getData();

        $notification = array(
            'title' => 'Church Attendance',
            'message' => 'New soul could not be updated. Please contact Amin.',
            'success' => 'success',
            'data' => $this->myData
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }

    public function fetch_church_att_yr() {

        // dd($request->all());
        $currentUser = Auth::user();


                $this->myData = ChurchAttendanceModel::getAreaChart();

        $notification = array(
            'title' => 'Church Attendance',
            'message' => 'New soul could not be updated. Please contact Amin.',
            'success' => 'success',
            'data' => $this->myData
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }

}
