<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <meta charset="utf-8">
  <title>Weir | Survey Form </title>

  <link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/form/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/form/waves.min.css')}}" type="text/css" media="all">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form/feather.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form/themify-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form/icofont.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form/font-awesome.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form/jquery.steps.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form/pages.css')}}">
  
  <style>
    .table2{
      font-size:12px;
      text-align: center;
    }.table2 tr{
      height:35px;
    }#text1{
      text-align: left;
      background-color: #d9d9d9;
    }#text2{
      text-align: left;
      style="vertical-align: top;
    }#text3{
      text-align: left;
      background-color: #f2f2f2;
    }.checkbox-color{
      margin-top: 10px;
      margin-left: 30px;
    }input[type="file"] {
      display: block;
    }.imageThumb {
      max-height: 100px;
      border: 1px solid;
      padding: 1px;
      cursor: pointer;
    }.pip {
      display: inline-block;
      margin: 10px 10px 0 0;
    }.remove {
      display: block;
      background: #263544;
      border: 1px solid ;
      color: white;
      text-align: center;
      cursor: pointer;
    }.remove:hover {
      background: white;
      color: black;
    }textarea {
      font-family: inherit;
      font-size: 8px;;
    
    }
  </style>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="{{ asset('js/proj4js.js') }}"></script>
  <script src="{{ asset('js/EPSG32647.js') }}"></script>

  <script type="text/javascript">
    var projHash = {};
    function initProj4js() {
      var crsSource = document.getElementById('crsSource');
      var crsDest = document.getElementById('crsDest');
      var optIndex = 0;
      for (var def in Proj4js.defs) {
        //def="EPSG:32647";
        projHash[def] = new Proj4js.Proj(def);    //create a Proj for each definition
        var label = def+" - "+ (projHash[def].title ? projHash[def].title : '');
        var opt = new Option(label, def);
        crsSource.options[optIndex]= opt;
        var opt = new Option(label, def);
        crsDest.options[optIndex]= opt;
        ++optIndex;
      }  // for
      updateCrs('Source');
      updateCrs('Dest');
    }
    function updateCrs(id) {
      var crs = document.getElementById('crs'+id);
      if(id=="Source"){
        // crs.value="WGS84";
        crs.value="EPSG:32647";
      }else{
        crs.value="WGS84";
        // crs.value="EPSG:32647";
      }
    } 
    function transform() {
     var crsSource = document.getElementById('crsSource');
     var projSource = null;
     //   console.log(crsSource.value);
            
     if (crsSource.value) {
      projSource = projHash["EPSG:32647"];
     } else {
      alert("Select a source coordinate system");
      return;
     }
            
     var crsDest = document.getElementById('crsDest');
     //   console.log(crsDest.value);
     var projDest = null;
     if (crsDest.value) {
       projDest = projHash["WGS84"];
       // projDest = projHash["EPSG:32647"];
     } else {
      alert("Select a destination coordinate system");
      return;
     }
      
     var pointInputX = document.getElementById('weir_XUTM');
     var pointInputY = document.getElementById('weir_YUTM');
     var pointInput = pointInputX.value+","+pointInputY.value;
               
     if (pointInputX.value) {
      var pointSource = new Proj4js.Point(pointInput);
      var pointDest = Proj4js.transform(projSource, projDest, pointSource);
      // console.log(pointDest.x);
      document.getElementById('weir_Y').value = pointDest.x.toFixed(4);
      document.getElementById('weir_X').value = pointDest.y.toFixed(4);
     } else {
      alert("Enter source coordinates");
      return;
     }
    }
    // ///////////////////////////////////////////////////////////
    function transformutm() {
     var crsSource = document.getElementById('crsSource');
     var projSource = null;
     //   console.log(crsSource.value);
           
     if (crsSource.value) {
      projSource = projHash["WGS84"];
      // projSource = projHash["EPSG:32647"];
     } else {
      alert("Select a source coordinate system");
      return;
     }
            
     var crsDest = document.getElementById('crsDest');
     //   console.log(crsDest.value);
     var projDest = null;
     if (crsDest.value) {
      //projDest = projHash["WGS84"];
      projDest = projHash["EPSG:32647"];
     } else {
      alert("Select a destination coordinate system");
      return;
     }
               
     var pointInputX = document.getElementById('weir_Y');
     var pointInputY = document.getElementById('weir_X');
     var pointInput = pointInputX.value+","+pointInputY.value;
                
     if (pointInputX.value) {
      var pointSource = new Proj4js.Point(pointInput);
      var pointDest = Proj4js.transform(projSource, projDest, pointSource);
      // console.log(pointDest.x);
      document.getElementById('weir_XUTM').value = pointDest.x.toFixed(0);
      document.getElementById('weir_YUTM').value = pointDest.y.toFixed(0);
     } else {
      alert("Enter source coordinates");
      return;
     }
    }
    // ///////////////////////////////////////////////////////////
  </script>
 </head>
 
 <body onload="initProj4js()">
    @yield('content')
  <div class="loader-bg">
    <div class="loader-bar"></div>
  </div>
  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">
        <!-- nav -->
        @include('menu.headlogin')
        <!-- nav -->
        <div class="pcoded-main-container">
          <div class="pcoded-wrapper">
            <!-- menubar -->
            @include('menu.menubar')
            <!--menubar  -->
            <div class="pcoded-content">
              <div class="pcoded-inner-content">
                <div class="main-body">
                  <div class="page-wrapper">
                    <div class="page-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="card">
                            <!-- header -->
                            <div class="card-header">
                              <h5>แบบฟอร์มการตรวจสอบสภาพฝาย</h5>
                            </div>
                            <!-- form -->
                            <div class="card-block">
                              <div class="row">
                                <div class="col-md-12">
                                  <div id="wizarda">
                                    <section>
                                    <form class="wizard-form" id="basic-forms" action="{{route('form.formupdata')}}" enctype="multipart/form-data" method="POST" onsubmit="return confirm('บันทึกข้อมูล เรียบร้อย !!');">
                                        
                                        @csrf <!-- {{ csrf_field() }} -->   
                                        
                                          <?php 
                                            $v=["ฝายสันมน","ฝายไหลตกตรง","ฝายสันกว้าง","ฝายหินทิ้ง","ฝายประตูระบาย","อื่นๆ "];
                                            $d=["บานตรง","บานโค้ง"];
                                            $b=["รอกโซ่","เครื่องกว้านคันชัก","เครื่องกว้านม้วนลวด"];
                                            $t=["ฝั่งซ้าย","ฝั่งขวา"];
                                            $c=["คลองดิน","คลองดาดคอนกรีต"];
                                            $t=["ไม่มี","มองไม่เห็น","อื่นๆ"];
                                            $l=["1","2","3","4","5"];
                                            $level=["น้อย","ปานกลาง", "มาก"];
                                            $level2=["less","mid","more"];
                                            function checkphoto($text){
                                              if($text!=NULL){
                                                  $img='http://localhost/weir-cr/public/'.$text;
                                                  echo "<img src='{$img}'  width=200px; style='margin-left:10px;'>";
                                              }else{ echo "";}	
                                            }
                                            function add($t) {
                                              if($t!=NULL){
                                                    $text='value=1 checked';
                                                }else{
                                                  $text='value=1';
                                                }
                                              return $text;
                                            }
                                            function addZero($t) {
                                                if($t==0){
                                                    $text='value=0 checked';
                                                }else{
                                                  $text='value=0';
                                                }
                                              return $text;
                                            } 
                                            function add3($t) {
                                              if($t!=NULL){
                                                    $text='value='.$t.' checked';
                                                }else{
                                                  $text='value='.$t;
                                                }
                                              return $text;
                                            }
                                          
                                            function checkdata($val,$t) {
                                                if($val==$t){
                                                  $text='value='.$val.' checked';
                                                }else{
                                                  $text='value='.$val;
                                                }
                                              return $text;
                                            }
                                          ?> 
                                        <!-- -ข้อมูลทั่วไป -->
                                        <h3> ข้อมูลทั่วไป</h3>
                                        <fieldset>
                                          <div class="form-group row">
                                            <label class="col-sm-1 col-form-label">ชื่อฝาย</label>
                                            <div class="col-sm-2">
                                              <input id="weir_name" name="weir_name" type="text" class=" form-control" placeholder="-- กรอกชื่อ --" value="{{$weir[0]->weir_name}}"> 
                                            </div>
                                            <label class="col-sm-1 col-form-label">ชื่อลำน้ำ</label>
                                            <div class="col-sm-2">
                                              <input id="river_name" name="river_name" type="text" class=" form-control" value="{{$river[0]->river_name}}">
                                            </div>
                                            <label class="col-sm-2 col-form-label" align="right">ลำน้ำสาขาของ</label>
                                            <div class="col-sm-3">
                                              <input id="river_branch" name="river_branch" type="text" class=" form-control" placeholder="-- กรอกชื่อลำน้ำสาขา --" value="{{$river[0]->river_branch}}">
                                             </div>
                                          </div>
                                          <input type="hidden" id="custId" name="river_id" value="{{$river[0]->river_id}}">
                                          <input type="hidden" id="custId" name="weir_id" value="{{$weir[0]->weir_id}}">
                                          <input type="hidden" id="custId" name="weir_code" value="{{$weir[0]->weir_code}}">
                                          <input type="hidden" id="custId" name="weir_spec_id" value="{{$weir[0]->weir_spec_id}}">
                                          <input type="hidden" id="custId" name="weir_location_id" value="{{$weir[0]->weir_location_id}}">
                                          <input type="hidden" name="maintain_id_r1" value="{{$maintain[0]['maintain_id']}}">
                                          <input type="hidden" name="maintain_id_r2" value="{{$maintain[1]['maintain_id']}}">
                                          <input type="hidden" name="maintain_id_r3" value="{{$maintain[2]['maintain_id']}}">
                                          <input type="hidden" name="maintain_id_r4" value="{{$maintain[3]['maintain_id']}}">
                                          <input type="hidden" name="maintain_id_r5" value="{{$maintain[4]['maintain_id']}}">
                                          <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">ก่อสร้างเมื่อ ปี พ.ศ.</label>
                                            <div class="col-sm-2">
                                              <input id="weir_year" name="weir_year" type="text" class=" form-control" placeholder="-- ปี (พ.ศ.) --" value="{{$weir[0]->weir_build}}"> 
                                            </div>
                                            <label class="col-sm-1 col-form-label">อายุฝาย</label>
                                            <div class="col-sm-2">
                                              <input id="weir_age" name="weir_age" type="text" class=" form-control" placeholder="-- อายุ (ปี) --" value="{{$weir[0]->weir_age}}">
                                            </div>
                                          </div>
                                          <!-- ข้อมูลปีก่อสร้างฝาย -->
                                            <div class="form-group row">
                                              <div class="col-sm-5">
                                                <div class="border-checkbox-section">
                                               
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="weir_self" name="weir_model[self][weir_self]" {{add($model->self->weir_self)}} >
                                                    <label class="border-checkbox-label" for="weir_self"> ออกแบบเอง &nbsp; &nbsp;&nbsp;</label>
                                                  </div>
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="weir_std" name="weir_model[self][weir_std]" {{add($model->self->weir_std)}}>
                                                    <label class="border-checkbox-label" for="weir_std"> ใช้แบบมาตราฐาน</label>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-sm-4">
                                                <input id="weir_std_detial" name="weir_model[self][detial]"  type="text" class=" form-control" placeholder="-- แบบมาตราฐาน --" value="{{$model->self->std_detial}}">
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <div class="col-sm-4">
                                                <div class="border-checkbox-section">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="weir_villager"  name="weir_model[self][villager]"  {{add($model->self->villager)}}>
                                                    <label class="border-checkbox-label" for="weir_villager"> ก่อสร้างเองใช้แรงงานชาวบ้านใช้งบของ</label>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-sm-4">
                                                <input id="weir_villager_detial"  name="weir_model[self][villager_detial]" type="text" class=" form-control" placeholder="-- งบของ --"  value="{{$model->self->villager_detial}}">
                                              </div>
                                            </div>
                                          <!-- หน่วยงานรับผิดชอบ -->
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label">หน่วยงานรับผิดชอบ</label>
                                              <div class="col-sm-4">
                                                <input id="resp_name" name="resp_name" type="text" class=" form-control" placeholder="-- หน่วยงาน --" value="{{$weir[0]->resp_name}}">
                                              </div>
                                              <label class="col-sm-2 col-form-label">รับถ่ายโอนจาก</label>
                                              <div class="col-sm-3">
                                                <input id="transfer" name="transfer" type="text" class=" form-control" placeholder="-- หน่วยงาน --" value="{{$weir[0]->transfer}}">
                                              </div>
                                                                                    
                                            </div>

                                          <!-- 1.ลักษณะทั่วไป -->
                                            <div class="form-group row">
                                              <div class="card-block button-list" style="margin-left:-40px;">
                                                <button type="button" class="btn btn-out waves-effect waves-light btn-inverse btn-square" > 1. ลักษณะทั่วไป </button>
                                              </div>
                                            </div>
                                          <!-- 1.1 -->
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label">1.1 ประเภทของลำน้ำ</label>
                                                <div class="col-sm-5">
                                                  <div class="border-checkbox-section">
                                                    <select name="river_type" id="river_type" class="form-control form-control-default">
                                                      <option value="0">{{$river[0]->river_type}}</option>
                                                      <option value="แม่น้ำสายหลัก">แม่น้ำสายหลัก</option>
                                                      <option value="แม่น้ำสาขา">แม่น้ำสาขา</option>
                                                      <option value="ลำห้วย">ลำห้วย</option>
                                                      <option value="ลำเหมือง">ลำเหมือง</option>
                                                    </select>
                                                  </div>
                                                </div>                                        
                                            </div>

                                          <!-- 1.2 -->
                                            <div class="form-group row">
                                              <label class="col-sm-5 col-form-label">1.2 ที่ตั้งพิกัดฝายที่ตรวจสภาพ</label>
                                            </div>
                                          <!-- 1.2 หมู่บ้าน -->
                                            <div class="form-group row">
                                              <label class="col-sm-1 col-form-label text-right">อำเภอ : </label>
                                              <div class="col-sm-3">
                                                <div class="border-checkbox-section">
                                                    <select id='weir_district' name='weir_district' class="form-control ">
                                                      <option value='{{$location[0]->weir_district}}'>{{$location[0]->weir_district}}</option>
                                                        @foreach($districtData['data'] as $village)
                                                          <option value='{{ $village->vill_district }}'>{{ $village->vill_district}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                              </div>
                                              <label class="col-sm-1 col-form-label text-right">ตำบล : </label>
                                              <div class="col-sm-3">
                                                <div class="border-checkbox-section">
                                                  <select id="weir_tumbol" name="weir_tumbol" class="form-control ">
                                                    <option value='{{ $location[0]->weir_tumbol }}'>{{ $location[0]->weir_tumbol }}</option>
                                                  </select>
                                                </div>
                                              </div>
                                              <label class="col-sm-1 col-form-label text-right">หมู่บ้าน : </label>
                                              <div class="col-sm-3">
                                                <div class="border-checkbox-section">
                                                  <select id="weir_village" name="weir_village" class="form-control">
                                                    <option value='{{ $location[0]->weir_village }}'>{{ $location[0]->weir_village }}</option>
                                                  </select>
                                                </div>
                                              </div>
                                            </div>
                                          <!-- 1.2 ตำแหน่ง -->
                                            <table>
                                              <tr>
                                                <td colspan="2">
                                                  <select name="crsSource" id="crsSource" onchange="updateCrs('Source')"  style="visibility:hidden;">
                                                    <option value selected="selected">Select a CRS</option>
                                                  </select>
                                                </td>
                                                <td colspan="2">
                                                  <select name="crsDest" id="crsDest" onchange="updateCrs('Dest')"  style="visibility:hidden;">
                                                    <option value selected="selected">Select a CRS</option>
                                                  </select>
                                                </td>
                                              </tr>
                                            </table>
                                                                                        
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label "> พิกัดของฝาย</label>
                                              <div class="col-sm-3">
                                                <input id="weir_XUTM" name="weir_UTM[x]" type="text" class=" form-control" placeholder="X UTM" value="{{$locationUTM->x}}">
                                              </div>
                                              <label class="col-sm-1 col-form-label text-right">
                                               <button type="button" onclick="transform()" class="btn waves-effect waves-light btn-primary btn-outline-primary btn-block"> >></button>
                                              </label>
                                              <div class="col-sm-3">
                                                <input id="weir_X" name="weir_latlog[x]" type="text" class=" form-control" placeholder="Latitude" value="{{$locationLat->x}}">
                                              </div>
                                                                                                            
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label ">  </label>
                                              <div class="col-sm-3">
                                                <input id="weir_YUTM" name="weir_UTM[y]" type="text" class=" form-control" placeholder="Y UTM" value="{{$locationUTM->y}}">
                                              </div>
                                              <label class="col-sm-1 col-form-label text-right">
                                                <button type="button" onclick="transformutm()" class="btn waves-effect waves-light btn-primary btn-outline-primary btn-block"> <<</button>
                                              </label>
                                              <div class="col-sm-3">
                                                <input id="weir_Y" name="weir_latlog[y]" type="text" class=" form-control" placeholder="Longitude" value="{{$locationLat->y}}">
                                              </div>
                                                                                                            
                                            </div>

                                          <!-- 1.3 ประเภทของสันฝาย -->
                                              
                                            <div class="form-group row">
                                              <label class="col-sm-3 col-form-label ">1.3 ประเภทของสันฝาย </label>
                                            </div>
                                            <div class="border-checkbox-section" >
                                              <div class="form-group row">
                                                <div class="col-sm-12">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="ridge_type_1" name="ridge_type[type]" {{checkdata($v[0],$space[0]->ridge_type->type)}} >
                                                    <label class="border-checkbox-label" for="ridge_type_1">ฝายสันมน</label>
                                                  </div>
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="ridge_type_2" name="ridge_type[type]" {{checkdata($v[1],$space[0]->ridge_type->type)}}>
                                                    <label class="border-checkbox-label" for="ridge_type_2"> ฝายไหลตกตรง</label>
                                                  </div>
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="ridge_type_3"  name="ridge_type[type]" {{checkdata($v[2],$space[0]->ridge_type->type)}}>
                                                    <label class="border-checkbox-label" for="ridge_type_3"> ฝายสันกว้าง</label>
                                                  </div>
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="ridge_type_4" name="ridge_type[type]" {{checkdata($v[3],$space[0]->ridge_type->type)}}>
                                                    <label class="border-checkbox-label" for="ridge_type_4"> ฝายหินทิ้ง</label>
                                                  </div>
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="ridge_type_5" name="ridge_type[type]" {{checkdata($v[4],$space[0]->ridge_type->type)}}>
                                                    <label class="border-checkbox-label" for="ridge_type_5"> ฝายประตูระบาย</label>
                                                  </div>
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="ridge_type_7" name="ridge_type[type]" {{checkdata($v[5],$space[0]->ridge_type->type)}}>
                                                    <label class="border-checkbox-label" for="ridge_type_7"> อื่นๆ 
                                                       <input id="ridge_type_7_detail" name="ridge_type[detail]" type="text" class="form-control" placeholder="ระบุ" style="margin-top:-30px;margin-left:30px;width:100px;" value="{{$space[0]->ridge_type->detail}}"> 
                                                    </label>
                                                  </div>      
                                                </div>
                                             </div>
                                            </div>

                                            <div class="form-group row">
                                              <div class="col-sm-8">
                                                <div class="form-group row">
                                                  <label class="col-sm-2 col-form-label ">ความสูงสัน </label>
                                                  <div class="col-sm-4">
                                                    <input id="ridge_height" name="ridge_height" type="text" class=" form-control" placeholder="(เมตร)" value={{$space[0]->ridge_height}}>
                                                  </div>
                                                  <label class="col-sm-2 col-form-label ">ความกว้างสัน</label>
                                                  <div class="col-sm-4">
                                                    <input id="ridge_width" name="ridge_width" type="text" class=" form-control" placeholder="(เมตร)" value={{$space[0]->ridge_width}}>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>

                                          <!-- 1.4  ประตูระบายน้ำ / ระบายทราย-->
                                            <div class="border-checkbox-section" >
                                              <div class="form-group row">
                                                <label class="col-sm-3 col-form-label "> 1.4  ประตูระบายน้ำ / ระบายทราย </label>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="gate_type_yes" name="gate_has" {{add($space[0]->gate_has)}}>
                                                    <label class="border-checkbox-label" for="gate_type_yes"> มี</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="gate_type_no" name="gate_has" {{addZero($space[0]->gate_has)}}>
                                                    <label class="border-checkbox-label" for="gate_type_no"> ไม่มี</label>
                                                  </div>
                                                                                                                        
                                                </div>
                                              </div>
                                            </div>

                                            <div class="border-checkbox-section" >
                                              <div class="form-group row">
                                                <label class="col-sm-1 col-form-label ">  </label>
                                                <label class="col-sm-2 col-form-label "> ชนิดบานประตู </label>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="door_line" name="gate_type" {{checkdata($d[0],$space[0]->gate_type)}}>
                                                    <label class="border-checkbox-label" for="door_line">บานตรง</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="door_curve" name="gate_type" {{checkdata($d[1],$space[0]->gate_type)}}>
                                                    <label class="border-checkbox-label" for="door_curve">บานโค้ง</label>
                                                  </div>
                                                </div>
                                                <label class="col-sm-1 col-form-label "> ขนาด </label>
                                                <div class="col-sm-2">
                                                  <input id="gate_size" name="gate_dimension[size]" type="text" class=" form-control" placeholder="(กว้างxสูง) เมตร" value={{$space[0]->gate_dimension->size}}>
                                                </div>                                                                                                            
                                                <label class="col-sm-1 col-form-label "> จำนวน </label>
                                                <div class="col-sm-1">
                                                  <input id="gate_num" name="gate_dimension[num]" type="text" class=" form-control" placeholder="ชุด" value={{$space[0]->gate_dimension->num}}>
                                                </div>
                                              </div>
                                            </div>

                                            <div class="border-checkbox-section" >
                                              <div class="form-group row">
                                                <label class="col-sm-1 col-form-label ">  </label>
                                                <label class="col-sm-2 col-form-label "> ชนิดเครื่องยกบาน </label>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="gate_machanic_yes" name="gate_machanic_has" {{add($space[0]->gate_machanic_has)}}>
                                                    <label class="border-checkbox-label" for="gate_machanic_yes">มี</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="gate_machanic_no" name="gate_machanic_has" {{addZero($space[0]->gate_machanic_has)}}>
                                                    <label class="border-checkbox-label" for="gate_machanic_no">ไม่มี</label>
                                                  </div>
                                                </div>
                                                                                                                
                                              </div>
                                            </div>

                                            <div class="border-checkbox-section" >
                                              <div class="form-group row">
                                                <label class="col-sm-3 col-form-label ">  </label>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="machine_chain" name="gate_machanic_type"  {{checkdata($b[0],$space[0]->gate_machanic_type)}} >
                                                    <label class="border-checkbox-label" for="machine_chain">รอกโซ่</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-3">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="machine_bow" name="gate_machanic_type" {{checkdata($b[1],$space[0]->gate_machanic_type)}}>
                                                    <label class="border-checkbox-label" for="machine_bow">เครื่องกว้านคันชัก</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-3">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="machine_coil" name="gate_machanic_type" {{checkdata($b[2],$space[0]->gate_machanic_type)}}>
                                                    <label class="border-checkbox-label" for="machine_coil">เครื่องกว้านม้วนลวด</label>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>

                                          <!-- 1.5  อาคารยังคับน้ำ-->
                                            <div class="border-checkbox-section" >
                                                <div class="form-group row">
                                                  <label class="col-sm-3 col-form-label "> 1.5 อาคารบังคับน้ำ </label>
                                                  <div class="col-sm-2">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                      <input class="border-checkbox" type="checkbox" id="water_building_yes" name="control_building_has" {{add($space[0]->control_building_has)}}>
                                                      <label class="border-checkbox-label" for="water_building_yes"> มี</label>
                                                    </div>
                                                  </div>
                                                  <div class="col-sm-2">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                      <input class="border-checkbox" type="checkbox" id="water_building_no" name="control_building_has" {{addZero($space[0]->control_building_has)}}>
                                                      <label class="border-checkbox-label" for="water_building_no"> ไม่มี</label>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>

                                            <div class="border-checkbox-section" >
                                              <div class="form-group row">
                                                <label class="col-sm-1 col-form-label ">  </label>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="water_building_open" name="control_building_type[open]" {{add($space[0]->control_building_type->open->type)}} >
                                                    <label class="border-checkbox-label" for="water_building_open">แบบปิด</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="water_building_open_left" name="control_building_type[open][left]" {{add($space[0]->control_building_type->open->left)}}>
                                                    <label class="border-checkbox-label" for="water_building_open_left">ฝั่งซ้าย</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="water_building_open_right" name="control_building_type[open][right]" {{add($space[0]->control_building_type->open->right)}}>
                                                    <label class="border-checkbox-label" for="water_building_open_right">ฝั่งขวา</label>
                                                  </div>
                                                </div>
                                                                                                                
                                              </div>
                                            </div>

                                            <div class="form-group row">
                                              <label class="col-sm-3 col-form-label ">  </label>
                                              <div class="col-sm-9">
                                                <div class="form-group row">
                                                  <label class="col-sm-2 col-form-label "> ขนาดฝาท่อปิด&#8709; </label>
                                                  <div class="col-sm-2">
                                                    <input id="water_building_size" name="conttrol_building_loc[size]" type="text" class=" form-control" placeholder="เมตร" value="{{$space[0]->conttrol_building_loc->size}}">
                                                  </div>                                                                                                            
                                                  <label class="col-sm-2 col-form-label "> ความยาวท่อ </label>
                                                  <div class="col-sm-2">
                                                    <input id="water_building_long" name="conttrol_building_loc[long]" type="text" class=" form-control" placeholder="เมตร" value="{{$space[0]->conttrol_building_loc->long}}">
                                                  </div>
                                                  <label class="col-sm-2 col-form-label "> ระดับธรณีบาน </label>
                                                  <div class="col-sm-2">
                                                    <input id="water_building_bed" name="conttrol_building_loc[base]" type="text" class=" form-control" placeholder="เมตร" value="{{$space[0]->conttrol_building_loc->base}}">
                                                  </div>
                                                </div>
                                              </div>
                                                                                                                
                                            </div>
                                                                                                            
                                            <div class="border-checkbox-section" >
                                              <div class="form-group row">
                                                <label class="col-sm-1 col-form-label ">  </label>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="water_building_close" name="control_building_type[close]" {{add($space[0]->control_building_type->close->type)}}>
                                                    <label class="border-checkbox-label" for="water_building_close">แบบเปิด</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="water_building_close_left" name="control_building_type[close][left]" {{add($space[0]->control_building_type->close->left)}}>
                                                    <label class="border-checkbox-label" for="water_building_close_left">ฝั่งซ้าย</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="water_building_close_right" name="control_building_type[close][right]" {{add($space[0]->control_building_type->close->right)}}>
                                                    <label class="border-checkbox-label" for="water_building_close_right">ฝั่งขวา</label>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>

                                            <div class="border-checkbox-section" >
                                              <div class="form-group row">
                                                <label class="col-sm-3 col-form-label ">  </label>
                                                  <div class="col-sm-9">
                                                    <div class="form-group row">
                                                      <label class="col-sm-2 col-form-label "> บานประตู </label>
                                                      <div class="col-sm-10">
                                                        <div class="form-group row">
                                                          <div class="col-sm-3">
                                                            <div class="border-checkbox-group border-checkbox-group-primary">
                                                              <input class="border-checkbox" type="checkbox" id="water_building_close_door_yes" name="control_building_gate_has"  {{add($space[0]->control_building_gate_has)}}>
                                                              <label class="border-checkbox-label" for="water_building_close_door_yes">มี</label>
                                                            </div>
                                                          </div>
                                                          <div class="col-sm-3">
                                                            <div class="border-checkbox-group border-checkbox-group-primary">
                                                              <input class="border-checkbox" type="checkbox" id="water_building_close_door_no" name="control_building_gate_has" {{addZero($space[0]->control_building_gate_has)}}>
                                                              <label class="border-checkbox-label" for="water_building_close_door_no">ไม่มี</label>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="form-group row">
                                                          <div class="col-sm-3">
                                                            <div class="border-checkbox-group border-checkbox-group-primary">
                                                              <input class="border-checkbox" type="checkbox" id="water_building_door_line" name="control_building_gate_type" {{checkdata($d[0],$space[0]->control_building_gate_type)}}>
                                                              <label class="border-checkbox-label" for="water_building_door_line">บานตรง</label>
                                                            </div>
                                                          </div>
                                                          <div class="col-sm-3">
                                                            <div class="border-checkbox-group border-checkbox-group-primary">
                                                              <input class="border-checkbox" type="checkbox" id="water_building_door_curve" name="control_building_gate_type" {{checkdata($d[1],$space[0]->control_building_gate_type)}}>
                                                              <label class="border-checkbox-label" for="water_building_door_curve">บานโค้ง</label>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="form-group row">
                                                          <label class="col-sm-3 col-form-label "> ขนาด(กว้างxสูง) </label>
                                                            <div class="col-sm-2">
                                                              <input id="building_gate_size" name="control_building_gate_dimension[size]" type="text" class=" form-control" placeholder="เมตร" value="{{$space[0]->control_building_gate_dimension->size}}">
                                                            </div>                                                                                                            
                                                            <label class="col-sm-2 col-form-label "> จำนวน </label>
                                                            <div class="col-sm-2">
                                                              <input id="building_gate_num" name="control_building_gate_dimension[num]" type="text" class=" form-control" placeholder="ชุด" value="{{$space[0]->control_building_gate_dimension->num}}">
                                                            </div>
                                                        </div>
                                                      </div>
                                                    </div>

                                                  </div>
                                              </div>
                                            </div>

                                            <div class="border-checkbox-section" >
                                              <div class="form-group row" style="margin-top:-20px;">
                                                <label class="col-sm-3 col-form-label ">  </label>
                                                <label class="col-sm-2 col-form-label "> ชนิดเครื่องยกบาน </label>
                                                <div class="col-sm-7">
                                                  <div class="form-group row">
                                                    <div class="col-sm-3">
                                                      <div class="border-checkbox-group border-checkbox-group-primary">
                                                        <input class="border-checkbox" type="checkbox" id="control_building_machanic_chain" name="control_building_machanic_type"  {{checkdata($b[0],$space[0]->control_building_machanic_type)}}>
                                                        <label class="border-checkbox-label" for="control_building_machanic_chain">รอกโซ่</label>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                      <div class="border-checkbox-group border-checkbox-group-primary">
                                                        <input class="border-checkbox" type="checkbox" id="control_building_machanic_bow" name="control_building_machanic_type"  {{checkdata($b[1],$space[0]->control_building_machanic_type)}}>
                                                        <label class="border-checkbox-label" for="control_building_machanic_bow">เครื่องกว้านคันชัก</label>
                                                      </div>
                                                    </div>
                                                      <div class="col-sm-5">
                                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                                          <input class="border-checkbox" type="checkbox" id="control_building_machanic_coil" name="control_building_machanic_type" {{checkdata($b[2],$space[0]->control_building_machanic_type)}}>
                                                          <label class="border-checkbox-label" for="control_building_machanic_coil">เครื่องกว้านม้วนลวด</label>
                                                        </div>
                                                      </div>
                                                  </div>
                                                </div>
                                                                                                                    
                                              </div>
                                            </div>

                                          <!-- 2.ระบบส่งน้ำ -->
                                            <div class="form-group row">
                                              <div class="card-block button-list" style="margin-left:-40px;">
                                                <button type="button" class="btn btn-out waves-effect waves-light btn-inverse btn-square" > 2. ระบบส่งน้ำ </button>
                                              </div>
                                            </div>

                                            <div class="border-checkbox-section" >
                                              <div class="form-group row" style="margin-top:-20px;">
                                                <label class="col-sm-2 col-form-label "> ระบบส่งน้ำ </label>
                                                  <div class="col-sm-2">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                      <input class="border-checkbox" type="checkbox" id="canal_yes"  name="canal_has" {{add($space[0]->canal_has)}}>
                                                      <label class="border-checkbox-label" for="canal_yes">มี</label>
                                                    </div>
                                                  </div>
                                                  <div class="col-sm-2">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                      <input class="border-checkbox" type="checkbox" id="canal_no" name="canal_has"  {{addZero($space[0]->canal_has)}}>
                                                      <label class="border-checkbox-label" for="canal_no">ไม่มี </label>
                                                    </div>
                                                   </div>                                         
                                              </div>
                                            </div>
                                           
                                            <div class="border-checkbox-section" >
                                              <div class="form-group row" style="margin-top:-20px;">
                                                <label class="col-sm-2 col-form-label "> ลักษณะคลอง </label>
                                                  <div class="col-sm-2">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                      <input class="border-checkbox" type="checkbox" id="canal_soil" name="canal_type" {{checkdata($c[0],$space[0]->canal_type)}}>
                                                      <label class="border-checkbox-label" for="canal_soil">คลองดิน</label>
                                                    </div>
                                                  </div>
                                                  <div class="col-sm-4">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                      <input class="border-checkbox" type="checkbox" id="canal_concrete" name="canal_type" {{checkdata($c[1],$space[0]->canal_type)}}>
                                                      <label class="border-checkbox-label" for="canal_concrete">คลองดาดคอนกรีต</label>
                                                    </div>
                                                  </div>                                          
                                              </div>
                                            </div>
                                                                                        

                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label ">ขนาดก้นคลองกว้าง </label>
                                              <div class="col-sm-3">
                                                <input id="canal_width" name="canel_dimension[width]" type="text" class=" form-control" placeholder="เมตร" value="{{$space[0]->canel_dimension->width}}">
                                              </div> 
                                              <label class="col-sm-2 col-form-label ">ความยาวประมาณ </label>
                                                <div class="col-sm-3">
                                                  <input id="canal_lenght" name="canel_dimension[lenght]" type="text" class=" form-control" placeholder="กิโลเมตร" value="{{$space[0]->canel_dimension->lenght}}">
                                                </div> 
                                            </div>
                                          <br><br><br>

                                        </fieldset>
                                        
                                        <h3> ประวัติการซ่อม </h3>
                                        <fieldset>
                                          <div class="form-group row">
                                            <div class="card-block button-list" style="margin-left:-40px;">
                                              <button type="button" class="btn btn-out waves-effect waves-light btn-inverse btn-square" > 3. ข้อมูลประวัติการซ่อม </button>
                                            </div>
                                          </div>
                                          <div class="form-group row" style="margin-top:-40px;">
                                            <div class="col-sm-12">
                                              <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                  <table class="table table-bordered">
                                                    <thead>
                                                      <tr align="center">
                                                        <th>ปี พ.ศ.</th>
                                                        <th>รายการซ่อม</th>
                                                        <th>หน่วยงาน</th>
                                                        <th>หมายเหตุ</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                      $r=["r1","r2","r3","r4","r5"];
                                                      for($i=0;$i<5;$i++){ ?>
                                                        
                                                      <tr>
                                                        <td><input id="maintain_date_{{$r[$i]}}" name="maintain_date_{{$r[$i]}}" type="text" class=" form-control" placeholder="ระบุ พ.ศ." value="{{$maintain[$i]['maintain_date']}}" ></td>
                                                        <td> <input id="maintain_detail_{{$r[$i]}}" name="maintain_detail_{{$r[$i]}}" type="text" class=" form-control" placeholder="ระบุรายการ " value="{{$maintain[$i]['maintain_detail']}}" > </td>
                                                        <td><input id="maintain_resp_{{$r[$i]}}" name="maintain_resp_{{$r[$i]}}" type="text" class=" form-control" placeholder="ระบุหน่วยงาน" value="{{$maintain[$i]['maintain_resp']}}"  ></td>
                                                        <td><input id="maintain_remark_{{$r[$i]}}" name="maintain_remark_{{$r[$i]}}" type="text" class=" form-control" placeholder="" value="{{$maintain[$i]['maintain_remark']}}" > </td>
                                                      </tr>
                                                    <?php }?> 
                                                                                   
                                                    </tbody>
                                                  </table>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                                                                        
                                        </fieldset>

                                        <h3> สภาพฝาย  </h3>
                                        <fieldset>
                                          <div class="form-group row">
                                            <div class="card-block button-list" style="margin-left:-40px;">
                                              <button type="button" class="btn btn-out waves-effect waves-light btn-inverse btn-square" > 4. การตรวจสอบสภาพฝาย </button>
                                            </div>
                                          </div>
                                          <div class="border-checkbox-section" >
                                            <div class="form-group row" style="margin-top:-40px;">
                                              <div class="col-sm-12">
                                                <div class="card-block table-border-style">
                                                  <div class="table-responsive">
                                                    <table class="table2 table-bordered" width=100%>  
                                                      <thead>
                                                        <tr align="center">
                                                          <th rowspan="2" colspan="2">องค์ประกอบ</th>
                                                          <th colspan="11">ผลการตรวจสอบสภาพฝายด้วยสายตา</th>
                                                        </tr>
                                                        <tr align="center">
                                                          <th>การกัดเซาะ</th>
                                                          <th>การทรุดตัว</th>
                                                          <th>การแตกร้าว</th>
                                                          <th>สิ่งกีดขวาง</th>
                                                          <th>รูโพรง</th>
                                                          <th>การรั่ว</th>
                                                          <th>การเคลื่อนตัว</th>
                                                          <th>การระบายน้ำ</th>
                                                          <th>ต้นไม้/วัชพืช</th>
                                                          <th>ขนาดความ<br>เสียหาย</th>
                                                          <th>หมายเหตุ</th>
                                                        </tr>
                                                      </thead>
                                                    <tbody>
                                                    <!-- 1 -->
                                                      <tr> 
                                                        <th colspan="13" id="text1">1. ส่วน Potection เหนือน้ำ (Upstream Protection Section) </th>
                                                      </tr>
                                                    <!-- 1.1 -->
                                                      <tr>
                                                        <th id="text2">1.1 พื้น (floor)</th> 
                                                        <td>ปกติ</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_1" name="floor_1_erosion" {{checkdata($l[0],$upprotection[0]->floor_erosion)}}><label for="1_1_normal_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_2" name="floor_1_subsidence" {{checkdata($l[0],$upprotection[0]->floor_subsidence)}}><label for="1_1_normal_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_3" name="floor_1_cracking" {{checkdata($l[0],$upprotection[0]->floor_cracking)}}><label for="1_1_normal_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_4" name="floor_1_obstruction" {{checkdata($l[0],$upprotection[0]->floor_obstruction)}}><label for="1_1_normal_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_5" name="floor_1_hole" {{checkdata($l[0],$upprotection[0]->floor_hole)}}><label for="1_1_normal_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_6" name="floor_1_leak" {{checkdata($l[0],$upprotection[0]->floor_leak)}}><label for="1_1_normal_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_7" name="floor_1_movement" {{checkdata($l[0],$upprotection[0]->floor_movement)}}><label for="1_1_normal_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_8" name="floor_1_drainage" {{checkdata($l[0],$upprotection[0]->floor_drainage)}}><label for="1_1_normal_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_9" name="floor_1_weed" {{checkdata($l[0],$upprotection[0]->floor_weed)}}><label for="1_1_normal_9"></label></div></td>
                                                        <td rowspan="4" width="8%" style="vertical-align: top;">
                                                          <textarea rows="7" cols="5" id="1_1_normal_9" name="floor_1_damage" class="form-control" placeholder="" >{{$upprotection[0]->floor_damage}}</textarea>
                                                        </td>
                                                        <td rowspan="4" width="10%">
                                                          <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                            <tr>
                                                              <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_1_normal_11_no" name="floor_1_remake[no]" {{add($upprotection[0]->floor_remake->no)}}><label for="1_1_normal_11_no"></label></div></td>
                                                              <td>ไม่มี</td>
                                                            </tr>
                                                            <tr >
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_1_normal_11_nosee" name="floor_1_remake[nosee]" {{add($upprotection[0]->floor_remake->nosee)}} ><label for="1_1_normal_11_nosee"></label></div></td>
                                                              <td>มองไม่เห็น</td>
                                                            </tr>
                                                            <tr>
                                                              <td > อื่นๆ </td>
                                                              <td><input id="weir_note_r11" name="floor_1_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$upprotection[0]->floor_remake->detail}}"> </td>
                                                            </tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                          </table>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td id="text2">ตะกอน</td> 
                                                        <td>น้อย</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_1"name="floor_1_erosion" {{checkdata($l[1],$upprotection[0]->floor_erosion)}}><label for="1_1_less_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_2" name="floor_1_subsidence" {{checkdata($l[1],$upprotection[0]->floor_subsidence)}}><label for="1_1_less_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_3" name="floor_1_cracking" {{checkdata($l[1],$upprotection[0]->floor_cracking)}}><label for="1_1_less_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_4" name="floor_1_obstruction" {{checkdata($l[1],$upprotection[0]->floor_obstruction)}}><label for="1_1_less_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_5" name="floor_1_hole" {{checkdata($l[1],$upprotection[0]->floor_hole)}}><label for="1_1_less_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_6" name="floor_1_leak" {{checkdata($l[1],$upprotection[0]->floor_leak)}}><label for="1_1_less_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_7" name="floor_1_movement" {{checkdata($l[1],$upprotection[0]->floor_movement)}}><label for="1_1_less_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_8" name="floor_1_drainage" {{checkdata($l[1],$upprotection[0]->floor_drainage)}}><label for="1_1_less_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_9" name="floor_1_weed" {{checkdata($l[1],$upprotection[0]->floor_weed)}}><label for="1_1_less_9"></label></div></td>
                                                      </tr>
                                                      <tr>
                                                        <td>
                                                          <table class="table2 table-borderless" id="text2"> 
                                                            <tr>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_1_sed_n" name="check_floor_1" {{checkdata($l[0],$upprotection[0]->check_floor)}}><label for="1_1_sed_n"></label></div></td>
                                                              <td>ปกติ   </td>
                                                              <td> <div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_1_sed_l" name="check_floor_1" {{checkdata($l[1],$upprotection[0]->check_floor)}}><label for="1_1_sed_l"></label></div></td>
                                                              <td>น้อย</td>
                                                            </tr>
                                                          </table>
                                                        </td> 
                                                        <td>ปานกลาง</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_1" name="floor_1_erosion" {{checkdata($l[2],$upprotection[0]->floor_erosion)}}><label for="1_1_mid_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_2" name="floor_1_subsidence" {{checkdata($l[2],$upprotection[0]->floor_subsidence)}}><label for="1_1_mid_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_3" name="floor_1_cracking" {{checkdata($l[2],$upprotection[0]->floor_cracking)}}><label for="1_1_mid_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_4" name="floor_1_obstruction" {{checkdata($l[2],$upprotection[0]->floor_obstruction)}}><label for="1_1_mid_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_5" name="floor_1_hole" {{checkdata($l[2],$upprotection[0]->floor_hole)}}><label for="1_1_mid_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_6" name="floor_1_leak" {{checkdata($l[2],$upprotection[0]->floor_leak)}}><label for="1_1_mid_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_7" name="floor_1_movement" {{checkdata($l[2],$upprotection[0]->floor_movement)}}><label for="1_1_mid_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_8" name="floor_1_drainage" {{checkdata($l[2],$upprotection[0]->floor_drainage)}}><label for="1_1_mid_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_9" name="floor_1_weed" {{checkdata($l[2],$upprotection[0]->floor_weed)}}><label for="1_1_mid_9"></label></div></td>
                                                      </tr>
                                                      <tr>
                                                        <td>
                                                          <table class="table2 table-borderless" id="text2"> 
                                                            <tr>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_1_sed_md" name="check_floor_1" {{checkdata($l[2],$upprotection[0]->check_floor)}}><label for="1_1_sed_md"></label></div></td>
                                                              <td>กลาง </td>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_1_sed_m" name="check_floor_1" {{checkdata($l[3],$upprotection[0]->check_floor)}}><label for="1_1_sed_m"></label></div></td>
                                                              <td>มาก</td>
                                                            </tr>
                                                          </table>
                                                        </td> 
                                                        <td>มาก</td>
                                                          <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_1" name="floor_1_erosion" {{checkdata($l[3],$upprotection[0]->floor_erosion)}}><label for="1_1_more_1"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_2" name="floor_1_subsidence" {{checkdata($l[3],$upprotection[0]->floor_subsidence)}}><label for="1_1_more_2"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_3" name="floor_1_cracking" {{checkdata($l[3],$upprotection[0]->floor_cracking)}}><label for="1_1_more_3"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_4" name="floor_1_obstruction" {{checkdata($l[3],$upprotection[0]->floor_obstruction)}}><label for="1_1_more_4"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_5" name="floor_1_hole" {{checkdata($l[3],$upprotection[0]->floor_hole)}}><label for="1_1_more_5"></label> </div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_6" name="floor_1_leak" {{checkdata($l[3],$upprotection[0]->floor_leak)}}><label for="1_1_more_6"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_7" name="floor_1_movement" {{checkdata($l[3],$upprotection[0]->floor_movement)}}><label for="1_1_more_7"></label> </div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_8" name="floor_1_drainage" {{checkdata($l[3],$upprotection[0]->floor_drainage)}}><label for="1_1_more_8"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_9" name="floor_1_weed" {{checkdata($l[3],$upprotection[0]->floor_weed)}}><label for="1_1_more_9"></label></div></td>
                                                      </tr>
                                                    <!-- 1.2 -->
                                                      <tr>
                                                        <th id="text2" rowspan="4" style="vertical-align: top;">1.2 ลาดด้านข้าง</th> 
                                                        <td>ปกติ</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_1" name="side_1_erosion" {{checkdata($l[0],$upprotection[0]->side_erosion)}}><label for="1_2_normal_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_2" name="side_1_subsidence" {{checkdata($l[0],$upprotection[0]->side_subsidence)}}><label for="1_2_normal_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_3" name="side_1_cracking" {{checkdata($l[0],$upprotection[0]->side_cracking)}}><label for="1_2_normal_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_4" name="side_1_obstruction" {{checkdata($l[0],$upprotection[0]->side_obstruction)}}><label for="1_2_normal_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_5" name="side_1_hole" {{checkdata($l[0],$upprotection[0]->side_hole)}}><label for="1_2_normal_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_6" name="side_1_leak" {{checkdata($l[0],$upprotection[0]->leak)}}><label for="1_2_normal_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_7" name="side_1_movement" {{checkdata($l[0],$upprotection[0]->side_movement)}}><label for="1_2_normal_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_8" name="side_1_drainage" {{checkdata($l[0],$upprotection[0]->side_drainage)}}><label for="1_2_normal_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_9" name="side_1_weed" {{checkdata($l[0],$upprotection[0]->side_weed)}}><label for="1_2_normal_9"></label></div></td>
                                                        <td rowspan="4" width="8%" style="vertical-align: top;">
                                                          <textarea rows="7" cols="5" id="1_2_normal_9" name="side_1_damage" class="form-control" placeholder=""  > {{$upprotection[0]->side_damage}} </textarea>
                                                        </td>
                                                        <td rowspan="4" width="8%">
                                                          <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                            <tr>
                                                              <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_2_normal_11_no" name="side_1_remake[no]" {{add($upprotection[0]->side_remake->no)}}><label for="1_2_normal_11_no"></label></div></td>
                                                              <td>ไม่มี</td>
                                                            </tr>
                                                            <tr >
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_2_normal_11_nosee" name="side_1_remake[nosee]" {{add($upprotection[0]->side_remake->nosee)}}><label for="1_2_normal_11_nosee"></label></div></td>
                                                              <td>มองไม่เห็น</td>
                                                            </tr>
                                                            <tr>
                                                              <td > อื่นๆ </td>
                                                              <td><input id="weir_note_r12" name="side_1_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$upprotection[0]->side_remake->detail}}"> </td>
                                                            </tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                            </table>
                                                        </td>
                                                      </tr>
                                                      <?php for($i=1 ; $i<4 ;$i++){?>
                                                        <tr>
                                                          <td>{{$level[$i-1]}}</td>
                                                          <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_{{$level2[$i-1]}}_1" name="side_1_erosion" {{checkdata($l[$i],$upprotection[0]->side_erosion)}}><label for="1_2_{{$level2[$i-1]}}_1"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_{{$level2[$i-1]}}_2" name="side_1_subsidence" {{checkdata($l[$i],$upprotection[0]->side_subsidence)}}><label for="1_2_{{$level2[$i-1]}}_2"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_{{$level2[$i-1]}}_3" name="side_1_cracking" {{checkdata($l[$i],$upprotection[0]->side_cracking)}}><label for="1_2_{{$level2[$i-1]}}_3"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_{{$level2[$i-1]}}_4" name="side_1_obstruction" {{checkdata($l[$i],$upprotection[0]->side_obstruction)}}><label for="1_2_{{$level2[$i-1]}}_4"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_{{$level2[$i-1]}}_5" name="side_1_hole" {{checkdata($l[$i],$upprotection[0]->side_hole)}}><label for="1_2_{{$level2[$i-1]}}_5"></label> </div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_{{$level2[$i-1]}}_6" name="side_1_leak" {{checkdata($l[$i],$upprotection[0]->side_leak)}}><label for="1_2_{{$level2[$i-1]}}_6"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_{{$level2[$i-1]}}_7" name="side_1_movement" {{checkdata($l[$i],$upprotection[0]->side_movement)}}><label for="1_2_{{$level2[$i-1]}}_7"></label> </div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_{{$level2[$i-1]}}_8" name="side_1_drainage" {{checkdata($l[$i],$upprotection[0]->side_drainage)}}><label for="1_2_{{$level2[$i-1]}}_8"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_{{$level2[$i-1]}}_9" name="side_1_weed" {{checkdata($l[$i],$upprotection[0]->side_weed)}}><label for="1_2_l{{$level2[$i-1]}}_9"></label></div></td>
                                                        </tr>


                                                      <?php } ?>
                                                      
                                                    <!-- 2 -->
                                                      <tr> 
                                                          <th colspan="13" id="text1">2. ส่วนเหนือน้ำ (Upstream Concrete Section) </th>
                                                      </tr>
                                                    <!-- 2.1 -->
                                                      <tr>
                                                        <th id="text2">2.1 พื้น (floor)</th> 
                                                        <td>ปกติ</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_1" name="floor_2_erosion" {{checkdata($l[0],$upconcrete[0]->floor_erosion)}}><label for="2_1_normal_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_2" name="floor_2_subsidence" {{checkdata($l[0],$upconcrete[0]->subsidence)}}><label for="2_1_normal_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_3" name="floor_2_cracking" {{checkdata($l[0],$upconcrete[0]->floor_cracking)}}><label for="2_1_normal_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_4" name="floor_2_obstruction" {{checkdata($l[0],$upconcrete[0]->floor_obstruction)}}><label for="2_1_normal_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_5" name="floor_2_hole" {{checkdata($l[0],$upconcrete[0]->floor_hole)}}><label for="2_1_normal_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_6" name="floor_2_leak" {{checkdata($l[0],$upconcrete[0]->floor_leak)}}><label for="2_1_normal_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_7" name="floor_2_movement" {{checkdata($l[0],$upconcrete[0]->floor_movement)}}><label for="2_1_normal_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_8" name="floor_2_drainage" {{checkdata($l[0],$upconcrete[0]->floor_drainage)}}><label for="2_1_normal_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_9" name="floor_2_weed" {{checkdata($l[0],$upconcrete[0]->floor_weed)}}><label for="2_1_normal_9"></label></div></td>
                                                        <td rowspan="4" width="8%" style="vertical-align: top;">
                                                          <textarea rows="7" cols="5" id="2_1_normal_9" name="floor_2_damage" class="form-control" placeholder="" > {{$upconcrete[0]->floor_damage}} </textarea>
                                                        </td>
                                                        <td rowspan="4" width="10%">
                                                          <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                            <tr>
                                                              <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_1_normal_11_no" name="floor_2_remake[no]" {{add($upconcrete[0]->floor_remake->no)}}><label for="2_1_normal_11_no"></label></div></td>
                                                              <td>ไม่มี</td>
                                                            </tr>
                                                            <tr >
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_1_normal_11_nosee" name="floor_2_remake[nosee]" {{add($upconcrete[0]->floor_remake->nosee)}}><label for="2_1_normal_11_nosee"></label></div></td>
                                                              <td>มองไม่เห็น</td>
                                                            </tr>
                                                            <tr>
                                                              <td > อื่นๆ </td>
                                                              <td><input id="weir_note_r21" name="floor_2_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$upconcrete[0]->floor_remake->detail}}"> </td>
                                                            </tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                          </table>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td id="text2">ตะกอน</td> 
                                                        <td>น้อย</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_1" name="floor_2_erosion" {{checkdata($l[1],$upconcrete[0]->floor_erosion)}}><label for="2_1_less_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_2" name="floor_2_subsidence"  {{checkdata($l[1],$upconcrete[0]->floor_subsidence)}}><label for="2_1_less_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_3" name="floor_2_cracking"  {{checkdata($l[1],$upconcrete[0]->floor_cracking)}}><label for="2_1_less_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_4" name="floor_2_obstruction"  {{checkdata($l[1],$upconcrete[0]->floor_obstruction)}}><label for="2_1_less_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_5" name="floor_2_hole"  {{checkdata($l[1],$upconcrete[0]->floor_hole)}}><label for="2_1_less_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_6" name="floor_2_leak"  {{checkdata($l[1],$upconcrete[0]->floor_leak)}}><label for="2_1_less_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_7" name="floor_2_movement"  {{checkdata($l[1],$upconcrete[0]->floor_movement)}}><label for="2_1_less_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_8" name="floor_2_drainage"  {{checkdata($l[1],$upconcrete[0]->floor_drainage)}}><label for="2_1_less_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_9" name="floor_2_weed"  {{checkdata($l[1],$upconcrete[0]->floor_weed)}}><label for="2_1_less_9"></label></div></td>
                                                      </tr>
                                                      <tr>
                                                        <td>
                                                          <table class="table2 table-borderless" id="text2"> 
                                                            <tr>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_1_sed_n" name="check_floor_2" {{checkdata($l[0],$upconcrete[0]->check_floor)}}><label for="2_1_sed_n"></label></div></td>
                                                              <td>ปกติ</td>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_1_sed_l" name="check_floor_2" {{checkdata($l[1],$upconcrete[0]->check_floor)}}><label for="2_1_sed_l"></label></div></td>
                                                              <td>น้อย</td>
                                                            </tr>
                                                          </table>
                                                        </td> 
                                                        <td>ปานกลาง</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_1" name="floor_2_erosion" {{checkdata($l[2],$upconcrete[0]->floor_erosion)}}><label for="2_1_mid_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_2" name="floor_2_subsidence" {{checkdata($l[2],$upconcrete[0]->floor_erosion)}}><label for="2_1_mid_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_3" name="floor_2_cracking" {{checkdata($l[2],$upconcrete[0]->floor_erosion)}}><label for="2_1_mid_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_4" name="floor_2_obstruction" {{checkdata($l[2],$upconcrete[0]->floor_erosion)}}><label for="2_1_mid_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_5" name="floor_2_hole" {{checkdata($l[2],$upconcrete[0]->floor_erosion)}}><label for="2_1_mid_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_6" name="floor_2_leak" {{checkdata($l[2],$upconcrete[0]->floor_erosion)}}><label for="2_1_mid_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_7" name="floor_2_movement" {{checkdata($l[2],$upconcrete[0]->floor_erosion)}}><label for="2_1_mid_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_8" name="floor_2_drainage" {{checkdata($l[2],$upconcrete[0]->floor_erosion)}}><label for="2_1_mid_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_9" name="floor_2_weed" {{checkdata($l[2],$upconcrete[0]->floor_erosion)}}><label for="2_1_mid_9"></label></div></td>
                                                      </tr>
                                                      <tr>
                                                        <td>
                                                          <table class="table2 table-borderless" id="text2"> 
                                                            <tr>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_1_sed_md" name="check_floor_2" {{checkdata($l[2],$upconcrete[0]->check_floor)}}><label for="2_1_sed_md"></label></div></td>
                                                              <td>กลาง</td>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_1_sed_m" name="check_floor_2" {{checkdata($l[3],$upconcrete[0]->check_floor)}}><label for="2_1_sed_m"></label></div></td>
                                                              <td>มาก</td>
                                                            </tr>
                                                          </table>
                                                        </td> 
                                                        <td>มาก</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_1" name="floor_2_erosion" {{checkdata($l[3],$upconcrete[0]->floor_erosion)}}><label for="2_1_more_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_2" name="floor_2_subsidence" {{checkdata($l[3],$upconcrete[0]->floor_subsidence)}}><label for="2_1_more_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_3" name="floor_2_cracking" {{checkdata($l[3],$upconcrete[0]->floor_cracking)}}><label for="2_1_more_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_4" name="floor_2_obstruction" {{checkdata($l[3],$upconcrete[0]->floor_obstruction)}}><label for="2_1_more_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_5" name="floor_2_hole" {{checkdata($l[3],$upconcrete[0]->floor_hole)}}><label for="2_1_more_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_6" name="floor_2_leak" {{checkdata($l[3],$upconcrete[0]->floor_leak)}}><label for="2_1_more_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_7" name="floor_2_movement" {{checkdata($l[3],$upconcrete[0]->floor_movement)}}><label for="2_1_more_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_8" name="floor_2_drainage" {{checkdata($l[3],$upconcrete[0]->floor_drainage)}}><label for="2_1_more_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_9" name="floor_2_weed" {{checkdata($l[3],$upconcrete[0]->floor_weed)}}><label for="2_1_more_9"></label></div></td>
                                                      </tr>
                                                    <!-- 2.2 -->
                                                      <tr>
                                                        <th id="text2" rowspan="4" style="vertical-align: top;">2.2 ลาดด้านข้าง</th> 
                                                        <td>ปกติ</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_1" name="side_2_erosion" {{checkdata($l[0],$upconcrete[0]->side_erosion)}}><label for="2_2_normal_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_2" name="side_2_subsidence" {{checkdata($l[0],$upconcrete[0]->side_subsidence)}}><label for="2_2_normal_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_3" name="side_2_cracking" {{checkdata($l[0],$upconcrete[0]->side_cracking)}}><label for="2_2_normal_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_4" name="side_2_obstruction" {{checkdata($l[0],$upconcrete[0]->side_obstruction)}}><label for="2_2_normal_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_5" name="side_2_hole" {{checkdata($l[0],$upconcrete[0]->side_hole)}}><label for="2_2_normal_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_6" name="side_2_leak" {{checkdata($l[0],$upconcrete[0]->side_leak)}}><label for="2_2_normal_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_7" name="side_2_movement" {{checkdata($l[0],$upconcrete[0]->side_movementn)}}><label for="2_2_normal_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_8" name="side_2_drainage"{{checkdata($l[0],$upconcrete[0]->side_drainage)}}><label for="2_2_normal_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_9" name="side_2_weed" {{checkdata($l[0],$upconcrete[0]->side_weed)}}><label for="2_2_normal_9"></label></div></td>
                                                        <td rowspan="4" width="8%" style="vertical-align: top;">
                                                          <textarea rows="7" cols="5" id="2_2_normal_9" name="side_2_damage" class="form-control" placeholder="" > {{$upconcrete[0]->side_damage}} </textarea>
                                                        </td>
                                                        <td rowspan="4" width="8%">
                                                          <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                            <tr>
                                                             <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_2_normal_11_no" name="side_2_remake[no]" {{add($upconcrete[0]->side_remake->no)}}><label for="2_2_normal_11_no"></label></div></td>
                                                             <td>ไม่มี</td>
                                                            </tr>
                                                            <tr >
                                                             <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_2_normal_11_nosee" name="side_2_remake[check]" {{add($upconcrete[0]->side_remake->nosee)}}><label for="2_2_normal_11_nosee"></label></div></td>
                                                             <td>มองไม่เห็น</td>
                                                            </tr>
                                                            <tr>
                                                             <td > อื่นๆ </td>
                                                             <td><input id="weir_note_r22" name="side_2_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$upconcrete[0]->floor_remake->detail}}"> </td>
                                                            </tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                          </table>
                                                        </td>
                                                      </tr>
                                                      <?php for($i=1 ; $i<4 ;$i++){?>
                                                        <tr>
                                                          <td>{{$level[$i-1]}}</td>
                                                          <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_{{$level2[$i-1]}}_1" name="side_2_erosion" {{checkdata($l[$i],$upconcrete[0]->side_erosion)}}><label for="2_2_{{$level2[$i-1]}}_1"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_{{$level2[$i-1]}}_2" name="side_2_subsidence" {{checkdata($l[$i],$upconcrete[0]->side_subsidence)}}><label for="2_2_{{$level2[$i-1]}}_2"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_{{$level2[$i-1]}}_3" name="side_2_cracking" {{checkdata($l[$i],$upconcrete[0]->side_cracking)}}><label for="2_2_{{$level2[$i-1]}}_3"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_{{$level2[$i-1]}}_4" name="side_2_obstruction" {{checkdata($l[$i],$upconcrete[0]->side_obstruction)}}><label for="2_2_{{$level2[$i-1]}}_4"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_{{$level2[$i-1]}}_5" name="side_2_hole" {{checkdata($l[$i],$upconcrete[0]->side_hole)}}><label for="2_2_{{$level2[$i-1]}}_5"></label> </div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_{{$level2[$i-1]}}_6" name="side_2_leak" {{checkdata($l[$i],$upconcrete[0]->side_leak)}}><label for="2_2_{{$level2[$i-1]}}_6"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_{{$level2[$i-1]}}_7" name="side_2_movement" {{checkdata($l[$i],$upconcrete[0]->side_movement)}}><label for="2_2_{{$level2[$i-1]}}_7"></label> </div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_{{$level2[$i-1]}}_8" name="side_2_drainage" {{checkdata($l[$i],$upconcrete[0]->side_drainage)}}><label for="2_2_{{$level2[$i-1]}}_8"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_{{$level2[$i-1]}}_9" name="side_2_weed" {{checkdata($l[$i],$upconcrete[0]->side_weed)}}><label for="2_2_{{$level2[$i-1]}}_9"></label></div></td>
                                                        </tr>
                                                      <?php } ?>
                                                                                                                                     
                                                    <!-- 3 -->
                                                      <tr> 
                                                       <th colspan="13" id="text1">3. ส่วนควบคุม (Control Sector) </th>
                                                      </tr>
                                                      <!-- 3.1 -->
                                                        <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">3.1 ฝายควบคุม <br>น้ำและบันไดปลา </th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_1" name="waterctrl_3_erosion" {{checkdata($l[0],$control[0]->waterctrl_erosion)}}><label for="3_1_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_2" name="waterctrl_3_subsidence" {{checkdata($l[0],$control[0]->waterctrl_subsidence)}}><label for="3_1_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_3" name="waterctrl_3_cracking" {{checkdata($l[0],$control[0]->waterctrl_cracking)}}><label for="3_1_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_4" name="waterctrl_3_obstruction" {{checkdata($l[0],$control[0]->waterctrl_obstruction)}}><label for="3_1_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_5" name="waterctrl_3_hole" {{checkdata($l[0],$control[0]->waterctrl_hole)}}><label for="3_1_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_6" name="waterctrl_3_leak" {{checkdata($l[0],$control[0]->waterctrl_leak)}}><label for="3_1_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_7" name="waterctrl_3_movement" {{checkdata($l[0],$control[0]->waterctrl_movement)}}><label for="3_1_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_8" name="waterctrl_3_drainage" {{checkdata($l[0],$control[0]->waterctrl_drainage)}}><label for="3_1_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_9" name="waterctrl_3_weed" {{checkdata($l[0],$control[0]->waterctrl_weed)}}><label for="3_1_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                              <textarea rows="7" cols="5" id="3_1_normal_9" name="waterctrl_3_damage" class="form-control" placeholder="" > {{$control[0]->waterctrl_damage}} </textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                              <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                               <tr>
                                                                 <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_1_normal_11_no" name="waterctrl_3_remake[no]" {{add($control[0]->waterctrl_remake->no)}}><label for="3_1_normal_11_no"></label></div></td>
                                                                 <td>ไม่มี</td>
                                                               </tr>
                                                               <tr >
                                                                 <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_1_normal_11_nosee" name="waterctrl_3_remake[nosee]" {{add($control[0]->waterctrl_remake->nosee)}}><label for="3_1_normal_11_nosee"></label></div></td>
                                                                 <td>มองไม่เห็น</td>
                                                               </tr>
                                                               <tr>
                                                                 <td > อื่นๆ </td>
                                                                 <td><input id="weir_note_r31" name="waterctrl_3_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$control[0]->waterctrl_remake->detail}}"> </td>
                                                               </tr>
                                                                 <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <?php for($i=1 ; $i<4 ;$i++){?>
                                                          <tr>
                                                          <td>{{$level[$i-1]}}</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_{{$level2[$i-1]}}_1" name="waterctrl_3_erosion" {{checkdata($l[$i],$control[0]->waterctrl_erosion)}}><label for="3_1_{{$level2[$i-1]}}_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_{{$level2[$i-1]}}_2" name="waterctrl_3_subsidence" {{checkdata($l[$i],$control[0]->waterctrl_subsidence)}}><label for="3_1_{{$level2[$i-1]}}_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_{{$level2[$i-1]}}_3" name="waterctrl_3_cracking" {{checkdata($l[$i],$control[0]->waterctrl_cracking)}}><label for="3_1_{{$level2[$i-1]}}_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_{{$level2[$i-1]}}_4" name="waterctrl_3_obstruction" {{checkdata($l[$i],$control[0]->waterctrl_obstruction)}}><label for="3_1_{{$level2[$i-1]}}_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_{{$level2[$i-1]}}_5" name="waterctrl_3_hole" {{checkdata($l[$i],$control[0]->waterctrl_hole)}}><label for="3_1_{{$level2[$i-1]}}_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_{{$level2[$i-1]}}_6" name="waterctrl_3_leak" {{checkdata($l[$i],$control[0]->waterctrl_leak)}}><label for="3_1_{{$level2[$i-1]}}_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_{{$level2[$i-1]}}_7" name="waterctrl_3_movement" {{checkdata($l[$i],$control[0]->waterctrl_movement)}}><label for="3_1_{{$level2[$i-1]}}_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_{{$level2[$i-1]}}_8" name="waterctrl_3_drainage" {{checkdata($l[$i],$control[0]->waterctrl_drainage)}}><label for="3_1_{{$level2[$i-1]}}_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_{{$level2[$i-1]}}_9" name="waterctrl_3_weed" {{checkdata($l[$i],$control[0]->waterctrl_weed)}}><label for="3_1_{{$level2[$i-1]}}_9"></label></div></td>
                                                          </tr>
                                                        <?php } ?>
                                                            
                                                      <!-- 3.2 -->
                                                        <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">3.2 กำแพงข้าง</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_1" name="sidewall_3_erosion" {{checkdata($l[0],$control[0]->sidewall_erosion)}}><label for="3_2_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_2" name="sidewall_3_subsidence" {{checkdata($l[0],$control[0]->sidewall_subsidence)}}><label for="3_2_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_3" name="sidewall_3_cracking" {{checkdata($l[0],$control[0]->sidewall_cracking)}}><label for="3_2_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_4" name="sidewall_3_obstruction" {{checkdata($l[0],$control[0]->sidewall_obstruction)}}><label for="3_2_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_5" name="sidewall_3_hole" {{checkdata($l[0],$control[0]->sidewall_hole)}}><label for="3_2_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_6" name="sidewall_3_leak" {{checkdata($l[0],$control[0]->sidewall_leak)}}><label for="3_2_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_7" name="sidewall_3_movement" {{checkdata($l[0],$control[0]->sidewall_movement)}}><label for="3_2_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_8" name="sidewall_3_drainage" {{checkdata($l[0],$control[0]->sidewall_drainage)}}><label for="3_2_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_9" name="sidewall_3_weed" {{checkdata($l[0],$control[0]->sidewall_weed)}}><label for="3_2_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                              <textarea rows="7" cols="5" id="3_2_normal_9" name="sidewall_3_damage" class="form-control" placeholder="" > {{$control[0]->sidewall_damage}}</textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                              <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                <tr>
                                                                  <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_2_normal_11_no" name="sidewall_3_remake[no]" {{add($control[0]->sidewall_remake->no)}}><label for="3_2_normal_11_no"></label></div></td>
                                                                  <td>ไม่มี</td>
                                                                </tr>
                                                                <tr >
                                                                  <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_2_normal_11_nosee" name="sidewall_3_remake[nosee]" {{add($control[0]->sidewall_remake->nosee)}}><label for="3_2_normal_11_nosee"></label></div></td>
                                                                  <td>มองไม่เห็น</td>
                                                                </tr>
                                                                <tr>
                                                                  <td > อื่นๆ </td>
                                                                  <td><input id="weir_note_r32" name="sidewall_3_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$control[0]->sidewall_remake->detail}}"> </td>
                                                                </tr>
                                                                <tr><td>&nbsp;</td></tr>
                                                              </table>
                                                            </td>
                                                        </tr>
                                                        <?php for($i=1 ; $i<4 ;$i++){?>
                                                          <tr>
                                                              s<td>{{$level[$i-1]}}</td>
                                                              <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_{{$level2[$i-1]}}_1" name="sidewall_3_erosion" {{checkdata($l[$i],$control[0]->sidewall_erosion)}}><label for="3_2_{{$level2[$i-1]}}_1"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_{{$level2[$i-1]}}_2" name="sidewall_3_subsidence" {{checkdata($l[$i],$control[0]->sidewall_subsidence)}}><label for="3_2_{{$level2[$i-1]}}_2"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_{{$level2[$i-1]}}_3" name="sidewall_3_cracking" {{checkdata($l[$i],$control[0]->sidewall_cracking)}}><label for="3_2_{{$level2[$i-1]}}_3"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_{{$level2[$i-1]}}_4" name="sidewall_3_obstruction" {{checkdata($l[$i],$control[0]->sidewall_obstruction)}}><label for="3_2_{{$level2[$i-1]}}_4"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_{{$level2[$i-1]}}_5" name="sidewall_3_hole" {{checkdata($l[$i],$control[0]->sidewall_hole)}}><label for="3_2_{{$level2[$i-1]}}_5"></label> </div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_{{$level2[$i-1]}}_6" name="sidewall_3_leak" {{checkdata($l[$i],$control[0]->sidewall_leak)}}><label for="3_2_{{$level2[$i-1]}}_6"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_{{$level2[$i-1]}}_7" name="sidewall_3_movement" {{checkdata($l[$i],$control[0]->sidewall_movement)}}><label for="3_2_{{$level2[$i-1]}}_7"></label> </div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_{{$level2[$i-1]}}_8" name="sidewall_3_drainage" {{checkdata($l[$i],$control[0]->sidewall_drainage)}}><label for="3_2_{{$level2[$i-1]}}_8"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_{{$level2[$i-1]}}_9" name="sidewall_3_weed" {{checkdata($l[$i],$control[0]->sidewall_weed)}}><label for="3_2_{{$level2[$i-1]}}_9"></label></div></td>
                                                          </tr>
                                                        <?php } ?>
                                                       
                                                      <!-- 3.3 -->
                                                        <tr> 
                                                          <th colspan="13" id="text3">3.3. ประตู/ช่องระบายทราย </th>
                                                        </tr>
                                                        <!-- 3.3.1 -->
                                                            <tr>
                                                                <th id="text2" rowspan="4" style="vertical-align: top;">3.3.1 พื้น</th> 
                                                                <td>ปกติ</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_1" name="dgfloor_3_erosion" {{checkdata($l[0],$control[0]->dgfloor_erosion)}}><label for="3_3_1_normal_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_2" name="dgfloor_3_subsidence" {{checkdata($l[0],$control[0]->dgfloor_subsidence)}}><label for="3_3_1_normal_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_3" name="dgfloor_3_cracking" {{checkdata($l[0],$control[0]->dgfloor_cracking)}}><label for="3_3_1_normal_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_4" name="dgfloor_3_obstruction" {{checkdata($l[0],$control[0]->dgfloor_obstruction)}}><label for="3_3_1_normal_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_5" name="dgfloor_3_hole" {{checkdata($l[0],$control[0]->dgfloor_hole)}}><label for="3_3_1_normal_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_6" name="dgfloor_3_leak" {{checkdata($l[0],$control[0]->dgfloor_leak)}}><label for="3_3_1_normal_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_7" name="dgfloor_3_movement" {{checkdata($l[0],$control[0]->dgfloor_movement)}}><label for="3_3_1_normal_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_8" name="dgfloor_3_drainage" {{checkdata($l[0],$control[0]->dgfloor_drainage)}}><label for="3_3_1_normal_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_9" name="dgfloor_3_weed" {{checkdata($l[0],$control[0]->dgfloor_weed)}}><label for="3_3_1_normal_9"></label></div></td>
                                                                <td rowspan="4" width="8%" style="vertical-align: top; font-size:10px;">
                                                                    <textarea rows="7" cols="5" id="3_3_1_normal_9" name="dgfloor_3_damage" class="form-control" placeholder="" > {{$control[0]->dgfloor_damage}} </textarea>
                                                                </td>
                                                                <td rowspan="4" width="8%">
                                                                    <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                        <tr>
                                                                            <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_1_normal_11_no" name="dgfloor_3_remake[no]" {{add($control[0]->dgfloor_remake->no)}}><label for="3_3_1_normal_11_no"></label></div></td>
                                                                            <td>ไม่มี</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_1_normal_11_nosee" name="dgfloor_3_remake[nosee]" {{add($control[0]->dgfloor_remake->nosee)}}><label for="3_3_1_normal_11_nosee"></label></div></td>
                                                                            <td>มองไม่เห็น</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td > อื่นๆ </td>
                                                                            <td><input id="weir_note_r331" name="dgfloor_3_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$control[0]->dgfloor_remake->detail}}"> </td>

                                                                        </tr>
                                                                        <tr><td>&nbsp;</td></tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <?php for($i=1 ; $i<4 ;$i++){?>
                                                              <tr>
                                                                  <td>{{$level[$i-1]}}</td>
                                                                  <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_{{$level2[$i-1]}}_1" name="dgfloor_3_erosion" {{checkdata($l[$i],$control[0]->dgfloor_erosion)}}><label for="3_3_1_{{$level2[$i-1]}}_1"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_{{$level2[$i-1]}}_2" name="dgfloor_3_subsidence" {{checkdata($l[$i],$control[0]->dgfloor_subsidence)}}><label for="3_3_1_{{$level2[$i-1]}}_2"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_{{$level2[$i-1]}}_3" name="dgfloor_3_cracking" {{checkdata($l[$i],$control[0]->dgfloor_cracking)}}><label for="3_3_1_{{$level2[$i-1]}}_3"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_{{$level2[$i-1]}}_4" name="dgfloor_3_obstruction" {{checkdata($l[$i],$control[0]->dgfloor_obstruction)}}><label for="3_3_1_{{$level2[$i-1]}}_4"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_{{$level2[$i-1]}}_5" name="dgfloor_3_hole" {{checkdata($l[$i],$control[0]->dgfloor_hole)}}><label for="3_3_1_{{$level2[$i-1]}}_5"></label> </div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_{{$level2[$i-1]}}_6" name="dgfloor_3_leak" {{checkdata($l[$i],$control[0]->dgfloor_leak)}}><label for="3_3_1_{{$level2[$i-1]}}_6"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_{{$level2[$i-1]}}_7" name="dgfloor_3_movement" {{checkdata($l[$i],$control[0]->dgfloor_movement)}}><label for="3_3_1_{{$level2[$i-1]}}_7"></label> </div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_{{$level2[$i-1]}}_8" name="dgfloor_3_drainage" {{checkdata($l[$i],$control[0]->dgfloor_drainage)}}><label for="3_3_1_{{$level2[$i-1]}}_8"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_{{$level2[$i-1]}}_9" name="dgfloor_3_weed" {{checkdata($l[$i],$control[0]->dgfloor_weed)}}><label for="3_3_1_{{$level2[$i-1]}}_9"></label></div></td>
                                                                  
                                                              </tr>
                                                            <?php } ?>
                                                        <!-- 3.3.2 -->
                                                            <tr>
                                                                <th id="text2" rowspan="4" style="vertical-align: top;">3.3.2 กำแพงข้าง</th> 
                                                                <td>ปกติ</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_1" name="dgwall_3_erosion" {{checkdata($l[0],$control[0]->dgwall_erosion)}}><label for="3_3_2_normal_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_2" name="dgwall_3_subsidence" {{checkdata($l[0],$control[0]->dgwall_subsidence)}}><label for="3_3_2_normal_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_3" name="dgwall_3_cracking" {{checkdata($l[0],$control[0]->dgwall_cracking)}}><label for="3_3_2_normal_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_4" name="dgwall_3_obstruction" {{checkdata($l[0],$control[0]->dgwall_obstruction)}}><label for="3_3_2_normal_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_5" name="dgwall_3_hole" {{checkdata($l[0],$control[0]->dgwall_hole)}}><label for="3_3_2_normal_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_6" name="dgwall_3_leak" {{checkdata($l[0],$control[0]->dgwall_leak)}}><label for="3_3_2_normal_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_7" name="dgwall_3_movement" {{checkdata($l[0],$control[0]->dgwall_movement)}}><label for="3_3_2_normal_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_8" name="dgwall_3_drainage" {{checkdata($l[0],$control[0]->dgwall_drainage)}}><label for="3_3_2_normal_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_9" name="dgwall_3_weed" {{checkdata($l[0],$control[0]->dgwall_weed)}}><label for="3_3_2_normal_9"></label></div></td>
                                                                <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                    <textarea rows="7" cols="5" id="3_3_2_normal_9" name="dgwall_3_damage" class="form-control" placeholder="" > {{$control[0]->dgwall_damage}} </textarea>
                                                                </td>
                                                                <td rowspan="4" width="8%">
                                                                    <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                        <tr>
                                                                            <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_2_normal_11_no" name="dgwall_3_remake[no]" {{add($control[0]->dgwall_remake->no)}}><label for="3_3_2_normal_11_no"></label></div></td>
                                                                            <td>ไม่มี</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_1_normal_11_nosee" name="dgwall_3_remake[nosee]" {{add($control[0]->dgwall_remake->nosee)}}><label for="3_3_1_normal_11_nosee"></label></div></td>
                                                                            <td>มองไม่เห็น</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td > อื่นๆ </td>
                                                                            <td><input id="weir_note_r332" name="dgwall_3_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$control[0]->dgwall_remake->detail}}"> </td>

                                                                        </tr>
                                                                        <tr><td>&nbsp;</td></tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <?php for($i=1 ; $i<4 ;$i++){?>
                                                              <tr>
                                                                  <td>{{$level[$i-1]}}</td>
                                                                  <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_{{$level2[$i-1]}}_1" name="dgwall_3_erosion" {{checkdata($l[$i],$control[0]->dgwall_erosion)}}><label for="3_3_2_{{$level2[$i-1]}}_1"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_{{$level2[$i-1]}}_2" name="dgwall_3_subsidence" {{checkdata($l[$i],$control[0]->dgwall_subsidence)}}><label for="3_3_2_{{$level2[$i-1]}}_2"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_{{$level2[$i-1]}}_3" name="dgwall_3_cracking" {{checkdata($l[$i],$control[0]->dgwall_cracking)}}><label for="3_3_2_{{$level2[$i-1]}}_3"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_{{$level2[$i-1]}}_4" name="dgwall_3_obstruction" {{checkdata($l[$i],$control[0]->dgwall_obstruction)}}><label for="3_3_2_{{$level2[$i-1]}}_4"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_{{$level2[$i-1]}}_5" name="dgwall_3_hole" {{checkdata($l[$i],$control[0]->dgwall_hole)}}><label for="3_3_2_{{$level2[$i-1]}}_5"></label> </div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_{{$level2[$i-1]}}_6" name="dgwall_3_leak" {{checkdata($l[$i],$control[0]->dgwall_leak)}}><label for="3_3_2_{{$level2[$i-1]}}_6"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_{{$level2[$i-1]}}_7" name="dgwall_3_movement" {{checkdata($l[$i],$control[0]->dgwall_movement)}}><label for="3_3_2_{{$level2[$i-1]}}_7"></label> </div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_{{$level2[$i-1]}}_8" name="dgwall_3_drainage" {{checkdata($l[$i],$control[0]->dgwall_drainage)}}><label for="3_3_2_{{$level2[$i-1]}}_8"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_{{$level2[$i-1]}}_9" name="dgwall_3_weed" {{checkdata($l[$i],$control[0]->dgwall_weed)}}><label for="3_3_2_{{$level2[$i-1]}}_9"></label></div></td>
                                                                  
                                                              </tr>
                                                            <?php } ?>
                                                            
                                                        <!-- 3.3.3 -->
                                                            <tr>
                                                                <th id="text2" rowspan="4" style="vertical-align: top;">3.3.3 ประตูระบายน้ำ<br>เฉพาะตัวบาน</th> 
                                                                <td>ปกติ</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_1" name="dggate_3_erosion" {{checkdata($l[0],$control[0]->dggate_erosion)}}><label for="3_3_3_normal_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_2" name="dggate_3_subsidence" {{checkdata($l[0],$control[0]->dggate_subsidence)}}><label for="3_3_3_normal_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_3" name="dggate_3_cracking" {{checkdata($l[0],$control[0]->dggate_cracking)}}><label for="3_3_3_normal_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_4" name="dggate_3_obstruction" {{checkdata($l[0],$control[0]->dggate_obstruction)}}><label for="3_3_3_normal_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_5" name="dggate_3_hole" {{checkdata($l[0],$control[0]->dggate_hole)}}><label for="3_3_3_normal_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_6" name="dggate_3_leak" {{checkdata($l[0],$control[0]->dggate_leak)}}><label for="3_3_3_normal_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_7" name="dggate_3_movement" {{checkdata($l[0],$control[0]->dggate_movement)}}><label for="3_3_3_normal_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_8" name="dggate_3_drainage" {{checkdata($l[0],$control[0]->dggate_drainage)}}><label for="3_3_3_normal_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_9" name="dggate_3_weed" {{checkdata($l[0],$control[0]->dggate_weed)}}><label for="3_3_3_normal_9"></label></div></td>
                                                                <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                    <textarea rows="7" cols="5" id="3_3_3_normal_9" name="dggate_3_damage" class="form-control" placeholder="" >{{$control[0]->dggate_damage}}</textarea>
                                                                </td>
                                                                <td rowspan="4" width="8%">
                                                                    <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                        <tr>
                                                                            <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_3_normal_11_no" name="dggate_3_remake[no]" {{add($control[0]->dggate_remake->no)}}><label for="3_3_3_normal_11_no"></label></div></td>
                                                                            <td>ไม่มี</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_1_normal_11_nosee" name="dggate_3_remake[nosee]" {{add($control[0]->dggate_remake->nosee)}}><label for="3_3_1_normal_11_nosee"></label></div></td>
                                                                            <td>มองไม่เห็น</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td > อื่นๆ </td>
                                                                            <td><input id="weir_note_r333" name="dggate_3_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$control[0]->dggate_remake->detail}}"> </td>

                                                                        </tr>
                                                                        <tr><td>&nbsp;</td></tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <?php for($i=1 ; $i<4 ;$i++){?>
                                                              <tr>
                                                                  <td>{{$level[$i-1]}}</td>
                                                                  <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_{{$level2[$i-1]}}_1" name="dggate_3_erosion" {{checkdata($l[$i],$control[0]->dggate_erosion)}}><label for="3_3_3_{{$level2[$i-1]}}_1"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_{{$level2[$i-1]}}_2" name="dggate_3_subsidence" {{checkdata($l[$i],$control[0]->dggate_subsidence)}}><label for="3_3_3_{{$level2[$i-1]}}_2"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_{{$level2[$i-1]}}_3" name="dggate_3_cracking" {{checkdata($l[$i],$control[0]->dggate_cracking)}}><label for="3_3_3_{{$level2[$i-1]}}_3"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_{{$level2[$i-1]}}_4" name="dggate_3_obstruction" {{checkdata($l[$i],$control[0]->dggate_obstruction)}}><label for="3_3_3_{{$level2[$i-1]}}_4"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_{{$level2[$i-1]}}_5" name="dggate_3_hole" {{checkdata($l[$i],$control[0]->dggate_hole)}}><label for="3_3_3_{{$level2[$i-1]}}_5"></label> </div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_{{$level2[$i-1]}}_6" name="dggate_3_leak" {{checkdata($l[$i],$control[0]->dggate_leak)}}><label for="3_3_3_{{$level2[$i-1]}}_6"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_{{$level2[$i-1]}}_7" name="dggate_3_movement" {{checkdata($l[$i],$control[0]->dggate_movement)}}><label for="3_3_3_{{$level2[$i-1]}}_7"></label> </div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_{{$level2[$i-1]}}_8" name="dggate_3_drainage" {{checkdata($l[$i],$control[0]->dggate_drainage)}}><label for="3_3_3_{{$level2[$i-1]}}_8"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_{{$level2[$i-1]}}_9" name="dggate_3_weed" {{checkdata($l[$i],$control[0]->dggate_weed)}}><label for="3_3_3_{{$level2[$i-1]}}_9"></label></div></td>
                                                              </tr>
                                                            <?php } ?>
                                                        <!-- 3.3.4 -->
                                                            <tr>
                                                                <th id="text2" rowspan="4" style="vertical-align: top;">3.3.4 ประตูระบายน้ำ <br> เคลื่องกล/อุปกรณ์</th> 
                                                                <td>ปกติ</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_1" name="dgmachanic_3_erosion" {{checkdata($l[0],$control[0]->dgmachanic_erosion)}}><label for="3_3_4_normal_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_2" name="dgmachanic_3_subsidence" {{checkdata($l[0],$control[0]->dgmachanic_subsidence)}}><label for="3_3_4_normal_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_3" name="dgmachanic_3_cracking" {{checkdata($l[0],$control[0]->dgmachanic_cracking)}}><label for="3_3_4_normal_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_4" name="dgmachanic_3_obstruction" {{checkdata($l[0],$control[0]->dgmachanic_obstruction)}}><label for="3_3_4_normal_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_5" name="dgmachanic_3_hole" {{checkdata($l[0],$control[0]->dgmachanic_hole)}}><label for="3_3_4_normal_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_6" name="dgmachanic_3_leak" {{checkdata($l[0],$control[0]->dgmachanic_leak)}}><label for="3_3_4_normal_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_7" name="dgmachanic_3_movement" {{checkdata($l[0],$control[0]->dgmachanic_movement)}}><label for="3_3_4_normal_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_8" name="dgmachanic_3_drainage" {{checkdata($l[0],$control[0]->dgmachanic_drainage)}}><label for="3_3_4_normal_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_9" name="dgmachanic_3_weed" {{checkdata($l[0],$control[0]->dgmachanic_weed)}}><label for="3_3_4_normal_9"></label></div></td>
                                                                <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                    <textarea rows="7" cols="5" id="3_3_4_normal_9" name="dgmachanic_3_damage" class="form-control" placeholder="">{{$control[0]->dgmachanic_damage}}</textarea>
                                                                </td>
                                                                <td rowspan="4" width="8%">
                                                                    <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                        <tr>
                                                                            <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_4_normal_11_no" name="dgmachanic_3_remake[no]" {{add($control[0]->dgmachanic_remake->no)}}><label for="3_3_4_normal_11_no"></label></div></td>
                                                                            <td>ไม่มี</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_4_normal_11_nosee" name="dgmachanic_3_remake[nosee]" {{add($control[0]->dgmachanic_remake->nosee)}}><label for="3_3_4_normal_11_nosee"></label></div></td>
                                                                            <td>มองไม่เห็น</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td > อื่นๆ </td>
                                                                            <td><input id="weir_note_r334" name="dgmachanic_3_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$control[0]->dgmachanic_remake->detail}}"> </td>

                                                                        </tr>
                                                                        <tr><td>&nbsp;</td></tr>
                                                                    </table>
                                                                </td>
                                                            </tr>

                                                            <?php for($i=1 ; $i<4 ;$i++){?>
                                                              <tr>
                                                                  <td>{{$level[$i-1]}}</td>
                                                                  <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_{{$level2[$i-1]}}_1" name="dgmachanic_3_erosion" {{checkdata($l[$i],$control[0]->dgmachanic_erosion)}}><label for="3_3_4_{{$level2[$i-1]}}_1"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_{{$level2[$i-1]}}_2" name="dgmachanic_3_subsidence" {{checkdata($l[$i],$control[0]->dgmachanic_subsidence)}}><label for="3_3_4_{{$level2[$i-1]}}_2"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_{{$level2[$i-1]}}_3" name="dgmachanic_3_cracking" {{checkdata($l[$i],$control[0]->dgmachanic_cracking)}}><label for="3_3_4_{{$level2[$i-1]}}_3"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_{{$level2[$i-1]}}_4" name="dgmachanic_3_obstruction" {{checkdata($l[$i],$control[0]->dgmachanic_obstruction)}}><label for="3_3_4_{{$level2[$i-1]}}_4"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_{{$level2[$i-1]}}_5" name="dgmachanic_3_hole" {{checkdata($l[$i],$control[0]->dgmachanic_hole)}}><label for="3_3_4_{{$level2[$i-1]}}_5"></label> </div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_{{$level2[$i-1]}}_6" name="dgmachanic_3_leak" {{checkdata($l[$i],$control[0]->dgmachanic_leak)}}><label for="3_3_4_{{$level2[$i-1]}}_6"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_{{$level2[$i-1]}}_7" name="dgmachanic_3_movement" {{checkdata($l[$i],$control[0]->dgmachanic_movement)}}><label for="3_3_4_{{$level2[$i-1]}}_7"></label> </div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_{{$level2[$i-1]}}_8" name="dgmachanic_3_drainage" {{checkdata($l[$i],$control[0]->dgmachanic_drainage)}}><label for="3_3_4_{{$level2[$i-1]}}_8"></label></div></td>
                                                                  <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_{{$level2[$i-1]}}_9" name="dgmachanic_3_weed" {{checkdata($l[$i],$control[0]->dgmachanic_weed)}}><label for="3_3_4_{{$level2[$i-1]}}_9"></label></div></td>
                                                                  
                                                              </tr>
                                                            <?php } ?>
                                                        <!-- 3.3.5 -->
                                                            <tr>
                                                                <th id="text2" rowspan="4" style="vertical-align: top;">3.3.5 ท่อนกันน้ำและ<br>ร่องบาน</th> 
                                                                <td>ปกติ</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_1" name="dgblock_3_erosion" {{checkdata($l[0],$control[0]->dgblock_erosion)}}><label for="3_3_5_normal_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_2" name="dgblock_3_subsidence" {{checkdata($l[0],$control[0]->dgblock_subsidence)}}><label for="3_3_5_normal_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_3" name="dgblock_3_cracking" {{checkdata($l[0],$control[0]->dgblock_cracking)}}><label for="3_3_5_normal_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_4" name="dgblock_3_obstruction" {{checkdata($l[0],$control[0]->dgblock_obstruction)}}><label for="3_3_5_normal_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_5" name="dgblock_3_hole" {{checkdata($l[0],$control[0]->dgblock_hole)}}><label for="3_3_5_normal_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_6" name="dgblock_3_leak" {{checkdata($l[0],$control[0]->dgblock_leak)}}><label for="3_3_5_normal_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_7" name="dgblock_3_movement" {{checkdata($l[0],$control[0]->dgblock_movement)}}><label for="3_3_5_normal_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_8" name="dgblock_3_drainage" {{checkdata($l[0],$control[0]->dgblock_drainage)}}><label for="3_3_5_normal_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_9" name="dgblock_3_weed" {{checkdata($l[0],$control[0]->dgblock_weed)}}><label for="3_3_5_normal_9"></label></div></td>
                                                                <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                    <textarea rows="7" cols="5" id="3_3_5_normal_9" name="dgblock_3_damage" class="form-control" placeholder="" > {{$control[0]->dgblock_damage}} </textarea>
                                                                </td>
                                                                <td rowspan="4" width="8%">
                                                                    <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                        <tr>
                                                                            <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_5_normal_11_no" name="dgblock_3_remake[no]" {{add($control[0]->dgblock_remake->no)}}><label for="3_3_5_normal_11_no"></label></div></td>
                                                                            <td>ไม่มี</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_1_normal_11_nosee" name="dgblock_3_remake[nosee]" {{add($control[0]->dgblock_remake->nosee)}}><label for="3_3_1_normal_11_nosee"></label></div></td>
                                                                            <td>มองไม่เห็น</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td > อื่นๆ </td>
                                                                            <td><input id="weir_note_r335" name="dgblock_3_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$control[0]->dgblock_remake->detail}}"> </td>

                                                                        </tr>
                                                                        <tr><td>&nbsp;</td></tr>
                                                                    </table>
                                                                </td>
                                                            </tr>

                                                            <?php for($i=1 ; $i<4 ;$i++){?>
                                                              <tr>
                                                                <td>{{$level[$i-1]}}</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_{{$level2[$i-1]}}_1" name="dgblock_3_erosion" {{checkdata($l[$i],$control[0]->dgblock_erosion)}}><label for="3_3_5_{{$level2[$i-1]}}_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_{{$level2[$i-1]}}_2" name="dgblock_3_subsidence" {{checkdata($l[$i],$control[0]->dgblock_subsidence)}}><label for="3_3_5_{{$level2[$i-1]}}_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_{{$level2[$i-1]}}_3" name="dgblock_3_cracking" {{checkdata($l[$i],$control[0]->dgblock_cracking)}}><label for="3_3_5_{{$level2[$i-1]}}_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_{{$level2[$i-1]}}_4" name="dgblock_3_obstruction" {{checkdata($l[$i],$control[0]->dgblock_obstruction)}}><label for="3_3_5_{{$level2[$i-1]}}_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_{{$level2[$i-1]}}_5" name="dgblock_3_hole" {{checkdata($l[$i],$control[0]->dgblock_hole)}}><label for="3_3_5_{{$level2[$i-1]}}_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_{{$level2[$i-1]}}_6" name="dgblock_3_leak" {{checkdata($l[$i],$control[0]->dgblock_leak)}}><label for="3_3_5_{{$level2[$i-1]}}_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_{{$level2[$i-1]}}_7" name="dgblock_3_movement" {{checkdata($l[$i],$control[0]->dgblock_movement)}}><label for="3_3_5_{{$level2[$i-1]}}_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_{{$level2[$i-1]}}_8" name="dgblock_3_drainage" {{checkdata($l[$i],$control[0]->dgblock_drainage)}}><label for="3_3_5_{{$level2[$i-1]}}_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_{{$level2[$i-1]}}_9" name="dgblock_3_weed" {{checkdata($l[$i],$control[0]->dgblock_weed)}}><label for="3_3_5_{{$level2[$i-1]}}_9"></label></div></td>
                                                                
                                                              </tr>
                                                            <?php } ?>
                                                      <!-- 3.4 -->
                                                        <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">3.4 แท่งสลายพลัง<br>งานน้ำปลายรางเท</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_1" name="waterbreak_3_erosion" {{checkdata($l[0],$control[0]->waterbreak_erosion)}}><label for="3_4_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_2" name="waterbreak_3_subsidence" {{checkdata($l[0],$control[0]->waterbreak_subsidence)}}><label for="3_4_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_3" name="waterbreak_3_cracking" {{checkdata($l[0],$control[0]->waterbreak_cracking)}}><label for="3_4_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_4" name="waterbreak_3_obstruction" {{checkdata($l[0],$control[0]->waterbreak_obstruction)}}><label for="3_4_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_5" name="waterbreak_3_hole" {{checkdata($l[0],$control[0]->waterbreak_hole)}}><label for="3_4_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_6" name="waterbreak_3_leak" {{checkdata($l[0],$control[0]->waterbreak_leak)}}><label for="3_4_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_7" name="waterbreak_3_movement" {{checkdata($l[0],$control[0]->waterbreak_movement)}}><label for="3_4_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_8" name="waterbreak_3_drainage" {{checkdata($l[0],$control[0]->waterbreak_drainage)}}><label for="3_4_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_9" name="waterbreak_3_weed" {{checkdata($l[0],$control[0]->waterbreak_weed)}}><label for="3_4_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="3_4_normal_9" name="waterbreak_3_damage" class="form-control" placeholder=""> {{$control[0]->waterbreak_damage}} </textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_4_normal_11_no" name="waterbreak_3_remake[no]" {{add($control[0]->waterbreak_remake->no)}}><label for="3_4_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_4_normal_11_nosee" name="waterbreak_3_remake[nosee]" {{add($control[0]->waterbreak_remake->nosee)}}><label for="3_4_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r34" name="waterbreak_3_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$control[0]->waterbreak_remake->detail}}"> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <?php for($i=1 ; $i<4 ;$i++){?>
                                                          <tr>
                                                            <td>{{$level[$i-1]}}</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_{{$level2[$i-1]}}_1" name="waterbreak_3_erosion" {{checkdata($l[$i],$control[0]->waterbreak_erosion)}}><label for="3_4_{{$level2[$i-1]}}_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_{{$level2[$i-1]}}_2" name="waterbreak_3_subsidence" {{checkdata($l[$i],$control[0]->waterbreak_subsidence)}}><label for="3_4_{{$level2[$i-1]}}_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_{{$level2[$i-1]}}_3" name="waterbreak_3_cracking" {{checkdata($l[$i],$control[0]->waterbreak_cracking)}}><label for="3_4_{{$level2[$i-1]}}_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_{{$level2[$i-1]}}_4" name="waterbreak_3_obstruction" {{checkdata($l[$i],$control[0]->waterbreak_obstruction)}}><label for="3_4_{{$level2[$i-1]}}_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_{{$level2[$i-1]}}_5" name="waterbreak_3_hole" {{checkdata($l[$i],$control[0]->waterbreak_hole)}}><label for="3_4_{{$level2[$i-1]}}_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_{{$level2[$i-1]}}_6" name="waterbreak_3_leak" {{checkdata($l[$i],$control[0]->waterbreak_leak)}}><label for="3_4_{{$level2[$i-1]}}_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_{{$level2[$i-1]}}_7" name="waterbreak_3_movement" {{checkdata($l[$i],$control[0]->waterbreak_movement)}}><label for="3_4_{{$level2[$i-1]}}_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_{{$level2[$i-1]}}_8" name="waterbreak_3_drainage" {{checkdata($l[$i],$control[0]->waterbreak_drainage)}}><label for="3_4_{{$level2[$i-1]}}_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_{{$level2[$i-1]}}_9" name="waterbreak_3_weed" {{checkdata($l[$i],$control[0]->waterbreak_weed)}}><label for="3_4_{{$level2[$i-1]}}_9"></label></div></td>
                                                          </tr>
                                                        <?php } ?>
                                                      

                                                      <!-- 3.5 -->
                                                        <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">3.5 สะพาน</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_1" name="bridge_3_erosion" {{checkdata($l[0],$control[0]->bridge_erosion)}}><label for="3_5_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_2" name="bridge_3_subsidence" {{checkdata($l[0],$control[0]->bridge_subsidence)}}><label for="3_5_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_3" name="bridge_3_cracking" {{checkdata($l[0],$control[0]->bridge_cracking)}}><label for="3_5_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_4" name="bridge_3_obstruction" {{checkdata($l[0],$control[0]->bridge_obstruction)}}><label for="3_5_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_5" name="bridge_3_hole" {{checkdata($l[0],$control[0]->bridge_hole)}}><label for="3_5_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_6" name="bridge_3_leak" {{checkdata($l[0],$control[0]->bridge_leak)}}><label for="3_5_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_7" name="bridge_3_movement" {{checkdata($l[0],$control[0]->bridge_movement)}}><label for="3_5_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_8" name="bridge_3_drainage" {{checkdata($l[0],$control[0]->bridge_drainage)}}><label for="3_5_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_9" name="bridge_3_weed" {{checkdata($l[0],$control[0]->bridge_weed)}}><label for="3_5_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="3_5_normal_9" name="bridge_3_damage" class="form-control" placeholder="" > {{$control[0]->bridge_damage}} </textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_5_normal_11_no" name="bridge_3_remake[no]" {{add($control[0]->bridge_remake->no)}}><label for="3_5_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_5_normal_11_nosee" name="bridge_3_remake[nosee]" {{add($control[0]->bridge_remake->nosee)}}><label for="3_5_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r3" name="bridge_3_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$control[0]->bridge_remake->detail}}"> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <?php for($i=1 ; $i<4 ;$i++){?>
                                                          <tr>
                                                            <td>{{$level[$i-1]}}</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_{{$level2[$i-1]}}_1" name="bridge_3_erosion" {{checkdata($l[$i],$control[0]->bridge_erosion)}}><label for="3_5_{{$level2[$i-1]}}_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_{{$level2[$i-1]}}_2" name="bridge_3_subsidence" {{checkdata($l[$i],$control[0]->bridge_subsidence)}}><label for="3_5_{{$level2[$i-1]}}_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_{{$level2[$i-1]}}_3" name="bridge_3_cracking" {{checkdata($l[$i],$control[0]->bridge_cracking)}}><label for="3_5_{{$level2[$i-1]}}_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_{{$level2[$i-1]}}_4" name="bridge_3_obstruction" {{checkdata($l[$i],$control[0]->bridge_obstruction)}}><label for="3_5_{{$level2[$i-1]}}_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_{{$level2[$i-1]}}_5" name="bridge_3_hole" {{checkdata($l[$i],$control[0]->bridge_hole)}}><label for="3_5_{{$level2[$i-1]}}_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_{{$level2[$i-1]}}_6" name="bridge_3_leak" {{checkdata($l[$i],$control[0]->bridge_leak)}}><label for="3_5_{{$level2[$i-1]}}_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_{{$level2[$i-1]}}_7" name="bridge_3_movement" {{checkdata($l[$i],$control[0]->bridge_movement)}}><label for="3_5_{{$level2[$i-1]}}_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_{{$level2[$i-1]}}_8" name="bridge_3_drainage" {{checkdata($l[$i],$control[0]->bridge_drainage)}}><label for="3_5_{{$level2[$i-1]}}_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_{{$level2[$i-1]}}_9" name="bridge_3_weed" {{checkdata($l[$i],$control[0]->bridge_weed)}}><label for="3_5_{{$level2[$i-1]}}_9"></label></div></td>
                                                          </tr>
                                                        <?php } ?>
                                                


                                                    <!-- 4 -->
                                                      <tr> 
                                                        <th colspan="13" id="text1">4. ส่วนท้ายน้ำ (Downstream Concrete Section) </th>
                                                      </tr>
                                                      <!-- 4.1 -->
                                                        <tr>
                                                            <th id="text2">4.1 พื้น (floor)</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_1" name="floor_4_erosion" {{checkdata($l[0],$downconcrete[0]->floor_erosion)}}><label for="4_1_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_2" name="floor_4_subsidence" {{checkdata($l[0],$downconcrete[0]->floor_subsidence)}}><label for="4_1_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_3" name="floor_4_cracking" {{checkdata($l[0],$downconcrete[0]->floor_cracking)}}><label for="4_1_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_4" name="floor_4_obstruction" {{checkdata($l[0],$downconcrete[0]->floor_obstruction)}}><label for="4_1_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_5" name="floor_4_hole" {{checkdata($l[0],$downconcrete[0]->floor_hole)}}><label for="4_1_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_6" name="floor_4_leak" {{checkdata($l[0],$downconcrete[0]->floor_leak)}}><label for="4_1_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_7" name="floor_4_movement" {{checkdata($l[0],$downconcrete[0]->floor_movement)}}><label for="4_1_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_8" name="floor_4_drainage" {{checkdata($l[0],$downconcrete[0]->floor_drainage)}}><label for="4_1_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_9" name="floor_4_weed" {{checkdata($l[0],$downconcrete[0]->floor_weed)}}><label for="4_1_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="4_1_normal_9" name="floor_4_damage" class="form-control" placeholder="" > {{$downconcrete[0]->floor_damage}} </textarea>
                                                            </td>
                                                            <td rowspan="4" width="10%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_1_normal_11_no" name="floor_4_remake[no]" {{add($downconcrete[0]->floor_remake->no)}}><label for="4_1_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_1_normal_11_nosee" name="floor_4_remake[nosee]" {{add($downconcrete[0]->floor_remake->nosee)}}><label for="4_1_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r41" name="floor_4_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$downconcrete[0]->floor_remake->detail}}"> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td id="text2">ตะกอน</td> 
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_1"name="floor_4_erosion" {{checkdata($l[1],$downconcrete[0]->floor_erosion)}}><label for="4_1_less_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_2" name="floor_4_subsidence" {{checkdata($l[1],$downconcrete[0]->floor_subsidence)}}><label for="4_1_less_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_3" name="floor_4_cracking" {{checkdata($l[1],$downconcrete[0]->floor_cracking)}}><label for="4_1_less_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_4" name="floor_4_obstruction" {{checkdata($l[1],$downconcrete[0]->floor_obstruction)}}><label for="4_1_less_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_5" name="floor_4_hole" {{checkdata($l[1],$downconcrete[0]->floor_hole)}}><label for="4_1_less_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_6" name="floor_4_leak" {{checkdata($l[1],$downconcrete[0]->floor_leak)}}><label for="4_1_less_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_7" name="floor_4_movement" {{checkdata($l[1],$downconcrete[0]->floor_movement)}}><label for="4_1_less_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_8" name="floor_4_drainage" {{checkdata($l[1],$downconcrete[0]->floor_drainage)}}><label for="4_1_less_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_9" name="floor_4_weed" {{checkdata($l[1],$downconcrete[0]->floor_weed)}}><label for="4_1_less_9"></label></div></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table class="table2 table-borderless" id="text2"> 
                                                                    <tr>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_1_sed_n" name="check_floor_4" {{checkdata($l[0],$downconcrete[0]->check_floor)}}><label for="4_1_sed_n"></label></div></td>
                                                                        <td>ปกติ</td>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_1_sed_l" name="check_floor_4" {{checkdata($l[1],$downconcrete[0]->check_floor)}}><label for="4_1_sed_l"></label></div></td>
                                                                        <td>น้อย</td>
                                                                    </tr>
                                                                </table>
                                                            </td> 
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_1" name="floor_4_erosion" {{checkdata($l[2],$downconcrete[0]->floor_erosion)}}><label for="4_1_mid_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_2" name="floor_4_subsidence" {{checkdata($l[2],$downconcrete[0]->floor_subsidence)}}><label for="4_1_mid_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_3" name="floor_4_cracking" {{checkdata($l[2],$downconcrete[0]->floor_cracking)}}><label for="4_1_mid_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_4" name="floor_4_obstruction" {{checkdata($l[2],$downconcrete[0]->floor_obstruction)}}><label for="4_1_mid_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_5" name="floor_4_hole" {{checkdata($l[2],$downconcrete[0]->floor_hole)}}><label for="4_1_mid_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_6" name="floor_4_leak" {{checkdata($l[2],$downconcrete[0]->floor_leak)}}><label for="4_1_mid_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_7" name="floor_4_movement" {{checkdata($l[2],$downconcrete[0]->floor_movement)}}><label for="4_1_mid_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_8" name="floor_4_drainage" {{checkdata($l[2],$downconcrete[0]->floor_drainage)}}><label for="4_1_mid_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_9" name="floor_4_weed" {{checkdata($l[2],$downconcrete[0]->floor_weed)}}><label for="4_1_mid_9"></label></div></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table class="table2 table-borderless" id="text2"> 
                                                                    <tr>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_1_sed_md" name="check_floor_4" {{checkdata($l[2],$downconcrete[0]->check_floor)}}><label for="4_1_sed_md"></label></div></td>
                                                                        <td>กลาง</td>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_1_sed_m" name="check_floor_4" {{checkdata($l[3],$downconcrete[0]->check_floor)}}><label for="4_1_sed_m"></label></div></td>
                                                                        <td>มาก</td>
                                                                    </tr>
                                                                </table>
                                                            </td> 
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_1" name="floor_4_erosion" {{checkdata($l[3],$downconcrete[0]->floor_erosion)}}><label for="4_1_more_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_2" name="floor_4_subsidence" {{checkdata($l[3],$downconcrete[0]->floor_subsidence)}}><label for="4_1_more_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_3" name="floor_4_cracking" {{checkdata($l[3],$downconcrete[0]->floor_cracking)}}><label for="4_1_more_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_4" name="floor_4_obstruction" {{checkdata($l[3],$downconcrete[0]->floor_obstruction)}}><label for="4_1_more_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_5" name="floor_4_hole" {{checkdata($l[3],$downconcrete[0]->floor_hole)}}><label for="4_1_more_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_6" name="floor_4_leak" {{checkdata($l[3],$downconcrete[0]->floor_leak)}}><label for="4_1_more_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_7" name="floor_4_movement" {{checkdata($l[3],$downconcrete[0]->floor_movement)}}><label for="4_1_more_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_8" name="floor_4_drainage" {{checkdata($l[3],$downconcrete[0]->floor_drainage)}}><label for="4_1_more_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_9" name="floor_4_weed" {{checkdata($l[3],$downconcrete[0]->floor_weed)}}><label for="4_1_more_9"></label></div></td>
                                                                      
                                                        </tr>
                                                      <!-- 4.2 -->
                                                        <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">4.2 ลาดด้านข้าง</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_1" name="side_4_erosion" {{checkdata($l[0],$downconcrete[0]->side_erosion)}}><label for="4_2_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_2" name="side_4_subsidence" {{checkdata($l[0],$downconcrete[0]->side_subsidence)}}><label for="4_2_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_3" name="side_4_cracking" {{checkdata($l[0],$downconcrete[0]->side_cracking)}}><label for="4_2_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_4" name="side_4_obstruction" {{checkdata($l[0],$downconcrete[0]->side_obstruction)}}><label for="4_2_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_5" name="side_4_hole" {{checkdata($l[0],$downconcrete[0]->side_hole)}}><label for="4_2_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_6" name="side_4_leak" {{checkdata($l[0],$downconcrete[0]->side_leak)}}><label for="4_2_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_7" name="side_4_movement" {{checkdata($l[0],$downconcrete[0]->side_movement)}}><label for="4_2_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_8" name="side_4_drainage" {{checkdata($l[0],$downconcrete[0]->side_drainage)}}><label for="4_2_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_9" name="side_4_weed" {{checkdata($l[0],$downconcrete[0]->side_weed)}}><label for="4_2_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="4_2_normal_9" name="side_4_damage" class="form-control" placeholder="" > {{$downconcrete[0]->side_damage}} </textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_2_normal_11_no" name="side_4_remake[check]" {{add($downconcrete[0]->side_remake->no)}}><label for="4_2_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_2_normal_11_nosee" name="side_4_remake[check]" {{add($downconcrete[0]->side_remake->nosee)}}><label for="4_2_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r42" name="side_4_remake[check][detail]" type="text" class=" form-control" placeholder="" value="{{$downconcrete[0]->side_remake->detail}}"> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <?php for($i=1 ; $i<4 ;$i++){?>
                                                          <tr>
                                                            <td>{{$level[$i-1]}}</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_{{$level2[$i-1]}}_1" name="side_4_erosion" {{checkdata($l[$i],$downconcrete[0]->side_erosion)}}><label for="4_2_{{$level2[$i-1]}}_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_{{$level2[$i-1]}}_2" name="side_4_subsidence" {{checkdata($l[$i],$downconcrete[0]->side_subsidence)}}><label for="4_2_{{$level2[$i-1]}}_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_{{$level2[$i-1]}}_3" name="side_4_cracking" {{checkdata($l[$i],$downconcrete[0]->side_cracking)}}><label for="4_2_{{$level2[$i-1]}}_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_{{$level2[$i-1]}}_4" name="side_4_obstruction" {{checkdata($l[$i],$downconcrete[0]->side_obstruction)}}><label for="4_2_{{$level2[$i-1]}}_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_{{$level2[$i-1]}}_5" name="side_4_hole" {{checkdata($l[$i],$downconcrete[0]->side_hole)}}><label for="4_2_{{$level2[$i-1]}}_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_{{$level2[$i-1]}}_6" name="side_4_leak" {{checkdata($l[$i],$downconcrete[0]->side_leak)}}><label for="4_2_{{$level2[$i-1]}}_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_{{$level2[$i-1]}}_7" name="side_4_movement" {{checkdata($l[$i],$downconcrete[0]->side_movement)}}><label for="4_2_{{$level2[$i-1]}}_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_{{$level2[$i-1]}}_8" name="side_4_drainage" {{checkdata($l[$i],$downconcrete[0]->side_drainage)}}><label for="4_2_{{$level2[$i-1]}}_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_{{$level2[$i-1]}}_9" name="side_4_weed" {{checkdata($l[$i],$downconcrete[0]->side_weed)}}><label for="4_2_{{$level2[$i-1]}}_9"></label></div></td>
                                                            
                                                          </tr>
                                                        <?php } ?>

                                                    

                                                      <!-- 4.3 -->
                                                        <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">4.3 ฟันตะเข้</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_1" name="flrblock_4_erosion" {{checkdata($l[0],$downconcrete[0]->flrblock_erosion)}}><label for="4_3_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_2" name="flrblock_4_subsidence" {{checkdata($l[0],$downconcrete[0]->flrblock_subsidence)}}><label for="4_3_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_3" name="flrblock_4_cracking" {{checkdata($l[0],$downconcrete[0]->flrblock_cracking)}}><label for="4_3_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_4" name="flrblock_4_obstruction" {{checkdata($l[0],$downconcrete[0]->flrblock_obstruction)}}><label for="4_3_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_5" name="flrblock_4_hole" {{checkdata($l[0],$downconcrete[0]->flrblock_hole)}}><label for="4_3_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_6" name="flrblock_4_leak" {{checkdata($l[0],$downconcrete[0]->flrblock_leak)}}><label for="4_3_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_7" name="flrblock_4_movement" {{checkdata($l[0],$downconcrete[0]->flrblock_movement)}}><label for="4_3_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_8" name="flrblock_4_drainage" {{checkdata($l[0],$downconcrete[0]->flrblock_drainage)}}><label for="4_3_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_9" name="flrblock_4_weed" {{checkdata($l[0],$downconcrete[0]->flrblock_weed)}}><label for="4_3_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="4_3_normal_9" name="flrblock_4_damage" class="form-control" placeholder="" > {{$downconcrete[0]->flrblock_damage}} </textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_3_normal_11_no" name="flrblock_4_remake[no]" {{add($downconcrete[0]->flrblock_remake->no)}}><label for="4_3_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_3_normal_11_nosee" name="flrblock_4_remake[nosee]" {{add($downconcrete[0]->flrblock_remake->nosee)}}><label for="4_3_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r43" name="flrblock_4_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$downconcrete[0]->flrblock_remake->detail}}"> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <?php for($i=1 ; $i<4 ;$i++){?>
                                                          <tr>
                                                            <td>{{$level[$i-1]}}</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_{{$level2[$i-1]}}_1" name="flrblock_4_erosion" {{checkdata($l[$i],$downconcrete[0]->flrblock_erosion)}}><label for="4_3_{{$level2[$i-1]}}_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_{{$level2[$i-1]}}_2" name="flrblock_4_subsidence" {{checkdata($l[$i],$downconcrete[0]->flrblock_subsidence)}}><label for="4_3_{{$level2[$i-1]}}_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_{{$level2[$i-1]}}_3" name="flrblock_4_cracking" {{checkdata($l[$i],$downconcrete[0]->flrblock_cracking)}}><label for="4_3_{{$level2[$i-1]}}_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_{{$level2[$i-1]}}_4" name="flrblock_4_obstruction" {{checkdata($l[$i],$downconcrete[0]->flrblock_obstruction)}}><label for="4_3_{{$level2[$i-1]}}_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_{{$level2[$i-1]}}_5" name="flrblock_4_hole" {{checkdata($l[$i],$downconcrete[0]->flrblock_hole)}}><label for="4_3_{{$level2[$i-1]}}_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_{{$level2[$i-1]}}_6" name="flrblock_4_leak" {{checkdata($l[$i],$downconcrete[0]->flrblock_leak)}}><label for="4_3_{{$level2[$i-1]}}_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_{{$level2[$i-1]}}_7" name="flrblock_4_movement" {{checkdata($l[$i],$downconcrete[0]->flrblock_movement)}}><label for="4_3_{{$level2[$i-1]}}_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_{{$level2[$i-1]}}_8" name="flrblock_4_drainage" {{checkdata($l[$i],$downconcrete[0]->flrblock_drainage)}}><label for="4_3_{{$level2[$i-1]}}_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_{{$level2[$i-1]}}_9" name="flrblock_4_weed" {{checkdata($l[$i],$downconcrete[0]->flrblock_weed)}}><label for="4_3_{{$level2[$i-1]}}_9"></label></div></td>
                                                          </tr>
                                                        <?php } ?>
                                                        
                                                      <!-- 4.4 -->
                                                        <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">4.4 แผงปะทะด้านท้ายน้ำ</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_1" name="endsill_4_erosion" {{checkdata($l[0],$downconcrete[0]->endsill_erosion)}}><label for="4_4_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_2" name="endsill_4_subsidence" {{checkdata($l[0],$downconcrete[0]->endsill_subsidence)}}><label for="4_4_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_3" name="endsill_4_cracking" {{checkdata($l[0],$downconcrete[0]->endsill_cracking)}}><label for="4_4_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_4" name="endsill_4_obstruction" {{checkdata($l[0],$downconcrete[0]->endsill_obstruction)}}><label for="4_4_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_5" name="endsill_4_hole" {{checkdata($l[0],$downconcrete[0]->endsill_hole)}}><label for="4_4_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_6" name="endsill_4_leak" {{checkdata($l[0],$downconcrete[0]->endsill_leak)}}><label for="4_4_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_7" name="endsill_4_movement" {{checkdata($l[0],$downconcrete[0]->endsill_movement)}}><label for="4_4_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_8" name="endsill_4_drainage" {{checkdata($l[0],$downconcrete[0]->endsill_drainage)}}><label for="4_4_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_9" name="endsill_4_weed" {{checkdata($l[0],$downconcrete[0]->endsill_weed)}}><label for="4_4_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="4_4_normal_9" name="endsill_4_damage" class="form-control" placeholder="" > {{$downconcrete[0]->endsill_damage}} </textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_4_normal_11_no" name="endsill_4_remake[no]" {{add($downconcrete[0]->endsill_remake->no)}}><label for="4_4_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_4_normal_11_nosee" name="endsill_4_remake[nosee]" {{add($downconcrete[0]->endsill_remake->nosee)}}><label for="4_4_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r44" name="endsill_4_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$downconcrete[0]->endsill_remake->detail}}"> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <?php for($i=1 ; $i<4 ;$i++){?>
                                                          <tr>
                                                            <td>{{$level[$i-1]}}</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_{{$level2[$i-1]}}_1" name="endsill_4_erosion" {{checkdata($l[$i],$downconcrete[0]->flrblock_erosion)}}><label for="4_4_{{$level2[$i-1]}}_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_{{$level2[$i-1]}}_2" name="endsill_4_subsidence" {{checkdata($l[$i],$downconcrete[0]->flrblock_subsidence)}}><label for="4_4_{{$level2[$i-1]}}_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_{{$level2[$i-1]}}_3" name="endsill_4_cracking" {{checkdata($l[$i],$downconcrete[0]->flrblock_cracking)}}><label for="4_4_{{$level2[$i-1]}}_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_{{$level2[$i-1]}}_4" name="endsill_4_obstruction" {{checkdata($l[$i],$downconcrete[0]->flrblock_obstruction)}}><label for="4_4_{{$level2[$i-1]}}_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_{{$level2[$i-1]}}_5" name="endsill_4_hole" {{checkdata($l[$i],$downconcrete[0]->flrblock_hole)}}><label for="4_4_{{$level2[$i-1]}}_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_{{$level2[$i-1]}}_6" name="endsill_4_leak" {{checkdata($l[$i],$downconcrete[0]->flrblock_leak)}}><label for="4_4_{{$level2[$i-1]}}_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_{{$level2[$i-1]}}_7" name="endsill_4_movement" {{checkdata($l[$i],$downconcrete[0]->flrblock_movement)}}><label for="4_4_{{$level2[$i-1]}}_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_{{$level2[$i-1]}}_8" name="endsill_4_drainage" {{checkdata($l[$i],$downconcrete[0]->flrblock_drainage)}}><label for="4_4_{{$level2[$i-1]}}_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_{{$level2[$i-1]}}_9" name="endsill_4_weed" {{checkdata($l[$i],$downconcrete[0]->flrblock_weed)}}><label for="4_4_{{$level2[$i-1]}}_9"></label></div></td>
                                                          </tr>
                                                         <?php } ?>  
                                                       
                                                    <!-- 5 -->
                                                        <tr> 
                                                          <th colspan="13" id="text1">5. ส่วน Protection ท้ายน้ำ (Downstream Protection Section) </th>
                                                        </tr>
                                                        <!-- 5.1 -->
                                                          <tr>
                                                            <th id="text2">5.1 พื้น</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_1" name="floor_5_erosion" {{checkdata($l[0],$downprotection[0]->floor_erosion)}}><label for="5_1_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_2" name="floor_5_subsidence" {{checkdata($l[0],$downprotection[0]->floor_subsidence)}}><label for="5_1_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_3" name="floor_5_cracking" {{checkdata($l[0],$downprotection[0]->floor_cracking)}}><label for="5_1_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_4" name="floor_5_obstruction" {{checkdata($l[0],$downprotection[0]->floor_obstruction)}}><label for="5_1_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_5" name="floor_5_hole" {{checkdata($l[0],$downprotection[0]->floor_hole)}}><label for="5_1_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_6" name="floor_5_leak" {{checkdata($l[0],$downprotection[0]->floor_leak)}}><label for="5_1_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_7" name="floor_5_movement" {{checkdata($l[0],$downprotection[0]->floor_movement)}}><label for="5_1_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_8" name="floor_5_drainage" {{checkdata($l[0],$downprotection[0]->floor_drainage)}}><label for="5_1_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_9" name="floor_5_weed" {{checkdata($l[0],$downprotection[0]->floor_weed)}}><label for="5_1_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="5_1_normal_9" name="floor_5_damage" class="form-control" placeholder="" > {{$downprotection[0]->floor_damage}} </textarea>
                                                            </td>
                                                            <td rowspan="4" width="10%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_1_normal_11_no" name="floor_5_remake[no]" {{add($downprotection[0]->floor_remake->no)}}><label for="5_1_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_1_normal_11_nosee" name="floor_5_remake[nosee]" {{add($downprotection[0]->floor_remake->nosee)}}><label for="5_1_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r51" name="floor_5_remake[check][detail]" type="text" class=" form-control" placeholder="" value="{{$downprotection[0]->floor_remake->detail}}"> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td id="text2">ตะกอน</td> 
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[0]}}_1"name="floor_5_erosion" {{checkdata($l[1],$downprotection[0]->floor_erosion)}}><label for="5_1_{{$level2[0]}}_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[0]}}_2" name="floor_5_subsidence" {{checkdata($l[1],$downprotection[0]->floor_subsidence)}}><label for="5_1_{{$level2[0]}}_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[0]}}_3" name="floor_5_cracking" {{checkdata($l[1],$downprotection[0]->floor_cracking)}}><label for="5_1_{{$level2[0]}}_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[0]}}_4" name="floor_5_obstruction" {{checkdata($l[1],$downprotection[0]->floor_obstruction)}}><label for="5_1_{{$level2[0]}}_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[0]}}_5" name="floor_5_hole" {{checkdata($l[1],$downprotection[0]->floor_hole)}}><label for="5_1_{{$level2[0]}}_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[0]}}_6" name="floor_5_leak" {{checkdata($l[1],$downprotection[0]->floor_leak)}}><label for="5_1_{{$level2[0]}}_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[0]}}_7" name="floor_5_movement" {{checkdata($l[1],$downprotection[0]->floor_movement)}}><label for="5_1_{{$level2[0]}}_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[0]}}_8" name="floor_5_drainage" {{checkdata($l[1],$downprotection[0]->floor_drainage)}}><label for="5_1_{{$level2[0]}}_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[0]}}_9" name="floor_5_weed" {{checkdata($l[1],$downprotection[0]->floor_weed)}}><label for="5_1_{{$level2[0]}}_9"></label></div></td>
                                                            
                                                          </tr>
                                                          <tr>
                                                             <td>
                                                                <table class="table2 table-borderless" id="text2"> 
                                                                    <tr>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_1_sed_n" name="check_floor_5" {{checkdata($l[0],$downprotection[0]->check_floor)}}><label for="5_1_sed_n"></label></div></td>
                                                                        <td>ปกติ</td>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_1_sed_l" name="check_floor_5" {{checkdata($l[1],$downprotection[0]->check_floor)}}><label for="5_1_sed_l"></label></div></td>
                                                                        <td>น้อย</td>
                                                                    </tr>
                                                                </table>
                                                            </td> 
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[1]}}_1"name="floor_5_erosion" {{checkdata($l[2],$downprotection[0]->floor_erosion)}}><label for="5_1_{{$level2[1]}}_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[1]}}_2" name="floor_5_subsidence" {{checkdata($l[2],$downprotection[0]->floor_subsidence)}}><label for="5_1_{{$level2[1]}}_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[1]}}_3" name="floor_5_cracking" {{checkdata($l[2],$downprotection[0]->floor_cracking)}}><label for="5_1_{{$level2[1]}}_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[1]}}_4" name="floor_5_obstruction" {{checkdata($l[2],$downprotection[0]->floor_obstruction)}}><label for="5_1_{{$level2[1]}}_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[1]}}_5" name="floor_5_hole" {{checkdata($l[2],$downprotection[0]->floor_hole)}}><label for="5_1_{{$level2[1]}}_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[1]}}_6" name="floor_5_leak" {{checkdata($l[2],$downprotection[0]->floor_leak)}}><label for="5_1_{{$level2[1]}}_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[1]}}_7" name="floor_5_movement" {{checkdata($l[2],$downprotection[0]->floor_movement)}}><label for="5_1_{{$level2[1]}}_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[1]}}_8" name="floor_5_drainage" {{checkdata($l[2],$downprotection[0]->floor_drainage)}}><label for="5_1_{{$level2[1]}}_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[1]}}_9" name="floor_5_weed" {{checkdata($l[2],$downprotection[0]->floor_weed)}}><label for="5_1_{{$level2[1]}}_9"></label></div></td>
                                                            

                                                          </tr>
                                                          <tr>
                                                            <td>
                                                                <table class="table2 table-borderless" id="text2"> 
                                                                    <tr>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_1_sed_md" name="check_floor_5" {{checkdata($l[2],$downprotection[0]->check_floor)}}><label for="5_1_sed_md"></label></div></td>
                                                                        <td>กลาง</td>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_1_sed_m" name="check_floor_5" {{checkdata($l[3],$downprotection[0]->check_floor)}}><label for="5_1_sed_m"></label></div></td>
                                                                        <td>มาก</td>
                                                                    </tr>
                                                                </table>
                                                            </td> 
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[2]}}_1"name="floor_5_erosion" {{checkdata($l[3],$downprotection[0]->floor_erosion)}}><label for="5_1_{{$level2[2]}}_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[2]}}_2" name="floor_5_subsidence" {{checkdata($l[3],$downprotection[0]->floor_subsidence)}}><label for="5_1_{{$level2[2]}}_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[2]}}_3" name="floor_5_cracking" {{checkdata($l[3],$downprotection[0]->floor_cracking)}}><label for="5_1_{{$level2[2]}}_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[2]}}_4" name="floor_5_obstruction" {{checkdata($l[3],$downprotection[0]->floor_obstruction)}}><label for="5_1_{{$level2[2]}}_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[2]}}_5" name="floor_5_hole" {{checkdata($l[3],$downprotection[0]->floor_hole)}}><label for="5_1_{{$level2[2]}}_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[2]}}_6" name="floor_5_leak" {{checkdata($l[3],$downprotection[0]->floor_leak)}}><label for="5_1_{{$level2[2]}}_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[2]}}_7" name="floor_5_movement" {{checkdata($l[3],$downprotection[0]->floor_movement)}}><label for="5_1_{{$level2[2]}}_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[2]}}_8" name="floor_5_drainage" {{checkdata($l[3],$downprotection[0]->floor_drainage)}}><label for="5_1_{{$level2[2]}}_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_{{$level2[2]}}_9" name="floor_5_weed" {{checkdata($l[3],$downprotection[0]->floor_weed)}}><label for="5_1_{{$level2[2]}}_9"></label></div></td>
                                                             
                                                          </tr>
                                                        <!-- 5.2 -->
                                                          <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">5.2 ลาดด้านข้าง</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_1" name="side_5_erosion" {{checkdata($l[0],$downprotection[0]->side_erosion)}}><label for="5_2_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_2" name="side_5_subsidence" {{checkdata($l[0],$downprotection[0]->side_subsidence)}}><label for="5_2_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_3" name="side_5_cracking" {{checkdata($l[0],$downprotection[0]->side_cracking)}}><label for="5_2_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_4" name="side_5_obstruction" {{checkdata($l[0],$downprotection[0]->side_obstruction)}}><label for="5_2_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_5" name="side_5_hole" {{checkdata($l[0],$downprotection[0]->side_hole)}}><label for="5_2_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_6" name="side_5_leak" {{checkdata($l[0],$downprotection[0]->side_leak)}}><label for="5_2_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_7" name="side_5_movement" {{checkdata($l[0],$downprotection[0]->side_movement)}}><label for="5_2_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_8" name="side_5_drainage" {{checkdata($l[0],$downprotection[0]->side_drainage)}}><label for="5_2_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_9" name="side_5_weed" {{checkdata($l[0],$downprotection[0]->side_weed)}}><label for="5_2_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="5_2_normal_9" name="side_5_damage" class="form-control" placeholder="" > {{$downprotection[0]->side_damage}}</textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_2_normal_11_no" name="side_5_remake[no]" {{add($downprotection[0]->side_remake->no)}}><label for="5_2_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_2_normal_11_nosee" name="side_5_remake[nosee]" {{add($downprotection[0]->side_remake->nosee)}}><label for="5_2_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r52" name="side_5_remake[check][detail]" type="text" class=" form-control" placeholder="" value="{{$downprotection[0]->side_remake->detail}}"> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                          </tr>
                                                          <?php for($i=1 ; $i<4 ;$i++){?>
                                                            <tr>
                                                              <td>{{$level[$i-1]}}</td>
                                                              <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_{{$level2[$i-1]}}_1" name="side_5_erosion" {{checkdata($l[$i-1],$downprotection[0]->floor_erosion)}}><label for="5_2_{{$level2[$i-1]}}_1"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_{{$level2[$i-1]}}_2" name="side_5_subsidence" {{checkdata($l[$i-1],$downprotection[0]->floor_subsidence)}}><label for="5_2_{{$level2[$i-1]}}_2"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_{{$level2[$i-1]}}_3" name="side_5_cracking" {{checkdata($l[$i-1],$downprotection[0]->floor_cracking)}}><label for="5_2_{{$level2[$i-1]}}_3"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_{{$level2[$i-1]}}_4" name="side_5_obstruction" {{checkdata($l[$i-1],$downprotection[0]->floor_obstruction)}}><label for="5_2_{{$level2[$i-1]}}_4"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_{{$level2[$i-1]}}_5" name="side_5_hole" {{checkdata($l[$i-1],$downprotection[0]->floor_hole)}}><label for="5_2_{{$level2[$i-1]}}_5"></label> </div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_{{$level2[$i-1]}}_6" name="side_5_leak" {{checkdata($l[$i-1],$downprotection[0]->floor_leak)}}><label for="5_2_{{$level2[$i-1]}}_6"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_{{$level2[$i-1]}}_7" name="side_5_movement" {{checkdata($l[$i-1],$downprotection[0]->floor_movement)}}><label for="5_2_{{$level2[$i-1]}}_7"></label> </div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_{{$level2[$i-1]}}_8" name="side_5_drainage" {{checkdata($l[$i-1],$downprotection[0]->floor_drainage)}}><label for="5_2_{{$level2[$i-1]}}_8"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_{{$level2[$i-1]}}_9" name="side_5_weed" {{checkdata($l[$i-1],$downprotection[0]->floor_weed)}}><label for="5_2_{{$level2[$i-1]}}_9"></label></div></td>
                                                            </tr>
                                                          <?php } ?>
                                                        
                                                    <!-- 6 -->
                                                        <tr> 
                                                            <th colspan="13" id="text1">6. ระบบส่งน้ำ </th>
                                                        </tr>
                                                        <!-- 6.1 -->
                                                          <tr>
                                                            <th id="text2">6.1 พื้น</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_1" name="floor_6_erosion" {{checkdata($l[0],$waterdelivery[0]->floor_erosion)}}><label for="6_1_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_2" name="floor_6_subsidence" {{checkdata($l[0],$waterdelivery[0]->floor_subsidence)}}><label for="6_1_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_3" name="floor_6_cracking" {{checkdata($l[0],$waterdelivery[0]->floor_cracking)}}><label for="6_1_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_4" name="floor_6_obstruction" {{checkdata($l[0],$waterdelivery[0]->floor_obstruction)}}><label for="6_1_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_5" name="floor_6_hole" {{checkdata($l[0],$waterdelivery[0]->floor_hole)}}><label for="6_1_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_6" name="floor_6_leak" {{checkdata($l[0],$waterdelivery[0]->floor_leak)}}><label for="6_1_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_7" name="floor_6_movement" {{checkdata($l[0],$waterdelivery[0]->floor_movement)}}><label for="6_1_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_8" name="floor_6_drainage" {{checkdata($l[0],$waterdelivery[0]->floor_drainage)}}><label for="6_1_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_9" name="floor_6_weed" {{checkdata($l[0],$waterdelivery[0]->floor_weed)}}><label for="6_1_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="6_1_normal_9" name="floor_6_damage" class="form-control" placeholder="" > {{$waterdelivery[0]->floor_damage}} </textarea>
                                                            </td>
                                                            <td rowspan="4" width="10%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_1_normal_11_no" name="floor_6_remake[no]" {{add($waterdelivery[0]->floor_remake->no)}}><label for="6_1_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_1_normal_11_nosee" name="floor_6_remake[nosee]" {{add($waterdelivery[0]->floor_remake->nosee)}}><label for="6_1_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r61" name="floor_6_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$waterdelivery[0]->floor_remake->detail}}"> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td id="text2">ตะกอน</td> 
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[0]}}_1"name="floor_6_erosion" {{checkdata($l[1],$waterdelivery[0]->floor_erosion)}}><label for="6_1_{{$level2[0]}}_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[0]}}_2" name="floor_6_subsidence" {{checkdata($l[1],$waterdelivery[0]->floor_subsidence)}}><label for="6_1_{{$level2[0]}}_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[0]}}_3" name="floor_6_cracking" {{checkdata($l[1],$waterdelivery[0]->floor_cracking)}}><label for="6_1_{{$level2[0]}}_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[0]}}_4" name="floor_6_obstruction" {{checkdata($l[1],$waterdelivery[0]->floor_obstruction)}}><label for="6_1_{{$level2[0]}}_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[0]}}_5" name="floor_6_hole" {{checkdata($l[1],$waterdelivery[0]->floor_hole)}}><label for="6_1_{{$level2[0]}}_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[0]}}_6" name="floor_6_leak" {{checkdata($l[1],$waterdelivery[0]->floor_leak)}}><label for="6_1_{{$level2[0]}}_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[0]}}_7" name="floor_6_movement" {{checkdata($l[1],$waterdelivery[0]->floor_movement)}}><label for="6_1_{{$level2[0]}}_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[0]}}_8" name="floor_6_drainage" {{checkdata($l[1],$waterdelivery[0]->floor_drainage)}}><label for="6_1_{{$level2[0]}}_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[0]}}_9" name="floor_6_weed" {{checkdata($l[1],$waterdelivery[0]->floor_weed)}}><label for="6_1_{{$level2[0]}}_9"></label></div></td>
                                                           
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                                <table class="table2 table-borderless" id="text2"> 
                                                                    <tr>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_1_sed_n" name="check_floor_6" {{checkdata($l[0],$waterdelivery[0]->check_floor)}} ><label for="6_1_sed_n"></label></div></td>
                                                                        <td>ปกติ</td>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_1_sed_l" name="check_floor_6" {{checkdata($l[1],$waterdelivery[0]->check_floor)}}><label for="6_1_sed_l"></label></div></td>
                                                                        <td>น้อย</td>
                                                                    </tr>
                                                                </table>
                                                            </td> 
                                                            <td>ปานกลาง</td>
                                                      
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[1]}}_1"name="floor_6_erosion" {{checkdata($l[2],$waterdelivery[0]->floor_erosion)}}><label for="6_1_{{$level2[1]}}_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[1]}}_2" name="floor_6_subsidence" {{checkdata($l[2],$waterdelivery[0]->floor_subsidence)}}><label for="6_1_{{$level2[1]}}_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[1]}}_3" name="floor_6_cracking" {{checkdata($l[2],$waterdelivery[0]->floor_cracking)}}><label for="6_1_{{$level2[1]}}_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[1]}}_4" name="floor_6_obstruction" {{checkdata($l[2],$waterdelivery[0]->floor_obstruction)}}><label for="6_1_{{$level2[1]}}_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[1]}}_5" name="floor_6_hole" {{checkdata($l[2],$waterdelivery[0]->floor_hole)}}><label for="6_1_{{$level2[1]}}_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[1]}}_6" name="floor_6_leak" {{checkdata($l[2],$waterdelivery[0]->floor_leak)}}><label for="6_1_{{$level2[1]}}_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[1]}}_7" name="floor_6_movement" {{checkdata($l[2],$waterdelivery[0]->floor_movement)}}><label for="6_1_{{$level2[1]}}_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[1]}}_8" name="floor_6_drainage" {{checkdata($l[2],$waterdelivery[0]->floor_drainage)}}><label for="6_1_{{$level2[1]}}_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[1]}}_9" name="floor_6_weed" {{checkdata($l[2],$waterdelivery[0]->floor_weed)}}><label for="6_1_{{$level2[1]}}_9"></label></div></td>
                                                           
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                                <table class="table2 table-borderless" id="text2"> 
                                                                    <tr>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_1_sed_md" name="check_floor_6" {{checkdata($l[2],$waterdelivery[0]->check_floor)}} ><label for="6_1_sed_md"></label></div></td>
                                                                        <td>กลาง</td>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_1_sed_m" name="6_1_chcheck_floor_6eck" {{checkdata($l[3],$waterdelivery[0]->check_floor)}} ><label for="6_1_sed_m"></label></div></td>
                                                                        <td>มาก</td>
                                                                    </tr>
                                                                </table>
                                                            </td> 
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[2]}}_1"name="floor_6_erosion" {{checkdata($l[3],$waterdelivery[0]->floor_erosion)}}><label for="6_1_{{$level2[2]}}_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[2]}}_2" name="floor_6_subsidence" {{checkdata($l[3],$waterdelivery[0]->floor_subsidence)}}><label for="6_1_{{$level2[2]}}_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[2]}}_3" name="floor_6_cracking" {{checkdata($l[3],$waterdelivery[0]->floor_cracking)}}><label for="6_1_{{$level2[2]}}_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[2]}}_4" name="floor_6_obstruction" {{checkdata($l[3],$waterdelivery[0]->floor_obstruction)}}><label for="6_1_{{$level2[2]}}_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[2]}}_5" name="floor_6_hole" {{checkdata($l[3],$waterdelivery[0]->floor_hole)}}><label for="6_1_{{$level2[2]}}_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[2]}}_6" name="floor_6_leak" {{checkdata($l[3],$waterdelivery[0]->floor_leak)}}><label for="6_1_{{$level2[2]}}_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[2]}}_7" name="floor_6_movement" {{checkdata($l[3],$waterdelivery[0]->floor_movement)}}><label for="6_1_{{$level2[2]}}_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[2]}}_8" name="floor_6_drainage" {{checkdata($l[3],$waterdelivery[0]->floor_drainage)}}><label for="6_1_{{$level2[2]}}_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_{{$level2[2]}}_9" name="floor_6_weed" {{checkdata($l[3],$waterdelivery[0]->floor_weed)}}><label for="6_1_{{$level2[2]}}_9"></label></div></td>
                                                             
                                                          </tr>

                                                        <!-- 6.2 -->
                                                          <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">6.2 ลาดด้านข้าง</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_1" name="side_6_erosion" {{checkdata($l[0],$waterdelivery[0]->side_erosion)}}><label for="6_2_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_2" name="side_6_subsidence" {{checkdata($l[0],$waterdelivery[0]->side_subsidence)}}><label for="6_2_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_3" name="side_6_cracking" {{checkdata($l[0],$waterdelivery[0]->side_cracking)}}><label for="6_2_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_4" name="side_6_obstruction" {{checkdata($l[0],$waterdelivery[0]->side_obstruction)}}><label for="6_2_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_5" name="side_6_hole" {{checkdata($l[0],$waterdelivery[0]->side_hole)}}><label for="6_2_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_6" name="side_6_leak" {{checkdata($l[0],$waterdelivery[0]->side_leak)}}><label for="6_2_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_7" name="side_6_movement" {{checkdata($l[0],$waterdelivery[0]->side_movement)}}><label for="6_2_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_8" name="side_6_drainage" {{checkdata($l[0],$waterdelivery[0]->side_drainage)}}><label for="6_2_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_9" name="side_6_weed" {{checkdata($l[0],$waterdelivery[0]->side_weed)}}><label for="6_2_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="6_2_normal_9" name="5_side_damage" class="form-control" placeholder="" > {{$waterdelivery[0]->side_damage}} </textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_2_normal_11_no" name="6_side_remake[no]" {{add($waterdelivery[0]->side_remake->no)}}><label for="6_2_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_2_normal_11_nosee" name="6_side_remake[nosee]" {{add($waterdelivery[0]->side_remake->nosee)}}><label for="6_2_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r62" name="5_side_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$waterdelivery[0]->side_remake->detail}}"> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                          </tr>
                                                          <?php for($i=1 ; $i<4 ;$i++){?>
                                                            <tr>
                                                              <td>{{$level[$i-1]}}</td>
                                                              <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_{{$level2[$i-1]}}_1" name="side_6_erosion" {{checkdata($l[0],$waterdelivery[0]->side_erosion)}}><label for="6_2_{{$level2[$i-1]}}_1"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_{{$level2[$i-1]}}_2" name="side_6_subsidence" {{checkdata($l[0],$waterdelivery[0]->side_subsidence)}}><label for="6_2_{{$level2[$i-1]}}_2"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_{{$level2[$i-1]}}_3" name="side_6_cracking" {{checkdata($l[0],$waterdelivery[0]->side_cracking)}}><label for="6_2_{{$level2[$i-1]}}_3"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_{{$level2[$i-1]}}_4" name="side_6_obstruction" {{checkdata($l[0],$waterdelivery[0]->side_obstruction)}}><label for="6_2_{{$level2[$i-1]}}_4"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_{{$level2[$i-1]}}_5" name="side_6_hole" {{checkdata($l[0],$waterdelivery[0]->side_hole)}}><label for="6_2_{{$level2[$i-1]}}_5"></label> </div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_{{$level2[$i-1]}}_6" name="side_6_leak" {{checkdata($l[0],$waterdelivery[0]->side_leak)}}><label for="6_2_{{$level2[$i-1]}}_6"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_{{$level2[$i-1]}}_7" name="side_6_movement" {{checkdata($l[0],$waterdelivery[0]->side_movement)}}><label for="6_2_{{$level2[$i-1]}}_7"></label> </div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_{{$level2[$i-1]}}_8" name="side_6_drainage" {{checkdata($l[0],$waterdelivery[0]->side_drainage)}}><label for="6_2_{{$level2[$i-1]}}_8"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_{{$level2[$i-1]}}_9" name="side_6_weed" {{checkdata($l[0],$waterdelivery[0]->side_weed)}}><label for="6_2_{{$level2[$i-1]}}_9"></label></div></td>
                                                            </tr>
                                                          <?php } ?>
                                                        
                                                                  
                                                        <!-- 6.3 -->
                                                          <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">6.3 ปากตูน้ำ/ปากคลอง</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_1" name="gate_6_erosion" {{checkdata($l[0],$waterdelivery[0]->gate_erosion)}}><label for="6_3_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_2" name="gate_6_subsidence" {{checkdata($l[0],$waterdelivery[0]->gate_subsidence)}}><label for="6_3_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_3" name="gate_6_cracking" {{checkdata($l[0],$waterdelivery[0]->gate_cracking)}}><label for="6_3_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_4" name="gate_6_obstruction" {{checkdata($l[0],$waterdelivery[0]->gate_obstruction)}}><label for="6_3_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_5" name="gate_6_hole" {{checkdata($l[0],$waterdelivery[0]->gate_hole)}}><label for="6_3_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_6" name="gate_6_leak" {{checkdata($l[0],$waterdelivery[0]->gate_leak)}}><label for="6_3_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_7" name="gate_6_movement" {{checkdata($l[0],$waterdelivery[0]->gate_movement)}}><label for="6_3_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_8" name="gate_6_drainage" {{checkdata($l[0],$waterdelivery[0]->gate_drainage)}}><label for="6_3_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_9" name="gate_6_weed" {{checkdata($l[0],$waterdelivery[0]->gate_weed)}}><label for="6_3_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="6_3_normal_9" name="gate_6_damage" class="form-control" placeholder="" >{{$waterdelivery[0]->gate_damage}}</textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_3_normal_11_no" name="gate_6_remake[no]" {{add($waterdelivery[0]->gate_remake->no)}}><label for="6_3_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_3_normal_11_nosee" name="gate_6_remake[nosee]" {{add($waterdelivery[0]->gate_remake->nosee)}}><label for="6_3_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r63" name="gate_6_remake[detail]" type="text" class=" form-control" placeholder="" value="{{$waterdelivery[0]->gate_remake->detail}}"> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                          </tr>
                                                          <?php for($i=1 ; $i<4 ;$i++){?>
                                                            <tr>
                                                              <td>{{$level[$i-1]}}</td>
                                                              <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_{{$level2[$i-1]}}_1" name="gate_6_erosion" {{checkdata($l[0],$waterdelivery[0]->gate_erosion)}}><label for="6_3_{{$level2[$i-1]}}_1"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_{{$level2[$i-1]}}_2" name="gate_6_subsidence" {{checkdata($l[0],$waterdelivery[0]->gate_subsidence)}}><label for="6_3_{{$level2[$i-1]}}_2"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_{{$level2[$i-1]}}_3" name="gate_6_cracking" {{checkdata($l[0],$waterdelivery[0]->gate_cracking)}}><label for="6_3_{{$level2[$i-1]}}_3"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_{{$level2[$i-1]}}_4" name="gate_6_obstruction" {{checkdata($l[0],$waterdelivery[0]->gate_obstruction)}}><label for="6_3_{{$level2[$i-1]}}_4"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_{{$level2[$i-1]}}_5" name="gate_6_hole" {{checkdata($l[0],$waterdelivery[0]->gate_hole)}}><label for="6_3_{{$level2[$i-1]}}_5"></label> </div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_{{$level2[$i-1]}}_6" name="gate_6_leak" {{checkdata($l[0],$waterdelivery[0]->gate_leak)}}><label for="6_3_{{$level2[$i-1]}}_6"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_{{$level2[$i-1]}}_7" name="gate_6_movement" {{checkdata($l[0],$waterdelivery[0]->gate_movement)}}><label for="6_3_{{$level2[$i-1]}}_7"></label> </div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_{{$level2[$i-1]}}_8" name="gate_6_drainage" {{checkdata($l[0],$waterdelivery[0]->gate_drainage)}}><label for="6_3_{{$level2[$i-1]}}_8"></label></div></td>
                                                              <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_{{$level2[$i-1]}}_9" name="gate_6_weed" {{checkdata($l[0],$waterdelivery[0]->gate_weed)}}><label for="6_3_{{$level2[$i-1]}}_9"></label></div></td>
                                                            </tr>
                                                          <?php } ?>
                                                          
                                                    </tbody>
                                                    </table>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </fieldset>

                                                                                
                                        <h3> การแก้ไข </h3>
                                          <fieldset>
                                            <!--7  -->
                                              <div class="form-group row">
                                                <div class="card-block button-list" style="margin-left:-40px;">
                                                  <button type="button" class="btn btn-out waves-effect waves-light btn-inverse btn-square" > 7. แผนการดำเนินการแก้ไขของหน่วยงาน  </button>
                                                </div>
                                              </div>
                                              <div class="border-checkbox-section">
                                                <!-- อยู่ในแผน -->
                                                  <div class="form-group row">
                                                    <div class="col-sm-3">
                                                      <div class="border-checkbox-group border-checkbox-group-primary">
                                                        <input class="border-checkbox" type="checkbox" id="plan_year_check" name="plan_year_check" {{add($plan[0]->plan_year_check)}}>
                                                        <label class="border-checkbox-label" for="plan_year_check"> อยู่ในแผน
                                                         <input id="plan_year" name="plan_year" type="text" class="form-control" placeholder="ปี" value="{{$plan[0]->plan_year}}" style="margin-top:-30px;margin-left:80px;width:100px;">
                                                        </label>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        ลักษณะโครงการ<input id="plan_type" name="plan_type" type="text" class=" form-control" placeholder="ระบุ" value="{{$plan[0]->plan_type}}" style="margin-top:-30px;margin-left:120px;width:180px;">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        งบประมาณ<input id="plan_budget" name="plan_budget" type="text" class=" form-control" placeholder="(บาท)" value="{{$plan[0]->plan_budget}}" style="margin-top:-30px;margin-left:80px;">
                                                    </div>
                                                  </div>
                                                <!-- ได้รับงบประมาณแล้ว -->
                                                  <div class="form-group row">
                                                    <div class="col-sm-4">
                                                      <div class="border-checkbox-group border-checkbox-group-primary">
                                                         <input class="border-checkbox" type="checkbox" id="proj_budget_check" name="proj_budget_check" {{add($plan[0]->proj_budget_check)}}>
                                                         <label class="border-checkbox-label" for="proj_budget_check"> ได้รับงบประมาณแล้ว
                                                            <input id="proj_budget" name="proj_budget" type="text" class="form-control" placeholder="(บาท)" value="{{$plan[0]->proj_budget}}" style="margin-top:-30px;margin-left:160px;width:120px;">
                                                         </label>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                       ลักษณะโครงการ<input id="proj_type" name="proj_type" type="text" class=" form-control" placeholder="ระบุ" value="{{$plan[0]->proj_type}}" style="margin-top:-30px;margin-left:120px;width:180px;">
                                                    </div>
                                                  </div>
                                                <!-- กำลังปรับปรุงกรือก่อสร้าง -->
                                                  <div class="form-group row">
                                                    <div class="col-sm-4">
                                                      <div class="border-checkbox-group border-checkbox-group-primary">
                                                        <input class="border-checkbox" type="checkbox" id="plan_improve" name="plan_improve" {{add($plan[0]->plan_improve)}}>
                                                        <label class="border-checkbox-label" for="plan_improve"> กำลังปรับปรุงกรือก่อสร้าง
                                                      </div>
                                                    </div>
                                                  </div>
                                                <!-- ยังไม่มีในแผน -->
                                                  <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                                            <input class="border-checkbox" type="checkbox" id="plan_no" name="plan_no" {{add($plan[0]->plan_no)}}>
                                                            <label class="border-checkbox-label" for="plan_no">ยังไม่มีในแผน
                                                            
                                                        </div>
                                                    </div>
                                                  </div>
                                              </div>
                                                                                        
                                            <!--8  -->
                                              <div class="form-group row">
                                                <div class="card-block button-list" style="margin-left:-40px;">
                                                    <button type="button" class="btn btn-out waves-effect waves-light btn-inverse btn-square" > 8. ความเห็นและข้อสังเกตเพิ่มเติม  </button>
                                                </div>
                                              </div>
                                              <div class="form-group row" style="margin-top:-40px;margin-bottom:50px;">
                                                <div class="col-sm-9">
                                                    <textarea rows="5" cols="5" id="suggustion" name="suggustion" class="form-control" placeholder="--ระบุความเห็นเพิ่มเติม--" value="{{$sug[0]->suggestion}}"></textarea>
                                                </div>
                                              </div>
                                          </fieldset>

                                        <h3> รูปภาพ </h3>
                                        <fieldset>
                                            <div class="form-group row">
                                              <div class="card-block button-list" style="margin-left:-40px;margin-bottom:-30px;">
                                                <button type="button" class="btn btn-out waves-effect waves-light btn-inverse btn-square" > รูปภาพประกอบ  </button>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <div class="field" >
                                                <h5> 1. ส่วน Protection เหนือน้ำ (Upstream Protection Section)</h5>
                                                  <?php for($i=0;$i<count($photo1);$i++){ ?>
                                                      {{checkphoto($photo1[$i]["file"])}}
                                                  <?php } ?>
                                               </div>
                                            </div>
                                            <div class="form-group row" >
                                             <div class="field" >
                                                <h5> 2. ส่วนเหนือน้ำ (Upstream Concrete Section) </h5>
                                                  <?php for($i=0;$i<count($photo2);$i++){ ?>
                                                      {{checkphoto($photo2[$i]["file"])}}
                                                  <?php } ?>
                                               </div>
                                            </div>
                                            <div class="form-group row" >
                                              <div class="field" >
                                                <h5> 3. ส่วนควบคุม (Control Sector) </h5>
                                                  <?php for($i=0;$i<count($photo3);$i++){ ?>
                                                      {{checkphoto($photo3[$i]["file"])}}
                                                  <?php } ?>
                                               </div>
                                            </div>
                                            <div class="form-group row" >
                                              <div class="field" >
                                                <h5> 4. ส่วนท้ายน้ำ (Downstream Concrete Section) </h5>
                                                  <?php for($i=0;$i<count($photo4);$i++){ ?>
                                                      {{checkphoto($photo4[$i]["file"])}}
                                                  <?php } ?>
                                               </div>
                                            </div>
                                            <div class="form-group row" >
                                              <div class="field" align="left">
                                                <h5> 5. ส่วน Protection ท้ายน้ำ (Downstream Protection Section) </h5>
                                                  <?php for($i=0;$i<count($photo5);$i++){ ?>
                                                      {{checkphoto($photo5[$i]["file"])}}
                                                  <?php } ?>
                                               </div>
                                            </div>
                                            <div class="form-group row" >
                                             <div class="field" align="left">
                                                <h5> 6. ระบบส่งน้ำ </h5>
                                                  <?php for($i=0;$i<count($photo6);$i++){ ?>
                                                      {{checkphoto($photo6[$i]["file"])}}
                                                  <?php } ?>
                                               </div>
                                            </div>
                                        </fieldset>

                                        <h3> บันทึกข้อมูล </h3>
                                          <fieldset>
                                            <br>
                                            <div class="page-body">
                                              <div class="row">
                                                <div class="col-3"></div>
                                                <div class="col-6">
                                                  <div class="card o-visible">
                                                      <div class="card-header" align="center"> 
                                                          <h3>กรุณาตรวจสอบข้อมูล <br>ที่ต้องการ Update <br>ให้เรียบร้อยก่อนการบันทึก </h3>
                                                      </div>
                                                      <div class="card-block" align="center">
                                                        <img src="{{ asset('images/icon/green-check.jpg') }}" width="50%">
                                                        <br>
                                                        <button type="submit" class="btn waves-effect waves-light btn-primary btn-block" >บันทึกข้อมูล Update</button>
                                                      </div>
                                                  </div>
                                                </div>
                                              </div>

                                            </div>
                                          </fieldset>
                                                                                   
                                      </form>
                                    </section>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div id="styleSelector">
          </div>
        </div>
      </div>
    </div>
  </div>

 <script src="{{ asset('js/form/jquery.min.js')}}"></script>
 <script src="{{ asset('js/form/jquery-ui.min.js')}}"></script>
 <script src="{{ asset('js/form/popper.min.js')}}"></script>
 <script src="{{ asset('js/form/bootstrap.min.js')}}"></script>

 <script src="{{ asset('js/form/waves.min.js')}}" ></script>
 <script src="{{ asset('js/form/jquery.slimscroll.js')}}"></script>

 <script src="{{ asset('js/form/modernizr.js')}}"></script>
 <script src="{{ asset('js/form/css-scrollbars.js')}}"></script>
 <script src="{{ asset('js/form/jquery.cookie.js')}}" ></script>
 <script src="{{ asset('js/form/jquery.steps.js')}}" ></script>
 <script src="{{ asset('js/form/jquery.validate.js')}}" ></script>

 <script src="{{ asset('js/form/underscore-min.js')}}" ></script>
 <script src="{{ asset('js/form/moment.min.js')}}" ></script>
 <script src="{{ asset('js/form/validate.js')}}"></script>

 <script src="{{ asset('js/form/form-wizard.js')}}" ></script>
 <script src="{{ asset('js/form/pcoded.min.js')}}" ></script>
 <script src="{{ asset('js/form/vertical-layout.min.js')}}" ></script>
 <script src="{{ asset('js/form/jquery.mcustomscrollbar.concat.min.js')}}" ></script>
 <script src="{{ asset('js/form/script.js')}}"></script>
 <script src="{{ asset('js/remove_photo.js')}}"></script>

 <script src= "{{ asset('js/chooselocation.js') }}"></script>
 <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" ></script>
 <script >
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-23581568-13');
 </script>
 <script src="{{ asset('js/form/rocket-loader.min.js')}}" data-cf-settings="ce2668daaac54a74e9f6cdff-|49" defer=""></script>


</body>

</html>
