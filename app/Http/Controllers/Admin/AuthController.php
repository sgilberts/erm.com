<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MyMailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    //
        //
        public function login_post(Request $request) {

            // $h_pass = Hash::make('admin');
            // dd($h_pass);
          
            $remember = $request->remember == 'on' ? true : false;
    
            $user = new User();
    
            // dd($request->all());
    
            // if (!empty($user->email)) {
                
                // Fetch user information
                $db_user = $user::where('email', '=', $request->email)->first();
    
                // Check if any field is empty
                // dd($db_user->password);
    
                if(empty($db_user)) {
    
                    $notification = array(
                        'title' => 'Login Denied!',
                        'message' => 'User does not exist. Contact Admin.',
                        'alert-type' => 'danger',
                        'icon' => 'block-helper'
                    );
    
                    return redirect()->back()->with($notification);
                } else {
    
                    if(!password_verify($request->password, $db_user->password)) {
                        $notification = array(
                            'title' => 'Login Denied!',
                            'message' => 'Sorry, you have entered a wrong password.',
                            'alert-type' => 'danger',
                            'icon' => 'alert-outline'
                        );
    
                        return redirect()->back()->with($notification);
    
                    } else {
    
                        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_role' => $db_user->user_role, 'is_deleted' => 0], $remember)) {
    
                            // dd($data->all());
                            $groupName = '';
                            
                            if ($db_user->user_role == 1) {
                                $groupName = 'admin';
                            }
    
                            if ($db_user->user_role == 2) {
                                $groupName = 'member';
                            }
    
                            if ($db_user->user_role == 3) {
                                $groupName = 'vor_admin';
                            }
    
                            if ($db_user->user_role == 4) {
                                $groupName = 'evangelism';
                            }
    
                            if ($db_user->user_role == 5) {
                                $groupName = 'it_media';
                            }
    
                            if ($db_user->user_role == 6) {
                                $groupName = 'guest';
                            }
    
                            $mf_name = !empty($db_user->fname) ? $db_user->fname : '';
                            $ml_name = !empty($db_user->lname) ? ' '.$db_user->lname : '';
                            $full_name = $mf_name.$ml_name;
    
                            $notification = array(
                                'title' => 'Login Success',
                                'message' => 'You are welcome '.$full_name,
                                'alert-type' => 'success',
                                'icon' => 'bullseye-arrow'
                            );
    
                            return redirect($groupName)->with($notification);
                
                        } else {
    
                            $notification = array(
                                'title' => 'Login Denied!',
                                'message' => 'Error login, please try again.',
                                'alert-type' => 'danger',
                                'icon' => 'alert-circle-outline'
                            );
                
                            return redirect()->back()->with($notification);
                        }
    
                    }
                }
                
            // } else {
                
            //     $notification = array(
            //         'title' => 'Login Denied!',
            //         'message' => 'Server is down. Please contact administrator.',
            //         'alert-type' => 'danger'
            //     );
    
            //     return redirect()->back()->with($notification);
            // }
    
        }
    
    
        //
        public function appLogin(Request $request) {
    
            $remember = true;
    
            $email = $request->email;
    
            $user = new User();
    
                $db_user = $user::where('email', '=', $email)->first();
    
                if(empty($db_user)) {
    
                    $notification = array(
                        'title' => 'Login Success',
                        'message' => 'User does not exist. Contact Admin.',
                        'success' => 'no_user',
                        'token' => 'User does not exist. Contact Admin.'
                    );
    
                    $selected_item = response()->json($notification);
    
                    return $selected_item;
                } else {
    
                    if(!password_verify($request->password, $db_user->password)) {
                        $notification = array(
                            'title' => 'Login Success',
                            'message' => 'Sorry, you have entered a wrong password.',
                            'success' => 'wrong_pass',
                            'token' => 'Sorry, you have entered a wrong password.'
                        );
        
                        $selected_item = response()->json($notification);
        
                        return $selected_item;
    
                    } else {
    
                        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_role' => $db_user->user_role, 'is_deleted' => 0], $remember)) {
    
                            $groupName = '';
                            
                            if ($db_user->user_role == 1) {
                                $groupName = 'admin';
                            }
    
                            if ($db_user->user_role == 2) {
                                $groupName = 'member';
                            }
    
                            if ($db_user->user_role == 3) {
                                $groupName = 'vor_admin';
                            }
    
                            if ($db_user->user_role == 4) {
                                $groupName = 'evangelism';
                            }
    
                            if ($db_user->user_role == 5) {
                                $groupName = 'it_media';
                            }
    
                            if ($db_user->user_role == 6) {
                                $groupName = 'guest';
                            }
    
                            
                            $randToken = Str::random(400);
                            $db_user->remember_token   = $randToken;
                            $is_success                = $db_user->update();
    
                            $new_user =  User::getSingleEmail($email);
    
                            $mf_name = !empty($db_user->fname) ? $db_user->fname : '';
                            $ml_name = !empty($db_user->lname) ? ' '.$db_user->lname : '';
                            $full_name = $mf_name.$ml_name;
    
                            $notification = array(
                                'title' => 'Login Success',
                                'message' => 'You are welcome '.$full_name,
                                'success' => 'success',
                                'token' => $randToken,
                                'user' => $new_user,
                            );
    
                            $selected_item = response()->json($notification);
    
                            return $selected_item;
                
                        } else {
    
                            $notification = array(
                                'title' => 'Login Denied!',
                                'message' => 'Error login, please try again.',
                                'success' => 'error',
                                'token' => 'Error login, please try again.'
                            );
                
                            $selected_item = response()->json($notification);
    
                            return $selected_item;
                        }
    
                    }
                }
    
        }
        
        public function forgot() {
            return view('admin.auth.forgot');
        }
    
    
    
        // public function forgot_post(Request $request) {
    
        //     // dd($request->all());
    
        //     $user = new User();
    
        //     // Fetch user information
        //     $db_user = $user::where('email', '=', $request->email)->first();
    
        //     if(!empty($db_user)) {
    
        //         $db_user->remember_token   = Str::random(50);
        //         $db_user->update();
    
        //         $notification = array(
        //             'title' => 'Reset Password',
        //             'message' => 'The reset password link has been sent to the email '.$db_user->email.'. Please check your mail.',
        //             'alert-type' => 'success'
        //         );
    
        //         Mail::to($db_user->email)->send(new ForgoPasswordMailer($db_user));
    
        //         // dd($gg);
        //         return redirect()->back()->with($notification);
    
        //      } else {
    
        //         $notification = array(
        //             'title' => 'Reset Password!',
        //             'message' => 'Sorry, user email is not registered in the system.',
        //             'alert-type' => 'danger'
        //         );
    
        //         return redirect()->back()->with($notification);
    
        //      }
        // }
    
    
        public function get_reset($token) {
    
            // dd($token);
            
            $user = new User();
    
            $db_user = $user::where('remember_token', '=', $token)->first();
    
            if (!empty($db_user)) {
                
                $data['token'] = $db_user->remember_token;
    
                return view('admin.auth.reset', $data);
            } else {
                abort(404);
            }
    
    
        }
    
    
        
        public function appSendEmail(Request $request)
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
                            'success' => 'success',
                        );
    
                        $selected_item = response()->json($notification);
    
                        return $selected_item;
                    } else {
                        $notification = array(
                            'title' => 'Reset Password',
                            'message' => 'Error sending code to the email ' . $db_user->email . '. Please check your email.',
                            'success' => 'error',
                        );
            
                        $selected_item = response()->json($notification);
            
                        return $selected_item;
                    }
    
                }
            } else {
                $notification = array(
                    'title' => 'Reset Password',
                    'message' => 'The email ' . $request->email . ' is not registered. Please contant the administrator.',
                    'success' => 'no_user',
                );
    
                $selected_item = response()->json($notification);
    
                return $selected_item;
            }
        }
    
    
        public function appSubmitPin(Request $request) {
    
            $db_user = User::getUserByEmail($request->email);
    
            $pin_code = trim($request->remember_token);
    
            if (!empty($db_user)) {
               if ($db_user->remember_token == $pin_code) {
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
                        'message' => 'Wrong Pin Code. Please try again.',
                        'success' => 'wrong_pin',
                    );
            
                    $selected_item = response()->json($notification);
            
                    return $selected_item;
               }
    
            } else {
                $notification = array(
                    'title' => 'New Password',
                    'message' => 'User does not exist.',
                    'success' => 'no_user',
                );
        
                $selected_item = response()->json($notification);
        
                return $selected_item;
           }
    
           
        }
    
        //
    
        public function appResetPassword(Request $request) {
    
            $h_pass = Hash::make(trim($request->password));
            $db_user = User::getUserByEmail($request->email);
    
            if (!empty($db_user)) {
    
                $db_user->remember_token   = null;
                $db_user->password         = $h_pass;
                $is_success                = $db_user->update();
    
               if (!empty($is_success)) {
    
                
                    $notification = array(
                        'title' => 'New Password',
                        'message' => 'New password created succesfully.',
                        'success' => 'success',
                    );
            
                    $selected_item = response()->json($notification);
            
                    return $selected_item;
               } else {
                    $notification = array(
                        'title' => 'New Password',
                        'message' => 'Error creating new password.',
                        'success' => 'error',
                    );
            
                    $selected_item = response()->json($notification);
            
                    return $selected_item;
               }
            } else {
                $notification = array(
                    'title' => 'New Password',
                    'message' => 'User does not exist.',
                    'success' => 'no_user',
                );
        
                $selected_item = response()->json($notification);
        
                return $selected_item;
           }
    
           
        }
    
    
    
        public function confirm() {
    
            $data = array(
                'success' => 'success',
            );
    
            return response()->json($data);
            // return  redirect('admin/auth/login');
        }
        //
        public function auth_logout_admin() {
    
            Auth::logout();
            return  redirect('login'); 
        }
    
}
