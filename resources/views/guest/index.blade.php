<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8">
    <title>Weir CRflood </title>

    <link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/form/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form/waves.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/form/feather.css')}}">
    <link rel="stylesheet" href="{{ asset('css/form/style1.css')}}">

    <!-- leaflet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" crossorigin=""/>
    <script src='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.2.0/leaflet-omnivore.min.js'></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet-src.js" crossorigin=""></script>
    <!-- <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" />
    <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
    <script src='https://api.tiles.mapbox.com/mapbox.js/v1.6.4/mapbox.js'></script> -->

    <style type="text/css">
      #map{

			  font-family: Mitr, sans-serif;
			  height: 600px;
			  display: block;
              margin: auto;
              text-align: left;
              font-size: 14px;
			}
		  #map.table {
		    font-family: 'Mitr', sans-serif;
		    width: 100%;
		  }#map.tr {
		    padding: 15px;
		    text-align: right;
		  }#map.td {
		    padding: 15px;
		    text-align: right;
        }
        select{
            width: 100%;
            height: 40px;
        }
        button.btn {
            width: 100%;
        }
        @media only screen and (max-width:480px) {
            #map{
                height: 450px;
                font-size: 14px;
            }
            table{
                font-size: 2vw;
            }
            select{
            width: 100%;
            height: 40px;
            }
            button.btn{
            width: 100%;
            }
            .btn-sm{
                font-size: 2vw;
            }
        }

    </style>

  </head>

  <body class="horizontal-icon-fixed">
    @yield('content')
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded" >
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">
        <nav class="navbar header-navbar pcoded-header" header-theme="theme5" >
          <div class="navbar-wrapper">
            <div class="navbar-logo" logo-theme="theme5">  
              <a href="#!"> Weir monitoring and improvement system </a>
              <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu icon-toggle-right"></i>
              </a>
              <a class="mobile-options waves-effect waves-light">
                <i class="feather icon-more-horizontal"></i>
              </a>
            </div>
            <div class="navbar-container container-fluid">
                <ul class="nav-right">
                    <li class="user-profile header-notification">
                        <div class="dropdown-primary dropdown">
                            <div class="dropdown-toggle" data-toggle="dropdown">
                               เข้าสู่ระบบ
                            </div>
                            <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" >
                                <li>
                                    <a href="login">
                                    <i class="feather icon-log-in"></i> Login
                                    </a>
                                </li>
                                <!-- <li>
                                    <a href="register">
                                    <i class="feather icon-clipboard"></i> Register
                                    </a>
                                </li> -->
                                
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
          </div>
        </nav>

        <div class="pcoded-main-container">
          <div class="pcoded-wrapper">
            <nav class="pcoded-navbar">
              <div class="pcoded-inner-navbar">
                <ul class="pcoded-item">
                  <li class="pcoded-hasmenu">
                    <a  href="javascript:void(0)" class="waves-effect waves-dark">
                      <span class="pcoded-mtext"><i class="feather icon-sidebar"></i>  ข้อมูลฝาย</span>
                    </a>
                    <ul class="pcoded-submenu">
                      <li class="">
                        <a href="navbar-light.html" class="waves-effect waves-dark" >
                          <span class="pcoded-mtext" data-i18n="nav.navigate.main" >แผนที่</span>
                        </a>
                      </li>
                      <li class="">
                        <a href="navbar-light.html" class="waves-effect waves-dark" >
                          <span class="pcoded-mtext" data-i18n="nav.navigate.main" >รายงานสภาพฝาย</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                      <span class="pcoded-mtext"><i class="feather icon-box"></i> คลังความรู้</span>
                    </a>
                    <ul class="pcoded-submenu">
                      <li class="">
                        <a href="javascript:void(0)"  class="waves-effect waves-dark">
                          <span class="pcoded-mtext">คู่มือสถานการณ์น้ำท่วม</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
            <!-- Map -->
            <div class="pcoded-content">
              <div class="card"><h3></h3></div>
              <div class="pcoded-inner-content">
                <div class="main-body">
                  <div class="page-wrapper">
                      <div class="page-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="card table-card">
                              <div class="card-header">
                                <h5>โครงการพัฒนาระบบสารสนเทศการตรวจสอบและวางแผนปรับปรุงเพิ่มประสิทธิภาพฝายในพื้นที่จังหวัดเชียงราย</h5>
                                <br>โดยจังหวัดเชียงรายร่วมกับมหาวิทยาลัยเชียงใหม่
                                <div class="card-header-right">
                                  <ul class="list-unstyled card-option">
                                    <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                    <li><i class="feather icon-maximize full-card"></i></li>
                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                    <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                    <li><i class="feather icon-trash close-card"></i></li>
                                    <li><i class="feather icon-chevron-left open-card-option"></i> </li>
                                  </ul>
                                </div>
                                <!-- Map Show -->
                                <div class="card-block p-b-0">
                                  <div id="map"></div>
                                </div>
                                <!-- End Map show -->
                                                        
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
            <!-- End Map -->
          </div>
        </div>

      </div>
    </div>

   
    <script src="{{ asset('js/form/jquery.min.js')}}"></script>
    <script src="{{ asset('js/form/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('js/form/popper.min.js')}}"></script>
    <script src="{{ asset('js/form/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/form/waves.min.js')}}" ></script>
    <script src="{{ asset('js/form/jquery-i18next.min.js')}}" ></script>
    <script src="{{ asset('js/form/pcoded.min.js')}}" ></script>
    <script src="{{ asset('js/form/menu-hori-fixed.js')}}" ></script>
    <script src="{{ asset('js/form/jquery.mcustomscrollbar.concat.min.js')}}" ></script>
    <script src="{{ asset('js/form/script.js')}}"></script>
    <script async  src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    
    <script src="{{ asset('js/form/rocket-loader.min.js')}}"></script>
    
    <!-- Map script -->
    <link rel="stylesheet" href="{{ asset('css/L.Control.Layers.Tree.css')}}" crossorigin=""/>
    <script src="{{ asset('/js/L.Control.Layers.Tree.js')}}"></script>

    <script type="text/javascript">
      var stations1 = new L.LayerGroup();
      var x = 20.15755 ;
      var y = 99.9995964;
      var mbAttr = 'CRFlood ',
          mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoidmFucGFueWEiLCJhIjoiY2loZWl5ZnJ4MGxnNHRwbHp5bmY4ZnNxOCJ9.IooQB0jYS_4QZvIq7gkjeQ';
          osm = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
              maxZoom: 20,subdomains:['mt0','mt1','mt2','mt3'], attribution: mbAttr });
          osmBw = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
                maxZoom: 20,subdomains:['mt0','mt1','mt2','mt3'], attribution: mbAttr });
      var map = L.map('map', {
          layers: [osm,stations1],
          center: [x,y],
          zoom: 9,
        });
      
      var pin = L.icon({
          iconUrl: '{{ asset('images/logo/pin.png') }}',
          iconRetinaUrl:'{{ asset('images/icon/pin.png') }}',
          iconSize: [20, 36],
          iconAnchor: [5, 30],
          popupAnchor: [0, 0]
        });

      var pinMO = L.icon({
          iconUrl: '{{ asset('images/logo/pin.png') }}',
          iconRetinaUrl:'{{ asset('images/icon/pin.png') }}',
          iconSize: [10, 16],
          iconAnchor: [5, 30],
          popupAnchor: [0, 0]
        });
           
      var amp=["แม่ลาว"];
      
      function addPin(ampName,i,mo){
        $.getJSON("{{ asset('form/getDataSurvey') }}/"+amp[i], 
        function (data){
          // alert (data[0].lat);
				  for (i=0;i<data.length;i++){
            // var lo =data[i].geometry.coordinates+ '';;
						var x=data[i].lat;
            var y=data[i].long;
            // alert (x);
            var text ="<font style=\"font-family: 'Mitr';\" size=\"3\"COLOR=#1AA90A > รหัส :" + data[i].weir_code + "</font><br>";
                text1 = "<font style=\"font-family: 'Mitr';\" size=\"2\"COLOR=#466DF3 > ฝาย : "+ data[i].weir_name+ " (ลำน้ำ : "+ data[i].river+")</font><br>";
                text2 = "<font style=\"font-family: 'Mitr';\" size=\"2\"COLOR=#466DF3 >ที่ตั้ง : "+ data[i].weir_village +" ต."+ data[i].weir_tumbol +" อ."+ data[i].weir_district +"</font><br>";
                text3 = "<br><table align=\"center\"><tr><td >" + "<button class=\"btn btn-primary btn-sm waves-effect waves-light\"><i class=\"feather icon-sidebar\"></i> รายงาน</button> </a></td> <td>"+"<button class=\"btn btn-primary btn-sm waves-effect waves-light\"><i class=\"feather icon-eye\"></i> แบบสำรวจ</button> </a>" +"</td><td > " + "<button class=\"btn btn-primary btn-sm waves-effect waves-light\"><i class=\"feather icon-image\"></i> ภาพประกอบ</button> </a></td></tr></table>";
            if(mo==0){
              L.marker([x,y],{icon: pinMO}).addTo(ampName).bindPopup(text+text1+text2+text3);  
            }else{
              L.marker([x,y],{icon: pin}).addTo(ampName).bindPopup(text+text1+text2+text3);  
            }
          }//end for
				});
      }
      
      var mx = window.matchMedia("(max-width: 700px)");
      if(mx.matches){
        mo=0;
        // alert(x.matches);
      }else{
        mo=1;
      }
           
      addPin(stations1,0,mo);

      var baseTree = {
          label: 'BaseLayers',
          noShow: true,
          children: [  {label: ' แผนที่ภูมิประเทศ (Streets)', layer: osm},
                       {label: ' แผนที่ภาพถ่ายผ่านดาวเทียม (Satellite)', layer: osmBw},
          ]
        };
      var overlays = {
          label: ' อำเภอ',
          selectAllCheckbox: true,
          children: [
            { label:" "+amp[0],layer: stations1,}
          ]
        };
      var ctl = L.control.layers.tree(baseTree, null );
          ctl.addTo(map).collapseTree().expandSelected();
          ctl.setOverlayTree(overlays).collapseTree().expandSelected();
    </script>
    
    <!-- End Map  -->
  </body>

</html>
