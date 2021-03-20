<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
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


class ReportPDFController extends Controller
{
    public function pdf_index(User $user, $weir_id=0) {
        // dd(Auth::user()->name);
        $user=Auth::user()->name ;
        $weir = WeirSurvey::select('*')->where('weir_code',$weir_id)->get();
        $location = WeirLocation::select('*')->where('weir_location_id',$weir[0]->weir_location_id)->get();
        $river = River::select('*')->where('river_id',$weir[0]->river_id)->get();
        $districtData['data'] = Location::getDistrictCR();
        $space = WeirSpaceification::select('*')->where('weir_spec_id',$weir[0]->weir_spec_id)->get();
        $upprotection = UpprotectionInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
        $upconcrete = UpconcreteInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
        $control = ControlInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
        $downconcrete = DownconcreteInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
        $downprotection = DownprotectionInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
        $waterdelivery = WaterdeliveryInv::select('*')->where('weir_id',$weir[0]->weir_id)->get();
        $plan = ImprovementPlan::select('*')->where('weir_id',$weir[0]->weir_id)->get();
        $maintain1 = Maintenance::select('*')->where('weir_id',$weir[0]->weir_id)->get();
        $sug = AdditinalSuggestion::select('*')->where('weir_id',$weir[0]->weir_id)->get();
        $photo = Photo::select('*')->where('weir_id',$weir[0]->weir_id)->get();
        


        $model=json_decode($weir[0]->weir_model);
        $locationUTM=json_decode($location[0]->utm);
        $locationLat=json_decode($location[0]->latlong);
        $space[0]->ridge_type=json_decode($space[0]->ridge_type);
        $space[0]->gate_dimension=json_decode($space[0]->gate_dimension);
        $space[0]->control_building_type=json_decode($space[0]->control_building_type);
        $space[0]->control_building_gate_dimension=json_decode($space[0]->control_building_gate_dimension);
        $space[0]->conttrol_building_loc=json_decode($space[0]->conttrol_building_loc);
        $space[0]->canel_dimension=json_decode($space[0]->canel_dimension);
        $upprotection[0]->floor_remake=json_decode($upprotection[0]->floor_remake);
        $upprotection[0]->side_remake=json_decode($upprotection[0]->side_remake);
        $upconcrete[0]->floor_remake=json_decode($upconcrete[0]->floor_remake);
        $upconcrete[0]->side_remake=json_decode($upconcrete[0]->side_remake);
        $control[0]->waterctrl_remake=json_decode($control[0]->waterctrl_remake);
        $control[0]->sidewall_remake=json_decode($control[0]->sidewall_remake);
        $control[0]->dgfloor_remake=json_decode($control[0]->dgfloor_remake);
        $control[0]->dgwall_remake=json_decode($control[0]->dgwall_remake);
        $control[0]->dggate_remake=json_decode($control[0]->dggate_remake);
        $control[0]->dgmachanic_remake=json_decode($control[0]->dgmachanic_remake);
        $control[0]->dgblock_remake=json_decode($control[0]->dgblock_remake);
        $control[0]->waterbreak_remake=json_decode($control[0]->waterbreak_remake);
        $control[0]->bridge_remake=json_decode($control[0]->bridge_remake);

        $downconcrete[0]->floor_remake=json_decode($downconcrete[0]->floor_remake);
        $downconcrete[0]->side_remake=json_decode($downconcrete[0]->side_remake);
        $downconcrete[0]->flrblock_remake=json_decode($downconcrete[0]->flrblock_remake);
        $downconcrete[0]->endsill_remake=json_decode($downconcrete[0]->endsill_remake);

        $downprotection[0]->floor_remake=json_decode($downprotection[0]->floor_remake);
        $downprotection[0]->side_remake=json_decode($downprotection[0]->side_remake);

        $waterdelivery[0]->floor_remake=json_decode($waterdelivery[0]->floor_remake);
        $waterdelivery[0]->side_remake=json_decode($waterdelivery[0]->side_remake);
        $waterdelivery[0]->gate_remake=json_decode($waterdelivery[0]->gate_remake);
        // dd($sug[0]->suggestion);
        $photo1[]=["name"=>NULL,"file"=>NULL];
        $photo2[]=["name"=>NULL,"file"=>NULL];
        $photo3[]=["name"=>NULL,"file"=>NULL];
        $photo4[]=["name"=>NULL,"file"=>NULL];
        $photo5[]=["name"=>NULL,"file"=>NULL];
        $photo6[]=["name"=>NULL,"file"=>NULL];
        $a=0;$b=0;$c=0;$d=0;$e=0;$f=0;
        for($i=0;$i<count($photo);$i++){
            if($photo[$i]->photo_type=="ส่วน Protection เหนือน้ำ"){
                $photo1[$a]=[
                    "name"=>$photo[$i]->photo_id,
                    "file"=>$photo[$i]->thumbnall_filename,
                ];
                $a=$a+1;
            }else if($photo[$i]->photo_type=="ส่วนเหนือน้ำ"){
                
                $photo2[$b]=[
                    "name"=>$photo[$i]->photo_id,
                    "file"=>$photo[$i]->thumbnall_filename,
                ];
                $b=$b+1;
            }else if($photo[$i]->photo_type=="ส่วนควบคุม"){
                $photo3[$c]=[
                    "name"=>$photo[$i]->photo_id,
                    "file"=>$photo[$i]->thumbnall_filename,
                ];
                $c=$c+1;
            }else if($photo[$i]->photo_type=="ส่วนท้ายน้ำ"){
                $photo4[$d]=[
                    "name"=>$photo[$i]->photo_id,
                    "file"=>$photo[$i]->thumbnall_filename,
                ];
                $d=$d+1;
            }else if($photo[$i]->photo_type=="ส่วน Protection ท้ายน้ำ "){
                $photo5[$e]=[
                    "name"=>$photo[$i]->photo_id,
                    "file"=>$photo[$i]->thumbnall_filename,
                ];
                $e=$e+1;
            }else if($photo[$i]->photo_type=="ระบบส่งน้ำ"){
                $photo6[$f]=[
                    "name"=>$photo[$i]->photo_id,
                    "file"=>$photo[$i]->thumbnall_filename,
                ];
                $f=$f+1;
            }
        }
        for($i=0;$i<5;$i++){
            if(!empty($maintain1[$i]->maintain_date)){
                    $maintain[$i]=[
                        'maintain_id'=>$maintain1[$i]->maintain_id,
                        'maintain_date'=>$maintain1[$i]->maintain_date,
                        'maintain_detail'=>$maintain1[$i]->maintain_detail,
                        'maintain_resp'=>$maintain1[$i]->maintain_resp,
                        'maintain_remark'=>$maintain1[$i]->maintain_remark
            ];
            }else{
                    $maintain[$i]=[
                        'maintain_id'=>NULL,
                        'maintain_date'=>NULL,
                        'maintain_detail'=>NULL,
                        'maintain_resp'=>NULL,
                        'maintain_remark'=>NULL
                    ];
            }
        }
        
        // dd($photo2[0]["file"]);
        $pdf = PDF::loadView('test_pdf',compact('weir','location','user','districtData','river','model','locationUTM','locationLat','space','upprotection','upconcrete','control','downconcrete','downprotection','waterdelivery','plan','maintain','sug','photo1','photo2','photo3','photo4','photo5','photo6'));
        return $pdf->stream('test.pdf'); //แบบนี้จะ stream มา preview
        //return $pdf->download('test.pdf'); //แบบนี้จะดาวโหลดเลย
    }
}
