<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Location extends Model
{
    // use HasFactory;
    // Fetch district
    public static function getDistrict(){
        $value=DB::table('locations')->distinct()->get('vill_district'); 
        return $value;
    }
    public static function getDistrictCR(){
        $value=DB::table('locations')->where('vill_province','=','เชียงราย')->distinct()->get('vill_district'); 
        //$value=DB::table('villages')->distinct()->get(); 
        return $value;
      }
    
      //Fetch District
        public static function getprovinceDistrict($vill_provinceid=0){
    
            $value=DB::table('locations')->where('vill_province', $vill_provinceid)->distinct()->get('vill_district');
    
            return $value;
        }
    
        // Fetch Tumtol
        public static function getdistrictTumbol($vill_districtid=0){
    
            
            $value=DB::table('locations')->where('vill_district', $vill_districtid)->distinct()->get('vill_tunbol');
    
            return $value;
        }
    
        //Fetch Tumtol
        public static function gettumbolVillage($vill_districtid=0,$vill_tumbolid=0){
    
            $value=DB::table('locations')->where('vill_district', $vill_districtid)->where('vill_tunbol', $vill_tumbolid)->orderBy('vill_code')->distinct()->get();
    
            return $value;
        }
}
