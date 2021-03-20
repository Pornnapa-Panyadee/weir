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
      vertical-align: top;
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
                                  <div id="wizard">
                                    <section>
                                      <form class="wizard-form" id="basic-forms" action="{{route('form.formsubmit')}}" enctype="multipart/form-data" method="POST" onsubmit="return confirm('บันทึกข้อมูล เรียบร้อย !!');">
                                        
                                        @csrf <!-- {{ csrf_field() }} -->   
                                        

                                        <!-- -ข้อมูลทั่วไป -->
                                        <h3> ข้อมูลทั่วไป</h3>
                                        <fieldset>
                                          <div class="form-group row">
                                            <label class="col-sm-1 col-form-label">ชื่อฝาย</label>
                                            <div class="col-sm-2">
                                              <input id="weir_name" name="weir_name" type="text" class=" form-control" placeholder="-- กรอกชื่อ --">
                                            </div>
                                            <label class="col-sm-1 col-form-label">ชื่อลำน้ำ</label>
                                            <div class="col-sm-2">
                                              <input id="river_name" name="river_name" type="text" class=" form-control" placeholder="-- กรอกชื่อลำน้ำ --">
                                            </div>
                                            <label class="col-sm-2 col-form-label" align="right">ลำน้ำสาขาของ</label>
                                            <div class="col-sm-3">
                                              <input id="river_branch" name="river_branch" type="text" class=" form-control" placeholder="-- กรอกชื่อลำน้ำสาขา --">
                                             </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">ก่อสร้างเมื่อ ปี พ.ศ.</label>
                                            <div class="col-sm-2">
                                              <input id="weir_year" name="weir_year" type="text" class=" form-control" placeholder="-- ปี (พ.ศ.) --">
                                            </div>
                                            <label class="col-sm-1 col-form-label">อายุฝาย</label>
                                            <div class="col-sm-2">
                                              <input id="weir_age" name="weir_age" type="text" class=" form-control" placeholder="-- อายุ (ปี) --">
                                            </div>
                                          </div>
                                          <!-- ข้อมูลปีก่อสร้างฝาย -->
                                            <div class="form-group row">
                                              <div class="col-sm-5">
                                                <div class="border-checkbox-section">
                                                                                                                    
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="weir_self" name="weir_model[self][weir_self]" value="1">
                                                    <label class="border-checkbox-label" for="weir_self"> ออกแบบเอง &nbsp; &nbsp;&nbsp;</label>
                                                  </div>
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="weir_std" name="weir_model[self][weir_std]" value="1">
                                                    <label class="border-checkbox-label" for="weir_std"> ใช้แบบมาตราฐาน</label>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-sm-4">
                                                <input id="weir_std_detial" name="weir_model[self][std_detial]"  type="text" class=" form-control" placeholder="-- แบบมาตราฐาน --">
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <div class="col-sm-4">
                                                <div class="border-checkbox-section">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="weir_villager"  name="weir_model[self][villager]"  value="1">
                                                    <label class="border-checkbox-label" for="weir_villager"> ก่อสร้างเองใช้แรงงานชาวบ้านใช้งบของ</label>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-sm-4">
                                                <input id="weir_villager_detial"  name="weir_model[self][villager_detial]" type="text" class=" form-control" placeholder="-- งบของ --">
                                              </div>
                                            </div>
                                          <!-- หน่วยงานรับผิดชอบ -->
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label">หน่วยงานรับผิดชอบ</label>
                                              <div class="col-sm-4">
                                                <input id="resp_name" name="resp_name" type="text" class=" form-control" placeholder="-- หน่วยงาน --">
                                              </div>
                                              <label class="col-sm-2 col-form-label">รับถ่ายโอนจาก</label>
                                              <div class="col-sm-3">
                                                <input id="transfer" name="transfer" type="text" class=" form-control" placeholder="-- หน่วยงาน --">
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
                                                      <option value="0">-- กรุณาเลือกประเภทลำน้ำ --</option>
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
                                                      <option value=''>-- เลือกอำเภอ --</option>
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
                                                    <option value=''>-- เลือกตำบล --</option>
                                                  </select>
                                                </div>
                                              </div>
                                              <label class="col-sm-1 col-form-label text-right">หมู่บ้าน : </label>
                                              <div class="col-sm-3">
                                                <div class="border-checkbox-section">
                                                  <select id="weir_village" name="weir_village" class="form-control">
                                                    <option value=''>-- เลือกหมู่บ้าน --</option>
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
                                                <input id="weir_XUTM" name="weir_UTM[x]" type="text" class=" form-control" placeholder="X UTM">
                                              </div>
                                              <label class="col-sm-1 col-form-label text-right">
                                               <button type="button" onclick="transform()" class="btn waves-effect waves-light btn-primary btn-outline-primary btn-block"> >></button>
                                              </label>
                                              <div class="col-sm-3">
                                                <input id="weir_X" name="weir_latlog[x]" type="text" class=" form-control" placeholder="Latitude">
                                              </div>
                                                                                                            
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label ">  </label>
                                              <div class="col-sm-3">
                                                <input id="weir_YUTM" name="weir_UTM[y]" type="text" class=" form-control" placeholder="Y UTM">
                                              </div>
                                              <label class="col-sm-1 col-form-label text-right">
                                                <button type="button" onclick="transformutm()" class="btn waves-effect waves-light btn-primary btn-outline-primary btn-block"> <<</button>
                                              </label>
                                              <div class="col-sm-3">
                                                <input id="weir_Y" name="weir_latlog[y]" type="text" class=" form-control" placeholder="Longitude">
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
                                                    <input class="border-checkbox" type="checkbox" id="ridge_type_1" name="ridge_type[type]" value="ฝายสันมน">
                                                    <label class="border-checkbox-label" for="ridge_type_1">ฝายสันมน</label>
                                                  </div>
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="ridge_type_2" name="ridge_type[type]" value="ฝายไหลตกตรง">
                                                    <label class="border-checkbox-label" for="ridge_type_2"> ฝายไหลตกตรง</label>
                                                  </div>
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="ridge_type_3"  name="ridge_type[type]" value="ฝายสันกว้าง">
                                                    <label class="border-checkbox-label" for="ridge_type_3"> ฝายสันกว้าง</label>
                                                  </div>
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="ridge_type_4" name="ridge_type[type]" value="ฝายหินทิ้ง">
                                                    <label class="border-checkbox-label" for="ridge_type_4"> ฝายหินทิ้ง</label>
                                                  </div>
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="ridge_type_5" name="ridge_type[type]" value="ฝายประตูระบาย">
                                                    <label class="border-checkbox-label" for="ridge_type_5"> ฝายประตูระบาย</label>
                                                  </div>
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="ridge_type_7" name="ridge_type[type]" value="อื่นๆ ">
                                                    <label class="border-checkbox-label" for="ridge_type_7"> อื่นๆ 
                                                       <input id="ridge_type_7_detail" name="ridge_type[detail]" type="text" class="form-control" placeholder="ระบุ" style="margin-top:-30px;margin-left:30px;width:100px;"> 
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
                                                    <input id="ridge_height" name="ridge_height" type="text" class=" form-control" placeholder="(เมตร)">
                                                  </div>
                                                  <label class="col-sm-2 col-form-label ">ความกว้างสัน</label>
                                                  <div class="col-sm-4">
                                                    <input id="ridge_width" name="ridge_width" type="text" class=" form-control" placeholder="(เมตร)">
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
                                                    <input class="border-checkbox" type="checkbox" id="gate_type_yes" name="gate_has" value="1">
                                                    <label class="border-checkbox-label" for="gate_type_yes"> มี</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="gate_type_no" name="gate_has" value="0">
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
                                                    <input class="border-checkbox" type="checkbox" id="door_line" name="gate_type" value="บานตรง">
                                                    <label class="border-checkbox-label" for="door_line">บานตรง</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="door_curve" name="gate_type" value="บานโค้ง">
                                                    <label class="border-checkbox-label" for="door_curve">บานโค้ง</label>
                                                  </div>
                                                </div>
                                                <label class="col-sm-1 col-form-label "> ขนาด </label>
                                                <div class="col-sm-2">
                                                  <input id="gate_size" name="gate_dimension[size]" type="text" class=" form-control" placeholder="(กว้างxสูง) เมตร">
                                                </div>                                                                                                            
                                                <label class="col-sm-1 col-form-label "> จำนวน </label>
                                                <div class="col-sm-1">
                                                  <input id="gate_num" name="gate_dimension[num]" type="text" class=" form-control" placeholder="ชุด">
                                                </div>
                                              </div>
                                            </div>

                                            <div class="border-checkbox-section" >
                                              <div class="form-group row">
                                                <label class="col-sm-1 col-form-label ">  </label>
                                                <label class="col-sm-2 col-form-label "> ชนิดเครื่องยกบาน </label>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="gate_machanic_yes" name="gate_machanic_has" value="1">
                                                    <label class="border-checkbox-label" for="gate_machanic_yes">มี</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="gate_machanic_no" name="gate_machanic_has" value="0">
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
                                                    <input class="border-checkbox" type="checkbox" id="machine_chain" name="gate_machanic_type" value="รอกโซ่">
                                                    <label class="border-checkbox-label" for="machine_chain">รอกโซ่</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-3">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="machine_bow" name="gate_machanic_type" value="เครื่องกว้านคันชัก">
                                                    <label class="border-checkbox-label" for="machine_bow">เครื่องกว้านคันชัก</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-3">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="machine_coil" name="gate_machanic_type" value="เครื่องกว้านม้วนลวด">
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
                                                      <input class="border-checkbox" type="checkbox" id="water_building_yes" name="control_building_has" value="1">
                                                      <label class="border-checkbox-label" for="water_building_yes"> มี</label>
                                                    </div>
                                                  </div>
                                                  <div class="col-sm-2">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                      <input class="border-checkbox" type="checkbox" id="water_building_no" name="control_building_has" value="0">
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
                                                    <input class="border-checkbox" type="checkbox" id="water_building_open" name="control_building_type[open]" value="1">
                                                    <label class="border-checkbox-label" for="water_building_open">แบบปิด</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="water_building_open_left" name="control_building_type[open][left]" value="1">
                                                    <label class="border-checkbox-label" for="water_building_open_left">ฝั่งซ้าย</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="water_building_open_right" name="control_building_type[open][right]" value="1">
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
                                                    <input id="water_building_size" name="conttrol_building_loc[size]" type="text" class=" form-control" placeholder="เมตร">
                                                  </div>                                                                                                            
                                                  <label class="col-sm-2 col-form-label "> ความยาวท่อ </label>
                                                  <div class="col-sm-2">
                                                    <input id="water_building_long" name="conttrol_building_loc[long]" type="text" class=" form-control" placeholder="เมตร">
                                                  </div>
                                                  <label class="col-sm-2 col-form-label "> ระดับธรณีบาน </label>
                                                  <div class="col-sm-2">
                                                    <input id="water_building_bed" name="conttrol_building_loc[base]" type="text" class=" form-control" placeholder="เมตร">
                                                  </div>
                                                </div>
                                              </div>
                                                                                                                
                                            </div>
                                                                                                            
                                            <div class="border-checkbox-section" >
                                              <div class="form-group row">
                                                <label class="col-sm-1 col-form-label ">  </label>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="water_building_close" name="control_building_type[close]" value="1">
                                                    <label class="border-checkbox-label" for="water_building_close">แบบเปิด</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="water_building_close_left" name="control_building_type[close][left]" value="1">
                                                    <label class="border-checkbox-label" for="water_building_close_left">ฝั่งซ้าย</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2">
                                                  <div class="border-checkbox-group border-checkbox-group-primary">
                                                    <input class="border-checkbox" type="checkbox" id="water_building_close_right" name="control_building_type[close][right]" value="1">
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
                                                              <input class="border-checkbox" type="checkbox" id="water_building_close_door_yes" name="control_building_gate_has"  value="1">
                                                              <label class="border-checkbox-label" for="water_building_close_door_yes">มี</label>
                                                            </div>
                                                          </div>
                                                          <div class="col-sm-3">
                                                            <div class="border-checkbox-group border-checkbox-group-primary">
                                                              <input class="border-checkbox" type="checkbox" id="water_building_close_door_no" name="control_building_gate_has" value="0">
                                                              <label class="border-checkbox-label" for="water_building_close_door_no">ไม่มี</label>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="form-group row">
                                                          <div class="col-sm-3">
                                                            <div class="border-checkbox-group border-checkbox-group-primary">
                                                              <input class="border-checkbox" type="checkbox" id="water_building_door_line" name="control_building_gate_type" value="บานตรง">
                                                              <label class="border-checkbox-label" for="water_building_door_line">บานตรง</label>
                                                            </div>
                                                          </div>
                                                          <div class="col-sm-3">
                                                            <div class="border-checkbox-group border-checkbox-group-primary">
                                                              <input class="border-checkbox" type="checkbox" id="water_building_door_curve" name="control_building_gate_type" value="บานโค้ง">
                                                              <label class="border-checkbox-label" for="water_building_door_curve">บานโค้ง</label>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="form-group row">
                                                          <label class="col-sm-3 col-form-label "> ขนาด(กว้างxสูง) </label>
                                                            <div class="col-sm-2">
                                                              <input id="building_gate_size" name="control_building_gate_dimension[size]" type="text" class=" form-control" placeholder="เมตร">
                                                            </div>                                                                                                            
                                                            <label class="col-sm-2 col-form-label "> จำนวน </label>
                                                            <div class="col-sm-2">
                                                              <input id="building_gate_num" name="control_building_gate_dimension[num]" type="text" class=" form-control" placeholder="ชุด">
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
                                                        <input class="border-checkbox" type="checkbox" id="control_building_machanic_chain" name="control_building_machanic_type" value="รอกโซ่">
                                                        <label class="border-checkbox-label" for="control_building_machanic_chain">รอกโซ่</label>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                      <div class="border-checkbox-group border-checkbox-group-primary">
                                                        <input class="border-checkbox" type="checkbox" id="control_building_machanic_bow" name="control_building_machanic_type"  value="เครื่องกว้านคันชัก">
                                                        <label class="border-checkbox-label" for="control_building_machanic_bow">เครื่องกว้านคันชัก</label>
                                                      </div>
                                                    </div>
                                                      <div class="col-sm-5">
                                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                                          <input class="border-checkbox" type="checkbox" id="control_building_machanic_coil" name="control_building_machanic_type" value="เครื่องกว้านม้วนลวด">
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
                                                      <input class="border-checkbox" type="checkbox" id="canal_yes"  name="canal_has" value="1">
                                                      <label class="border-checkbox-label" for="canal_yes">มี</label>
                                                    </div>
                                                  </div>
                                                  <div class="col-sm-2">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                      <input class="border-checkbox" type="checkbox" id="canal_no" name="canal_has"  value="0">
                                                      <label class="border-checkbox-label" for="canal_no">ไม่มี</label>
                                                    </div>
                                                   </div>                                         
                                              </div>
                                            </div>

                                            <div class="border-checkbox-section" >
                                              <div class="form-group row" style="margin-top:-20px;">
                                                <label class="col-sm-2 col-form-label "> ลักษณะคลอง </label>
                                                  <div class="col-sm-2">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                      <input class="border-checkbox" type="checkbox" id="canal_soil" name="canal_type" value="คลองดิน">
                                                      <label class="border-checkbox-label" for="canal_soil">คลองดิน</label>
                                                    </div>
                                                  </div>
                                                  <div class="col-sm-4">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                      <input class="border-checkbox" type="checkbox" id="canal_concrete" name="canal_type" value="คลองดาดคอนกรีต">
                                                      <label class="border-checkbox-label" for="canal_concrete">คลองดาดคอนกรีต</label>
                                                    </div>
                                                  </div>                                          
                                              </div>
                                            </div>
                                                                                        

                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label ">ขนาดก้นคลองกว้าง </label>
                                              <div class="col-sm-3">
                                                <input id="canal_width" name="canel_dimension[width]" type="text" class=" form-control" placeholder="เมตร">
                                              </div> 
                                              <label class="col-sm-2 col-form-label ">ความยาวประมาณ </label>
                                                <div class="col-sm-3">
                                                  <input id="canal_lenght" name="canel_dimension[lenght]" type="text" class=" form-control" placeholder="กิโลเมตร">
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
                                                      <tr>
                                                        <td><input id="maintain_date_r1" name="maintain_date_r1" type="text" class=" form-control" placeholder="ระบุ พ.ศ."></td>
                                                        <td> <input id="maintain_detail_r1" name="maintain_detail_r1" type="text" class=" form-control" placeholder="ระบุรายการ "> </td>
                                                        <td><input id="maintain_resp_r1" name="maintain_resp_r1" type="text" class=" form-control" placeholder="ระบุหน่วยงาน"></td>
                                                        <td><input id="maintain_remark_r1" name="maintain_remark_r1" type="text" class=" form-control" placeholder=""> </td>
                                                      </tr>
                                                      <tr>
                                                        <td><input id="maintain_date_r2" name="maintain_date_r2" type="text" class=" form-control" placeholder="ระบุ พ.ศ."></td>
                                                        <td><input id="maintain_detail_r2" name="maintain_detail_r2" type="text" class=" form-control" placeholder="ระบุรายการ "></td>
                                                        <td><input id="maintain_resp_r2" name="maintain_resp_r2" type="text" class=" form-control" placeholder="ระบุหน่วยงาน"></td>
                                                        <td><input id="maintain_remark_r2" name="maintain_remark_r2" type="text" class=" form-control" placeholder=""></td>
                                                      </tr>
                                                      <tr>
                                                        <td><input id="maintain_date_r3" name="maintain_date_r3" type="text" class=" form-control" placeholder="ระบุ พ.ศ."> </td>
                                                        <td><input id="maintain_detail_r3" name="maintain_detail_r3" type="text" class=" form-control" placeholder="ระบุรายการ "> </td>
                                                        <td><input id="maintain_resp_r3" name="maintain_resp_r3" type="text" class=" form-control" placeholder="ระบุหน่วยงาน"> </td>
                                                        <td><input id="maintain_remark_r3" name="maintain_remark_r3" type="text" class=" form-control" placeholder=""> </td>
                                                      </tr>
                                                      <tr>
                                                        <td><input id="maintain_date_r4" name="maintain_date_r4" type="text" class=" form-control" placeholder="ระบุ พ.ศ."> </td>
                                                        <td><input id="maintain_detail_r4" name="maintain_detail_r4" type="text" class=" form-control" placeholder="ระบุรายการ "> </td>
                                                        <td><input id="maintain_resp_r4" name="maintain_resp_r4" type="text" class=" form-control" placeholder="ระบุหน่วยงาน"> </td>
                                                        <td><input id="maintain_remark_r4" name="maintain_remark_r4" type="text" class=" form-control" placeholder=""> </td>
                                                      </tr>
                                                      <tr>
                                                        <td><input id="maintain_date_r5" name="maintain_date_r5" type="text" class=" form-control" placeholder="ระบุ พ.ศ."> </td>
                                                        <td><input id="maintain_detail_r5" name="maintain_detail_r5" type="text" class=" form-control" placeholder="ระบุรายการ "> </td>
                                                        <td><input id="maintain_resp_r5" name="maintain_resp_r5" type="text" class=" form-control" placeholder="ระบุหน่วยงาน"> </td>
                                                        <td><input id="maintain_remark_r5" name="maintain_remark_r5" type="text" class=" form-control" placeholder=""> </td>
                                                      </tr>
                                                                                                                           
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
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_1" name="floor_1_erosion" value="1"><label for="1_1_normal_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_2" name="floor_1_subsidence" value="1"><label for="1_1_normal_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_3" name="floor_1_cracking" value="1"><label for="1_1_normal_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_4" name="floor_1_obstruction" value="1"><label for="1_1_normal_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_5" name="floor_1_hole" value="1"><label for="1_1_normal_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_6" name="floor_1_leak" value="1"><label for="1_1_normal_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_7" name="floor_1_movement" value="1"><label for="1_1_normal_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_8" name="floor_1_drainage" value="1"><label for="1_1_normal_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_normal_9" name="floor_1_weed" value="1"><label for="1_1_normal_9"></label></div></td>
                                                        <td rowspan="4" width="8%" style="vertical-align: top;">
                                                          <textarea rows="7" cols="5" id="1_1_normal_9" name="floor_1_damage" class="form-control" placeholder=""></textarea>
                                                        </td>
                                                        <td rowspan="4" width="10%">
                                                          <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                            <tr>
                                                              <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_1_normal_11_no" name="floor_1_remake[no]" value="1"><label for="1_1_normal_11_no"></label></div></td>
                                                              <td>ไม่มี</td>
                                                            </tr>
                                                            <tr >
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_1_normal_11_nosee" name="floor_1_remake[nosee]" value="1"><label for="1_1_normal_11_nosee"></label></div></td>
                                                              <td>มองไม่เห็น</td>
                                                            </tr>
                                                            <tr>
                                                              <td > อื่นๆ </td>
                                                              <td><input id="weir_note_r11" name="floor_1_remake[detail]" type="text" class=" form-control" placeholder=""> </td>
                                                            </tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                          </table>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td id="text2">ตะกอน</td> 
                                                        <td>น้อย</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_1"name="floor_1_erosion" value="2"><label for="1_1_less_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_2" name="floor_1_subsidence" value="2"><label for="1_1_less_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_3" name="floor_1_cracking" value="2"><label for="1_1_less_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_4" name="floor_1_obstruction" value="2"><label for="1_1_less_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_5" name="floor_1_hole" value="2"><label for="1_1_less_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_6" name="floor_1_leak" value="2"><label for="1_1_less_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_7" name="floor_1_movement" value="2"><label for="1_1_less_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_8" name="floor_1_drainage" value="2"><label for="1_1_less_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_less_9" name="floor_1_weed" value="2"><label for="1_1_less_9"></label></div></td>
                                                      </tr>
                                                      <tr>
                                                        <td>
                                                          <table class="table2 table-borderless" id="text2"> 
                                                            <tr>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_1_sed_n" name="check_floor_1" value="1"><label for="1_1_sed_n"></label></div></td>
                                                              <td>ปกติ</td>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_1_sed_l" name="check_floor_1" value="2"><label for="1_1_sed_l"></label></div></td>
                                                              <td>น้อย</td>
                                                            </tr>
                                                          </table>
                                                        </td> 
                                                        <td>ปานกลาง</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_1" name="floor_1_erosion" value="3"><label for="1_1_mid_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_2" name="floor_1_subsidence" value="3"><label for="1_1_mid_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_3" name="floor_1_cracking" value="3"><label for="1_1_mid_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_4" name="floor_1_obstruction" value="3"><label for="1_1_mid_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_5" name="floor_1_hole" value="3"><label for="1_1_mid_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_6" name="floor_1_leak" value="3"><label for="1_1_mid_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_7" name="floor_1_movement" value="3"><label for="1_1_mid_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_8" name="floor_1_drainage" value="3"><label for="1_1_mid_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_mid_9" name="floor_1_weed" value="3"><label for="1_1_mid_9"></label></div></td>
                                                      </tr>
                                                      <tr>
                                                        <td>
                                                          <table class="table2 table-borderless" id="text2"> 
                                                            <tr>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_1_sed_md" name="check_floor_1" value="3"><label for="1_1_sed_md"></label></div></td>
                                                              <td>กลาง</td>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_1_sed_m" name="check_floor_1" value="4"><label for="1_1_sed_m"></label></div></td>
                                                              <td>มาก</td>
                                                            </tr>
                                                          </table>
                                                        </td> 
                                                        <td>มาก</td>
                                                          <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_1" name="floor_1_erosion" value="4"><label for="1_1_more_1"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_2" name="floor_1_subsidence" value="4"><label for="1_1_more_2"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_3" name="floor_1_cracking" value="4"><label for="1_1_more_3"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_4" name="floor_1_obstruction" value="4"><label for="1_1_more_4"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_5" name="floor_1_hole" value="4"><label for="1_1_more_5"></label> </div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_6" name="floor_1_leak" value="4"><label for="1_1_more_6"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_7" name="floor_1_movement" value="4"><label for="1_1_more_7"></label> </div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_8" name="floor_1_drainage" value="4"><label for="1_1_more_8"></label></div></td>
                                                          <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_1_more_9" name="floor_1_weed" value="4"><label for="1_1_more_9"></label></div></td>
                                                      </tr>
                                                    <!-- 1.2 -->
                                                      <tr>
                                                        <th id="text2" rowspan="4" style="vertical-align: top;">1.2 ลาดด้านข้าง</th> 
                                                        <td>ปกติ</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_1" name="side_1_erosion" value="1"><label for="1_2_normal_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_2" name="side_1_subsidence" value="1"><label for="1_2_normal_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_3" name="side_1_cracking" value="1"><label for="1_2_normal_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_4" name="side_1_obstruction" value="1"><label for="1_2_normal_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_5" name="side_1_hole" value="1"><label for="1_2_normal_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_6" name="side_1_leak" value="1"><label for="1_2_normal_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_7" name="side_1_movement" value="1"><label for="1_2_normal_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_8" name="side_1_drainage" value="1"><label for="1_2_normal_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_normal_9" name="side_1_weed" value="1"><label for="1_2_normal_9"></label></div></td>
                                                        <td rowspan="4" width="8%" style="vertical-align: top;">
                                                          <textarea rows="7" cols="5" id="1_2_normal_9" name="side_1_damage" class="form-control" placeholder=""></textarea>
                                                        </td>
                                                        <td rowspan="4" width="8%">
                                                          <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                            <tr>
                                                              <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_2_normal_11_no" name="side_1_remake[no]" value="1"><label for="1_2_normal_11_no"></label></div></td>
                                                              <td>ไม่มี</td>
                                                            </tr>
                                                            <tr >
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="1_2_normal_11_nosee" name="side1__remake[nosee]" value="1"><label for="1_2_normal_11_nosee"></label></div></td>
                                                              <td>มองไม่เห็น</td>
                                                            </tr>
                                                            <tr>
                                                              <td > อื่นๆ </td>
                                                              <td><input id="weir_note_r12" name="side_1_remake[detail]" type="text" class=" form-control" placeholder=""> </td>
                                                            </tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                            </table>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td>น้อย</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_less_1" name="side_1_erosion" value="2"><label for="1_2_less_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_less_2" name="side_1_subsidence" value="2"><label for="1_2_less_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_less_3" name="side_1_cracking" value="2"><label for="1_2_less_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_less_4" name="side_1_obstruction" value="2"><label for="1_2_less_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_less_5" name="side_1_hole" value="2"><label for="1_2_less_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_less_6" name="side_1_leak" value="2"><label for="1_2_less_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_less_7" name="side_1_movement" value="2"><label for="1_2_less_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_less_8" name="side_1_drainage" value="2"><label for="1_2_less_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_less_9" name="side_1_weed" value="2"><label for="1_2_less_9"></label></div></td>
                                                       </tr>
                                                       <tr>
                                                        <td>ปานกลาง</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_mid_1" name="side_1_erosion" value="3"><label for="1_2_mid_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_mid_2" name="side_1_subsidence" value="3"><label for="1_2_mid_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_mid_3" name="side_1_cracking" value="3"><label for="1_2_mid_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_mid_4" name="side_1_obstruction" value="3"><label for="1_2_mid_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_mid_5" name="side_1_hole" value="3"><label for="1_2_mid_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_mid_6" name="side_1_leak" value="3"><label for="1_2_mid_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_mid_7" name="side_1_movement" value="3"><label for="1_2_mid_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_mid_8" name="side_1_drainage" value="3"><label for="1_2_mid_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_mid_9" name="side_1_weed" value="3"><label for="1_2_mid_9"></label></div></td>
                                                       </tr>
                                                       <tr>
                                                        <td>มาก</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_more_1" name="side_1_erosion" value="4"><label for="1_2_more_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_more_2" name="side_1_subsidence" value="4"><label for="1_2_more_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_more_3" name="side_1_cracking" value="4"><label for="1_2_more_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_more_4" name="side_1_obstruction" value="4"><label for="1_2_more_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_more_5" name="side_1_hole" value="4"><label for="1_2_more_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_more_6" name="side_1_leak" value="4"><label for="1_2_more_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_more_7" name="side_1_movement" value="4"><label for="1_2_more_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_more_8" name="side_1_drainage" value="4"><label for="1_2_more_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="1_2_more_9" name="side_1_weed" value="4"><label for="1_2_more_9"></label></div></td>
                                                       </tr>
                                                    <!-- 2 -->
                                                      <tr> 
                                                          <th colspan="13" id="text1">2. ส่วนเหนือน้ำ (Upstream Concrete Section) </th>
                                                      </tr>
                                                    <!-- 2.1 -->
                                                      <tr>
                                                        <th id="text2">2.1 พื้น (floor)</th> 
                                                        <td>ปกติ</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_1" name="floor_2_erosion" value="1"><label for="2_1_normal_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_2" name="floor_2_subsidence" value="1"><label for="2_1_normal_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_3" name="floor_2_cracking" value="1"><label for="2_1_normal_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_4" name="floor_2_obstruction" value="1"><label for="2_1_normal_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_5" name="floor_2_hole" value="1"><label for="2_1_normal_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_6" name="floor_2_leak" value="1"><label for="2_1_normal_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_7" name="floor_2_movement" value="1"><label for="2_1_normal_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_8" name="floor_2_drainage" value="1"><label for="2_1_normal_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_normal_9" name="floor_2_weed" value="1"><label for="2_1_normal_9"></label></div></td>
                                                        <td rowspan="4" width="8%" style="vertical-align: top;">
                                                          <textarea rows="7" cols="5" id="2_1_normal_9" name="floor_2_damage" class="form-control" placeholder=""></textarea>
                                                        </td>
                                                        <td rowspan="4" width="10%">
                                                          <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                            <tr>
                                                              <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_1_normal_11_no" name="floor_2_remake[no]" value="1"><label for="2_1_normal_11_no"></label></div></td>
                                                              <td>ไม่มี</td>
                                                            </tr>
                                                            <tr >
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_1_normal_11_nosee" name="floor_2_remake[nosee]" value="1"><label for="2_1_normal_11_nosee"></label></div></td>
                                                              <td>มองไม่เห็น</td>
                                                            </tr>
                                                            <tr>
                                                              <td > อื่นๆ </td>
                                                              <td><input id="weir_note_r21" name="floor_2_remake[detail]" type="text" class=" form-control" placeholder=""> </td>
                                                            </tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                          </table>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td id="text2">ตะกอน</td> 
                                                        <td>น้อย</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_1" name="floor_2_erosion" value="2"><label for="2_1_less_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_2" name="floor_2_subsidence" value="2"><label for="2_1_less_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_3" name="floor_2_cracking" value="2"><label for="2_1_less_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_4" name="floor_2_obstruction" value="2"><label for="2_1_less_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_5" name="floor_2_hole" value="2"><label for="2_1_less_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_6" name="floor_2_leak" value="2"><label for="2_1_less_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_7" name="floor_2_movement" value="2"><label for="2_1_less_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_8" name="floor_2_drainage" value="2"><label for="2_1_less_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_less_9" name="floor_2_weed" value="2"><label for="2_1_less_9"></label></div></td>
                                                      </tr>
                                                      <tr>
                                                        <td>
                                                          <table class="table2 table-borderless" id="text2"> 
                                                            <tr>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_1_sed_n" name="check_floor_2" value="1"><label for="2_1_sed_n"></label></div></td>
                                                              <td>ปกติ</td>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_1_sed_l" name="check_floor_2" value="2"><label for="2_1_sed_l"></label></div></td>
                                                              <td>น้อย</td>
                                                            </tr>
                                                          </table>
                                                        </td> 
                                                        <td>ปานกลาง</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_1" name="floor_2_erosion" value="3"><label for="2_1_mid_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_2" name="floor_2_subsidence" value="3"><label for="2_1_mid_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_3" name="floor_2_cracking" value="3"><label for="2_1_mid_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_4" name="floor_2_obstruction" value="3"><label for="2_1_mid_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_5" name="floor_2_hole" value="3"><label for="2_1_mid_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_6" name="floor_2_leak" value="3"><label for="2_1_mid_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_7" name="floor_2_movement" value="3"><label for="2_1_mid_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_8" name="floor_2_drainage" value="3"><label for="2_1_mid_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_mid_9" name="floor_2_weed" value="3"><label for="2_1_mid_9"></label></div></td>
                                                      </tr>
                                                      <tr>
                                                        <td>
                                                          <table class="table2 table-borderless" id="text2"> 
                                                            <tr>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_1_sed_md" name="check_floor_2" value="3"><label for="2_1_sed_md"></label></div></td>
                                                              <td>กลาง</td>
                                                              <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_1_sed_m" name="check_floor_2" value="4"><label for="2_1_sed_m"></label></div></td>
                                                              <td>มาก</td>
                                                            </tr>
                                                          </table>
                                                        </td> 
                                                        <td>มาก</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_1" name="floor_2_erosion" value="4"><label for="2_1_more_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_2" name="floor_2_subsidence" value="4"><label for="2_1_more_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_3" name="floor_2_cracking" value="4"><label for="2_1_more_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_4" name="floor_2_obstruction" value="4"><label for="2_1_more_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_5" name="floor_2_hole" value="4"><label for="2_1_more_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_6" name="floor_2_leak" value="4"><label for="2_1_more_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_7" name="floor_2_movement" value="4"><label for="2_1_more_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_8" name="floor_2_drainage" value="4"><label for="2_1_more_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_1_more_9" name="floor_2_weed" value="4"><label for="2_1_more_9"></label></div></td>
                                                      </tr>
                                                    <!-- 2.2 -->
                                                      <tr>
                                                        <th id="text2" rowspan="4" style="vertical-align: top;">2.2 ลาดด้านข้าง</th> 
                                                        <td>ปกติ</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_1" name="side_2_erosion" value="1"><label for="2_2_normal_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_2" name="side_2_subsidence" value="1"><label for="2_2_normal_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_3" name="side_2_cracking" value="1"><label for="2_2_normal_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_4" name="side_2_obstruction" value="1"><label for="2_2_normal_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_5" name="side_2_hole" value="1"><label for="2_2_normal_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_6" name="side_2_leak" value="1"><label for="2_2_normal_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_7" name="side_2_movement" value="1"><label for="2_2_normal_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_8" name="side_2_drainage" value="1"><label for="2_2_normal_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_normal_9" name="side_2_weed" value="1"><label for="2_2_normal_9"></label></div></td>
                                                        <td rowspan="4" width="8%" style="vertical-align: top;">
                                                          <textarea rows="7" cols="5" id="2_2_normal_9" name="side_2_damage" class="form-control" placeholder=""></textarea>
                                                        </td>
                                                        <td rowspan="4" width="8%">
                                                          <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                            <tr>
                                                             <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_2_normal_11_no" name="side_2_remake[no]" value="1"><label for="2_2_normal_11_no"></label></div></td>
                                                             <td>ไม่มี</td>
                                                            </tr>
                                                            <tr >
                                                             <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="2_2_normal_11_nosee" name="side_2_remake[nosee]" value="1"><label for="2_2_normal_11_nosee"></label></div></td>
                                                             <td>มองไม่เห็น</td>
                                                            </tr>
                                                            <tr>
                                                             <td > อื่นๆ </td>
                                                             <td><input id="weir_note_r22" name="side_2_remake[detail]" type="text" class=" form-control" placeholder=""> </td>
                                                            </tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                          </table>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td>น้อย</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_less_1" name="side_2_erosion" value="2"><label for="2_2_less_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_less_2" name="side_2_subsidence" value="2"><label for="2_2_less_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_less_3" name="side_2_cracking" value="2"><label for="2_2_less_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_less_4" name="side_2_obstruction" value="2"><label for="2_2_less_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_less_5" name="side_2_hole" value="2"><label for="2_2_less_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_less_6" name="side_2_leak" value="2"><label for="2_2_less_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_less_7" name="side_2_movement" value="2"><label for="2_2_less_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_less_8" name="side_2_drainage" value="2"><label for="2_2_less_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_less_9" name="side_2_weed" value="2"><label for="2_2_less_9"></label></div></td>
                                                      </tr>
                                                      <tr>
                                                        <td>ปานกลาง</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_mid_1" name="side_2_erosion" value="3"><label for="2_2_mid_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_mid_2" name="side_2_subsidence" value="3"><label for="2_2_mid_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_mid_3" name="side_2_cracking" value="3"><label for="2_2_mid_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_mid_4" name="side_2_obstruction" value="3"><label for="2_2_mid_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_mid_5" name="side_2_hole" value="3"><label for="2_2_mid_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_mid_6" name="side_2_leak" value="3"><label for="2_2_mid_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_mid_7" name="side_2_movement" value="3"><label for="2_2_mid_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_mid_8" name="side_2_drainage" value="3"><label for="2_2_mid_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_mid_9" name="side_2_weed" value="3"><label for="2_2_mid_9"></label></div></td>
                                                      </tr>
                                                      <tr>
                                                        <td>มาก</td>
                                                        <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_more_1" name="side_2_erosion" value="4"><label for="2_2_more_1"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_more_2" name="side_2_subsidence" value="4"><label for="2_2_more_2"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_more_3" name="side_2_cracking" value="4"><label for="2_2_more_3"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_more_4" name="side_2_obstruction" value="4"><label for="2_2_more_4"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_more_5" name="side_2_hole" value="4"><label for="2_2_more_5"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_more_6" name="side_2_leak" value="4"><label for="2_2_more_6"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_more_7" name="side_2_movement" value="4"><label for="2_2_more_7"></label> </div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_more_8" name="side_2_drainage" value="4"><label for="2_2_more_8"></label></div></td>
                                                        <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="2_2_more_9" name="side_2_weed" value="4"><label for="2_2_more_9"></label></div></td>
                                                                                                                                                                                               
                                                      </tr>
                                                                                                                                     
                                                    <!-- 3 -->
                                                      <tr> 
                                                       <th colspan="13" id="text1">3. ส่วนควบคุม (Control Sector) </th>
                                                      </tr>
                                                      <!-- 3.1 -->
                                                        <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">3.1 ฝายควบคุม <br>น้ำและบันไดปลา </th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_1" name="waterctrl_3_erosion" value="1"><label for="3_1_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_2" name="waterctrl_3_subsidence" value="1"><label for="3_1_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_3" name="waterctrl_3_cracking" value="1"><label for="3_1_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_4" name="waterctrl_3_obstruction" value="1"><label for="3_1_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_5" name="waterctrl_3_hole" value="1"><label for="3_1_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_6" name="waterctrl_3_leak" value="1"><label for="3_1_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_7" name="waterctrl_3_movement" value="1"><label for="3_1_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_8" name="waterctrl_3_drainage" value="1"><label for="3_1_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_normal_9" name="waterctrl_3_weed" value="1"><label for="3_1_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                              <textarea rows="7" cols="5" id="3_1_normal_9" name="waterctrl_3_damage" class="form-control" placeholder=""></textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                              <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                               <tr>
                                                                 <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_1_normal_11_no" name="waterctrl_3_remake[no]" value="1"><label for="3_1_normal_11_no"></label></div></td>
                                                                 <td>ไม่มี</td>
                                                               </tr>
                                                               <tr >
                                                                 <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_1_normal_11_nosee" name="waterctrl_3_remake[nosee]" value="1"><label for="3_1_normal_11_nosee"></label></div></td>
                                                                 <td>มองไม่เห็น</td>
                                                               </tr>
                                                               <tr>
                                                                 <td > อื่นๆ </td>
                                                                 <td><input id="weir_note_r31" name="waterctrl_3_remake[detail]" type="text" class=" form-control" placeholder=""> </td>
                                                               </tr>
                                                                 <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_less_1" name="waterctrl_3_erosion" value="2"><label for="3_1_less_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_less_2" name="waterctrl_3_subsidence" value="2"><label for="3_1_less_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_less_3" name="waterctrl_3_cracking" value="2"><label for="3_1_less_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_less_4" name="waterctrl_3_obstruction" value="2"><label for="3_1_less_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_less_5" name="waterctrl_3_hole" value="2"><label for="3_1_less_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_less_6" name="waterctrl_3_leak" value="2"><label for="3_1_less_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_less_7" name="waterctrl_3_movement" value="2"><label for="3_1_less_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_less_8" name="waterctrl_3_drainage" value="2"><label for="3_1_less_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_less_9" name="waterctrl_3_weed" value="2"><label for="3_1_less_9"></label></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_mid_1" name="waterctrl_3_erosion" value="3"><label for="3_1_mid_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_mid_2" name="waterctrl_3_subsidence" value="3"><label for="3_1_mid_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_mid_3" name="waterctrl_3_cracking" value="3"><label for="3_1_mid_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_mid_4" name="waterctrl_3_obstruction" value="3"><label for="3_1_mid_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_mid_5" name="waterctrl_3_hole" value="3"><label for="3_1_mid_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_mid_6" name="waterctrl_3_leak" value="3"><label for="3_1_mid_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_mid_7" name="waterctrl_3_movement" value="3"><label for="3_1_mid_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_mid_8" name="waterctrl_3_drainage" value="3"><label for="3_1_mid_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_mid_9" name="waterctrl_3_weed" value="3"><label for="3_1_mid_9"></label></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_more_1" name="waterctrl_3_erosion" value="4"><label for="3_1_more_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_more_2" name="waterctrl_3_subsidence" value="4"><label for="3_1_more_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_more_3" name="waterctrl_3_cracking" value="4"><label for="3_1_more_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_more_4" name="waterctrl_3_obstruction" value="4"><label for="3_1_more_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_more_5" name="waterctrl_3_hole" value="4"><label for="3_1_more_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_more_6" name="waterctrl_3_leak" value="4"><label for="3_1_more_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_more_7" name="waterctrl_3_movement" value="4"><label for="3_1_more_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_more_8" name="waterctrl_3_drainage" value="4"><label for="3_1_more_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_1_more_9" name="waterctrl_3_weed" value="4"><label for="3_1_more_9"></label></div></td>
                                                        </tr>
                                                                      
                                                      <!-- 3.2 -->
                                                        <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">3.2 กำแพงข้าง</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_1" name="sidewall_3_erosion" value="1"><label for="3_2_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_2" name="sidewall_3_subsidence" value="1"><label for="3_2_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_3" name="sidewall_3_cracking" value="1"><label for="3_2_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_4" name="sidewall_3_obstruction" value="1"><label for="3_2_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_5" name="sidewall_3_hole" value="1"><label for="3_2_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_6" name="sidewall_3_leak" value="1"><label for="3_2_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_7" name="sidewall_3_movement" value="1"><label for="3_2_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_8" name="sidewall_3_drainage" value="1"><label for="3_2_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_normal_9" name="sidewall_3_weed" value="1"><label for="3_2_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                              <textarea rows="7" cols="5" id="3_2_normal_9" name="sidewall_3_damage" class="form-control" placeholder=""></textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                              <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                <tr>
                                                                  <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_2_normal_11_no" name="sidewall_3_remake[no]" value="1"><label for="3_2_normal_11_no"></label></div></td>
                                                                  <td>ไม่มี</td>
                                                                </tr>
                                                                <tr >
                                                                  <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_2_normal_11_nosee" name="sidewall_3_remake[nosee]" value="1"><label for="3_2_normal_11_nosee"></label></div></td>
                                                                  <td>มองไม่เห็น</td>
                                                                </tr>
                                                                <tr>
                                                                  <td > อื่นๆ </td>
                                                                  <td><input id="weir_note_r32" name="sidewall_3_remake[detail]" type="text" class=" form-control" placeholder=""> </td>
                                                                </tr>
                                                                <tr><td>&nbsp;</td></tr>
                                                              </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_less_1" name="sidewall_3_erosion" value="2"><label for="3_2_less_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_less_2" name="sidewall_3_subsidence" value="2"><label for="3_2_less_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_less_3" name="sidewall_3_cracking" value="2"><label for="3_2_less_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_less_4" name="sidewall_3_obstruction" value="2"><label for="3_2_less_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_less_5" name="sidewall_3_hole" value="2"><label for="3_2_less_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_less_6" name="sidewall_3_leak" value="2"><label for="3_2_less_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_less_7" name="sidewall_3_movement" value="2"><label for="3_2_less_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_less_8" name="sidewall_3_drainage" value="2"><label for="3_2_less_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_less_9" name="sidewall_3_weed" value="2"><label for="3_2_less_9"></label></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_mid_1" name="sidewall_3_erosion" value="3"><label for="3_2_mid_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_mid_2" name="sidewall_3_subsidence" value="3"><label for="3_2_mid_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_mid_3" name="sidewall_3_cracking" value="3"><label for="3_2_mid_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_mid_4" name="sidewall_3_obstruction" value="3"><label for="3_2_mid_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_mid_5" name="sidewall_3_hole" value="3"><label for="3_2_mid_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_mid_6" name="sidewall_3_leak" value="3"><label for="3_2_mid_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_mid_7" name="sidewall_3_movement" value="3"><label for="3_2_mid_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_mid_8" name="sidewall_3_drainage" value="3"><label for="3_2_mid_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_mid_9" name="sidewall_3_weed" value="3"><label for="3_2_mid_9"></label></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_more_1" name="sidewall_3_erosion" value="4"><label for="3_2_more_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_more_2" name="sidewall_3_subsidence" value="4"><label for="3_2_more_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_more_3" name="sidewall_3_cracking" value="4"><label for="3_2_more_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_more_4" name="sidewall_3_obstruction" value="4"><label for="3_2_more_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_more_5" name="sidewall_3_hole" value="4"><label for="3_2_more_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_more_6" name="sidewall_3_leak" value="4"><label for="3_2_more_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_more_7" name="sidewall_3_movement" value="4"><label for="3_2_more_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_more_8" name="sidewall_3_drainage" value="4"><label for="3_2_more_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_2_more_9" name="sidewall_3_weed" value="4"><label for="3_2_more_9"></label></div></td>
                                                        </tr>
                                                      <!-- 3.3 -->
                                                        <tr> 
                                                          <th colspan="13" id="text3">3.3.1 ประตู/ช่องระบายทราย </th>
                                                        </tr>
                                                        <!-- 3.3.1 -->
                                                            <tr>
                                                                <th id="text2" rowspan="4" style="vertical-align: top;">3.3.1 พื้น</th> 
                                                                <td>ปกติ</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_1" name="dgfloor_3_erosion" value="1"><label for="3_3_1_normal_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_2" name="dgfloor_3_subsidence" value="1"><label for="3_3_1_normal_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_3" name="dgfloor_3_cracking" value="1"><label for="3_3_1_normal_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_4" name="dgfloor_3_obstruction" value="1"><label for="3_3_1_normal_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_5" name="dgfloor_3_hole" value="1"><label for="3_3_1_normal_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_6" name="dgfloor_3_leak" value="1"><label for="3_3_1_normal_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_7" name="dgfloor_3_movement" value="1"><label for="3_3_1_normal_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_8" name="dgfloor_3_drainage" value="1"><label for="3_3_1_normal_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_normal_9" name="dgfloor_3_weed" value="1"><label for="3_3_1_normal_9"></label></div></td>
                                                                <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                    <textarea rows="7" cols="5" id="3_3_1_normal_9" name="dgfloor_3_damage" class="form-control" placeholder=""></textarea>
                                                                </td>
                                                                <td rowspan="4" width="8%">
                                                                    <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                        <tr>
                                                                            <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_1_normal_11_no" name="dgfloor_3_remake[no]" value="1"><label for="3_3_1_normal_11_no"></label></div></td>
                                                                            <td>ไม่มี</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_1_normal_11_nosee" name="dgfloor_3_remake[nosee]" value="1"><label for="3_3_1_normal_11_nosee"></label></div></td>
                                                                            <td>มองไม่เห็น</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td > อื่นๆ </td>
                                                                            <td><input id="weir_note_r331" name="dgfloor_3_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                        </tr>
                                                                        <tr><td>&nbsp;</td></tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>น้อย</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_less_1" name="dgfloor_3_erosion" value="2"><label for="3_3_1_less_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_less_2" name="dgfloor_3_subsidence" value="2"><label for="3_3_1_less_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_less_3" name="dgfloor_3_cracking" value="2"><label for="3_3_1_less_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_less_4" name="dgfloor_3_obstruction" value="2"><label for="3_3_1_less_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_less_5" name="dgfloor_3_hole" value="2"><label for="3_3_1_less_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_less_6" name="dgfloor_3_leak" value="2"><label for="3_3_1_less_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_less_7" name="dgfloor_3_movement" value="2"><label for="3_3_1_less_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_less_8" name="dgfloor_3_drainage" value="2"><label for="3_3_1_less_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_less_9" name="dgfloor_3_weed" value="2"><label for="3_3_1_less_9"></label></div></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>ปานกลาง</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_mid_1" name="dgfloor_3_erosion" value="3"><label for="3_3_1_mid_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_mid_2" name="dgfloor_3_subsidence" value="3"><label for="3_3_1_mid_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_mid_3" name="dgfloor_3_cracking" value="3"><label for="3_3_1_mid_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_mid_4" name="dgfloor_3_obstruction" value="3"><label for="3_3_1_mid_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_mid_5" name="dgfloor_3_hole" value="3"><label for="3_3_1_mid_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_mid_6" name="dgfloor_3_leak" value="3"><label for="3_3_1_mid_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_mid_7" name="dgfloor_3_movement" value="3"><label for="3_3_1_mid_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_mid_8" name="dgfloor_3_drainage" value="3"><label for="3_3_1_mid_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_mid_9" name="dgfloor_3_weed" value="3"><label for="3_3_1_mid_9"></label></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td>มาก</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_more_1" name="dgfloor_3_erosion" value="4"><label for="3_3_1_more_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_more_2" name="dgfloor_3_subsidence" value="4"><label for="3_3_1_more_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_more_3" name="dgfloor_3_cracking" value="4"><label for="3_3_1_more_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_more_4" name="dgfloor_3_obstruction" value="4"><label for="3_3_1_more_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_more_5" name="dgfloor_3_hole" value="4"><label for="3_3_1_more_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_more_6" name="dgfloor_3_leak" value="4"><label for="3_3_1_more_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_more_7" name="dgfloor_3_movement" value="4"><label for="3_3_1_more_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_more_8" name="dgfloor_3_drainage" value="4"><label for="3_3_1_more_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_1_more_9" name="dgfloor_3_weed" value="4"><label for="3_3_1_more_9"></label></div></td>
                                                            
                                                            </tr>
                                                        <!-- 3.3.2 -->
                                                            <tr>
                                                                <th id="text2" rowspan="4" style="vertical-align: top;">3.3.2 กำแพงข้าง</th> 
                                                                <td>ปกติ</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_1" name="dgwall_3_erosion" value="1"><label for="3_3_2_normal_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_2" name="dgwall_3_subsidence" value="1"><label for="3_3_2_normal_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_3" name="dgwall_3_cracking" value="1"><label for="3_3_2_normal_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_4" name="dgwall_3_obstruction" value="1"><label for="3_3_2_normal_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_5" name="dgwall_3_hole" value="1"><label for="3_3_2_normal_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_6" name="dgwall_3_leak" value="1"><label for="3_3_2_normal_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_7" name="dgwall_3_movement" value="1"><label for="3_3_2_normal_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_8" name="dgwall_3_drainage" value="1"><label for="3_3_2_normal_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_normal_9" name="dgwall_3_weed" value="1"><label for="3_3_2_normal_9"></label></div></td>
                                                                <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                    <textarea rows="7" cols="5" id="3_3_2_normal_9" name="dgwall_3_damage" class="form-control" placeholder=""></textarea>
                                                                </td>
                                                                <td rowspan="4" width="8%">
                                                                    <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                        <tr>
                                                                            <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_2_normal_11_no" name="dgwall_3_remake[no]" value="1"><label for="3_3_2_normal_11_no"></label></div></td>
                                                                            <td>ไม่มี</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_1_normal_11_nosee" name="dgwall_3_remake[nosee]" value="1"><label for="3_3_1_normal_11_nosee"></label></div></td>
                                                                            <td>มองไม่เห็น</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td > อื่นๆ </td>
                                                                            <td><input id="weir_note_r332" name="dgwall_3_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                        </tr>
                                                                        <tr><td>&nbsp;</td></tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>น้อย</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_less_1" name="dgwall_3_erosion" value="2"><label for="3_3_2_less_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_less_2" name="dgwall_3_subsidence" value="2"><label for="3_3_2_less_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_less_3" name="dgwall_3_cracking" value="2"><label for="3_3_2_less_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_less_4" name="dgwall_3_obstruction" value="2"><label for="3_3_2_less_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_less_5" name="dgwall_3_hole" value="2"><label for="3_3_2_less_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_less_6" name="dgwall_3_leak" value="2"><label for="3_3_2_less_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_less_7" name="dgwall_3_movement" value="2"><label for="3_3_2_less_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_less_8" name="dgwall_3_drainage" value="2"><label for="3_3_2_less_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_less_9" name="dgwall_3_weed" value="2"><label for="3_3_2_less_9"></label></div></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>ปานกลาง</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_mid_1" name="dgwall_3_erosion" value="3"><label for="3_3_2_mid_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_mid_2" name="dgwall_3_subsidence" value="3"><label for="3_3_2_mid_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_mid_3" name="dgwall_3_cracking" value="3"><label for="3_3_2_mid_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_mid_4" name="dgwall_3_obstruction" value="3"><label for="3_3_2_mid_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_mid_5" name="dgwall_3_hole" value="3"><label for="3_3_2_mid_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_mid_6" name="dgwall_3_leak" value="3"><label for="3_3_2_mid_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_mid_7" name="dgwall_3_movement" value="3"><label for="3_3_2_mid_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_mid_8" name="dgwall_3_drainage" value="3"><label for="3_3_2_mid_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_mid_9" name="dgwall_3_weed" value="3"><label for="3_3_2_mid_9"></label></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td>มาก</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_more_1" name="dgwall_3_erosion" value="4"><label for="3_3_2_more_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_more_2" name="dgwall_3_subsidence" value="4"><label for="3_3_2_more_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_more_3" name="dgwall_3_cracking" value="4"><label for="3_3_2_more_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_more_4" name="dgwall_3_obstruction" value="4"><label for="3_3_2_more_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_more_5" name="dgwall_3_hole" value="4"><label for="3_3_2_more_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_more_6" name="dgwall_3_leak" value="4"><label for="3_3_2_more_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_more_7" name="dgwall_3_movement" value="4"><label for="3_3_2_more_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_more_8" name="dgwall_3_drainage" value="4"><label for="3_3_2_more_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_2_more_9" name="dgwall_3_weed" value="4"><label for="3_3_2_more_9"></label></div></td>
                                                            
                                                            </tr>
                                                        <!-- 3.3.3 -->
                                                            <tr>
                                                                <th id="text2" rowspan="4" style="vertical-align: top;">3.3.3 ประตูระบายน้ำ<br>เฉพาะตัวบาน</th> 
                                                                <td>ปกติ</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_1" name="dggate_3_erosion" value="1"><label for="3_3_3_normal_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_2" name="dggate_3_subsidence" value="1"><label for="3_3_3_normal_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_3" name="dggate_3_cracking" value="1"><label for="3_3_3_normal_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_4" name="dggate_3_obstruction" value="1"><label for="3_3_3_normal_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_5" name="dggate_3_hole" value="1"><label for="3_3_3_normal_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_6" name="dggate_3_leak" value="1"><label for="3_3_3_normal_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_7" name="dggate_3_movement" value="1"><label for="3_3_3_normal_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_8" name="dggate_3_drainage" value="1"><label for="3_3_3_normal_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_normal_9" name="dggate_3_weed" value="1"><label for="3_3_3_normal_9"></label></div></td>
                                                                <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                    <textarea rows="7" cols="5" id="3_3_3_normal_9" name="dggate_3_damage" class="form-control" placeholder=""></textarea>
                                                                </td>
                                                                <td rowspan="4" width="8%">
                                                                    <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                        <tr>
                                                                            <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_3_normal_11_no" name="dggate_3_remake[no]" value="1"><label for="3_3_3_normal_11_no"></label></div></td>
                                                                            <td>ไม่มี</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_1_normal_11_nosee" name="dggate_3_remake[nosee]" value="1"><label for="3_3_1_normal_11_nosee"></label></div></td>
                                                                            <td>มองไม่เห็น</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td > อื่นๆ </td>
                                                                            <td><input id="weir_note_r333" name="dggate_3_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                        </tr>
                                                                        <tr><td>&nbsp;</td></tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>น้อย</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_less_1" name="dggate_3_erosion" value="2"><label for="3_3_3_less_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_less_2" name="dggate_3_subsidence" value="2"><label for="3_3_3_less_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_less_3" name="dggate_3_cracking" value="2"><label for="3_3_3_less_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_less_4" name="dggate_3_obstruction" value="2"><label for="3_3_3_less_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_less_5" name="dggate_3_hole" value="2"><label for="3_3_3_less_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_less_6" name="dggate_3_leak" value="2"><label for="3_3_3_less_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_less_7" name="dggate_3_movement" value="2"><label for="3_3_3_less_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_less_8" name="dggate_3_drainage" value="2"><label for="3_3_3_less_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_less_9" name="dggate_3_weed" value="2"><label for="3_3_3_less_9"></label></div></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>ปานกลาง</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_mid_1" name="dggate_3_erosion" value="3"><label for="3_3_3_mid_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_mid_2" name="dggate_3_subsidence" value="3"><label for="3_3_3_mid_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_mid_3" name="dggate_3_cracking" value="3"><label for="3_3_3_mid_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_mid_4" name="dggate_3_obstruction" value="3"><label for="3_3_3_mid_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_mid_5" name="dggate_3_hole" value="3"><label for="3_3_3_mid_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_mid_6" name="dggate_3_leak" value="3"><label for="3_3_3_mid_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_mid_7" name="dggate_3_movement" value="3"><label for="3_3_3_mid_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_mid_8" name="dggate_3_drainage" value="3"><label for="3_3_3_mid_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_mid_9" name="dggate_3_weed" value="3"><label for="3_3_3_mid_9"></label></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td>มาก</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_more_1" name="dggate_3_erosion" value="4"><label for="3_3_3_more_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_more_2" name="dggate_3_subsidence" value="4"><label for="3_3_3_more_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_more_3" name="dggate_3_cracking" value="4"><label for="3_3_3_more_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_more_4" name="dggate_3_obstruction" value="4"><label for="3_3_3_more_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_more_5" name="dggate_3_hole" value="4"><label for="3_3_3_more_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_more_6" name="dggate_3_leak" value="4"><label for="3_3_3_more_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_more_7" name="dggate_3_movement" value="4"><label for="3_3_3_more_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_more_8" name="dggate_3_drainage" value="4"><label for="3_3_3_more_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_3_more_9" name="dggate_3_weed" value="4"><label for="3_3_3_more_9"></label></div></td>
                                                            
                                                            </tr>
                                                        <!-- 3.3.4 -->
                                                            <tr>
                                                                <th id="text2" rowspan="4" style="vertical-align: top;">3.3.4 ประตูระบายน้ำ <br> เคลื่องกล/อุปกรณ์</th> 
                                                                <td>ปกติ</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_1" name="dgmachanic_3_erosion" value="1"><label for="3_3_4_normal_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_2" name="dgmachanic_3_subsidence" value="1"><label for="3_3_4_normal_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_3" name="dgmachanic_3_cracking" value="1"><label for="3_3_4_normal_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_4" name="dgmachanic_3_obstruction" value="1"><label for="3_3_4_normal_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_5" name="dgmachanic_3_hole" value="1"><label for="3_3_4_normal_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_6" name="dgmachanic_3_leak" value="1"><label for="3_3_4_normal_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_7" name="dgmachanic_3_movement" value="1"><label for="3_3_4_normal_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_8" name="dgmachanic_3_drainage" value="1"><label for="3_3_4_normal_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_normal_9" name="dgmachanic_3_weed" value="1"><label for="3_3_4_normal_9"></label></div></td>
                                                                <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                    <textarea rows="7" cols="5" id="3_3_4_normal_9" name="dgmachanic_3_damage" class="form-control" placeholder=""></textarea>
                                                                </td>
                                                                <td rowspan="4" width="8%">
                                                                    <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                        <tr>
                                                                            <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_4_normal_11_no" name="dgmachanic_3_remake[no]" value="1"><label for="3_3_4_normal_11_no"></label></div></td>
                                                                            <td>ไม่มี</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_4_normal_11_nosee" name="dgmachanic_3_remake[nosee]" value="1"><label for="3_3_4_normal_11_nosee"></label></div></td>
                                                                            <td>มองไม่เห็น</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td > อื่นๆ </td>
                                                                            <td><input id="weir_note_r334" name="dgmachanic_3_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                        </tr>
                                                                        <tr><td>&nbsp;</td></tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>น้อย</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_less_1" name="dgmachanic_3_erosion" value="2"><label for="3_3_4_less_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_less_2" name="dgmachanic_3_subsidence" value="2"><label for="3_3_4_less_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_less_3" name="dgmachanic_3_cracking" value="2"><label for="3_3_4_less_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_less_4" name="dgmachanic_3_obstruction" value="2"><label for="3_3_4_less_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_less_5" name="dgmachanic_3_hole" value="2"><label for="3_3_4_less_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_less_6" name="dgmachanic_3_leak" value="2"><label for="3_3_4_less_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_less_7" name="dgmachanic_3_movement" value="2"><label for="3_3_4_less_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_less_8" name="dgmachanic_3_drainage" value="2"><label for="3_3_4_less_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_less_9" name="dgmachanic_3_weed" value="2"><label for="3_3_4_less_9"></label></div></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>ปานกลาง</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_mid_1" name="dgmachanic_3_erosion" value="3"><label for="3_3_4_mid_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_mid_2" name="dgmachanic_3_subsidence" value="3"><label for="3_3_4_mid_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_mid_3" name="dgmachanic_3_cracking" value="3"><label for="3_3_4_mid_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_mid_4" name="dgmachanic_3_obstruction" value="3"><label for="3_3_4_mid_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_mid_5" name="dgmachanic_3_hole" value="3"><label for="3_3_4_mid_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_mid_6" name="dgmachanic_3_leak" value="3"><label for="3_3_4_mid_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_mid_7" name="dgmachanic_3_movement" value="3"><label for="3_3_4_mid_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_mid_8" name="dgmachanic_3_drainage" value="3"><label for="3_3_4_mid_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_mid_9" name="dgmachanic_3_weed" value="3"><label for="3_3_4_mid_9"></label></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td>มาก</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_more_1" name="dgmachanic_3_erosion" value="4"><label for="3_3_4_more_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_more_2" name="dgmachanic_3_subsidence" value="4"><label for="3_3_4_more_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_more_3" name="dgmachanic_3_cracking" value="4"><label for="3_3_4_more_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_more_4" name="dgmachanic_3_obstruction" value="4"><label for="3_3_4_more_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_more_5" name="dgmachanic_3_hole" value="4"><label for="3_3_4_more_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_more_6" name="dgmachanic_3_leak" value="4"><label for="3_3_4_more_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_more_7" name="dgmachanic_3_movement" value="4"><label for="3_3_4_more_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_more_8" name="dgmachanic_3_drainage" value="4"><label for="3_3_4_more_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_4_more_9" name="dgmachanic_3_weed" value="4"><label for="3_3_4_more_9"></label></div></td>
                                                            
                                                            </tr>
                                                        <!-- 3.3.5 -->
                                                            <tr>
                                                                <th id="text2" rowspan="4" style="vertical-align: top;">3.3.5 ท่อนกันน้ำและ<br>ร่องบาน</th> 
                                                                <td>ปกติ</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_1" name="dgblock_3_erosion" value="1"><label for="3_3_5_normal_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_2" name="dgblock_3_subsidence" value="1"><label for="3_3_5_normal_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_3" name="dgblock_3_cracking" value="1"><label for="3_3_5_normal_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_4" name="dgblock_3_obstruction" value="1"><label for="3_3_5_normal_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_5" name="dgblock_3_hole" value="1"><label for="3_3_5_normal_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_6" name="dgblock_3_leak" value="1"><label for="3_3_5_normal_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_7" name="dgblock_3_movement" value="1"><label for="3_3_5_normal_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_8" name="dgblock_3_drainage" value="1"><label for="3_3_5_normal_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_normal_9" name="dgblock_3_weed" value="1"><label for="3_3_5_normal_9"></label></div></td>
                                                                <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                    <textarea rows="7" cols="5" id="3_3_5_normal_9" name="dgblock_3_damage" class="form-control" placeholder=""></textarea>
                                                                </td>
                                                                <td rowspan="4" width="8%">
                                                                    <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                        <tr>
                                                                            <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_5_normal_11_no" name="dgblock_3_remake[no]" value="1"><label for="3_3_5_normal_11_no"></label></div></td>
                                                                            <td>ไม่มี</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_3_1_normal_11_nosee" name="dgblock_3_remake[nosee]" value="1"><label for="3_3_1_normal_11_nosee"></label></div></td>
                                                                            <td>มองไม่เห็น</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td > อื่นๆ </td>
                                                                            <td><input id="weir_note_r335" name="dgblock_3_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                        </tr>
                                                                        <tr><td>&nbsp;</td></tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>น้อย</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_less_1" name="dgblock_3_erosion" value="2"><label for="3_3_5_less_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_less_2" name="dgblock_3_subsidence" value="2"><label for="3_3_5_less_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_less_3" name="dgblock_3_cracking" value="2"><label for="3_3_5_less_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_less_4" name="dgblock_3_obstruction" value="2"><label for="3_3_5_less_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_less_5" name="dgblock_3_hole" value="2"><label for="3_3_5_less_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_less_6" name="dgblock_3_leak" value="2"><label for="3_3_5_less_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_less_7" name="dgblock_3_movement" value="2"><label for="3_3_5_less_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_less_8" name="dgblock_3_drainage" value="2"><label for="3_3_5_less_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_less_9" name="dgblock_3_weed" value="2"><label for="3_3_5_less_9"></label></div></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>ปานกลาง</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_mid_1" name="dgblock_3_erosion" value="3"><label for="3_3_5_mid_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_mid_2" name="dgblock_3_subsidence" value="3"><label for="3_3_5_mid_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_mid_3" name="dgblock_3_cracking" value="3"><label for="3_3_5_mid_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_mid_4" name="dgblock_3_obstruction" value="3"><label for="3_3_5_mid_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_mid_5" name="dgblock_3_hole" value="3"><label for="3_3_5_mid_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_mid_6" name="dgblock_3_leak" value="3"><label for="3_3_5_mid_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_mid_7" name="dgblock_3_movement" value="3"><label for="3_3_5_mid_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_mid_8" name="dgblock_3_drainage" value="3"><label for="3_3_5_mid_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_mid_9" name="dgblock_3_weed" value="3"><label for="3_3_5_mid_9"></label></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td>มาก</td>
                                                                <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_more_1" name="dgblock_3_erosion" value="4"><label for="3_3_5_more_1"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_more_2" name="dgblock_3_subsidence" value="4"><label for="3_3_5_more_2"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_more_3" name="dgblock_3_cracking" value="4"><label for="3_3_5_more_3"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_more_4" name="dgblock_3_obstruction" value="4"><label for="3_3_5_more_4"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_more_5" name="dgblock_3_hole" value="4"><label for="3_3_5_more_5"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_more_6" name="dgblock_3_leak" value="4"><label for="3_3_5_more_6"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_more_7" name="dgblock_3_movement" value="4"><label for="3_3_5_more_7"></label> </div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_more_8" name="dgblock_3_drainage" value="4"><label for="3_3_5_more_8"></label></div></td>
                                                                <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_3_5_more_9" name="dgblock_3_weed" value="4"><label for="3_3_5_more_9"></label></div></td>
                                                            
                                                            </tr>
                                                      <!-- 3.4 -->
                                                        <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">3.4 แท่งสลายพลัง<br>งานน้ำปลายรางเท</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_1" name="waterbreak_3_erosion" value="1"><label for="3_4_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_2" name="waterbreak_3_subsidence" value="1"><label for="3_4_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_3" name="waterbreak_3_cracking" value="1"><label for="3_4_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_4" name="waterbreak_3_obstruction" value="1"><label for="3_4_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_5" name="waterbreak_3_hole" value="1"><label for="3_4_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_6" name="waterbreak_3_leak" value="1"><label for="3_4_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_7" name="waterbreak_3_movement" value="1"><label for="3_4_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_8" name="waterbreak_3_drainage" value="1"><label for="3_4_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_normal_9" name="waterbreak_3_weed" value="1"><label for="3_4_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="3_4_normal_9" name="waterbreak_3_damage" class="form-control" placeholder=""></textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_4_normal_11_no" name="waterbreak_3_remake[no]" value="1"><label for="3_4_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_4_normal_11_nosee" name="waterbreak_3_remake[nosee]" value="1"><label for="3_4_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r34" name="waterbreak_3_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_less_1" name="waterbreak_3_erosion" value="2"><label for="3_4_less_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_less_2" name="waterbreak_3_subsidence" value="2"><label for="3_4_less_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_less_3" name="waterbreak_3_cracking" value="2"><label for="3_4_less_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_less_4" name="waterbreak_3_obstruction" value="2"><label for="3_4_less_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_less_5" name="waterbreak_3_hole" value="2"><label for="3_4_less_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_less_6" name="waterbreak_3_leak" value="2"><label for="3_4_less_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_less_7" name="waterbreak_3_movement" value="2"><label for="3_4_less_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_less_8" name="waterbreak_3_drainage" value="2"><label for="3_4_less_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_less_9" name="waterbreak_3_weed" value="2"><label for="3_4_less_9"></label></div></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_mid_1" name="waterbreak_3_erosion" value="3"><label for="3_4_mid_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_mid_2" name="waterbreak_3_subsidence" value="3"><label for="3_4_mid_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_mid_3" name="waterbreak_3_cracking" value="3"><label for="3_4_mid_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_mid_4" name="waterbreak_3_obstruction" value="3"><label for="3_4_mid_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_mid_5" name="waterbreak_3_hole" value="3"><label for="3_4_mid_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_mid_6" name="waterbreak_3_leak" value="3"><label for="3_4_mid_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_mid_7" name="waterbreak_3_movement" value="3"><label for="3_4_mid_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_mid_8" name="waterbreak_3_drainage" value="3"><label for="3_4_mid_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_mid_9" name="waterbreak_3_weed" value="3"><label for="3_4_mid_9"></label></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_more_1" name="waterbreak_3_erosion" value="4"><label for="3_4_more_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_more_2" name="waterbreak_3_subsidence" value="4"><label for="3_4_more_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_more_3" name="waterbreak_3_cracking" value="4"><label for="3_4_more_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_more_4" name="waterbreak_3_obstruction" value="4"><label for="3_4_more_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_more_5" name="waterbreak_3_hole" value="4"><label for="3_4_more_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_more_6" name="waterbreak_3_leak" value="4"><label for="3_4_more_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_more_7" name="waterbreak_3_movement" value="4"><label for="3_4_more_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_more_8" name="waterbreak_3_drainage" value="4"><label for="3_4_more_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_4_more_9" name="waterbreak_3_weed" value="4"><label for="3_4_more_9"></label></div></td>
                                                                      
                                                        </tr>

                                                      <!-- 3.5 -->
                                                        <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">3.5 สะพาน</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_1" name="bridge_3_erosion" value="1"><label for="3_5_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_2" name="bridge_3_subsidence" value="1"><label for="3_5_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_3" name="bridge_3_cracking" value="1"><label for="3_5_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_4" name="bridge_3_obstruction" value="1"><label for="3_5_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_5" name="bridge_3_hole" value="1"><label for="3_5_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_6" name="bridge_3_leak" value="1"><label for="3_5_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_7" name="bridge_3_movement" value="1"><label for="3_5_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_8" name="bridge_3_drainage" value="1"><label for="3_5_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_normal_9" name="bridge_3_weed" value="1"><label for="3_5_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="3_5_normal_9" name="bridge_3_damage" class="form-control" placeholder=""></textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_5_normal_11_no" name="bridge_3_remake[no]" value="1"><label for="3_5_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="3_5_normal_11_nosee" name="bridge_3_remake[nosee]" value="1"><label for="3_5_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r3" name="bridge_3_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_less_1" name="bridge_3_erosion" value="2"><label for="3_5_less_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_less_2" name="bridge_3_subsidence" value="2"><label for="3_5_less_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_less_3" name="bridge_3_cracking" value="2"><label for="3_5_less_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_less_4" name="bridge_3_obstruction" value="2"><label for="3_5_less_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_less_5" name="bridge_3_hole" value="2"><label for="3_5_less_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_less_6" name="bridge_3_leak" value="2"><label for="3_5_less_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_less_7" name="bridge_3_movement" value="2"><label for="3_5_less_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_less_8" name="bridge_3_drainage" value="2"><label for="3_5_less_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_less_9" name="bridge_3_weed" value="2"><label for="3_5_less_9"></label></div></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_mid_1" name="bridge_3_erosion" value="3"><label for="3_5_mid_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_mid_2" name="bridge_3_subsidence" value="3"><label for="3_5_mid_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_mid_3" name="bridge_3_cracking" value="3"><label for="3_5_mid_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_mid_4" name="bridge_3_obstruction" value="3"><label for="3_5_mid_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_mid_5" name="bridge_3_hole" value="3"><label for="3_5_mid_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_mid_6" name="bridge_3_leak" value="3"><label for="3_5_mid_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_mid_7" name="bridge_3_movement" value="3"><label for="3_5_mid_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_mid_8" name="bridge_3_drainage" value="3"><label for="3_5_mid_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_mid_9" name="bridge_3_weed" value="3"><label for="3_5_mid_9"></label></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_more_1" name="bridge_3_erosion" value="4"><label for="3_5_more_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_more_2" name="bridge_3_subsidence" value="4"><label for="3_5_more_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_more_3" name="bridge_3_cracking" value="4"><label for="3_5_more_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_more_4" name="bridge_3_obstruction" value="4"><label for="3_5_more_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_more_5" name="bridge_3_hole" value="4"><label for="3_5_more_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_more_6" name="bridge_3_leak" value="4"><label for="3_5_more_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_more_7" name="bridge_3_movement" value="4"><label for="3_5_more_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_more_8" name="bridge_3_drainage" value="4"><label for="3_5_more_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="3_5_more_9" name="bridge_3_weed" value="4"><label for="3_5_more_9"></label></div></td>
                                                                      
                                                        </tr>


                                                    <!-- 4 -->
                                                      <tr> 
                                                        <th colspan="13" id="text1">4. ส่วนท้ายน้ำ (Downstream Concrete Section) </th>
                                                      </tr>
                                                      <!-- 4.1 -->
                                                        <tr>
                                                            <th id="text2">4.1 พื้น (floor)</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_1" name="floor_4_erosion" value="1"><label for="4_1_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_2" name="floor_4_subsidence" value="1"><label for="4_1_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_3" name="floor_4_cracking" value="1"><label for="4_1_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_4" name="floor_4_obstruction" value="1"><label for="4_1_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_5" name="floor_4_hole" value="1"><label for="4_1_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_6" name="floor_4_leak" value="1"><label for="4_1_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_7" name="floor_4_movement" value="1"><label for="4_1_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_8" name="floor_4_drainage" value="1"><label for="4_1_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_normal_9" name="floor_4_weed" value="1"><label for="4_1_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="4_1_normal_9" name="floor_4_damage" class="form-control" placeholder=""></textarea>
                                                            </td>
                                                            <td rowspan="4" width="10%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_1_normal_11_no" name="floor_4_remake[no]" value="1"><label for="4_1_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_1_normal_11_nosee" name="floor_4_remake[nosee]" value="1"><label for="4_1_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r41" name="floor_4_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td id="text2">ตะกอน</td> 
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_1"name="floor_4_erosion" value="2"><label for="4_1_less_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_2" name="floor_4_subsidence" value="2"><label for="4_1_less_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_3" name="floor_4_cracking" value="2"><label for="4_1_less_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_4" name="floor_4_obstruction" value="2"><label for="4_1_less_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_5" name="floor_4_hole" value="2"><label for="4_1_less_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_6" name="floor_4_leak" value="2"><label for="4_1_less_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_7" name="floor_4_movement" value="2"><label for="4_1_less_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_8" name="floor_4_drainage" value="2"><label for="4_1_less_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_less_9" name="floor_4_weed" value="2"><label for="4_1_less_9"></label></div></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table class="table2 table-borderless" id="text2"> 
                                                                    <tr>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_1_sed_n" name="check_floor_4" value="1"><label for="4_1_sed_n"></label></div></td>
                                                                        <td>ปกติ</td>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_1_sed_l" name="check_floor_4" value="2"><label for="4_1_sed_l"></label></div></td>
                                                                        <td>น้อย</td>
                                                                    </tr>
                                                                </table>
                                                            </td> 
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_1" name="floor_4_erosion" value="3"><label for="4_1_mid_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_2" name="floor_4_subsidence" value="3"><label for="4_1_mid_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_3" name="floor_4_cracking" value="3"><label for="4_1_mid_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_4" name="floor_4_obstruction" value="3"><label for="4_1_mid_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_5" name="floor_4_hole" value="3"><label for="4_1_mid_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_6" name="floor_4_leak" value="3"><label for="4_1_mid_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_7" name="floor_4_movement" value="3"><label for="4_1_mid_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_8" name="floor_4_drainage" value="3"><label for="4_1_mid_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_mid_9" name="floor_4_weed" value="3"><label for="4_1_mid_9"></label></div></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table class="table2 table-borderless" id="text2"> 
                                                                    <tr>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_1_sed_md" name="check_floor_4" value="3"><label for="4_1_sed_md"></label></div></td>
                                                                        <td>กลาง</td>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_1_sed_m" name="check_floor_4" value="4"><label for="4_1_sed_m"></label></div></td>
                                                                        <td>มาก</td>
                                                                    </tr>
                                                                </table>
                                                            </td> 
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_1" name="floor_4_erosion" value="4"><label for="4_1_more_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_2" name="floor_4_subsidence" value="4"><label for="4_1_more_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_3" name="floor_4_cracking" value="4"><label for="4_1_more_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_4" name="floor_4_obstruction" value="4"><label for="4_1_more_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_5" name="floor_4_hole" value="4"><label for="4_1_more_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_6" name="floor_4_leak" value="4"><label for="4_1_more_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_7" name="floor_4_movement" value="4"><label for="4_1_more_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_8" name="floor_4_drainage" value="4"><label for="4_1_more_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_1_more_9" name="floor_4_weed" value="4"><label for="4_1_more_9"></label></div></td>
                                                                      
                                                        </tr>
                                                      <!-- 4.2 -->
                                                        <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">4.2 ลาดด้านข้าง</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_1" name="side_4_erosion" value="1"><label for="4_2_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_2" name="side_4_subsidence" value="1"><label for="4_2_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_3" name="side_4_cracking" value="1"><label for="4_2_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_4" name="side_4_obstruction" value="1"><label for="4_2_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_5" name="side_4_hole" value="1"><label for="4_2_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_6" name="side_4_leak" value="1"><label for="4_2_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_7" name="side_4_movement" value="1"><label for="4_2_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_8" name="side_4_drainage" value="1"><label for="4_2_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_normal_9" name="side_4_weed" value="1"><label for="4_2_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="4_2_normal_9" name="side_4_damage" class="form-control" placeholder=""></textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_2_normal_11_no" name="side_4_remake[no]" value="1"><label for="4_2_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_2_normal_11_nosee" name="side_4_remake[nosee]" value="1"><label for="4_2_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r42" name="side_4_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_less_1" name="side_4_erosion" value="2"><label for="4_2_less_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_less_2" name="side_4_subsidence" value="2"><label for="4_2_less_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_less_3" name="side_4_cracking" value="2"><label for="4_2_less_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_less_4" name="side_4_obstruction" value="2"><label for="4_2_less_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_less_5" name="side_4_hole" value="2"><label for="4_2_less_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_less_6" name="side_4_leak" value="2"><label for="4_2_less_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_less_7" name="side_4_movement" value="2"><label for="4_2_less_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_less_8" name="side_4_drainage" value="2"><label for="4_2_less_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_less_9" name="side_4_weed" value="2"><label for="4_2_less_9"></label></div></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_mid_1" name="side_4_erosion" value="3"><label for="4_2_mid_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_mid_2" name="side_4_subsidence" value="3"><label for="4_2_mid_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_mid_3" name="side_4_cracking" value="3"><label for="4_2_mid_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_mid_4" name="side_4_obstruction" value="3"><label for="4_2_mid_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_mid_5" name="side_4_hole" value="3"><label for="4_2_mid_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_mid_6" name="side_4_leak" value="3"><label for="4_2_mid_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_mid_7" name="side_4_movement" value="3"><label for="4_2_mid_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_mid_8" name="side_4_drainage" value="3"><label for="4_2_mid_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_mid_9" name="side_4_weed" value="3"><label for="4_2_mid_9"></label></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_more_1" name="side_4_erosion" value="4"><label for="4_2_more_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_more_2" name="side_4_subsidence" value="4"><label for="4_2_more_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_more_3" name="side_4_cracking" value="4"><label for="4_2_more_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_more_4" name="side_4_obstruction" value="4"><label for="4_2_more_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_more_5" name="side_4_hole" value="4"><label for="4_2_more_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_more_6" name="side_4_leak" value="4"><label for="4_2_more_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_more_7" name="side_4_movement" value="4"><label for="4_2_more_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_more_8" name="side_4_drainage" value="4"><label for="4_2_more_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_2_more_9" name="side_4_weed" value="4"><label for="4_2_more_9"></label></div></td>
                                                                      
                                                        </tr>

                                                      <!-- 4.3 -->
                                                        <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">4.3 ฟันตะเข้</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_1" name="flrblock_4_erosion" value="1"><label for="4_3_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_2" name="flrblock_4_subsidence" value="1"><label for="4_3_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_3" name="flrblock_4_cracking" value="1"><label for="4_3_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_4" name="flrblock_4_obstruction" value="1"><label for="4_3_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_5" name="flrblock_4_hole" value="1"><label for="4_3_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_6" name="flrblock_4_leak" value="1"><label for="4_3_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_7" name="flrblock_4_movement" value="1"><label for="4_3_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_8" name="flrblock_4_drainage" value="1"><label for="4_3_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_normal_9" name="flrblock_4_weed" value="1"><label for="4_3_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="4_3_normal_9" name="flrblock_4_damage" class="form-control" placeholder=""></textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_3_normal_11_no" name="flrblock_4_remake[no]" value="1"><label for="4_3_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_3_normal_11_nosee" name="flrblock_4_remake[nosee]" value="1"><label for="4_3_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r43" name="flrblock_4_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_less_1" name="flrblock_4_erosion" value="2"><label for="4_3_less_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_less_2" name="flrblock_4_subsidence" value="2"><label for="4_3_less_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_less_3" name="flrblock_4_cracking" value="2"><label for="4_3_less_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_less_4" name="flrblock_4_obstruction" value="2"><label for="4_3_less_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_less_5" name="flrblock_4_hole" value="2"><label for="4_3_less_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_less_6" name="flrblock_4_leak" value="2"><label for="4_3_less_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_less_7" name="flrblock_4_movement" value="2"><label for="4_3_less_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_less_8" name="flrblock_4_drainage" value="2"><label for="4_3_less_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_less_9" name="flrblock_4_weed" value="2"><label for="4_3_less_9"></label></div></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_mid_1" name="flrblock_4_erosion" value="3"><label for="4_3_mid_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_mid_2" name="flrblock_4_subsidence" value="3"><label for="4_3_mid_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_mid_3" name="flrblock_4_cracking" value="3"><label for="4_3_mid_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_mid_4" name="flrblock_4_obstruction" value="3"><label for="4_3_mid_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_mid_5" name="flrblock_4_hole" value="3"><label for="4_3_mid_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_mid_6" name="flrblock_4_leak" value="3"><label for="4_3_mid_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_mid_7" name="flrblock_4_movement" value="3"><label for="4_3_mid_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_mid_8" name="flrblock_4_drainage" value="3"><label for="4_3_mid_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_mid_9" name="flrblock_4_weed" value="3"><label for="4_3_mid_9"></label></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_more_1" name="flrblock_4_erosion" value="4"><label for="4_3_more_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_more_2" name="flrblock_4_subsidence" value="4"><label for="4_3_more_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_more_3" name="flrblock_4_cracking" value="4"><label for="4_3_more_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_more_4" name="flrblock_4_obstruction" value="4"><label for="4_3_more_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_more_5" name="flrblock_4_hole" value="4"><label for="4_3_more_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_more_6" name="flrblock_4_leak" value="4"><label for="4_3_more_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_more_7" name="flrblock_4_movement" value="4"><label for="4_3_more_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_more_8" name="flrblock_4_drainage" value="4"><label for="4_3_more_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_3_more_9" name="flrblock_4_weed" value="4"><label for="4_3_more_9"></label></div></td>
                                                                      
                                                        </tr>
                                                      <!-- 4.4 -->
                                                        <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">4.4 แผงปะทะด้านท้ายน้ำ</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_1" name="endsill_4_erosion" value="1"><label for="4_4_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_2" name="endsill_4_subsidence" value="1"><label for="4_4_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_3" name="endsill_4_cracking" value="1"><label for="4_4_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_4" name="endsill_4_obstruction" value="1"><label for="4_4_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_5" name="endsill_4_hole" value="1"><label for="4_4_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_6" name="endsill_4_leak" value="1"><label for="4_4_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_7" name="endsill_4_movement" value="1"><label for="4_4_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_8" name="endsill_4_drainage" value="1"><label for="4_4_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_normal_9" name="endsill_4_weed" value="1"><label for="4_4_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="4_4_normal_9" name="endsill_4_damage" class="form-control" placeholder=""></textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_4_normal_11_no" name="endsill_4_remake[no]" value="1"><label for="4_4_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="4_4_normal_11_nosee" name="endsill_4_remake[nosee]" value="1"><label for="4_4_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r44" name="endsill_4_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_less_1" name="endsill_4_erosion" value="2"><label for="4_4_less_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_less_2" name="endsill_4_subsidence" value="2"><label for="4_4_less_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_less_3" name="endsill_4_cracking" value="2"><label for="4_4_less_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_less_4" name="endsill_4_obstruction" value="2"><label for="4_4_less_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_less_5" name="endsill_4_hole" value="2"><label for="4_4_less_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_less_6" name="endsill_4_leak" value="2"><label for="4_4_less_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_less_7" name="endsill_4_movement" value="2"><label for="4_4_less_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_less_8" name="endsill_4_drainage" value="2"><label for="4_4_less_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_less_9" name="endsill_4_weed" value="2"><label for="4_4_less_9"></label></div></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_mid_1" name="endsill_4_erosion" value="3"><label for="4_4_mid_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_mid_2" name="endsill_4_subsidence" value="3"><label for="4_4_mid_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_mid_3" name="endsill_4_cracking" value="3"><label for="4_4_mid_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_mid_4" name="endsill_4_obstruction" value="3"><label for="4_4_mid_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_mid_5" name="endsill_4_hole" value="3"><label for="4_4_mid_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_mid_6" name="endsill_4_leak" value="3"><label for="4_4_mid_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_mid_7" name="endsill_4_movement" value="3"><label for="4_4_mid_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_mid_8" name="endsill_4_drainage" value="3"><label for="4_4_mid_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_mid_9" name="endsill_4_weed" value="3"><label for="4_4_mid_9"></label></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_more_1" name="endsill_4_erosion" value="4"><label for="4_4_more_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_more_2" name="endsill_4_subsidence" value="4"><label for="4_4_more_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_more_3" name="endsill_4_cracking" value="4"><label for="4_4_more_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_more_4" name="endsill_4_obstruction" value="4"><label for="4_4_more_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_more_5" name="endsill_4_hole" value="4"><label for="4_4_more_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_more_6" name="endsill_4_leak" value="4"><label for="4_4_more_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_more_7" name="endsill_4_movement" value="4"><label for="4_4_more_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_more_8" name="endsill_4_drainage" value="4"><label for="4_4_more_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="4_4_more_9" name="endsill_4_weed" value="4"><label for="4_4_more_9"></label></div></td>
                                                                      
                                                        </tr>
                                                      <!-- 5 -->
                                                        <tr> 
                                                          <th colspan="13" id="text1">5. ส่วน Protection ท้ายน้ำ (Downstream Protection Section) </th>
                                                        </tr>
                                                        <!-- 5.1 -->
                                                          <tr>
                                                            <th id="text2">5.1 พื้น</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_1" name="floor_5_erosion" value="1"><label for="5_1_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_2" name="floor_5_subsidence" value="1"><label for="5_1_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_3" name="floor_5_cracking" value="1"><label for="5_1_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_4" name="floor_5_obstruction" value="1"><label for="5_1_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_5" name="floor_5_hole" value="1"><label for="5_1_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_6" name="floor_5_leak" value="1"><label for="5_1_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_7" name="floor_5_movement" value="1"><label for="5_1_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_8" name="floor_5_drainage" value="1"><label for="5_1_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_normal_9" name="floor_5_weed" value="1"><label for="5_1_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="5_1_normal_9" name="floor_5_damage" class="form-control" placeholder=""></textarea>
                                                            </td>
                                                            <td rowspan="4" width="10%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_1_normal_11_no" name="floor_5_remake[no]" value="1"><label for="5_1_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_1_normal_11_nosee" name="floor_5_remake[nosee]" value="1"><label for="5_1_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r51" name="floor_5_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td id="text2">ตะกอน</td> 
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_less_1"name="floor_5_erosion" value="2"><label for="5_1_less_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_less_2" name="floor_5_subsidence" value="2"><label for="5_1_less_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_less_3" name="floor_5_cracking" value="2"><label for="5_1_less_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_less_4" name="floor_5_obstruction" value="2"><label for="5_1_less_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_less_5" name="floor_5_hole" value="2"><label for="5_1_less_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_less_6" name="floor_5_leak" value="2"><label for="5_1_less_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_less_7" name="floor_5_movement" value="2"><label for="5_1_less_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_less_8" name="floor_5_drainage" value="2"><label for="5_1_less_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_less_9" name="floor_5_weed" value="2"><label for="5_1_less_9"></label></div></td>
                                                            
                                                          </tr>
                                                          <tr>
                                                             <td>
                                                                <table class="table2 table-borderless" id="text2"> 
                                                                    <tr>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_1_sed_n" name="check_floor_5" value="1"><label for="5_1_sed_n"></label></div></td>
                                                                        <td>ปกติ</td>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_1_sed_l" name="check_floor_5" value="2"><label for="5_1_sed_l"></label></div></td>
                                                                        <td>น้อย</td>
                                                                    </tr>
                                                                </table>
                                                            </td> 
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_mid_1" name="floor_5_erosion" value="3"><label for="5_1_mid_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_mid_2" name="floor_5_subsidence" value="3"><label for="5_1_mid_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_mid_3" name="floor_5_cracking" value="3"><label for="5_1_mid_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_mid_4" name="floor_5_obstruction" value="3"><label for="5_1_mid_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_mid_5" name="floor_5_hole" value="3"><label for="5_1_mid_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_mid_6" name="floor_5_leak" value="3"><label for="5_1_mid_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_mid_7" name="floor_5_movement" value="3"><label for="5_1_mid_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_mid_8" name="floor_5_drainage" value="3"><label for="5_1_mid_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_mid_9" name="floor_5_weed" value="3"><label for="5_1_mid_9"></label></div></td>
                                                            
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                                <table class="table2 table-borderless" id="text2"> 
                                                                    <tr>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_1_sed_md" name="check_floor_5" value="3"><label for="5_1_sed_md"></label></div></td>
                                                                        <td>กลาง</td>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_1_sed_m" name="check_floor_5" value="4"><label for="5_1_sed_m"></label></div></td>
                                                                        <td>มาก</td>
                                                                    </tr>
                                                                </table>
                                                            </td> 
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_more_1" name="floor_5_erosion" value="4"><label for="5_1_more_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_more_2" name="floor_5_subsidence" value="4"><label for="5_1_more_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_more_3" name="floor_5_cracking" value="4"><label for="5_1_more_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_more_4" name="floor_5_obstruction" value="4"><label for="5_1_more_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_more_5" name="floor_5_hole" value="4"><label for="5_1_more_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_more_6" name="floor_5_leak" value="4"><label for="5_1_more_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_more_7" name="floor_5_movement" value="4"><label for="5_1_more_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_more_8" name="floor_5_drainage" value="4"><label for="5_1_more_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_1_more_9" name="floor_5_weed" value="4"><label for="5_1_more_9"></label></div></td>
                                                                      
                                                          </tr>
                                                        <!-- 5.2 -->
                                                          <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">5.2 ลาดด้านข้าง</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_1" name="side_5_erosion" value="1"><label for="5_2_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_2" name="side_5_subsidence" value="1"><label for="5_2_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_3" name="side_5_cracking" value="1"><label for="5_2_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_4" name="side_5_obstruction" value="1"><label for="5_2_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_5" name="side_5_hole" value="1"><label for="5_2_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_6" name="side_5_leak" value="1"><label for="5_2_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_7" name="side_5_movement" value="1"><label for="5_2_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_8" name="side_5_drainage" value="1"><label for="5_2_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_normal_9" name="side_5_weed" value="1"><label for="5_2_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="5_2_normal_9" name="side_5_damage" class="form-control" placeholder=""></textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_2_normal_11_no" name="side_5_remake[no]" value="1"><label for="5_2_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="5_2_normal_11_nosee" name="side_5_remake[nosee]" value="1"><label for="5_2_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r52" name="side_5_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_less_1" name="side_5_erosion" value="2"><label for="5_2_less_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_less_2" name="side_5_subsidence" value="2"><label for="5_2_less_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_less_3" name="side_5_cracking" value="2"><label for="5_2_less_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_less_4" name="side_5_obstruction" value="2"><label for="5_2_less_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_less_5" name="side_5_hole" value="2"><label for="5_2_less_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_less_6" name="side_5_leak" value="2"><label for="5_2_less_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_less_7" name="side_5_movement" value="2"><label for="5_2_less_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_less_8" name="side_5_drainage" value="2"><label for="5_2_less_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_less_9" name="side_5_weed" value="2"><label for="5_2_less_9"></label></div></td>
                                                          </tr>
                                                          <tr>
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_mid_1" name="side_5_erosion" value="3"><label for="5_2_mid_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_mid_2" name="side_5_subsidence" value="3"><label for="5_2_mid_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_mid_3" name="side_5_cracking" value="3"><label for="5_2_mid_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_mid_4" name="side_5_obstruction" value="3"><label for="5_2_mid_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_mid_5" name="side_5_hole" value="3"><label for="5_2_mid_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_mid_6" name="side_5_leak" value="3"><label for="5_2_mid_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_mid_7" name="side_5_movement" value="3"><label for="5_2_mid_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_mid_8" name="side_5_drainage" value="3"><label for="5_2_mid_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_mid_9" name="side_5_weed" value="3"><label for="5_2_mid_9"></label></div></td>
                                                          </tr>
                                                          <tr>
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_more_1" name="side_5_erosion" value="4"><label for="5_2_more_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_more_2" name="side_5_subsidence" value="4"><label for="5_2_more_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_more_3" name="side_5_cracking" value="4"><label for="5_2_more_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_more_4" name="side_5_obstruction" value="4"><label for="5_2_more_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_more_5" name="side_5_hole" value="4"><label for="5_2_more_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_more_6" name="side_5_leak" value="4"><label for="5_2_more_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_more_7" name="side_5_movement" value="4"><label for="5_2_more_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_more_8" name="side_5_drainage" value="4"><label for="5_2_more_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="5_2_more_9" name="side_5_weed" value="4"><label for="5_2_more_9"></label></div></td>
                                                                      
                                                          </tr>
                                                    <!-- 6 -->
                                                        <tr> 
                                                            <th colspan="13" id="text1">6. ระบบส่งน้ำ </th>
                                                        </tr>
                                                        <!-- 6.1 -->
                                                          <tr>
                                                            <th id="text2">6.1 พื้น</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_1" name="floor_6_erosion" value="1"><label for="6_1_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_2" name="floor_6_subsidence" value="1"><label for="6_1_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_3" name="floor_6_cracking" value="1"><label for="6_1_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_4" name="floor_6_obstruction" value="1"><label for="6_1_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_5" name="floor_6_hole" value="1"><label for="6_1_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_6" name="floor_6_leak" value="1"><label for="6_1_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_7" name="floor_6_movement" value="1"><label for="6_1_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_8" name="floor_6_drainage" value="1"><label for="6_1_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_normal_9" name="floor_6_weed" value="1"><label for="6_1_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="6_1_normal_9" name="floor_6_damage" class="form-control" placeholder=""></textarea>
                                                            </td>
                                                            <td rowspan="4" width="10%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_1_normal_11_no" name="floor_6_remake[no]" value="1"><label for="6_1_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_1_normal_11_nosee" name="floor_6_remake[nosee]" value="1"><label for="6_1_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r61" name="floor_6_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td id="text2">ตะกอน</td> 
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_less_1"name="floor_6_erosion" value="2"><label for="6_1_less_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_less_2" name="floor_6_subsidence" value="2"><label for="6_1_less_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_less_3" name="floor_6_cracking" value="2"><label for="6_1_less_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_less_4" name="floor_6_obstruction" value="2"><label for="6_1_less_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_less_5" name="floor_6_hole" value="2"><label for="6_1_less_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_less_6" name="floor_6_leak" value="2"><label for="6_1_less_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_less_7" name="floor_6_movement" value="2"><label for="6_1_less_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_less_8" name="floor_6_drainage" value="2"><label for="6_1_less_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_less_9" name="floor_6_weed" value="2"><label for="6_1_less_9"></label></div></td>
                                                           
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                                <table class="table2 table-borderless" id="text2"> 
                                                                    <tr>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_1_sed_n" name="check_floor_6" value="ปกติ"><label for="6_1_sed_n"></label></div></td>
                                                                        <td>ปกติ</td>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_1_sed_l" name="check_floor_6" value="น้อย"><label for="6_1_sed_l"></label></div></td>
                                                                        <td>น้อย</td>
                                                                    </tr>
                                                                </table>
                                                            </td> 
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_mid_1" name="floor_6_erosion" value="3"><label for="6_1_mid_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_mid_2" name="floor_6_subsidence" value="3"><label for="6_1_mid_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_mid_3" name="floor_6_cracking" value="3"><label for="6_1_mid_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_mid_4" name="floor_6_obstruction" value="3"><label for="6_1_mid_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_mid_5" name="floor_6_hole" value="3"><label for="6_1_mid_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_mid_6" name="floor_6_leak" value="3"><label for="6_1_mid_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_mid_7" name="floor_6_movement" value="3"><label for="6_1_mid_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_mid_8" name="floor_6_drainage" value="3"><label for="6_1_mid_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_mid_9" name="floor_6_weed" value="3"><label for="6_1_mid_9"></label></div></td>
                                                           
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                                <table class="table2 table-borderless" id="text2"> 
                                                                    <tr>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_1_sed_md" name="check_floor_6" value="กลาง"><label for="6_1_sed_md"></label></div></td>
                                                                        <td>กลาง</td>
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_1_sed_m" name="check_floor_6" value="มาก"><label for="6_1_sed_m"></label></div></td>
                                                                        <td>มาก</td>
                                                                    </tr>
                                                                </table>
                                                            </td> 
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_more_1" name="floor_6_erosion" value="4"><label for="6_1_more_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_more_2" name="floor_6_subsidence" value="4"><label for="6_1_more_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_more_3" name="floor_6_cracking" value="4"><label for="6_1_more_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_more_4" name="floor_6_obstruction" value="4"><label for="6_1_more_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_more_5" name="floor_6_hole" value="4"><label for="6_1_more_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_more_6" name="floor_6_leak" value="4"><label for="6_1_more_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_more_7" name="floor_6_movement" value="4"><label for="6_1_more_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_more_8" name="floor_6_drainage" value="4"><label for="6_1_more_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_1_more_9" name="floor_6_weed" value="4"><label for="6_1_more_9"></label></div></td>
                                                                      
                                                          </tr>

                                                        <!-- 6.2 -->
                                                          <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">6.2 ลาดด้านข้าง</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_1" name="side_6_erosion" value="1"><label for="6_2_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_2" name="side_6_subsidence" value="1"><label for="6_2_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_3" name="side_6_cracking" value="1"><label for="6_2_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_4" name="side_6_obstruction" value="1"><label for="6_2_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_5" name="side_6_hole" value="1"><label for="6_2_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_6" name="side_6_leak" value="1"><label for="6_2_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_7" name="side_6_movement" value="1"><label for="6_2_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_8" name="side_6_drainage" value="1"><label for="6_2_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_normal_9" name="side_6_weed" value="1"><label for="6_2_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="6_2_normal_9" name="5_side_damage" class="form-control" placeholder=""></textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_2_normal_11_no" name="5_side_remake[no]" value="1"><label for="6_2_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_2_normal_11_nosee" name="5_side_remake[nosee]" value="1"><label for="6_2_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r62" name="5_side_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_less_1" name="side_6_erosion" value="2"><label for="6_2_less_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_less_2" name="side_6_subsidence" value="2"><label for="6_2_less_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_less_3" name="side_6_cracking" value="2"><label for="6_2_less_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_less_4" name="side_6_obstruction" value="2"><label for="6_2_less_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_less_5" name="side_6_hole" value="2"><label for="6_2_less_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_less_6" name="side_6_leak" value="2"><label for="6_2_less_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_less_7" name="side_6_movement" value="2"><label for="6_2_less_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_less_8" name="side_6_drainage" value="2"><label for="6_2_less_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_less_9" name="side_6_weed" value="2"><label for="6_2_less_9"></label></div></td>
                                                           
                                                          </tr>
                                                          <tr>
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_mid_1" name="side_6_erosion" value="3"><label for="6_2_mid_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_mid_2" name="side_6_subsidence" value="3"><label for="6_2_mid_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_mid_3" name="side_6_cracking" value="3"><label for="6_2_mid_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_mid_4" name="side_6_obstruction" value="3"><label for="6_2_mid_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_mid_5" name="side_6_hole" value="3"><label for="6_2_mid_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_mid_6" name="side_6_leak" value="3"><label for="6_2_mid_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_mid_7" name="side_6_movement" value="3"><label for="6_2_mid_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_mid_8" name="side_6_drainage" value="3"><label for="6_2_mid_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_mid_9" name="side_6_weed" value="3"><label for="6_2_mid_9"></label></div></td>
                                                          </tr>
                                                          <tr>
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_more_1" name="side_6_erosion" value="4"><label for="6_2_more_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_more_2" name="side_6_subsidence" value="4"><label for="6_2_more_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_more_3" name="side_6_cracking" value="4"><label for="6_2_more_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_more_4" name="side_6_obstruction" value="4"><label for="6_2_more_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_more_5" name="side_6_hole" value="4"><label for="6_2_more_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_more_6" name="side_6_leak" value="4"><label for="6_2_more_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_more_7" name="side_6_movement" value="4"><label for="6_2_more_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_more_8" name="side_6_drainage" value="4"><label for="6_2_more_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_2_more_9" name="side_6_weed" value="4"><label for="6_2_more_9"></label></div></td>
                                                                      
                                                          </tr>

                                                                  
                                                        <!-- 6.3 -->
                                                          <tr>
                                                            <th id="text2" rowspan="4" style="vertical-align: top;">6.3 ปากตูน้ำ/ปากคลอง</th> 
                                                            <td>ปกติ</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_1" name="gate_6_erosion" value="1"><label for="6_3_normal_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_2" name="gate_6_subsidence" value="1"><label for="6_3_normal_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_3" name="gate_6_cracking" value="1"><label for="6_3_normal_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_4" name="gate_6_obstruction" value="1"><label for="6_3_normal_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_5" name="gate_6_hole" value="1"><label for="6_3_normal_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_6" name="gate_6_leak" value="1"><label for="6_3_normal_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_7" name="gate_6_movement" value="1"><label for="6_3_normal_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_8" name="gate_6_drainage" value="1"><label for="6_3_normal_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_normal_9" name="gate_6_weed" value="1"><label for="6_3_normal_9"></label></div></td>
                                                            <td rowspan="4" width="8%" style="vertical-align: top;">
                                                                <textarea rows="7" cols="5" id="6_3_normal_9" name="gate_6_damage" class="form-control" placeholder=""></textarea>
                                                            </td>
                                                            <td rowspan="4" width="8%">
                                                                <table class="table2 table-borderless" id="text2" style="vertical-align: top;"> 
                                                                    <tr>
                                                                        <td ><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_3_normal_11_no" name="gate_6_remake[no]" value="1"><label for="6_3_normal_11_no"></label></div></td>
                                                                        <td>ไม่มี</td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td><div class="checkbox-color1 checkbox-primary"><input type="checkbox" id="6_3_normal_11_nosee" name="gate_6_remake[nosee]" value="1"><label for="6_3_normal_11_nosee"></label></div></td>
                                                                        <td>มองไม่เห็น</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td > อื่นๆ </td>
                                                                        <td><input id="weir_note_r63" name="gate_6_remake[detail]" type="text" class=" form-control" placeholder=""> </td>

                                                                    </tr>
                                                                    <tr><td>&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            
                                                            <td>น้อย</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_less_1" name="gate_6_erosion" value="2"><label for="6_3_less_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_less_2" name="gate_6_subsidence" value="2"><label for="6_3_less_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_less_3" name="gate_6_cracking" value="2"><label for="6_3_less_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_less_4" name="gate_6_obstruction" value="2"><label for="6_3_less_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_less_5" name="gate_6_hole" value="2"><label for="6_3_less_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_less_6" name="gate_6_leak" value="2"><label for="6_3_less_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_less_7" name="gate_6_movement" value="2"><label for="6_3_less_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_less_8" name="gate_6_drainage" value="2"><label for="6_3_less_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_less_9" name="gate_6_weed" value="2"><label for="6_3_less_9"></label></div></td>
                                                           
                                                          </tr>
                                                          <tr>
                                                            <td>ปานกลาง</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_mid_1" name="gate_6_erosion" value="3"><label for="6_3_mid_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_mid_2" name="gate_6_subsidence" value="3"><label for="6_3_mid_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_mid_3" name="gate_6_cracking" value="3"><label for="6_3_mid_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_mid_4" name="gate_6_obstruction" value="3"><label for="6_3_mid_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_mid_5" name="gate_6_hole" value="3"><label for="6_3_mid_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_mid_6" name="gate_6_leak" value="3"><label for="6_3_mid_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_mid_7" name="gate_6_movement" value="3"><label for="6_3_mid_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_mid_8" name="gate_6_drainage" value="3"><label for="6_3_mid_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_mid_9" name="gate_6_weed" value="3"><label for="6_3_mid_9"></label></div></td>
                                                          </tr>
                                                          <tr>
                                                            <td>มาก</td>
                                                            <td ><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_more_1" name="gate_6_erosion" value="4"><label for="6_3_more_1"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_more_2" name="gate_6_subsidence" value="4"><label for="6_3_more_2"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_more_3" name="gate_6_cracking" value="4"><label for="6_3_more_3"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_more_4" name="gate_6_obstruction" value="4"><label for="6_3_more_4"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_more_5" name="gate_6_hole" value="4"><label for="6_3_more_5"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_more_6" name="gate_6_leak" value="4"><label for="6_3_more_6"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_more_7" name="gate_6_movement" value="4"><label for="6_3_more_7"></label> </div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_more_8" name="gate_6_drainage" value="4"><label for="6_3_more_8"></label></div></td>
                                                            <td><div class="checkbox-color checkbox-primary"><input type="checkbox" id="6_3_more_9" name="gate_6_weed" value="4"><label for="6_3_more_9"></label></div></td>
                                                          </tr>
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
                                                        <input class="border-checkbox" type="checkbox" id="plan_year_check" name="plan_year_check" value="1">
                                                        <label class="border-checkbox-label" for="plan_year_check"> อยู่ในแผน
                                                         <input id="plan_year" name="plan_year" type="text" class="form-control" placeholder="ปี" style="margin-top:-30px;margin-left:80px;width:100px;">
                                                        </label>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        ลักษณะโครงการ<input id="plan_type" name="plan_type" type="text" class=" form-control" placeholder="ระบุ" style="margin-top:-30px;margin-left:120px;width:180px;">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        งบประมาณ<input id="plan_budget" name="plan_budget" type="text" class=" form-control" placeholder="(บาท)" style="margin-top:-30px;margin-left:80px;">
                                                    </div>
                                                  </div>
                                                <!-- ได้รับงบประมาณแล้ว -->
                                                  <div class="form-group row">
                                                    <div class="col-sm-4">
                                                      <div class="border-checkbox-group border-checkbox-group-primary">
                                                         <input class="border-checkbox" type="checkbox" id="proj_budget_check" name="proj_budget_check" value="1">
                                                         <label class="border-checkbox-label" for="proj_budget_check"> ได้รับงบประมาณแล้ว
                                                            <input id="proj_budget" name="proj_budget" type="text" class="form-control" placeholder="(บาท)" style="margin-top:-30px;margin-left:160px;width:120px;">
                                                         </label>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                       ลักษณะโครงการ<input id="proj_type" name="proj_type" type="text" class=" form-control" placeholder="ระบุ" style="margin-top:-30px;margin-left:120px;width:180px;">
                                                    </div>
                                                  </div>
                                                <!-- กำลังปรับปรุงกรือก่อสร้าง -->
                                                  <div class="form-group row">
                                                    <div class="col-sm-4">
                                                      <div class="border-checkbox-group border-checkbox-group-primary">
                                                        <input class="border-checkbox" type="checkbox" id="plan_improve" name="plan_improve" value="1">
                                                        <label class="border-checkbox-label" for="plan_improve"> กำลังปรับปรุงกรือก่อสร้าง
                                                      </div>
                                                    </div>
                                                  </div>
                                                <!-- ยังไม่มีในแผน -->
                                                  <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                                            <input class="border-checkbox" type="checkbox" id="plan_no" name="plan_no" value="1">
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
                                                    <textarea rows="5" cols="5" id="suggustion" name="suggustion" class="form-control" placeholder="--ระบุความเห็นเพิ่มเติม--"></textarea>
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
                                                <h5> 1. ส่วน Protection เหนือน้ำ (Upstream Protection Section)
                                                <input type="file" id="upstream_protection" name="upstream_protection[]" multiple /> </h5>
                                               </div>
                                            </div>
                                            <div class="form-group row" >
                                             <div class="field" >
                                                <h5> 2. ส่วนเหนือน้ำ (Upstream Concrete Section) </h5>
                                                <input type="file" id="upstream_concrete" name="upstream_concrete[]" multiple />
                                               </div>
                                            </div>
                                            <div class="form-group row" >
                                              <div class="field" >
                                                <h5> 3. ส่วนควบคุม (Control Sector) </h5>
                                                <input type="file" id="control" name="control[]" multiple />
                                               </div>
                                            </div>
                                            <div class="form-group row" >
                                              <div class="field" >
                                                <h5> 4. ส่วนท้ายน้ำ (Downstream Concrete Section) </h5>
                                                <input type="file" id="downstream_concrete" name="downstream_concrete[]" multiple />
                                               </div>
                                            </div>
                                            <div class="form-group row" >
                                              <div class="field" align="left">
                                                <h5> 5. ส่วน Protection ท้ายน้ำ (Downstream Protection Section) </h5>
                                                <input type="file" id="downstream_protection" name="downstream_protection[]" multiple />
                                               </div>
                                            </div>
                                            <div class="form-group row" >
                                             <div class="field" align="left">
                                                <h5> 6. ระบบส่งน้ำ </h5>
                                                <input type="file" id="water_system" name="water_system[]" multiple />
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
                                                          <h3>กรุณาตรวจสอบข้อมูล <br>ให้เรียบร้อยก่อนการบันทึก </h3>
                                                      </div>
                                                      <div class="card-block" align="center">
                                                        <img src="{{ asset('images/icon/green-check.jpg') }}" width="50%">
                                                        <br>
                                                        <button type="submit" class="btn waves-effect waves-light btn-primary btn-block" >บันทึกข้อมูล</button>
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
