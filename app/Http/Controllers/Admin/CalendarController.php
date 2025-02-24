<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CalendarModel;
use App\Models\Admin\CalEventTitleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    //

    public $myData;

    public function home()
    {

        return view('admin.calendar.home');
    }

    public function fetch_calendar_items()
    {

        // dd('Meeeeeee');
        $currentUser = Auth::user();

        $this->myData = CalendarModel::getRecord();

        $notification = array(
            'title' => 'Church Calendar',
            'message' => 'New soul could not be updated. Please contact Amin.',
            'success' => 'success',
            'data' => $this->myData
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }



    public function save_new_event(Request $request)
    {

        dd($request->all());
        $currentUser = Auth::user();

        $this->myData = CalendarModel::getRecord();

        $notification = array(
            'title' => 'Church Calendar',
            'message' => 'New soul could not be updated. Please contact Amin.',
            'success' => 'success',
            'data' => $this->myData
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }

    public function update_church_events(Request $request)
    {

        dd($request->all());
        if ($request->id == 'new') {
            
            $cal_event = new CalendarModel();

            $cal_event->title           = trim($request->title);
            $cal_event->start           = trim($request->start);
            $cal_event->end             = trim($request->end);


            if (!empty($request->color)) {
                $cal_event->color      = trim($request->color);
            }

            if (!empty($request->descript)) {
                $cal_event->descript   = trim($request->descript);
            }


            if ($request->allDay == 'true') {
                $cal_event->allDay   = 1;
            } else {
                $cal_event->allDay   = 0;
            }

            $cal_event->user_id              = Auth::user()->id;
            $is_success               = $cal_event->save();


            if (!empty($is_success)) {


                $notification = array(
                    'title' => 'Church Calendar',
                    'message' => 'New soul could not be updated. Please contact Amin.',
                    'success' => 'success',
                );
    
                $selected_item = response()->json($notification);
    
                return $selected_item;
            }

        } else {

            $cal_event = CalendarModel::getSingle($request->id);

            $cal_event->title          = trim($request->title);
            $cal_event->start          = trim($request->start);

            if (!empty($request->end)) {
                $cal_event->end        = trim($request->end);
            }

            if (!empty($request->color)) {
                $cal_event->color      = trim($request->color);
            }

            if (!empty($request->descript)) {
                $cal_event->descript   = trim($request->descript);
            }


            if ($request->allDay == 'true') {
                $cal_event->allDay   = 1;
            } else {
                $cal_event->allDay   = 0;
            }

            // $cal_event->allDay         = trim($request->allDay);
            $is_success                = $cal_event->update();

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

    }



    public function fetch_cal_title_names()
    {

        // dd('Meeeeeee');
        $currentUser = Auth::user();

        $this->myData = CalEventTitleModel::getRecord();

        $notification = array(
            'title' => 'Church Calendar',
            'message' => 'New soul could not be updated. Please contact Amin.',
            'success' => 'success',
            'data' => $this->myData
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }



    public function pem_delete_ft(Request $request) {
        // dd($id);

        $db_ft = CalendarModel::getSingle($request->id);


        $isSuccess = $db_ft->delete();

        if ($isSuccess) {
            $notification = array(
                'title' => 'Restore!',
                'message' =>  'user password has been reset.',
                'success' => 'success',
                'positionClass' => 'toast-top-right'
            );

            $selected_item = response()->json($notification);

            return $selected_item;
        }
    }

}
