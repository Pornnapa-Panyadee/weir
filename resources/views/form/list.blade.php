<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8">
    <title>Weir | List Survey</title>

    <link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/form/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form/waves.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/feather.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/themify-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/icofont.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/font-awesome.min.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/datatables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/buttons.datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/responsive.bootstrap4.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/jquery.steps.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/pages.css')}}">

    <style>
      #fix-header{
        font-size:13px;
      }
    </style>
  

</head>

<body >
    
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
                                      <h5>ข้อมูลการตรวจสอบสภาพฝาย</h5>
                                    </div>
                                    <!-- form -->
                                    <div class="card-block">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div id="wizarda">
                                            <section>
                                              <div class="form-group row justify-content-md-end" >
                                                <div class="col-sm-3 " > 
                                                  <a href="form"> <button class="btn waves-effect waves-light btn-primary btn-outline-primary"><i class="fa fa-plus-circle"></i>เพิ่มข้อมูลการตรวจสอบฝาย</button></a>
                                                </div>
                                                <div class="col-sm-2 " > 
                                                  <button class="btn waves-effect waves-light btn-primary btn-outline-primary"><i class="fa fa-home"></i>หน้าแรก</button>
                                                </div>
                                              </div>
                                              <div class="card">
                                                <div class="card-block">
                                                  <div class="row">
                                                    <div class="col-lg-12 col-xl-12">
                                                      <div class="sub-title">รายละเอียดการตรวจสอบฝาย โดย {{$user}}</div>
                                                        <div class="tab-content tabs card-block">
                                                          <div class="tab-pane active" id="home1" role="tabpanel">
                                                            <div class="pcoded-inner-content">
                                                               <div class="main-body">
                                                                <div class="page-wrapper">
                                                                  <div class="page-body">
                                                                    <div class="dt-responsive table-responsive">
                                                                      <table id="fix-header" class="table table-striped table-bordered nowrap">
                                                                        <thead>
                                                                          <tr>
                                                                            <th>#</th>
                                                                            <th>รหัส</th>
                                                                            <th>ชื่อฝาย/ลำน้ำ</th>
                                                                            <th>ที่ตั้ง</th>
                                                                            <th>วันที่เก็บข้อมูล</th>
                                                                            <th></th>
                                                                          </tr>
                                                                         </thead>
                                                                        <tbody>
                                                                          <?php for($i = 0;$i < count($dataUser);$i++){  ?>
                                                                            <tr>
                                                                              <td align="center">{{$i+1}} </td>
                                                                              <td>{{$dataUser[$i]['weir_code']}}</td>
                                                                              <td>{{$dataUser[$i]['weir_name']}}/{{$dataUser[$i]['river']}} </td>
                                                                              <td>{{$dataUser[$i]['weir_village']}} ต.{{$dataUser[$i]['weir_tumbol']}} อ.{{$dataUser[$i]['weir_district']}}  </td>
                                                                              <td>{{$dataUser[$i]['date']}}</td>
                                                                              
                                                                              <td align="center"> 
                                                                                <a href='{{ asset('/pdf') }}/{{$dataUser[$i]['weir_code']}}' target=\"_blank\" ><button class="btn waves-effect waves-dark btn-mini btn-info btn-outline-info"><i class="icofont icofont-eye-alt"></i></button></a>
                                                                                <a href='{{ asset('/edit') }}/{{$dataUser[$i]['weir_code']}}' target=\"_blank\"><button class="btn waves-effect waves-dark btn-mini btn-warning btn-outline-warning"><i class="icofont icofont-edit-alt"></i></button> </a>
                                                                                <a href='{{ asset('/remove') }}/{{$dataUser[$i]['weir_code']}}' target=\"_blank\"><button class="btn waves-effect waves-dark btn-mini btn-danger btn-outline-danger" onclick="myFunction()"><i class="icofont icofont-delete-alt"></i></button></a>
                                                                              </td>
                                                                            </tr>
                                                                          <?php } ?>                                              
                                                                                                                                        
                                                                        </tbody>
                                                                      </table>
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
            </div>
        </div>
      </div>
    </div>


    <script>
      function myFunction() {
        confirm("คุณต้องการลบข้อมูลฝายใช่ไหม?");
      }
    </script>

    <script src="{{ asset('js/form/jquery.min.js')}}"></script>
    <script src="{{ asset('js/form/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('js/form/popper.min.js')}}"></script>
    <script src="{{ asset('js/form/bootstrap.min.js')}}"></script>

    <script src="{{ asset('js/form/waves.min.js')}}" ></script>

    <script src="{{ asset('js/form/jquery.slimscroll.js')}}"></script>

    <script src="{{ asset('js/form/modernizr.js')}}"></script>
    <script src="{{ asset('js/form/css-scrollbars.js')}}"></script>

    <script src="{{ asset('js/form/jquery.datatables.min.js')}}" ></script>
    <script src="{{ asset('js/form/datatables.buttons.min.js')}}" ></script>
    <script src="{{ asset('js/form/jszip.min.js')}}" ></script>
    <script src="{{ asset('js/form/pdfmake.min.js')}}" ></script>
    <script src="{{ asset('js/form/vfs_fonts.js')}}" ></script>
    <script src="{{ asset('js/form/datatables.fixedheader.min.js')}}"></script>

    <script src="{{ asset('js/form/datatables.colreorder.min.js')}}" ></script>
    <script src="{{ asset('js/form/buttons.print.min.js')}}" ></script>
    <script src="{{ asset('js/form/datatables.bootstrap4.min.js')}}" ></script>
    <script src="{{ asset('js/form/datatables.responsive.min.js')}}" ></script>
    <script src="{{ asset('js/form/responsive.bootstrap4.min.js')}}"></script>

    <script src= "{{ asset('js/form/fixed-header-custom.js') }}"></script>

    <script src= "{{ asset('js/form/pcoded.min.js') }}"></script>
    <script src= "{{ asset('js/form/vertical-layout.min.js') }}"></script>
    <script src= "{{ asset('js/form/jquery.mcustomscrollbar.concat.min.js') }}"></script>

    <script src= "{{ asset('js/form/script.js') }}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" ></script>
  
    <script src="{{ asset('js/form/rocket-loader.min.js')}}" data-cf-settings="ce2668daaac54a74e9f6cdff-|49" defer=""></script>



    

</body>

</html>
