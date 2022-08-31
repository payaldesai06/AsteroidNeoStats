<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Commonhelper;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Config;

class UserController extends Controller
{
    public function index(){
        return view('home');
    }

    public function settings() {
		return view('settings');
	}

    public function updateProfile(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'email'  => 'required|email|unique:users,email,'.$user->id
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors()->all());
        }
        $user->fill($request->only('username','email'));
        if($request->has('avatar'))
        {
            if($user->avatar){
                Commonhelper::deleteFile($user->avatar);
            }
            $user->avatar = Commonhelper::uploadFile("avatars/",$request->avatar,'avatar');
            if(!$user->avatar){return redirect()->back()->with('error',trans("Sorry, Only image files are allowed."));}
        }
        $user->save();
        return redirect()->route('settings')->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password'  => 'required',
            'password' => 'required|min:6'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors()->all());
        }
        try{
            $user = Auth::getUser();
            if (\Hash::check($request->get('current_password'), $user->password)) {
                $user->password = \Hash::make($request->get('password'));
                $user->save();
				return redirect()->route('settings')->with('success', 'Password change successfully!');
            } else {
                return back()->withErrors('Current password is incorrect.');
            }
        }catch(\Exception $e){
            return back()->withErrors('Something went wrong.please try again!');
        }
    }

    public function getNeoStates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date'  => 'required',
            'end_date' => 'required'
        ]);
        if($validator->fails()){
            return '<div class="alert alert-danger"> Error: '.$validator->errors()->all().'</div>';
        }
        try{
            $start_date = date('Y-m-d',strtotime($request->start_date));
            $end_date = date('Y-m-d',strtotime($request->end_date));
            $method_request = 'start_date='.$start_date.'&end_date='.$end_date.'&detailed=true&api_key='. Config::get('constants.NASA_API_KEY');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.nasa.gov/neo/rest/v1/feed?".$method_request);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($output);
            if(@$result->error_message){return '<div class="alert alert-danger"> Error: '.$result->error_message.'</div>';}
            $resonse = [];
            if(@$result->near_earth_objects){
                $earth_objects = $result->near_earth_objects;
                $chartdata = [];
                $stats = '';
                $asteroids = [];
                $fastest_asteroid = 'N/A';
                $fastest_asteroid_id = 'N/A';
                $closest_asteroid = 'N/A';
                $closest_asteroid_id = 'N/A';
                $average_size_asteroid = 'N/A';
                foreach($earth_objects as $key=>$asteroidValue){
                    foreach($asteroidValue as $asteroid){
                        // $size = (($asteroid->estimated_diameter->kilometers->estimated_diameter_min +
                        // $asteroid->estimated_diameter->kilometers->estimated_diameter_max) / 2);
                        $size = $asteroid->estimated_diameter->kilometers->estimated_diameter_max;
                        $asteroids[] = [
                            'id'=>$asteroid->id,
                            'speed'=>$asteroid->close_approach_data[0]->relative_velocity->kilometers_per_hour,
                            'distance'=>$asteroid->close_approach_data[0]->miss_distance->kilometers,
                            'size'=>$size
                        ];
                    }
                    $fastest_asteroid = max(array_column($asteroids, 'speed'));
                    $asteroid_key = array_search($fastest_asteroid, array_column($asteroids, 'speed'));
                    $fastest_asteroid_id = $asteroids[$asteroid_key]['id'];
                    $closest_asteroid = min(array_column($asteroids, 'distance'));
                    $asteroid_key = array_search($closest_asteroid, array_column($asteroids, 'distance'));
                    $closest_asteroid_id = $asteroids[$asteroid_key]['id'];
                    $average_size_asteroid = (array_sum(array_column($asteroids, 'size')) / count($asteroids));
                    $chartdata[] = ['year'=>date('Y',strtotime($key)),'month'=>date('m',strtotime($key)),'date'=>date('d',strtotime($key)),'count'=>count($asteroidValue)];
                }
                $resonse['chartdata'] = $chartdata;
                $stats = '<p><b>Fastest Asteroid in km/h</b> : ID -> '.$fastest_asteroid_id.' and Speed -> '.number_format($fastest_asteroid,3).' km/h</p><br>
                <p><b>Closest Asteroid</b> : ID -> '.$closest_asteroid_id.' and Distance -> '.number_format($closest_asteroid,3).' km</p><br>
                <p><b>Average Size of the Asteroids in kilometers</b> : '.number_format($average_size_asteroid,3).' km</p><br>';
                $resonse['data'] = $stats;
            }else{
                $resonse['data'] = '<div class="alert alert-danger">No result found!</div>';
            }
            return $resonse;
        }catch(\Exception $e){
            // return '<div class="alert alert-danger">Something went wrong.please try again!</div>';
            return '<div class="alert alert-danger">'.$e->getMessage().'</div>';

        }
    }
}
