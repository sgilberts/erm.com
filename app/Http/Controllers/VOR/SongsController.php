<?php

namespace App\Http\Controllers\VOR;

use App\Http\Controllers\Controller;
use App\Models\Admin\CalEventTitleModel;
use App\Models\VOR\DownloadSongModel;
use App\Models\VOR\SongsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class SongsController extends Controller
{
    public $myData;


    public function vor_home() {

        $songs = SongsModel::getAllSongs();
        $favSong = SongsModel::getFavSong('downloads');
        $mostPlayed = SongsModel::getFavSong('played');

        $maxDownloads = 0;
        $downloads = 0;
        $totalPlayed = 0;

        $downloadArray = array();
        $favSongArray = array();
        $mostPlayedArray = array();

        foreach ($songs as $song) {
            $downloads += $song->downloads;
            $totalPlayed += $song->played;

            $downloadArray[] = $song->downloads;

        }

        for ($i=0; $i < 6; $i++) { 
            
            $favSongArray[] = $favSong[$i];
            $mostPlayedArray[] = $mostPlayed[$i];

        }

        // dd($favSongArray);

        $maxDownloads = max($downloadArray);

        $data['getTotalDown'] = $downloads;
        $data['totalPlayed'] = $totalPlayed;
        $data['maxDownloads'] = $maxDownloads;
        $data['getFavSong'] = $favSongArray;
        $data['mostPlayed'] = $mostPlayedArray;
        $data['mostDownloadedSong'] = $favSong[0];
        $data['mostPlayedSong'] = $mostPlayed[0];

        return view('vor.home.home', $data);
    }





    public function get_all_songs()
    {

        // dd($request->all());
        $currentUser = Auth::user();


        $this->myData = SongsModel::getAllSongs();

        $notification = array(
            'title' => 'List Of Songs',
            'success' => 'success',
            'data' => $this->myData
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }


    public function get_dist_artiste()
    {

        $currentUser = Auth::user();

        $artistes = SongsModel::getDistinctArtiste();
        $events = CalEventTitleModel::getRecord();
        $this->myData = SongsModel::getAllSongs();

        $myArtistList = array();
        $mySongsByArtiste = array();
        $myArray = array();


        foreach ($artistes as $artiste) {

            $myArtistList[] = SongsModel::getFirstArtisteInfo($artiste->artiste);
           
            // $mySongsByArtiste[] = SongsModel::getAllSongsByArtiste($artiste->artiste);

            
            $myArray[$artiste->artiste][] = SongsModel::getAllSongsByArtiste($artiste->artiste);
             

        }


        $allSongs = array(
            'title' => 'List Of Songs',
            'success' => 'success',
            'data' => $this->myData
        );

        $allArtistes = array(
            'title' => 'List Of Artistes',
            'success' => 'success',
            'data' => $myArtistList
        );

        $artisteSongs = array(
            'title' => 'List Of Song By Artistes',
            'success' => 'success',
            'data' => $myArray
        );

        $eventTitles = array(
            'title' => 'List Of Event Titles',
            'success' => 'success',
            'data' => $events
        );


    
        $notification = array(
            'title' => 'List Of Artiste',
            'success' => 'success',
            'success' => 'success',
            'allSongs' => $allSongs,
            'artistes' => $allArtistes,
            'songs' => $artisteSongs,
            'eventTitles' => $eventTitles,
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }

    public function appAddSong(Request $request)
    {

        $songTitle = trim($request->songTitle);
        $artiste   = trim($request->artiste);

        $song_exists = SongsModel::songExists($songTitle, $artiste);

        if (!empty($song_exists)) {
            $notification = array(
                'title' => 'Songs',
                'message' => 'The song "'.$songTitle.' By '. $artiste.'" exists.',
                'success' => 'error',
            );

            $selected_item = response()->json($notification);

            return $selected_item;
        } else {
                
            $songs = new SongsModel();

            $songs->songTitle            = $songTitle;
            $songs->artiste              = $artiste;
            $songs->genre                = trim($request->genre);
            $songs->lyrics               = trim($request->lyrics);
            $songs->song_cat             = trim($request->song_cat);
            $songs->album                = trim($request->album);
            $songs->user_id              = trim($request->user_id);
            $is_success                  = $songs->save();

            $notification = array(
                'title' => 'Songs',
                'message' => 'Have added '.$songTitle.' By '. $artiste.' successfully',
                'success' => 'success',
            );

            $selected_item = response()->json($notification);

            return $selected_item;
        }
        
    }

    public function appUpdateSong(Request $request) {

        // dd($request->all());
        $songTitle = trim($request->songTitle);
        $artiste   = trim($request->artiste);

        
        $songs = SongsModel::getSongById($request->id);

        $songs->songTitle            = $songTitle;
        $songs->artiste              = $artiste;
        $songs->genre                = trim($request->genre);
        $songs->lyrics               = trim($request->lyrics);
        $songs->song_cat             = trim($request->song_cat);
        $songs->album                = trim($request->album);
        $is_success                  = $songs->update();


        if(empty($is_success)) {
            $notification = array(
                'title' => 'Failed Update!',
                'message' => 'Song could not be updated. Please contact Amin.',
                'success' => 'error',
            );
            $selected_item = response()->json($notification);

            return $selected_item;
        } else {

        
            $notification = array(
                'title' => 'VOR Songs!',
                'message' => 'Have updated '.$songTitle.' By '. $artiste.' successfully',
                'success' => 'success',
            );
            $selected_item = response()->json($notification);

            return $selected_item;
        }

    }


    public function appDeleteSong(Request $request) {

        // dd($request->all());
        $songId = $request->id;
        
        $songs = SongsModel::getSongById($songId);

        if ($songs->getSongFile() == null) {
            $is_success = $songs->delete();
            $notification = array(
                'title' => 'Failed Delete!',
                'message' => 'Song file does not exist.',
                'success' => 'error',
            );
            $selected_item = response()->json($notification);

            return $selected_item;
        } else {
                    
            if ($songs->getSongImage() == null) {
                $is_success = $songs->delete();
                $notification = array(
                    'title' => 'Failed Delete!',
                    'message' => 'Song image file does not exist.',
                    'success' => 'error',
                );
                $selected_item = response()->json($notification);

                return $selected_item;
            } else {
                unlink(public_path('vor/songs/'.$songs->file_names));
                unlink(public_path('vor/songimg/'.$songs->cover_image));
                $is_success = $songs->delete();
    
                if(empty($is_success)) {
                    $notification = array(
                        'title' => 'Failed Delete!',
                        'message' => 'Song could not be deleted. Please contact Amin.',
                        'success' => 'error',
                    );
                    $selected_item = response()->json($notification);
    
                    return $selected_item;
                } else {
    
                
                    $notification = array(
                        'title' => 'VOR Songs!',
                        'message' => 'Have deleted '.$songs->songTitle.' By '. $songs->artiste.' successfully',
                        'success' => 'success',
                    );
                    $selected_item = response()->json($notification);
    
                    return $selected_item;
                }
            }
            

        }

    }


    public function download_song_file(Request $request)
    {

        // dd($request->all());
        $currentUser = Auth::user();
        $db_downloads = new DownloadSongModel();

        $userAgent = $request->userAgent(); 
        $clientIpAddress = $request->getClientIp(); 

        $agent = new Agent();
        $browser = $agent->browser();
        $browser_version = $agent->version($browser);

        $platform = $agent->platform();
        $platform_version = $agent->version($platform);
        $device = $agent->device();
        $languages = $agent->languages();


        $db_song = SongsModel::getSongById($request->id);
        // $db_downloads = SongsModel::getSongById($db_song->id);

        $db_song->downloads     = ($db_song->downloads+1);
        $is_success           = $db_song->update();

        // $is_success = Storage::download('public/vor/songs/'.$db_song->file_names);
        if (!empty($is_success )) {
            
            $db_downloads->song_id           = $db_song->id;
            $db_downloads->download_ip       = $clientIpAddress;
            $db_downloads->computer_name     = $platform_version;
            $db_downloads->browser           = $browser;
            $db_downloads->os                = $platform;
            $db_downloads->device            = $device;
            $is_success                      = $db_downloads->save();

            if (!empty($is_success )) {
                $notification = array(
                    'title' => 'Downloads',
                    'message' => 'The Song '.$db_song->fileNames .' has been downloaded.',
                    'success' => 'success',
                    'data' => $db_song
                );
        
                $selected_item = response()->json($notification);
        
                return $selected_item;
            }

        }


    }

    public function app_download_song_file(Request $request)
    {

        $db_downloads = new DownloadSongModel();

        $userAgent = $request->userAgent(); 
        $clientIpAddress = $request->getClientIp(); 

        $agent = new Agent();
        $browser = $agent->browser();
        $browser_version = $agent->version($browser);

        // $platform = $agent->platform();
        // $platform_version = $agent->version($platform);
        // $device = $agent->device();
        // $languages = $agent->languages();

        $my_device_info = $request->my_device_info;


        $db_song = SongsModel::getSongById($request->id);
        // $db_downloads = SongsModel::getSongById($db_song->id);

        $db_song->downloads     = ($db_song->downloads+1);
        $is_success           = $db_song->update();

        // $is_success = Storage::download('public/vor/songs/'.$db_song->file_names);
        if (!empty($is_success )) {
            
            $db_downloads->song_id           = $db_song->id;
            $db_downloads->download_ip       = $clientIpAddress;
            $db_downloads->computer_name     = $my_device_info['manufacturer'];
            $db_downloads->browser           = $my_device_info['version.release'];
            $db_downloads->os                = $my_device_info['os'];
            $db_downloads->device            = $my_device_info['device'];
            $is_success                      = $db_downloads->save();

            if (!empty($is_success )) {
                $notification = array(
                    'title' => 'Downloads',
                    'message' => 'The Song '.$db_song->fileNames .' has been downloaded.',
                    'success' => 'success',
                    'data' => $db_song
                );
        
                $selected_item = response()->json($notification);
        
                return $selected_item;
            }

        }


    }

    public function app_upload_song_file(Request $request) {

    
        $song_id = $request->id;
        $file = $request->file('file');
        $file_type = $request->file_type;

        $db_song = SongsModel::getSongById($song_id);

        if ($request->has('file')) {

            $ext              = $file->getClientOriginalExtension();
 
            if($ext == 'mp3' || $ext == 'MP3') {
                $folderPath = 'vor/songs/';

                // // $randomStr              = $db_user->id.Str::random(20);
                // // $fileName               = strtolower($randomStr).'.'.$ext;
                $fileName         = $db_song->songTitle. ' by ' . $db_song->artiste . '.'.$ext ;

                $fff              = $file->move(public_path($folderPath), $fileName);
                
                $db_song->file_names        = $fileName;
                $is_success                      = $db_song->update();
                    
                $notification = array(
                    'title' => 'Upload',
                    'message' => 'The Song has been upload.',
                    'moved' => $fff,
                    'success' => $ext,
                    'data' => 'Just uploaded '.$fileName
                );

                $selected_item = response()->json($notification);

                return $selected_item;
            } else {

                $folderPath = 'vor/songimg/';

                // // $randomStr              = $db_user->id.Str::random(20);
                // // $fileName               = strtolower($randomStr).'.'.$ext;
                $fileName         = $db_song->songTitle. ' by ' . $db_song->artiste . '.'.$ext ;

                $fff              = $file->move(public_path($folderPath), $fileName);

                $db_song->cover_image        = $fileName;
                $is_success                      = $db_song->update();
                    
                $notification = array(
                    'title' => 'Upload',
                    'message' => 'The Song Cover Image has been upload.',
                    'moved' => $fff,
                    'success' => $ext,
                    'data' => 'Just uploaded '.$fileName
                );

                $selected_item = response()->json($notification);

                return $selected_item;
            }

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

    public function edit_song_details(Request $request)
    {

        // dd($request->all());
        $currentUser = Auth::user();
        
        $item = SongsModel::getSongById($request->id);

     
        // $is_success = Storage::download('public/vor/songs/'.$item->file_names);

        $notification = array(
            'title' => 'Downloads',
            // 'message' => $is_success,
            'success' => 'success',
            'data' => $item
        );

        $selected_item = response()->json($notification);

        return $selected_item;
    }

    public function downloads_files(Request $request)
    {


        $item = SongsModel::getSongById($request->id);

        // dd($request->all());
        // $notification = array(
        //     'song' => $request->song,
        // );

        //   return response()->file('http://192.168.8.137/laravel_proj/arm.com/vor/public/downloads.php?song='.$request->song);
        // return Redirect::to('http://192.168.8.137/laravel_proj/arm.com/vor/public/downloads.php?song='.$request->song);
        // return Redirect::route('public/downloads.php')->with( ['song' => $request->song] );

        $song_download_path = public_path("vor/songs/{$item->file_names}");
        $headers = array('Content-Type: application/octet-stream',);
        $response = response()->download($song_download_path, $item->file_names, $headers);
        
        if (!empty($response)) {
            
            $this->download_song_file($request);

        }

        $notification = array(
            'title' => 'Downloads',
            'message' => $item->file_names,
            'success' => 'success',
            'data' => $response
        );

        $selected_item = response()->json($notification);

        return $response;
    }

    
    public function add_played_song_info($id)
    {


        $song_item = SongsModel::getSongById($id);
       
        // $song_download_path = public_path("vor/songs/{$song_item->file_names}");
        // $headers = array('Content-Type: application/octet-stream',);
        // $response = response()->download($song_download_path, $song_item->file_names, $headers);
        
        if (!empty($song_item->getSongFile())) {

            $song_item->played = ($song_item->played+1);
            $is_success        = $song_item->update();

   
            // $song_item->played = $played_no;
            // $is_success        = $song_item->update();

            if (!empty($is_success)) {
                $notification = array(
                    'title' => 'Play',
                    'message' => $song_item->file_names,
                    'success' => 'success',
                    'data' => 'playing'
                );
        
                $selected_item = response()->json($notification);
        
                return $selected_item;
            } else {
                $notification = array(
                    'title' => 'Play',
                    'message' => $song_item->file_names,
                    'success' => 'uuuppppssss failed',
                    'data' => 'did mot update!'
                );
        
                $selected_item = response()->json($notification);
        
                return $selected_item;
            }
       

        } else {
            $notification = array(
                'title' => 'Downloads',
                'message' => $song_item->file_names,
                'success' => 'failed',
                'data' => 'does not exist.'
            );
    
            $selected_item = response()->json($notification);
    
            return $selected_item;
        }


    }


    public function appAddPlayed_song(Request $request)
    {


        $song_item = SongsModel::getSongById($request->id);
       
        // $song_download_path = public_path("vor/songs/{$song_item->file_names}");
        // $headers = array('Content-Type: application/octet-stream',);
        // $response = response()->download($song_download_path, $song_item->file_names, $headers);
        
        if (!empty($song_item->getSongFile())) {

            $song_item->played = ($song_item->played+1);
            $is_success        = $song_item->update();

   
            // $song_item->played = $played_no;
            // $is_success        = $song_item->update();

            if (!empty($is_success)) {
                $notification = array(
                    'title' => 'Play',
                    'message' => $song_item->file_names,
                    'success' => 'success',
                    'data' => 'playing'
                );
        
                $selected_item = response()->json($notification);
        
                return $selected_item;
            } else {
                $notification = array(
                    'title' => 'Play',
                    'message' => $song_item->file_names,
                    'success' => 'uuuppppssss failed',
                    'data' => 'did mot update!'
                );
        
                $selected_item = response()->json($notification);
        
                return $selected_item;
            }
       

        } else {
            $notification = array(
                'title' => 'Downloads',
                'message' => $song_item->file_names,
                'success' => 'failed',
                'data' => 'does not exist.'
            );
    
            $selected_item = response()->json($notification);
    
            return $selected_item;
        }


    }

}
