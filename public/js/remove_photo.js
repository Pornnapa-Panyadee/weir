$(document).ready(function() {
 if (window.File && window.FileList && window.FileReader) {
    $("#upstream_protection").on("change", function(e) {
     var files = e.target.files,
     filesLength = files.length;
     for (var i = 0; i < filesLength; i++) {
      var f = files[i]
      var fileReader = new FileReader();
      fileReader.onload = (function(e) {
        var file = e.target;
        $("<span class=\"pip\">" +
        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
        "<br/><span class=\"remove\">ลบรูป</span>" +
        "</span>").insertAfter("#upstream_protection");
        $(".remove").click(function(){
        $(this).parent(".pip").remove();
       });
      });
      fileReader.readAsDataURL(f);
      }
    });
 } else {
      alert("Your browser doesn't support to File API")
 }

 if (window.File && window.FileList && window.FileReader) {
    $("#upstream_concrete").on("change", function(e) {
     var files = e.target.files,
     filesLength = files.length;
     for (var i = 0; i < filesLength; i++) {
      var f = files[i]
      var fileReader = new FileReader();
      fileReader.onload = (function(e) {
        var file = e.target;
        $("<span class=\"pip\">" +
        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
        "<br/><span class=\"remove\">ลบรูป</span>" +
        "</span>").insertAfter("#upstream_concrete");
        $(".remove").click(function(){
        $(this).parent(".pip").remove();
       });
      });
      fileReader.readAsDataURL(f);
      }
    });
 } else {
      alert("Your browser doesn't support to File API")
 }

 if (window.File && window.FileList && window.FileReader) {
    $("#control").on("change", function(e) {
     var files = e.target.files,
     filesLength = files.length;
     for (var i = 0; i < filesLength; i++) {
      var f = files[i]
      var fileReader = new FileReader();
      fileReader.onload = (function(e) {
        var file = e.target;
        $("<span class=\"pip\">" +
        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
        "<br/><span class=\"remove\">ลบรูป</span>" +
        "</span>").insertAfter("#control");
        $(".remove").click(function(){
        $(this).parent(".pip").remove();
       });
      });
      fileReader.readAsDataURL(f);
      }
    });
 } else {
      alert("Your browser doesn't support to File API")
 }

 if (window.File && window.FileList && window.FileReader) {
    $("#downstream_concrete").on("change", function(e) {
     var files = e.target.files,
     filesLength = files.length;
     for (var i = 0; i < filesLength; i++) {
      var f = files[i]
      var fileReader = new FileReader();
      fileReader.onload = (function(e) {
        var file = e.target;
        $("<span class=\"pip\">" +
        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
        "<br/><span class=\"remove\">ลบรูป</span>" +
        "</span>").insertAfter("#downstream_concrete");
        $(".remove").click(function(){
        $(this).parent(".pip").remove();
       });
      });
      fileReader.readAsDataURL(f);
      }
    });
 } else {
      alert("Your browser doesn't support to File API")
 }

 if (window.File && window.FileList && window.FileReader) {
    $("#downstream_protection").on("change", function(e) {
     var files = e.target.files,
     filesLength = files.length;
     for (var i = 0; i < filesLength; i++) {
      var f = files[i]
      var fileReader = new FileReader();
      fileReader.onload = (function(e) {
        var file = e.target;
        $("<span class=\"pip\">" +
        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
        "<br/><span class=\"remove\">ลบรูป</span>" +
        "</span>").insertAfter("#downstream_protection");
        $(".remove").click(function(){
        $(this).parent(".pip").remove();
       });
      });
      fileReader.readAsDataURL(f);
      }
    });
 } else {
      alert("Your browser doesn't support to File API")
 }

 if (window.File && window.FileList && window.FileReader) {
    $("#water_system").on("change", function(e) {
     var files = e.target.files,
     filesLength = files.length;
     for (var i = 0; i < filesLength; i++) {
      var f = files[i]
      var fileReader = new FileReader();
      fileReader.onload = (function(e) {
        var file = e.target;
        $("<span class=\"pip\">" +
        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
        "<br/><span class=\"remove\">ลบรูป</span>" +
        "</span>").insertAfter("#water_system");
        $(".remove").click(function(){
        $(this).parent(".pip").remove();
       });
      });
      fileReader.readAsDataURL(f);
      }
    });
 } else {
      alert("Your browser doesn't support to File API")
 }

 
});