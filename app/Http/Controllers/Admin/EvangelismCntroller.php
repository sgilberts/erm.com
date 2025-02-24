<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BranchModel;
use App\Models\Admin\EvangelismModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvangelismCntroller extends Controller
{
   //
   public function list() {

    $currentUser = Auth::user();

    $data['getRecord'] = EvangelismModel::getRecord();
    $data['getBranch'] = BranchModel::getRecords();
    // $data['getUserRole'] = UserRoleModel::getRecord();
    $data['currentUser'] = $currentUser;

    return view('admin.evangelism.list', $data);
}



public function edit_new_soul($id) {

    // dd($id);

    $db_dep = EvangelismModel::getSingle($id);

    // echo json_decode($json);
    $selected_item = response()->json($db_dep);

    return $selected_item;

}


public function add_new_soul(Request $request) {

    // dd($request->all());

    $ft = new EvangelismModel();

    $ft->first_name           = trim($request->first_name);
    $ft->last_name            = trim($request->last_name);
    $ft->email                = trim($request->email);
    $ft->cell_number          = trim($request->cell_number);
    $ft->gender               = trim($request->gender);
    $ft->ft_location          = trim($request->ft_location);
    $ft->report_info          = trim($request->report_info);
    $ft->ft_accept_jesus      = trim($request->ft_accept_jesus);
    $ft->ft_rec_holy          = trim($request->ft_rec_holy);
    $ft->branch_id            = trim($request->branch_id);
    $ft->user_id              = Auth::user()->id;
    $is_success               = $ft->save();

    if(empty($is_success)) {
        $notification = array(
            'title' => 'Failed Adding!',
            'message' => 'New soul could not be created. Please contact Admin',
            'alert-type' => 'danger',
            'icon' => 'alert-outline'
        );

        return redirect('admin/evangelism/list')->with($notification);

    } else {

    
        $notification = array(
            'title' => 'New Soul!',
            'message' => 'New soul successfully created.',
            'alert-type' => 'success',
            'icon' => 'bullseye-arrow'
        );

        return redirect('admin/evangelism/list')->with($notification);

    }

}



public function update_new_soul(Request $request) {

    // dd($request->all());
    
    $ft = EvangelismModel::getSingle($request->id);

    $ft->first_name          = trim($request->fname);
    $ft->last_name           = trim($request->lname);
    $ft->email               = trim($request->email);
    $ft->cell_number         = trim($request->phone);
    $ft->gender              = trim($request->gender);
    $ft->ft_location         = trim($request->location);
    $ft->ft_accept_jesus     = trim($request->ft_accept_jesus);
    $ft->ft_rec_holy         = trim($request->ft_rec_holy);
    $ft->branch_id           = trim($request->branch_id);
    $ft->report_info         = trim($request->report_info);
    $is_success              = $ft->update();

    if(empty($is_success)) {
        $notification = array(
            'title' => 'New Soul Update!',
            'message' => 'New soul could not be updated. Please contact Amin.',
            'alert-type' => 'danger',
            'icon' => 'alert-outline'
        );

        return redirect('admin/evangelism/list')->with($notification);

    } else {

    
        $notification = array(
            'title' => 'New Soul Update!',
            'message' => 'New soul successfully updated.',
            'alert-type' => 'success',
            'icon' => 'bullseye-arrow'
        );

        return redirect('admin/evangelism/list')->with($notification);

    }

}


public function delete_new_soul($id) {

    // dd($id);

    $db_dep = EvangelismModel::getSingle($id);

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

    $data['getRecord'] = EvangelismModel::getRecycleRecord();
    $data['getBranch'] = BranchModel::getRecords();
    // $data['getUserRole'] = UserRoleModel::getRecord();
    $data['currentUser'] = $currentUser;


    return view('admin.evangelism.recycle', $data);
}

public function restore_new_soul($id) {

    // dd($id);

    $db_dep = EvangelismModel::getSingle($id);

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

    $geItems = EvangelismModel::getSelecetdItems();

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



public function pem_delete_new_soul($id) {
    // dd($id);

    $db_ft = EvangelismModel::getSingle($id);


    $isSuccess = $db_ft->delete();

    if ($isSuccess) {
        $notification = array(
            'title' => 'Restore!',
            'message' =>  'new soul password has been reset.',
            'alert_type' => 'success',
            'positionClass' => 'toast-top-right'
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }
}

}
