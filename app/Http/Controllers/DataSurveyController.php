<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use AuthenticatesUsers;
use App\Models\Location;
use App\Models\AdditinalSuggestion;
use App\Models\DownconcreteInv;
use App\Models\DownprotectionInv;
use App\Models\WeirSurvey;
use App\Models\ControlInv;
use App\Models\ImprovementPlan;
use App\Models\Maintenance;
use App\Models\Photo;
use App\Models\River;
use App\Models\UpconcreteInv;
use App\Models\UpprotectionInv;
use App\Models\User;
use App\Models\WaterdeliveryInv;
use App\Models\WeirLocation;
use App\Models\WeirSpaceification;


class DataSurveyController extends Controller
{
    public function getDataSurvey($amp=0) {
        header('Access-Control-Allow-Origin: *');
        $location = WeirLocation::select('*')->where('weir_district',$amp)->get();

        for ($i=0;$i<count($location);$i++){ 
            $weir = WeirSurvey::select('weir_id','weir_code','weir_name','river_id')->where('weir_location_id',$location[$i]->weir_location_id)->get();
            $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
            $latlong=json_decode($location[$i]->latlong);
            $result[] = [
                'weir_id'=> $weir[0]->weir_id,
                'weir_code'=> $weir[0]->weir_code,
                'weir_name'=> $weir[0]->weir_name,
                'lat'=>$latlong->x,
                'long'=>$latlong->y,
                'weir_village'=> $location[$i]->weir_village,
                'weir_tumbol'=> $location[$i]->weir_tumbol,
                'weir_district'=> $location[$i]->weir_district,
                'river' => $river[0]->river_name
            ];
        
        }
        $result = json_encode($result);

        echo $result;
    }

    public function getDatatoTable(User $user) {
        
        $user=Auth::user()->name ;
        // dd($user);
        $location = WeirLocation::select('*')->get();
        for ($i=0;$i<count($location);$i++){ 
            $weir = WeirSurvey::select('weir_id','weir_code','weir_name','river_id','user','created_at')->where('weir_location_id',$location[$i]->weir_location_id)->get();
            $river = River::select('river_name')->where('river_id',$weir[0]->river_id)->get();
            $latlong=json_decode($location[$i]->latlong);
            $data[] = [
                'weir_id'=> $weir[0]->weir_id,
                'weir_code'=> $weir[0]->weir_code,
                'weir_name'=> $weir[0]->weir_name,
                'lat'=>$latlong->x,
                'long'=>$latlong->y,
                'weir_village'=> $location[$i]->weir_village,
                'weir_tumbol'=> $location[$i]->weir_tumbol,
                'weir_district'=> $location[$i]->weir_district,
                'river' => $river[0]->river_name,
                'date'=>$weir[0]->created_at
            ];
            // dd($weir[0]->user);

            if($weir[0]->user==$user){
                $dataUser[] = [
                    'weir_id'=> $weir[0]->weir_id,
                    'weir_code'=> $weir[0]->weir_code,
                    'weir_name'=> $weir[0]->weir_name,
                    'lat'=>$latlong->x,
                    'long'=>$latlong->y,
                    'weir_village'=> $location[$i]->weir_village,
                    'weir_tumbol'=> $location[$i]->weir_tumbol,
                    'weir_district'=> $location[$i]->weir_district,
                    'river' => $river[0]->river_name,
                    'date'=>$weir[0]->created_at
                ];
            }
        
        }
        return view('form.list',compact('data','dataUser','user'));
    }

    public function formEdit(User $user, $weir_id=0) {
        $user=Auth::user()->name ;
        $weir = WeirSurvey::select('*')->where('weir_code',$weir_id)->get();
        $location = WeirLocation::select('*')->where('weir_location_id',$weir[0]->weir_location_id)->get();
        $river = River::select('*')->where('river_id',$weir[0]->river_id)->get();
        $districtData['data'] = Location::getDistrictCR();

        return view('form.editform',compact('weir','location','user','districtData','river'));

        
    }
}
