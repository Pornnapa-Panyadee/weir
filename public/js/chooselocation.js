
var ID = window.location.href.replace("http://weir.crflood.com/", "");
// var ID = window.location.href.replace("http://localhost/weir-cr/public/", "");
// alert(ID);

function Province(id,district) {
  
  $('#weir_district').find('option').not(':first').remove();
  // AJAX request 
  $.ajax({
    url: 'getdistrict/' + id,
        //  url: 'https://survey.crflood.com/getdistrict/' + id,
        //url: link+'getVillage/' + id,
 
    type: 'get',
    dataType: 'json',
    success: function (response) {

      var len = 0;
      if (response['data'] != null) {
        len = response['data'].length;
      }

      if (len > 0) {
        // Read data and create <option >
        for (var i = 0; i < len; i++) {

          var id = response['data'][i].vill_id;
          var name = response['data'][i].vill_district;
          var option = "<option value='" + name + "'>" + name + "</option>";
          $("#weir_district").append(option);
          if (district == name) {
            $('#weir_district option:contains(' + district + ')').prop({selected: true});
          }
        }

      }

    }
  });
}


function District(id, tumbol) {


    // Empty the dropdown

    $('#weir_tumbol').find('option').not(':first').remove();
    
    // AJAX request 
    $.ajax({
      // url: 'getTumbol/' + id,
      // url: 'http://localhost/weir-cr/public/getTumbol/' + id,
      url: 'http://weir.crflood.com/getTumbol/' + id,
      // url: link+'getTumbol/' + id,
      type: 'get',
      dataType: 'json',
      success: function (response) {

        var len = 0;
        
        if (response['data'] != null) {
          len = response['data'].length;
        }

        if (len > 0) {
          // Read data and create <option >

          

          for (var i = 0; i < len; i++) {

            var id = response['data'][i].vill_id;
            var name = response['data'][i].vill_tunbol;
            var option = "<option value='" + name + "'>" + name + "</option>";
            $("#weir_tumbol").append(option);
            if (tumbol == name) {
              $('#weir_tumbol option:contains(' + tumbol + ')').prop({selected: true});
            }
          }
        }

      }
    });
}


function Tumbol(dis, id, vill) {
      // Empty the dropdown
      $('#weir_village').find('option').not(':first').remove();
   
      // AJAX request 
      $.ajax({
      url: 'http://weir.crflood.com/getVillage/'+ dis+"/"+ id,
      // url: 'getVillage/' + dis+"/"+ id,
      type: 'get',
      dataType: 'json',
      success: function (response) {
  
        var len = 0;
        if (response['data'] != null) {
          len = response['data'].length;
        }
  
        if (len > 0) {
          // Read data and create <option >
          for (var i = 0; i < len; i++) {
              var name = response['data'][i].vill_name;
              var moo = response['data'][i].vill_moo;
              var village = "หมู่ที่ " + moo + " " + name;
              var option = "<option value='" + village + "'>" + village + "</option>";
  
              $("#weir_village").append(option);
              if (vill == village) {
                $('#weir_village option:contains(' + vill + ')').prop({selected: true});
              }
            }
          }
  
        }
      });
}
// console.log(ID);


$(document).ready(function () {
  // District Change

  $('#blk_province').change(function () {
      let id = $('#blk_province').val();
      //console.log(id)
      Province(id, "0");

  });

});




$(document).ready(function () {
  // District Change

  $('#weir_district').change(function () {
      let id = $('#weir_district').val();
      //console.log(id)
      District(id, "0");

  });

});


$(document).ready(function () {

  $('#weir_district').change(function () {
    var dis = $('#weir_district').val();
    // Tombol Change
    $('#weir_tumbol').change(function () {

      // Tombol name
      var id = $(this).val();
      // alert(dis);
      //alert(id2);
      Tumbol(dis,id, "0");


    });

  });
  

});


