<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMailer;
use App\Models\Admin\ChapterModel;
use App\Models\UserRoleModel;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
     //
     public function list()
     {
 
         $currentUser = Auth::user();
 
         $data['getUsers'] = User::getRecord();
         $data['getUserChapter'] = ChapterModel::getRecords();
         $data['getUserRole'] = UserRoleModel::getRecord();
         $data['currentUser'] = $currentUser;
 
         return view('admin.users.list', $data);
     }
 
 
     public function edit_user($id)
     {
 
         // dd($id);
 
         $db_dep = User::getSingle($id);
 
         // echo json_decode($json);
         $selected_item = response()->json($db_dep);
 
         return $selected_item;
     }
 
     public function app_user_info(Request $request)
     {
 
         $token = $request->token;
 
         $db_user = User::getSingleUser($token);
 
         $db_dep = array(
             'title' => 'User Success',
             'success' => 'success',
             'user_info' => $db_user,
         );
 
         $selected_item = response()->json($db_dep);
 
         return $selected_item;
     }
 
     public function app_upload_user_image(Request $request) {
         
         $user_id = $request->id;
         $file = $request->file('file');
         $file_type = $request->file_type;
 
         $db_user = User::getSingle($user_id);
 
         if ($request->has('file')) {
 
             $ext        = $file->getClientOriginalExtension();
  
             $folderPath = 'uploads/user_img/';
 
             // // $randomStr              = $db_user->id.Str::random(20);
             // // $fileName               = strtolower($randomStr).'.'.$ext;
             $fileName                     = strtolower($db_user->email . $db_user->id) . '.' . $ext;
 
             $fff                          = $file->move(public_path($folderPath), $fileName);
 
             $db_user->img_name            = $fileName;
             $is_success                   = $db_user->update();
                 
             $notification = array(
                 'title' => 'Upload',
                 'message' => $db_user->fname . ' ' . $db_user->lname . "'s" . ' user image has been successfully updated.',
                 'moved' => $fff,
                 'success' => $ext,
                 'data' => 'Just uploaded '.$fileName
             );
 
             $selected_item = response()->json($notification);
 
             return $selected_item;
           
         } else {
             
             $notification = array(
                 'title' => 'Upload',
                 'message' => 'The file is empty',
                 'success' => 'success',
                 'data' => 'Image not valid'
             );
 
             $selected_item = response()->json($notification);
 
             return $selected_item;
 
         }
 
     }
 
 
     public function app_update_user(Request $request)
     {
 
         // dd($request->all());
 
         $user = User::getSingle($request->id);
 
         $user->fname               = trim($request->fname);
         $user->lname               = trim($request->lname);
         $user->email               = trim($request->email);
         $user->username            = trim($request->username);
         $is_success                = $user->update();
 
         if (empty($is_success)) {
             $notification = array(
                 'title' => 'Upload',
                 'message' => 'Error updating ' . $user->fname . ' ' . $user->lname . ' information.',
                 'success' => 'error',
             );
 
             $selected_item = response()->json($notification);
 
             return $selected_item;
         } else {
 
 
             $notification = array(
                 'title' => 'Upload',
                 'message' => $user->fname . ' ' . $user->lname . "'s" . ' user information has been updated successfully.',
                 'success' => 'success',
             );
 
             $selected_item = response()->json($notification);
 
             return $selected_item;
         }
     }
 
     public function change_status(Request $request)
     {
 
         // dd($request->all());
 
         $db_dep = User::getSingle($request->id);
 
         $db_dep->status               = trim($request->send_val);
         $db_dep->update();
 
         $selected_item = response()->json($db_dep);
 
         return $selected_item;
     }
 
 
     public function add_user(Request $request)
     {
 
         // dd($request->all());
 
         $user = new User();
 
         $cdateY = date('ys');
 
         $registartionId = rand(0, 99);
 
         $nameIni = $request->fname[0] . $request->lname[0];
 
         $user_code = $nameIni . $cdateY . $registartionId;
 
         $h_pass = Hash::make(trim($request->password));
 
         // dd($user_code);
 
         $db_user = $user::where('email', '=', $request->email)->first();
 
         // if(!password_verify($request->password, $db_user->password)) {
         //     $notification = array(
         //         'title' => 'Login Denied!',
         //         'message' => 'Sorry, you have entered a wrong password.',
         //         'alert-type' => 'danger',
         //         'icon' => 'alert-outline'
         //     );
 
         //     return redirect()->back()->with($notification);
 
         // }
 
         if ($request->password !== $request->cpassword) {
 
             $notification = array(
                 'title' => 'Password Error!',
                 'message' => 'Sorry, passwords do not match.',
                 'alert-type' => 'danger',
                 'icon' => 'alert-outline'
             );
 
             return redirect()->back()->with($notification);
         } else {
 
             if (!empty($db_user)) {
 
                 $notification = array(
                     'title' => 'Failed Adding!',
                     'message' => 'User already exist. Contact Admin.',
                     'alert-type' => 'danger',
                     'icon' => 'block-helper'
                 );
 
                 return redirect('admin/users/list')->with($notification);
             } else {
 
                 $user->fname                = trim($request->fname);
                 $user->lname                = trim($request->lname);
                 $user->email                = trim($request->email);
                 $user->user_code            = trim($user_code);
                 $user->gender               = trim($request->gender);
                 $user->user_role            = trim($request->user_role);
                 $user->password             = $h_pass;
                 $user->username             = trim($request->username);
                 $user->chapter_id           = trim($request->chapter_id);
                 $user->chapter_role         = trim($request->chapter_role);
                 $is_success                 = $user->save();
 
                 if (empty($is_success)) {
                     $notification = array(
                         'title' => 'Failed Adding!',
                         'message' => 'User could not be created. Please contact M.',
                         'alert-type' => 'danger',
                         'icon' => 'alert-outline'
                     );
 
                     return redirect('admin/users/list')->with($notification);
                 } else {
 
 
                     $notification = array(
                         'title' => 'User Account!',
                         'message' => 'User account successfully created.',
                         'alert-type' => 'success',
                         'icon' => 'bullseye-arrow'
                     );
 
                     return redirect('admin/users/list')->with($notification);
                 }
             }
         }
     }
 
 
     public function update_user(Request $request)
     {
 
         // dd($request->all());
 
         $user = User::getSingle($request->id);
 
         $user->fname                = trim($request->edit_fname);
         $user->lname                = trim($request->edit_lname);
         $user->email                = trim($request->edit_email);
         $user->username            = trim($request->edit_username);
         $user->gender               = trim($request->edit_gender);
         $user->user_role            = trim($request->user_role);
         $user->phone                = trim($request->edit_phone);
         $user->chapter_id           = trim($request->edit_chapter);
         $user->chapter_role         = trim($request->chapter_role);
         $user->about_admin          = trim($request->about_user);
         $is_success                 = $user->update();
 
         if (empty($is_success)) {
             $notification = array(
                 'title' => 'Failed Update!',
                 'message' => 'User could not be updated. Please contact Amin.',
                 'alert-type' => 'danger',
                 'icon' => 'alert-outline'
             );
 
             return redirect('admin/users/list')->with($notification);
         } else {
 
 
             $notification = array(
                 'title' => 'User Account!',
                 'message' => 'User account successfully updated.',
                 'alert-type' => 'success',
                 'icon' => 'bullseye-arrow'
             );
 
             return redirect('admin/users/list')->with($notification);
         }
     }
 
 
     public function reset_user_password($id)
     {
 
         // dd($id);
 
         $h_pass = Hash::make(trim('arm'));
 
         $db_dep = User::getSingle($id);
 
         $db_dep->password      = $h_pass;
         $db_dep->update();
 
         $notification = array(
             'title' => 'Reset User Password!',
             'message' =>  $db_dep->fname . ' ' . $db_dep->lname . "'s" . ' user password has been reset.',
             'alert_type' => 'success',
             'positionClass' => 'toast-top-right'
         );
 
         $selected_item = response()->json($notification);
         // return redirect('admin/users/list')->with($notification);
         return $selected_item;
     }
 
 
     public function delete_user($id)
     {
 
         // dd($id);
 
         $db_dep = User::getSingle($id);
 
         $db_dep->is_deleted      = 1;
         $db_dep->update();
 
         $notification = array(
             'title' => 'Delete!',
             'message' =>  $db_dep->fname . ' ' . $db_dep->lname . "'s" . ' user password has been reset.',
             'alert_type' => 'success',
             'positionClass' => 'toast-top-right'
         );
 
         $selected_item = response()->json($notification);
         // return redirect('admin/users/list')->with($notification);
         return $selected_item;
     }
 
     public function recycle()
     {
 
         // $user = new User();
 
         // dd($user->lname);
 
         $currentUser = Auth::user();
 
         $data['getUsers'] = User::getRecycleRecord();
         $data['getUserChapter'] = ChapterModel::getRecords();
         $data['getUserRole'] = UserRoleModel::getRecord();
         $data['currentUser'] = $currentUser;
 
         return view('admin.users.recycle', $data);
     }
 
 
     public function restore_user($id)
     {
 
         // dd($id);
 
         $db_dep = User::getSingle($id);
 
         $db_dep->is_deleted      = 0;
         $db_dep->update();
 
         $notification = array(
             'title' => 'Restore!',
             'message' =>  $db_dep->fname . ' ' . $db_dep->lname . "'s" . ' user password has been reset.',
             'alert_type' => 'success',
             'positionClass' => 'toast-top-right'
         );
 
         $selected_item = response()->json($notification);
         // return redirect('admin/users/list')->with($notification);
         return $selected_item;
     }
 
     public function online_user($id)
     {
 
         // dd($id);
 
         $db_dep = User::myOnline($id);
 
         // $db_dep->is_deleted      = 0;
         // $db_dep->update();
 
         $notification = array(
             'title' => 'Restore!',
             'message' =>  $db_dep,
             'alert_type' => 'success',
             'positionClass' => 'toast-top-right'
         );
 
         $selected_item = response()->json($notification);
         // return redirect('admin/users/list')->with($notification);
         return $selected_item;
     }
 
 
     public function update_user_image(Request $request)
     {
 
         // dd($request->all());
 
         $db_user = User::getSingle($request->id);
         $image = $request->file('user_image_file');
 
         // ProductImageModel::deleteProductImage($product->id);
 
         if (!empty($image)) {
 
 
             if ($image->isValid()) {
 
                 $ext                    = $image->getClientOriginalExtension();
                 // $randomStr              = $db_user->id.Str::random(20);
                 // $fileName               = strtolower($randomStr).'.'.$ext;
                 $fileName               = strtolower($db_user->email . $db_user->id) . '.' . $ext;
                 $image->move('public/uploads/user_img/', $fileName);
 
 
                 $db_user->img_name = $fileName;
                 $db_user->update();
 
                 $notification = array(
                     'title' => 'User Image',
                     'message' =>  $db_user->fname . ' ' . $db_user->lname . "'s" . ' user image has been successfully updated.',
                     'alert-type' => 'success',
                     'icon' => 'alert-outline'
                 );
 
                 return redirect()->back()->with($notification);
             }
         }
     }
 
 
 
     public function pem_delete_user($id)
     {
         // dd($id);
 
         $image = User::getSingle($id);
 
         if (!empty($image->getAdminImage())) {
 
             if ($image->img_name == null) {
             } else {
 
                 unlink('public/uploads/user_img/' . $image->img_name);
             }
         }
 
         $image->delete();
 
         $notification = array(
             'title' => 'Restore!',
             'message' =>  $image->fname . ' ' . $image->lname . "'s" . ' user password has been reset.',
             'alert_type' => 'success',
             'positionClass' => 'toast-top-right'
         );
 
         $selected_item = response()->json($notification);
 
         return $selected_item;
     }
 
 
 
     public function image_delete($id)
     {
 
 
         $image = User::getSingle($id);
 
         if (!empty($image->getAdminImage())) {
 
             unlink('public/uploads/user_img/' . $image->img_name);
         }
 
         $image->delete();
 
         $notification = array(
             'title' => 'User Image',
             'message' =>  $image->fname . ' ' . $image->lname . "'s" . ' user image has been successfully deleted.',
             'alert-type' => 'success',
             'icon' => 'alert-outline'
         );
 
         return redirect()->back()->with($notification);
     }
 
     public function verify_email($id)
     {
 
 
         $db_user = User::getSingle($id);
 
         $randToken = Str::random(50);
 
         if (!empty($db_user)) {
 
             $db_user->remember_token   = $randToken;
             $is_success                = $db_user->update();
 
             if (!empty($is_success)) {
 
                 $notification = array(
                     'title' => 'Email Verification',
                     'message' => 'The verification link has been sent to the email ' . $db_user->email . '. Please check your mail.',
                     'alert-type' => 'success'
                 );
 
                 $mailData = [
                     'title' => 'Email Verification',
                     'mesasges' => 'Tap the button below to type in your pin code. If you didn\'t create an account with Active Rhema Ministries, you can safely delete this email.',
                     'link' => 'http://192.168.8.137/laravel_proj/arm.com/verify/?email=' . $db_user->email . '&token=' . $randToken,
                     'type' => 'verify',
                     'remember_token' => $randToken,
                     'btn_text' => 'Confirm Email',
                 ];
 
                 Mail::to($db_user->email)->send(new MyMailer($mailData));
 
                 // dd($gg);
                 return redirect()->back()->with($notification);
             }
         }
     }
 
 
     public function verify_now(Request $request)
     {
 
 
         $db_user = User::getUserByEmail($request->email);
 
         if (!empty($db_user)) {
 
             if ($request->token == $db_user->remember_token) {
 
                 $db_user->remember_token   = null;
                 $db_user->verified         = 1;
                 $is_success                = $db_user->update();
 
                 if (!empty($is_success)) {
 
                     $notification = array(
                         'title' => 'Email Verification',
                         'message' => 'Your email has been verified.',
                         'alert-type' => 'success'
                     );
 
                     // dd($gg);
                     return redirect('admin')->with($notification);
                 }
             }
         }
     }
 
 
     public function forgot_page() {
 
         return view('admin.auth.forgot');
     }
 
     public function pincode_page() {
 
         return view('admin.auth.pincode');
     }
     public function forgot_password(Request $request)
     {
 
         // dd($request->all());
 
         $db_user = User::getUserByEmail($request->email);
 
         $randomNumber = random_int(100000, 999999);
         $randToken = $randomNumber;
 
         if (!empty($db_user)) {
 
             $db_user->remember_token   = $randToken;
             $is_success                = $db_user->update();
 
             if (!empty($is_success)) {
 
 
                 $mailData = [
                     'title' => 'Reset Password',
                     'mesasges' => 'Tap the button below to confirm your email address. If you didn\'t create an account with Active Rhema Ministries, you can safely delete this email.',
                     'link' => 'http://192.168.8.137/laravel_proj/arm.com/pincode/?email=' . $db_user->email . '&token=' . $randToken,
                     'type' => 'reset',
                     'pincode' => $randToken,
                     'remember_token' => $randToken,
                     'btn_text' => 'Reset Password',
                 ];
 
                 $sendMail = Mail::to($db_user->email)->send(new MyMailer($mailData));
 
                 if (!empty($sendMail)) {
                     
                     $notification = array(
                         'title' => 'Reset Password',
                         'message' => 'The six digit pin code has been sent to the email ' . $db_user->email . '. Please check your mail.',
                         'alert-type' => 'success'
                     );
 
                     return redirect()->back()->with($notification);
                 }
 
             }
         } else {
             $notification = array(
                 'title' => 'Reset Password',
                 'message' => 'The email ' . $request->email . ' is not registered. Please contant the administrator.',
                 'alert-type' => 'success'
             );
 
             return redirect()->back()->with($notification);
         }
     }
 
 
     public function reset_password(Request $request)
     {
 
 
         $db_user = User::getUserByEmail($request->email);
 
         if (!empty($db_user)) {
 
             if ($request->token == $db_user->remember_token) {
 
                 $db_user->remember_token   = null;
                 $db_user->verified         = 1;
                 $is_success                = $db_user->update();
 
                 if (!empty($is_success)) {
 
                     $notification = array(
                         'title' => 'Email Verification',
                         'message' => 'Your email has been verified.',
                         'alert-type' => 'success'
                     );
 
                     // dd($gg);
                     return redirect('admin')->with($notification);
                 }
             }
         }
     }
 
     public function send_pincode(Request $request) {
 
         $db_user = User::getUserByEmail($request->email);
 
         if (!empty($db_user)) {
            if ($db_user->remember_token == $request->pincode) {
                 $notification = array(
                     'title' => 'New Password',
                     'message' => 'Create New Password',
                     'success' => 'success',
                 );
         
                 $selected_item = response()->json($notification);
         
                 return $selected_item;
            } else {
                 $notification = array(
                     'title' => 'New Password',
                     'message' => 'User does not exist',
                     'success' => 'failed',
                 );
         
                 $selected_item = response()->json($notification);
         
                 return $selected_item;
            }
         }
 
        
     }
 
     public function create_new_password(Request $request) {
 
         $h_pass = Hash::make(trim($request->password));
         $db_user = User::getUserByEmail($request->email);
 
         if (!empty($db_user)) {
 
             $db_user->remember_token   = null;
             $db_user->password         = $h_pass;
             $is_success                = $db_user->update();
 
            if (!empty($is_success)) {
 
             
                 $notification = array(
                     'title' => 'New Password',
                     'message' => 'Create New Password',
                     'success' => 'success',
                 );
         
                 $selected_item = response()->json($notification);
         
                 return $selected_item;
            } else {
                 $notification = array(
                     'title' => 'New Password',
                     'message' => 'New password created succesfully.',
                     'success' => 'failed',
                 );
         
                 $selected_item = response()->json($notification);
         
                 return $selected_item;
            }
         }
 
        
     }
 
}
