$(document).ready(function(){
    $.ajax({
        url : 'pocetna.php',
        method : 'GET',
        dataType : 'json',
        success : function(response){
            var ime = response.ime;
            var prezime = response.prezime;
            var status = response.status;
            console.log(ime,prezime,status);
        },
        error: function() {
            console.log('Došlo je do greške prilikom izvršavanja AJAX zahteva.');
        }
    })
    $("#objavi").click(function(e){
        e.preventDefault();
        naslovO = $("#naslov").val();
        tekstO = $("#objava").val();
        $.ajax({
            url : 'ajax/ajaxObjava.php?funkcija=objava',
            method : 'POST',
            data : {
                naslov : naslovO,
                tekst : tekstO,
            },
            success: function(response){
                $(".right-div").html(response);
            }
        })
    })
})  
function obrisi(vestID){
    $.ajax({
        url : 'ajax/ajaxObrisi.php?funkcija=obrisi',
        method : 'POST',
        data : {
            vest : vestID
        },
        success: function(response){
            $(".right-div").html(response);
        }
    })
}

