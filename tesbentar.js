var obat = document.getElementById('dropobat');
var dataTable = document.getElementById('dataTable');

obat.addEventListener("click",function(){
//buat object ajax
var xhr = new XMLHttpRequest();
 
//cek kesiapan ajax
xhr.onreadystatechange =function() {
    if(xhr.readyState==4 && xhr.status== 200){
        dataTable.innerHTML = this.responseText;
    }
}

xhr.open('GET','../../ajax/barang2.php',true);
xhr.send();


});