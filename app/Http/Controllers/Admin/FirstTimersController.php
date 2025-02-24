<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BranchModel;
use App\Models\Admin\FirstTimersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirstTimersController extends Controller
{
     //
     public function list() {

        $currentUser = Auth::user();

        $data['getRecord'] = FirstTimersModel::getRecord(null);
        $data['getBranch'] = BranchModel::getRecords();
        // $data['getUserRole'] = UserRoleModel::getRecord();
        $data['currentUser'] = $currentUser;

        return view('admin.first_timers.list', $data);
    }


    
    public function edit_first_timer($id) {

        // dd($id);

        $db_dep = FirstTimersModel::getSingle($id);

        // echo json_decode($json);
        $selected_item = response()->json($db_dep);

        return $selected_item;

    }


    public function add_first_timer(Request $request) {

        // dd($request->all());

        $ft = new FirstTimersModel();

        $ft->first_name           = trim($request->first_name);
        $ft->last_name            = trim($request->last_name);
        $ft->email                = trim($request->email);
        $ft->cell_number          = trim($request->cell_number);
        $ft->gender               = trim($request->gender);
        $ft->ft_location          = trim($request->ft_location);
        $ft->ft_interest          = trim($request->ft_interest);
        $ft->ft_accept_jesus      = trim($request->ft_accept_jesus);
        $ft->ft_rec_holy          = trim($request->ft_rec_holy);
        $ft->branch_id            = trim($request->branch_id);
        $ft->user_id              = Auth::user()->id;
        $is_success               = $ft->save();

        if(empty($is_success)) {
            $notification = array(
                'title' => 'Failed Adding!',
                'message' => 'First Timer could not be created. Please contact Admin',
                'alert-type' => 'danger',
                'icon' => 'alert-outline'
            );

            return redirect('admin/first_timers/list')->with($notification);

        } else {

        
            $notification = array(
                'title' => 'First Timer!',
                'message' => 'First Timer successfully created.',
                'alert-type' => 'success',
                'icon' => 'bullseye-arrow'
            );

            return redirect('admin/first_timers/list')->with($notification);

        }
    
    }
    


    public function update_first_timer(Request $request) {

        // dd($request->all());
        
        $ft = FirstTimersModel::getSingle($request->id);

        $ft->first_name          = trim($request->fname);
        $ft->last_name           = trim($request->lname);
        $ft->email               = trim($request->email);
        $ft->cell_number         = trim($request->phone);
        $ft->gender              = trim($request->gender);
        $ft->ft_location         = trim($request->location);
        $ft->ft_accept_jesus     = trim($request->ft_accept_jesus);
        $ft->ft_rec_holy         = trim($request->ft_rec_holy);
        $ft->branch_id           = trim($request->branch_id);
        $ft->ft_interest         = trim($request->ft_interest);
        $is_success              = $ft->update();

        if(empty($is_success)) {
            $notification = array(
                'title' => 'Failed Update!',
                'message' => 'First Timer could not be updated. Please contact Amin.',
                'alert-type' => 'danger',
                'icon' => 'alert-outline'
            );

            return redirect('admin/first_timers/list')->with($notification);

        } else {

        
            $notification = array(
                'title' => 'First Timer!',
                'message' => 'First Timer successfully updated.',
                'alert-type' => 'success',
                'icon' => 'bullseye-arrow'
            );

            return redirect('admin/first_timers/list')->with($notification);

        }

    }


    public function delete_ft($id) {

        // dd($id);

        $db_dep = FirstTimersModel::getSingle($id);

        $db_dep->is_deleted      = 1;
        $db_dep->update();

        $notification = array(
            'title' => 'Delete!',
            'message' =>  $db_dep->fname.' '.$db_dep->lname."'s".' user password has been reset.',
            'alert_type' => 'success',
            'positionClass' => 'toast-top-right'
        );

        $selected_item = response()->json($notification);
        // return redirect('admin/users/list')->with($notification);
        return $selected_item;

    }


    public function recycle() {

        // $user = new User();
        $currentUser = Auth::user();

        $data['getRecord'] = FirstTimersModel::getRecycleRecord();
        $data['getBranch'] = BranchModel::getRecords();
        // $data['getUserRole'] = UserRoleModel::getRecord();
        $data['currentUser'] = $currentUser;


        return view('admin.first_timers.recycle', $data);
    }

    public function restore_ft($id) {

        // dd($id);

        $db_dep = FirstTimersModel::getSingle($id);

        $db_dep->is_deleted   = 0;
        $db_dep->update();

        $notification = array(
            'title' => 'Restore!',
            'message' =>  $db_dep->first_name.' '.$db_dep->last_name."'s".' user password has been reset.',
            'alert_type' => 'success',
            'positionClass' => 'toast-top-right'
        );

        $selected_item = response()->json($notification);
        // return redirect('admin/users/list')->with($notification);
        return $selected_item;

    }

    public function seletedAction(Request $request) {
        // del_sel_form
        // dd($request->all());

        $geItems = FirstTimersModel::getSelecetdItems();

        // dd($geItems);

        $isSuccess = '';

        if ($request->what_to_do == 'del_sel_form') {
            
            foreach ($geItems as $row) {
                $row->is_deleted = 1;
                $isSuccess = $row->update();
            }

            if ($isSuccess) {
                $notification = array(
                    'title' => 'Restore!',
                    'message' => ' user password has been reset.',
                    'alert_type' => 'success',
                    'positionClass' => 'toast-top-right'
                );
        
                $selected_item = response()->json($notification);
                
                return $selected_item;
        
            }

        } elseif ($request->what_to_do == 'restore_sel_form') {
            
            foreach ($geItems as $row) {
                $row->is_deleted = 0;
                $isSuccess = $row->update();
            }

            if ($isSuccess) {
                $notification = array(
                    'title' => 'Restore!',
                    'message' => ' user password has been reset.',
                    'alert_type' => 'success',
                    'positionClass' => 'toast-top-right'
                );
        
                $selected_item = response()->json($notification);
                
                return $selected_item;
        
            }

        } elseif ($request->what_to_do == 'perm_del_sel_form') {
            
            foreach ($geItems as $row) {
                $isSuccess = $row->delete();
            }

            if ($isSuccess) {
                $notification = array(
                    'title' => 'Restore!',
                    'message' => ' user password has been reset.',
                    'alert_type' => 'success',
                    'positionClass' => 'toast-top-right'
                );
        
                $selected_item = response()->json($notification);
                
                return $selected_item;
        
            }

        }
        

    }



    public function pem_delete_ft($id) {
        // dd($id);

        $db_ft = FirstTimersModel::getSingle($id);


        $isSuccess = $db_ft->delete();

        if ($isSuccess) {
            $notification = array(
                'title' => 'Restore!',
                'message' =>  'user password has been reset.',
                'alert_type' => 'success',
                'positionClass' => 'toast-top-right'
            );

            $selected_item = response()->json($notification);

            return $selected_item;
        }
    }

}




function my_pagination($myData) {
    // For Pagination [START]
    $page = 0;
    if (!empty($myData->nextPageUrl())) {
        $parse_url = parse_url($myData->nextPageUrl());
        
        if (!empty($parse_url['query'])) {

            parse_str($parse_url['query'], $get_array);

            $page = $get_array['page'] != null ? ($get_array['page']) : 0;
        }
    }

    // $data['page'] = $page;

    // $return = $data['page'];
    // For Pagination [END]

    return $page;
}