$(document).ready(function(e){
    $('#btnInsertArticle').click(function(){
        var name= $('#tbNameArticle').val();
        var porez= $('#ddlPorez').val();
        var rabat= $('#ddlRabat').val();

        $.ajax({
                type    :'POST',
                data    :{name:name, porez:porez, rabat:rabat },
                url     :'insert.php',
                success :function(result){
                    
                        alert(result);
                        }
            }
        )
    });
});
    