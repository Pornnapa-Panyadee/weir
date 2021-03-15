<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\UploadedFile;

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
use Grimzy\LaravelMysqlSpatial\Types\Point;

// use SpatialTrait;

// use File;
// use Image;


class FormsController extends Controller
{
    public function __construct()
    {
          $this->middleware('auth');
    }

    public function locationCR(){

        $districtData['data'] = Location::getDistrictCR();
        // dd($districtData);
        return view('form/form', compact('districtData'));
    }

    public function getDistrict($vill_provinceid=0){
        $userData['data'] = Location::getprovinceDistrict($vill_provinceid);        
        echo json_encode($userData);
        exit;
    }

    // Fetch tumbol
    public function getTumbol($vill_districtid=0){
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: *');
      header('Access-Control-Allow-Headers: *');
      // Fetch Employees by Departmentid
      $userData['data'] = Location::getdistrictTumbol($vill_districtid);        
      echo json_encode($userData);
      exit;
    }

    public function getVillage($vill_districtid=0,$vill_tumbolid=0){

      // Fetch Employees by Departmentid
      $userVill['data'] = Location::gettumbolVillage($vill_districtid,$vill_tumbolid); 

      echo json_encode($userVill);
      exit;
    }


    public function formSubmit(Request $request, User $user){
        // dd($request);
        // dd($user);
        $name=Auth::user()->name ;

        function calCode($users,$text) {
          if($users== NULL){
            return ("00001");
          }else{
            $names = str_split($users->$text);
            if($text=="prob_id" ||$text=="proj_id" ){
             $code =$names[3].$names[4].$names[5].$names[6];
            }else{
             $code =$names[2].$names[3].$names[4].$names[5];
            }
            $num=$code+1;
            if($num<10){
              return ("0000".$num);
            }else if ($num<100){
              return ("000".$num);
            }else if ($num<1000){
              return ("00".$num);
            }else {
              return ("0".$num);
            }
          }
            
        }

        $weir_id_last = DB::table('weir_surveys')->select('weir_id')->orderBy('created_at', 'asc')->get()->last();
        $river_id_last= DB::table('rivers')->select('river_id')->orderBy('created_at', 'asc')->get()->last();
        $weir_spec_id_last= DB::table('weir_spaceifications')->select('weir_spec_id')->orderBy('created_at', 'asc')->get()->last();
        $weir_location_id_last= DB::table('weir_locations')->select('weir_location_id')->orderBy('created_at', 'asc')->get()->last();
        $maintain_id_last= DB::table('maintenances')->select('maintain_id')->orderBy('created_at', 'asc')->get()->last();
        $plan_id_last= DB::table('improvement_plans')->select('plan_id')->orderBy('created_at', 'asc')->get()->last();
        $suggest_id_last= DB::table('additinal_suggestions')->select('suggest_id')->orderBy('created_at', 'asc')->get()->last();

        $weir_id="W".calCode($weir_id_last,"weir_id");
        $river_id="R".calCode($river_id_last,"river_id");
        $weir_spec_id="S".calCode($weir_spec_id_last,"weir_spec_id");
        $weir_location_id="L".calCode($weir_location_id_last,"weir_location_id");
        $maintain_id="M".calCode($maintain_id_last,"maintain_id");
        $plan_id="P".calCode($plan_id_last,"plan_id");
        $suggest_id="S".calCode($suggest_id_last,"suggest_id");

        $vill=explode(" ",$request->weir_village);
        // dd($vill);
        $code =DB::table('locations')->select('vill_code')->where('vill_name',$vill[2] )->where('vill_moo',$vill[1])->get();
        
        $codeweir=$code[0]->vill_code;       
        $weircode = DB::table('weir_surveys')->select('weir_id')->where('weir_id','like',$codeweir.'%' )->get();
        $num=(count($weircode)+1);
        $codeweir=$code[0]->vill_code.$num;

        // dd($codeweir);
        
        /////--------weir_surveys-------------/////////
        $river=new River(
          [
            'river_id'=>$river_id,
            'river_name'=>$request->river_name,
            'river_branch'=>$request->river_branch,
            'river_type'=>$request->river_type
          ]
        );
        $river->save();

        /////--------weir_Location-------------/////////
        // $locationSt = new Point($request->weir_X,$request->weir_Y);
        // $locationSt_utm = new Point($request->weir_XUTM,$request->weir_YUTM);
        // dd($request->weir_latlog);
        // $locationSt_utm = $request->weir_UTM;
        // dd($locationSt_utm->getLat());
        $location=new WeirLocation(
          [
            'weir_location_id'=>$weir_location_id,
            'utm'=> json_encode($request->weir_UTM),
            'latlong'=>json_encode($request->weir_latlog),
            'weir_village'=>$request->weir_village,
            'weir_tumbol'=>$request->weir_tumbol,
            'weir_district'=>$request->weir_district,
            'weir_province'=>"เชียงราย", 
          ]
        );
        $location->save();
       
        
        /////--------weir_spaceifications-------------/////////
        $space_weir=new WeirSpaceification(
          [
            'weir_spec_id'=>$weir_spec_id,
            'ridge_type'=>json_encode($request->ridge_type, JSON_UNESCAPED_UNICODE),
            'ridge_height'=>$request->ridge_height,
            'ridge_width'=>$request->ridge_width,
            'gate_has'=>$request->gate_has,
            'gate_type'=>$request->gate_type,
            'gate_dimension'=>json_encode($request->gate_dimension, JSON_UNESCAPED_UNICODE),
            'gate_machanic_has'=>$request->gate_machanic_has,
            'gate_machanic_type'=>$request->gate_machanic_type,
            'control_building_has'=>$request->control_building_has,
            'control_building_type'=>json_encode($request->control_building_type, JSON_UNESCAPED_UNICODE),
            'control_building_gate_has'=>$request->control_building_gate_has,
            'control_building_gate_type'=>$request->control_building_gate_type,
            'control_building_gate_dimension'=>json_encode($request->control_building_gate_dimension, JSON_UNESCAPED_UNICODE),
            'control_building_machanic_type'=>$request->control_building_machanic_type,
            'canal_has'=>$request->canal_has,
            'canal_type'=>$request->canal_type,
            'canel_dimension'=>json_encode($request->canel_dimension, JSON_UNESCAPED_UNICODE)
          ]
        );
        $space_weir->save();

        // dd($space_weir);

        ///////--------MaintenanceLog------------********Must be loop***************-/////////
        $num=calCode($request->maintain_id_last,"maintain_id");
        for($m=1;$m<6;$m++){
          $date="maintain_date_r".$m;
          $detail="maintain_detail_r".$m;
          $resp="maintain_resp_r".$m;
          $remark="maintain_remark_r".$m;

          if($request->$date!=NULL){
            $maintence=new Maintenance(
              [
                'maintain_id'=>$maintain_id,
                'weir_id'=>$weir_id ,
                'maintain_date'=>$request->$date,
                'maintain_detail'=>$request->$detail,
                'maintain_resp'=>$request->$resp,
                'maintain_remark'=>$request->$remark,
              ]
            );
            $maintence->save();
          }
          $maintain_id_last= DB::table('maintenances')->select('maintain_id')->orderBy('created_at', 'asc')->get()->last();
          $maintain_id="M".calCode($maintain_id_last,"maintain_id");
        }

        // /////--------weir_surveys-------------/////////
        $weir= new WeirSurvey(
          [
            'weir_id'=>$weir_id,
            'weir_code'=>$codeweir,
            'weir_name'=>$request->weir_name,
            'river_id'=>$river_id,
            'weir_spec_id'=>$weir_spec_id,
            'weir_location_id'=>$weir_location_id,
            'weir_build'=>$request->weir_year,
            'weir_age'=>$request->weir_age,
            'weir_model'=>json_encode($request->weir_model, JSON_UNESCAPED_UNICODE),
            'resp_name'=>$request->resp_name,
            'transfer'=>$request->transfer,
            'user'=>$name
          ]
        );
        $weir->save();

        ///////----1----upprotection_invs-------------/////////
        $upprotection=new UpprotectionInv(
          [
            'weir_id'=>$weir_id,          
            'floor_erosion'=>$request->floor_1_erosion,
            'floor_subsidence'=>$request->floor_1_subsidence,
            'floor_cracking'=>$request->floor_1_cracking,
            'floor_obstruction'=>$request->floor_1_obstruction,
            'floor_hole'=>$request->floor_1_hole,
            'floor_leak'=>$request->floor_1_leak,
            'floor_movement'=>$request->floor_1_movement,
            'floor_drainage'=>$request->floor_1_drainage,
            'floor_weed'=>$request->floor_1_weed,
            'floor_damage'=>$request->floor_1_damage,
            'floor_remake'=>json_encode($request->floor_1_remake, JSON_UNESCAPED_UNICODE),
            'check_floor'=>$request->check_floor_1,
            'side_erosion'=>$request->side_1_erosion,
            'side_subsidence'=>$request->side_1_subsidence,
            'side_cracking'=>$request->side_1_cracking,
            'side_obstruction'=>$request->side_1_obstruction,
            'side_hole'=>$request->side_1_hole,
            'side_leak'=>$request->side_1_leak,
            'side_movement'=>$request->side_1_movement,
            'side_drainage'=>$request->side_1_drainage,
            'side_weed'=>$request->side_1_weed,
            'side_damage'=>$request->side_1_damage,
            'side_remake'=>json_encode($request->side_1_remake, JSON_UNESCAPED_UNICODE),
          ]
        );
        $upprotection->save();

        ///////----2----upconcrete_invs-------------/////////
        $upconcrete=new UpconcreteInv(
          [
            'weir_id'=>$weir_id,  
            'floor_erosion'=>$request->floor_2_erosion,
            'floor_subsidence'=>$request->floor_2_subsidence,
            'floor_cracking'=>$request->floor_2_cracking,
            'floor_obstruction'=>$request->floor_2_obstruction,
            'floor_hole'=>$request->floor_2_hole,
            'floor_leak'=>$request->floor_2_leak,
            'floor_movement'=>$request->floor_2_movement,
            'floor_drainage'=>$request->floor_2_damage,
            'floor_weed'=>$request->floor_2_weed,
            'floor_damage'=>$request->floor_2_damage,
            'floor_remake'=>json_encode($request->floor_2_remark, JSON_UNESCAPED_UNICODE),
            'check_floor'=>$request->check_floor_2,
            'side_erosion'=>$request->side_2_erosion,
            'side_subsidence'=>$request->side_2_subsidence,
            'side_cracking'=>$request->side_2_cracking,
            'side_obstruction'=>$request->side_2_obstruction,
            'side_hole'=>$request->side_2_hole,
            'side_leak'=>$request->side_2_leak,
            'side_movement'=>$request->side_2_movement,
            'side_drainage'=>$request->side_2_drainage,
            'side_weed'=>$request->side_2_weed,
            'side_damage'=>$request->side_2_damage,
            'side_remake'=>json_encode($request->side_2_remark, JSON_UNESCAPED_UNICODE)
          ]
        );
        $upconcrete->save();

        ///////----3----control_invs-------------/////////
        $control=new ControlInv(
          [
            'weir_id'=>$weir_id,

            'waterctrl_erosion'=>$request->waterctrl_3_erosion,
            'waterctrl_subsidence'=>$request->waterctrl_3_subsidence,
            'waterctrl_cracking'=>$request->waterctrl_3_cracking,
            'waterctrl_obstruction'=>$request->waterctrl_3_obstruction,
            'waterctrl_hole'=>$request->waterctrl_3_hole,
            'waterctrl_leak'=>$request->waterctrl_3_leak,
            'waterctrl_movement'=>$request->waterctrl_3_movement,
            'waterctrl_drainage'=>$request->waterctrl_3_drainage,
            'waterctrl_weed'=>$request->waterctrl_3_weed,
            'waterctrl_damage'=>$request->waterctrl_3_damage,
            'waterctrl_remake'=>json_encode($request->waterctrl_3_remark, JSON_UNESCAPED_UNICODE),

            'sidewall_erosion'=>$request->sidewall_3_erosion,
            'sidewall_subsidence'=>$request->sidewall_3_subsidence,
            'sidewall_cracking'=>$request->sidewall_3_cracking,
            'sidewall_obstruction'=>$request->sidewall_3_obstruction,
            'sidewall_hole'=>$request->sidewall_3_hole,
            'sidewall_leak'=>$request->sidewall_3_leak,
            'sidewall_movement'=>$request->sidewall_3_movement,
            'sidewall_drainage'=>$request->sidewall_3_drainage,
            'sidewall_weed'=>$request->sidewall_3_weed,
            'sidewall_damage'=>$request->sidewall_3_damage,
            'sidewall_remake'=>json_encode($request->sidewall_3_remark, JSON_UNESCAPED_UNICODE),

            'dgfloor_erosion'=>$request->dgfloor_3_erosion,
            'dgfloor_subsidence'=>$request->dgfloor_3_subsidence,
            'dgfloor_cracking'=>$request->dgfloor_3_cracking,
            'dgfloor_obstruction'=>$request->dgfloor_3_obstruction,
            'dgfloor_hole'=>$request->dgfloor_3_hole,
            'dgfloor_leak'=>$request->dgfloor_3_leak,
            'dgfloor_movement'=>$request->dgfloor_3_movement,
            'dgfloor_drainage'=>$request->dgfloor_3_drainage,
            'dgfloor_weed'=>$request->dgfloor_3_weed,
            'dgfloor_damage'=>$request->dgfloor_3_damage,
            'dgfloor_remake'=>json_encode($request->dgfloor_3_remark, JSON_UNESCAPED_UNICODE),

            'dgwall_erosion'=>$request->dgwall_3_erosion,
            'dgwall_subsidence'=>$request->dgwall_3_subsidence,
            'dgwall_cracking'=>$request->dgwall_3_cracking,
            'dgwall_obstruction'=>$request->dgwall_3_obstruction,
            'dgwall_hole'=>$request->dgwall_3_hole,
            'dgwall_leak'=>$request->dgwall_3_leak,
            'dgwall_movement'=>$request->dgwall_3_movement,
            'dgwall_drainage'=>$request->dgwall_3_drainage,
            'dgwall_weed'=>$request->dgwall_3_weed,
            'dgwall_damage'=>$request->dgwall_3_damage,
            'dgwall_remake'=>json_encode($request->dgwall_3_remark, JSON_UNESCAPED_UNICODE),

            'dggate_erosion'=>$request->dggate_3_erosion,
            'dggate_subsidence'=>$request->dggate_3_subsidence,
            'dggate_cracking'=>$request->dggate_3_cracking,
            'dggate_obstruction'=>$request->dggate_3_obstruction,
            'dggate_hole'=>$request->dggate_3_hole,
            'dggate_leak'=>$request->dggate_3_leak,
            'dggate_movement'=>$request->dggate_3_movement,
            'dggate_drainage'=>$request->dggate_3_drainage,
            'dggate_weed'=>$request->dggate_3_weed,
            'dggate_damage'=>$request->dggate_3_damage,
            'dggate_remake'=>json_encode($request->dggate_3_remark, JSON_UNESCAPED_UNICODE),

            'dgmachanic_erosion'=>$request->dgmachanic_3_erosion,
            'dgmachanic_subsidence'=>$request->dgmachanic_3_subsidence,
            'dgmachanic_cracking'=>$request->dgmachanic_3_cracking,
            'dgmachanic_obstruction'=>$request->dgmachanic_3_obstruction,
            'dgmachanic_hole'=>$request->dgmachanic_3_hole,
            'dgmachanic_leak'=>$request->dgmachanic_3_leak,
            'dgmachanic_movement'=>$request->dgmachanic_3_movement,
            'dgmachanic_drainage'=>$request->dgmachanic_3_drainage,
            'dgmachanic_weed'=>$request->dgmachanic_3_weed,
            'dgmachanic_damage'=>$request->dgmachanic_3_damage,
            'dgmachanic_remake'=>json_encode($request->dgmachanic_3_remark, JSON_UNESCAPED_UNICODE),

            'dgblock_erosion'=>$request->dgblock_3_erosion,
            'dgblock_subsidence'=>$request->dgblock_3_subsidence,
            'dgblock_cracking'=>$request->dgblock_3_cracking,
            'dgblock_obstruction'=>$request->dgblock_3_obstruction,
            'dgblock_hole'=>$request->dgblock_3_hole,
            'dgblock_leak'=>$request->dgblock_3_leak,
            'dgblock_movement'=>$request->dgblock_3_movement,
            'dgblock_drainage'=>$request->dgblock_3_drainage,
            'dgblock_weed'=>$request->dgblock_3_weed,
            'dgblock_damage'=>$request->dgblock_3_damage,
            'dgblock_remake'=>json_encode($request->dgblock_3_remark, JSON_UNESCAPED_UNICODE),

            'waterbreak_erosion'=>$request->waterbreak_3_erosion,
            'waterbreak_subsidence'=>$request->waterbreak_3_subsidence,
            'waterbreak_cracking'=>$request->waterbreak_3_cracking,
            'waterbreak_obstruction'=>$request->waterbreak_3_obstruction,
            'waterbreak_hole'=>$request->waterbreak_3_hole,
            'waterbreak_leak'=>$request->waterbreak_3_leak,
            'waterbreak_movement'=>$request->waterbreak_3_movement,
            'waterbreak_drainage'=>$request->waterbreak_3_drainage,
            'waterbreak_weed'=>$request->waterbreak_3_weed,
            'waterbreak_damage'=>$request->waterbreak_3_damage,
            'waterbreak_remake'=>json_encode($request->waterbreak_3_remark, JSON_UNESCAPED_UNICODE),

            'bridge_erosion'=>$request->bridge_3_erosion,
            'bridge_subsidence'=>$request->bridge_3_subsidence,
            'bridge_cracking'=>$request->bridge_3_cracking,
            'bridge_obstruction'=>$request->bridge_3_obstruction,
            'bridge_hole'=>$request->bridge_3_hole,
            'bridge_leak'=>$request->bridge_3_leak,
            'bridge_movement'=>$request->bridge_3_movement,
            'bridge_drainage'=>$request->bridge_3_drainage,
            'bridge_weed'=>$request->bridge_3_weed,
            'bridge_damage'=>$request->bridge_3_damage,
            'bridge_remake'=>json_encode($request->bridge_3_remark, JSON_UNESCAPED_UNICODE),
          ]
        );
        $control->save();

        ///////---4-----downconcrete_invs-------------/////////
        $downconcrete=new DownconcreteInv(
          [
            'weir_id'=>$weir_id,

            'floor_erosion'=>$request->floor_4_erosion,
            'floor_subsidence'=>$request->floor_4_subsidence,
            'floor_cracking'=>$request->floor_4_cracking,
            'floor_obstruction'=>$request->floor_4_obstruction,
            'floor_hole'=>$request->floor_4_hole,
            'floor_leak'=>$request->floor_4_leak,
            'floor_movement'=>$request->floor_4_movement,
            'floor_drainage'=>$request->floor_4_drainage,
            'floor_weed'=>$request->floor_4_weed,
            'floor_damage'=>$request->floor_4_damage,
            'floor_remake'=>json_encode($request->floor_4_remake, JSON_UNESCAPED_UNICODE),
            'check_floor'=>$request->check_floor_4,

            'side_erosion'=>$request->side_4_erosion,
            'side_subsidence'=>$request->side_4_subsidence,
            'side_cracking'=>$request->side_4_cracking,
            'side_obstruction'=>$request->side_4_obstruction,
            'side_hole'=>$request->side_4_hole,
            'side_leak'=>$request->side_4_leak,
            'side_movement'=>$request->side_4_movement,
            'side_drainage'=>$request->side_4_drainage,
            'side_weed'=>$request->side_4_weed,
            'side_damage'=>$request->side_4_damage,
            'side_remake'=>json_encode($request->side_4_remake, JSON_UNESCAPED_UNICODE),

            'flrblock_erosion'=>$request->flrblock_4_erosion,
            'flrblock_subsidence'=>$request->flrblock_4_subsidence,
            'flrblock_cracking'=>$request->flrblock_4_cracking,
            'flrblock_obstruction'=>$request->flrblock_4_obstruction,
            'flrblock_hole'=>$request->flrblock_4_hole,
            'flrblock_leak'=>$request->flrblock_4_leak,
            'flrblock_movement'=>$request->flrblock_4_movement,
            'flrblock_drainage'=>$request->flrblock_4_drainage,
            'flrblock_weed'=>$request->flrblock_4_weed,
            'flrblock_damage'=>$request->flrblock_4_damage,
            'flrblock_remake'=>json_encode($request->flrblock_4_remake, JSON_UNESCAPED_UNICODE),

            'endsill_erosion'=>$request->endsill_4_erosion,
            'endsill_subsidence'=>$request->endsill_4_subsidence,
            'endsill_cracking'=>$request->endsill_4_cracking,
            'endsill_obstruction'=>$request->endsill_4_obstruction,
            'endsill_hole'=>$request->endsill_4_hole,
            'endsill_leak'=>$request->endsill_4_leak,
            'endsill_movement'=>$request->endsill_4_movement,
            'endsill_drainage'=>$request->endsill_4_drainage,
            'endsill_weed'=>$request->endsill_4_weed,
            'endsill_damage'=>$request->endsill_4_damage,
            'endsill_remake'=>json_encode($request->endsill_4_remake, JSON_UNESCAPED_UNICODE),
          ]
        );
        $downconcrete->save();

        ///////----5----downprotection_invs-------------/////////
        $downprotection=new DownprotectionInv(
          [
            'weir_id'=>$weir_id,

            'floor_erosion'=>$request->floor_5_erosion,
            'floor_subsidence'=>$request->floor_5_subsidence,
            'floor_cracking'=>$request->floor_5_cracking,
            'floor_obstruction'=>$request->floor_5_obstruction,
            'floor_hole'=>$request->floor_5_hole,
            'floor_leak'=>$request->floor_5_leak,
            'floor_movement'=>$request->floor_5_movement,
            'floor_drainage'=>$request->floor_5_drainage,
            'floor_weed'=>$request->floor_5_weed,
            'floor_damage'=>$request->floor_5_damage,
            'floor_remake'=>json_encode($request->floor_5_remake, JSON_UNESCAPED_UNICODE),
            'check_floor'=>$request->check_floor_5,

            'side_erosion'=>$request->side_5_erosion,
            'side_subsidence'=>$request->side_5_subsidence,
            'side_cracking'=>$request->side_5_cracking,
            'side_obstruction'=>$request->side_5_obstruction,
            'side_hole'=>$request->side_5_hole,
            'side_leak'=>$request->side_5_leak,
            'side_movement'=>$request->side_5_movement,
            'side_drainage'=>$request->side_5_drainage,
            'side_weed'=>$request->side_5_weed,
            'side_damage'=>$request->side_5_damage,
            'side_remake'=>json_encode($request->side_5_remake, JSON_UNESCAPED_UNICODE)
            
          ]
        );
        $downprotection->save();

        ///////----6----waterdelivery_invs-------------/////////
        $water=new WaterdeliveryInv(
          [
            'weir_id'=>$weir_id,

            'floor_erosion'=>$request->floor_6_erosion,
            'floor_subsidence'=>$request->floor_6_subsidence,
            'floor_cracking'=>$request->floor_6_cracking,
            'floor_obstruction'=>$request->floor_6_obstruction,
            'floor_hole'=>$request->floor_6_hole,
            'floor_leak'=>$request->floor_6_leak,
            'floor_movement'=>$request->floor_6_movement,
            'floor_drainage'=>$request->floor_6_drainage,
            'floor_weed'=>$request->floor_6_weed,
            'floor_damage'=>$request->floor_6_damage,
            'floor_remake'=>json_encode($request->floor_6_remake, JSON_UNESCAPED_UNICODE),
            'check_floor'=>$request->check_floor_6,

            'side_erosion'=>$request->side_6_erosion,
            'side_subsidence'=>$request->side_6_subsidence,
            'side_cracking'=>$request->side_6_cracking,
            'side_obstruction'=>$request->side_6_obstruction,
            'side_hole'=>$request->side_6_hole,
            'side_leak'=>$request->side_6_leak,
            'side_movement'=>$request->side_6_movement,
            'side_drainage'=>$request->side_6_drainage,
            'side_weed'=>$request->side_6_weed,
            'side_damage'=>$request->side_6_damage,
            'side_remake'=>json_encode($request->side_6_remake, JSON_UNESCAPED_UNICODE),

            'gate_erosion'=>$request->gate_6_erosion,
            'gate_subsidence'=>$request->gate_6_subsidence,
            'gate_cracking'=>$request->gate_6_cracking,
            'gate_obstruction'=>$request->gate_6_obstruction,
            'gate_hole'=>$request->gate_6_hole,
            'gate_leak'=>$request->gate_6_leak,
            'gate_movement'=>$request->gate_6_movement,
            'gate_drainage'=>$request->gate_6_drainage,
            'gate_weed'=>$request->gate_6_weed,
            'gate_damage'=>$request->gate_6_damage,
            'gate_remake'=>json_encode($request->gate_6_remake, JSON_UNESCAPED_UNICODE),
            
          ]
        );
        $water->save();

        // /////--------improvement_plans-------------/////////
        $plan= new ImprovementPlan(
          [
            'plan_id'=>$plan_id,
            'weir_id'=>$weir_id,
            'plan_year_check'=>$request->plan_year_check,
            'plan_year'=>$request->plan_year,
            'plan_type'=>$request->plan_type,
            'plan_budget'=>$request->plan_budget,
            'proj_budget_check'=>$request->proj_budget_check,
            'proj_budget'=>$request->proj_budget_check,
            'proj_type'=>$request->proj_type,
            'plan_improve'=>$request->plan_improve,
            'plan_no'=>$request->plan_no,
          ]
        );
        $plan->save();

        // /////--------additinal_suggestions-------------/////////
        $plan= new AdditinalSuggestion(
          [
            'suggest_id'=>$suggest_id,
            'weir_id'=>$weir_id,
            'suggestion'=>$request->suggustion
          ]
        );
        $plan->save();
       
        
        return view('form.list');
      


    }




}
