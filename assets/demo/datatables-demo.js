


//awal tidak bisa submit 2x
$('#doubleclick').on('click',function(){

   setTimeout(function(){


    $('#doubleclick').attr('disabled','on');

   },100); 
 

});

$('#kuantitas').on('click',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#kuantitas').on('keyup',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#pengirim').on('click',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#pengirim').on('keyup',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#penerima').on('click',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#penerima').on('keyup',function(){

    $('#doubleclick').removeAttr('disabled');

});
$('#no_stock').on('click',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#no_stock').on('keyup',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#no_batch').on('click',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#no_batch').on('keyup',function(){

    $('#doubleclick').removeAttr('disabled');

});
$('#nama_barang').on('click',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#nama_barang').on('keyup',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#jenis_barang').on('click',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#jenis_barang').on('keyup',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#satuan').on('click',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#satuan').on('keyup',function(){

    $('#doubleclick').removeAttr('disabled');

});


$('#harga_perolehan').on('click',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#harga_perolehan').on('keyup',function(){

    $('#doubleclick').removeAttr('disabled');

});
$('#tanggal_masuk').on('click',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#tanggal_masuk').on('keyup',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#tanggal_daluwarsa').on('click',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#tanggal_daluwarsa').on('keyup',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#sumber').on('click',function(){

    $('#doubleclick').removeAttr('disabled');

});

$('#sumber').on('keyup',function(){

    $('#doubleclick').removeAttr('disabled');

});
// akhir tidak bisa submit 2x

// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
});

// jam digital
window.setTimeout("waktu()", 1000);
 
	function waktu() {
		var waktu = new Date();
		setTimeout("waktu()", 1000);
		document.getElementById("jam").innerHTML = waktu.getHours();
		document.getElementById("menit").innerHTML = waktu.getMinutes();
		document.getElementById("detik").innerHTML = waktu.getSeconds();
}

/*!
    * Start Bootstrap - SB Admin v6.0.2 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);



// awal window refresh

$(window).on('load',function(){

    $('.logo-besar').addClass('muncul');
    $('.lead').addClass('muncul');

    // awal sosial media

   
        $('.card').each(function(i){
            setTimeout(function(){
                $('.card').eq(i).addClass('muncul');

            },350 * i);

        });

      $(".konfirmasi") .addClass('muncul'); 
        
   
        
        
    

    // akhir sosial media

});











