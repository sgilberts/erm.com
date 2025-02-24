<?php

namespace App\Http\Controllers\VOR;

use App\Http\Controllers\Controller;
use App\Models\VOR\ScheduleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ScheduleController extends Controller
{
    public $myData;

    public function get_all_schedules()
    {

        // dd($request->all());
        $currentUser = Auth::user();


        $this->myData = ScheduleModel::getAllSchedules();

        $notification = array(
            'title' => 'VOR Schedules',
            'success' => 'success',
            'data' => $this->myData
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }


    public function appAddSchedule(Request $request)
    {

        $eventTitle    = trim($request->event_title);
        $eventDate     = trim($request->event_date);

        $schedule_exist = ScheduleModel::scheduleExists($eventTitle, $eventDate);

        if (!empty($schedule_exist)) {
            $notification = array(
                'title' => 'Schedules',
                'message' => 'The schedule "'.$eventTitle.' Of '. getRealDate($eventDate).'" already exist.',
                'success' => 'error',
            );

            $selected_item = response()->json($notification);

            return $selected_item;
        } else {
                
            $schedules         = new ScheduleModel();

            $schedules->event_title              = $eventTitle;
            $schedules->event_date               = $eventDate;
            $schedules->eve_theme                = trim($request->eve_theme);
            $schedules->worship_song             = trim($request->worship_song);
            $schedules->praise_song              = trim($request->praise_song);
            $schedules->mini_song                = trim($request->mini_song);
            $schedules->offer_song               = trim($request->offer_song);
            $schedules->user_id                  = trim($request->user_id);
            $is_success                          = $schedules->save();

            if (!empty($is_success)) {
                        
                $notification = array(
                    'title' => 'Schedules',
                    'message' => 'Have added '.$eventTitle.' Of '. getRealDate($eventDate).' successfully',
                    'success' => 'success',
                );

                $selected_item = response()->json($notification);

                return $selected_item;
            } 
        
        }
        

    }



    public function appUpdateSchedule(Request $request)
    {
        $schedule_id = $request->id;
        
        $schedules = ScheduleModel::getScheduleById($schedule_id);

        $eventTitle    = trim($request->event_title);
        $eventDate     = trim($request->event_date);

       
        $schedules->event_title              = $eventTitle;
        $schedules->event_date               = $eventDate;
        $schedules->eve_theme                = trim($request->eve_theme);
        $schedules->worship_song             = trim($request->worship_song);
        $schedules->praise_song              = trim($request->praise_song);
        $schedules->mini_song                = trim($request->mini_song);
        $schedules->offer_song               = trim($request->offer_song);
        $is_success                          = $schedules->update();
        
        $notification = array(
            'title' => 'Downloads',
            'message' => 'Have added '.$eventTitle.' Of '. getRealDate($eventDate).' successfully',
            'success' => 'success',
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }

    public function appDeleteSchedule(Request $request)
    {
        $schedule_id = $request->id;
        
        $schedules = ScheduleModel::getScheduleById($schedule_id);

        $eventTitle    = trim($request->event_title);
        $eventDate     = trim($request->event_date);

       
        $is_success    = $schedules->delete();
        
        $notification = array(
            'title' => 'Schedule',
            'message' => $eventTitle.' Of '. getRealDate($eventDate).' has been deleted',
            'success' => 'success',
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
