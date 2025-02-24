<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BranchModel;
use App\Models\Admin\ChapterModel;
use App\Models\Admin\MembersModel;
use App\Models\Admin\Nations\ContryModel;
use App\Models\Admin\Nations\StatesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MembersController extends Controller
{
    //
    public function list() {

        $currentUser = Auth::user();

        $data['getRecord'] = MembersModel::getRecord(null);
        $data['getBranch'] = BranchModel::getRecords();
        $data['getChapter'] = ChapterModel::getRecords();
        $data['getCountry'] = ContryModel::getRecord();
        $data['currentUser'] = $currentUser;

        return view('admin.members.list', $data);
    }


    public function change_status(Request $request) {

        // dd($request->all());

        $db_dep = MembersModel::getSingle($request->id);

        $db_dep->status               = trim($request->send_val);
        $db_dep->update();

        $selected_item = response()->json($db_dep);

        return $selected_item;

    }


    public function get_state_country(Request $request) {


        $country_id = $request->id;
        $stateOfCountry = StatesModel::getRecordByCountry($country_id);
        
        $html = '';

        $html .= '<option value selected disabled>Select State</option>';

        foreach ($stateOfCountry as $row) {
            $html .='<option value="'.$row->id.'">'.$row->name.'</option>';
        }

        $json['html'] = $html;

        // echo json_decode($json);
        $selected_item = response()->json($json);

        return $selected_item;

    }

    
    public function edit_member($id) {

        // dd($id);

        $db_dep = MembersModel::getSingle($id);

        // echo json_decode($json);
        $selected_item = response()->json($db_dep);

        return $selected_item;

    }


    public function add_members(Request $request) {

        // dd($request->all());

        // if ($chapter_counting == '1') {
        //     $chapter_count_msg = $chapter_counting .' member.';
        //   } else {
        //     $chapter_count_msg = '<span class="badge bg-info"> Has [ '.$chapter_counting .' ] Members</span>';
        //   }

        $member = new MembersModel();

        $last_member = $member->get_last_member_id();

        $pre_name = "ARM";
        $pre_year = date('Y');
        $pre_na_yr = $pre_name . $pre_year;

        $new_mem_id = '';
   
        if (!empty($member)) {

            $db_last_id = $last_member->mem_id;

            $mem_id = substr($db_last_id, 7);
            $mem_id = intval($mem_id);
            $next_mem_id = ($mem_id + 1);
            $prefix_id = sprintf('%06d', $next_mem_id );
            $new_mem_id = $pre_na_yr . $prefix_id;

        } else {
                
            $new_mem_id = $pre_na_yr . '000001';

        }
    
            // dd($new_mem_id);
            
        $h_pass = Hash::make(trim('arm'));

        $member->first_name           = trim($request->fname);
        $member->other_names          = trim($request->oname);
        $member->last_name            = trim($request->lname);
        $member->mem_id               = $new_mem_id;
        $member->password             = $h_pass;
        $member->email                = trim($request->email);
        $member->user_code            = Auth::user()->user_code;
        $member->bdate                = !empty($request->dob) ? trim($request->dob) : null;
        $member->contact              = trim($request->contact);
        $member->gps                  = trim($request->gps);
        $member->baptized             = trim($request->baptized);
        $member->bap_date             = !empty($request->bapDate) ? trim($request->bapDate) : null;
        $member->accept_jesus         = trim($request->accept_jesus);
        $member->holy_spirit          = trim($request->recHolySpirit);
        $member->gender               = trim($request->gender);
        $member->location             = trim($request->location);
        $member->nationality_id       = trim($request->nationality_id);
        $member->state_county_id      = trim($request->state_id);
        $member->chapter_id           = trim($request->chapter_id);
        $member->branch_id            = trim($request->branch_id);
        $member->user_id              = Auth::user()->id;
        $is_success               = $member->save();

        if(empty($is_success)) {
            $notification = array(
                'title' => 'Failed Adding!',
                'message' => 'Member could not be created. Please contact Admin',
                'alert-type' => 'danger',
                'icon' => 'alert-outline'
            );

            return redirect('admin/members/list')->with($notification);

        } else {

        
            $notification = array(
                'title' => 'Member!',
                'message' => 'Member successfully created.',
                'alert-type' => 'success',
                'icon' => 'bullseye-arrow'
            );

            return redirect('admin/members/list')->with($notification);

        }
    
    }
    


    public function update_member(Request $request) {

        // dd($request->all());
        
        $member = MembersModel::getSingle($request->id);

        $member->first_name           = trim($request->edit_fname);
        $member->other_names          = trim($request->edit_other_names);
        $member->last_name            = trim($request->edit_lname);
        $member->email                = trim($request->edit_email);
        $member->bdate                = !empty($request->edit_bdate) ? trim($request->edit_bdate) : null;
        $member->contact              = trim($request->edit_phone);
        $member->gps                  = trim($request->edit_gps);
        $member->baptized             = trim($request->edit_baptized);
        $member->bap_date             = !empty($request->edit_bap_date) ? trim($request->edit_bap_date) : null;
        $member->accept_jesus         = trim($request->edit_accept_jesus);
        $member->holy_spirit          = trim($request->edit_holy_spirit);
        $member->gender               = trim($request->edit_gender);
        $member->location             = trim($request->edit_location);
        $member->nationality_id       = trim($request->edit_nationality_id);

        if (!empty($request->edit_state_id)) {
            $member->state_county_id  = trim($request->edit_state_id);
        }
        
        $member->chapter_id           = trim($request->edit_chapter);
        $member->branch_id            = trim($request->edit_branch_name);
        $is_success                   = $member->update();

        if(empty($is_success)) {
            $notification = array(
                'title' => 'Failed Update!',
                'message' => 'Member could not be updated. Please contact Amin.',
                'alert-type' => 'danger',
                'icon' => 'alert-outline'
            );

            return redirect('admin/members/list')->with($notification);

        } else {

        
            $notification = array(
                'title' => 'Member!',
                'message' => 'Member successfully updated.',
                'alert-type' => 'success',
                'icon' => 'bullseye-arrow'
            );

            return redirect('admin/members/list')->with($notification);

        }

    }


    public function delete_member($id) {

        // dd($id);

        $db_dep = MembersModel::getSingle($id);

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

        $data['getRecord'] = MembersModel::getRecycleRecord();
        $data['getBranch'] = BranchModel::getRecords();
        // $data['getUserRole'] = UserRoleModel::getRecord();
        $data['currentUser'] = $currentUser;


        return view('admin.members.recycle', $data);
    }

    public function restore_member($id) {

        // dd($id);

        $db_dep = MembersModel::getSingle($id);

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

        $geItems = MembersModel::getSelecetdItems();

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



    public function pem_delete_member($id) {
        // dd($id);

        $db_member = MembersModel::getSingle($id);


        $isSuccess = $db_member->delete();

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

    public function reset_member_password($id) {

        // dd($id);

        $h_pass = Hash::make(trim('arm'));

        $db_dep = MembersModel::getSingle($id);

        $fname = !empty($db_dep->first_name) ? $db_dep->first_name : '';
        $oname = !empty($db_dep->other_names) ? ' '.$db_dep->other_names : '';
        $lname = !empty($db_dep->last_name) ? ' '.$db_dep->last_name : '';

        $fullName = $fname.$oname.$lname;

        $db_dep->password      = $h_pass;
        $isSuccess             = $db_dep->update();

        if ($isSuccess) {
            $notification = array(
                'title' => 'Reset Member Password!',
                'message' =>  $fullName."'s".' member password has been reset.',
                'alert_type' => 'success',
                'positionClass' => 'toast-top-right'
            );
    
            $selected_item = response()->json($notification);
            // return redirect('admin/users/list')->with($notification);
            return $selected_item;
    
        }

    }


    public function update_member_image(Request $request) {

        // dd($request->all());

        $db_user = MembersModel::getSingle($request->id);
        
        $fname = !empty($db_user->first_name) ? $db_user->first_name : '';
        $oname = !empty($db_user->other_names) ? ' '.$db_user->other_names : '';
        $lname = !empty($db_user->last_name) ? ' '.$db_user->last_name : '';

        $fullName = $fname.$oname.$lname;
        
        $image = $request->file('member_image_file');

        if (!empty($image)) {
        
        
            if ($image->isValid()) {

                $ext                    = $image->getClientOriginalExtension();
                
                $fileName               = strtolower($db_user->email.$db_user->id).'.'.$ext;
                $image->move('public/uploads/mem_img/', $fileName);

                $db_user->mem_img_name = $fileName;
                $isSuccess             = $db_user->update();

                if ($isSuccess) {
                               
                $notification = array(
                    'title' => 'Member Image',
                    'message' =>  $fullName."'s".' member image has been successfully updated.',
                    'alert-type' => 'success',
                    'icon' => 'alert-outline'
                );

                return redirect()->back()->with($notification);

            
                } 

            }
        
         }

    }

    public function pem_delete_user($id) {
        // dd($id);

        $image = MembersModel::getSingle($id);

        if (!empty($image->getAdminImage())) {

            if ($image->mem_img_name == null) {
               
            } else {
                    
                unlink('public/uploads/mem_img/'.$image->mem_img_name);

            }
            
          
        }

        $image->delete();

        $notification = array(
            'title' => 'Restore!',
            'message' =>  $image->fname.' '.$image->lname."'s".' user password has been reset.',
            'alert_type' => 'success',
            'positionClass' => 'toast-top-right'
        );

        $selected_item = response()->json($notification);

        return $selected_item;

    }

}
