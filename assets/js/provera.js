
    function proveraNaziv(obj) {
        var spanInput   = document.getElementById('spanNaziv');
        var spanEdit    = document.getElementById('spanNazivEdit');
        var editInput   = document.getElementById('productName');
        var insertInput = document.getElementById('tbNameArticle');
        var id          = obj.id;
        var regNaziv    = /^[\d\w ]*$/;

        if(!regNaziv.test(insertInput.value)){
            insertInput.style.borderColor="red";
                            
            if(id=='tbNameArticle'){

                spanInput.style.color="red";
                spanInput.innerHTML="neispravan unos!";
                                            
            }
                                        
        }
        else if(!regNaziv.test(editInput.value)){
            editInput.style.borderColor="red";

            if(id='productName'){

                spanEdit.style.color="red";
                spanEdit.innerHTML="neispravan unos!";                            
            }
        }
        else{
            if(id=='tbNameArticle'){
                insertInput.style.borderColor="green";
                spanInput.style.color="green";
                spanInput.innerHTML="&#10004;!";
                spanEdit.innerHTML="";
                editInput.style.removeProperty('border');
            }
            else if(id=='productName'){
                editInput.style.borderColor="green";
                spanEdit.style.color="green";
                spanEdit.innerHTML="&#10004;!";
                spanInput.innerHTML="";
                insertInput.style.removeProperty('border');
            }
        }
                                    
                           

    
    }

    function proveraDdlJedinica(){
        var jedinica = document.getElementById('ddlJedinica2');
        var vrednost = jedinica.options[jedinica.selectedIndex].value;
        
        if(vrednost=="0"){
            document.getElementById("ddlJedinica2").style.borderColor="red";
            document.getElementById("spanJedinica").style.color="red";
            document.getElementById("spanJedinica").innerHTML="Morate izabrati jedinicu!";
        }
        else{
            document.getElementById("ddlJedinica2").style.borderColor="green";
            document.getElementById("spanJedinica").style.color="green";
            document.getElementById("spanJedinica").innerHTML="&#10004;!";
        }

    }
                                   
    function proveraDdlKategorija(){
        var kategorija = document.getElementById('ddlKategorija2');
        var kategorija2=document.getElementById('ddlKategorija2').value;
        var vrednost = kategorija.options[kategorija.selectedIndex].value;
        
        if(vrednost=="0"){
            document.getElementById("ddlKategorija2").style.borderColor="red";
            document.getElementById("spanKategorija").style.color="red";
            document.getElementById("spanKategorija").innerHTML="Morate izabrati kategoriju!";
        }
        else{
            document.getElementById("ddlKategorija2").style.borderColor="green";
            document.getElementById("spanKategorija").style.color="green";
            document.getElementById("spanKategorija").innerHTML="&#10004;!";
        }

    }
    
    function proveraDdlPorez(){
        var porez = document.getElementById('ddlPorez');
        var vrednost = porez.options[porez.selectedIndex].value;

        if(porez.options[porez.selectedIndex].value=="0"){
            document.getElementById("ddlPorez").style.borderColor="red";
            document.getElementById("spanPorez").style.color="red";
            document.getElementById("spanPorez").innerHTML="Morate izabrati porez!";
        }
        else{
            document.getElementById("ddlPorez").style.borderColor="green";
            document.getElementById("spanPorez").style.color="green";
            document.getElementById("spanPorez").innerHTML="&#10004;!";
        }
                                
    }
                                     
    function proveraDdlRabat(){
        var rabat = document.getElementById('ddlRabat');
        
        if(rabat.options[rabat.selectedIndex].value=="izaberi"){
            document.getElementById("ddlRabat").style.borderColor="red";
            document.getElementById("spanRabat").style.color="red";
            document.getElementById("spanRabat").innerHTML="Morate izabrati rabat!";
        }
        else{
            rabat.style.borderColor="green";
            document.getElementById("spanRabat").style.color="green";
            document.getElementById("spanRabat").innerHTML="&#10004;!";
        }
    }

    function proveraDecimal(obj){
        /*var cena     = document.getElementById('tbPrice');
        var kolicina = document.getElementById('tbQuantity');*/
        var vrednost =obj.value;
        var id       = obj.id;
        var reCena  = /^[\d\/.\/,]*$/;
//alert(id);
        if(id=="tbPrice"){
            if(!reCena.test(vrednost)){
                obj.style.borderColor="red";
                document.getElementById('spanCena').style.color="red";
                document.getElementById('spanCena').innerHTML="Neispravan unos cene!";
            }
            else{
                obj.style.borderColor="green";
                document.getElementById("spanCena").style.color="green";
                document.getElementById("spanCena").innerHTML="&#10004;!";
            }
        }
        else if(id=="tbQuantity"){
            if(!reCena.test(vrednost)){
                obj.style.borderColor="red";
                document.getElementById('spanKolicina').style.color="red";
                document.getElementById('spanKolicina').innerHTML="Neispravan unos kolicine!";
            }
            else{
                obj.style.borderColor="green";
                document.getElementById("spanKolicina").style.color="green";
                document.getElementById("spanKolicina").innerHTML="&#10004;!";
            }
        }
        else if(id=="tbCenaUlaz"){
            if(!reCena.test(vrednost)){
                obj.style.borderColor="red";
                document.getElementById('spanCenaEdit').style.color="red";
                document.getElementById('spanCenaEdit').innerHTML="Neispravan unos cene!";
            }
            else{
                obj.style.borderColor="green";
                document.getElementById("spanCenaEdit").style.color="green";
                document.getElementById("spanCenaEdit").innerHTML="&#10004;!";
            }

        }

        else if(id=="tbKolicinaUlaz"){
            if(!reCena.test(vrednost)){
                obj.style.borderColor="red";
                document.getElementById('spanKolicinaEdit').style.color="red";
                document.getElementById('spanKolicinaEdit').innerHTML="Neispravan unos kolicine!";
            }
            else{
                obj.style.borderColor="green";
                document.getElementById("spanKolicinaEdit").style.color="green";
                document.getElementById("spanKolicinaEdit").innerHTML="&#10004;!";
            }

        }

        else if(id=="tbKolicinaIzlaz"){
            if(!reCena.test(vrednost)){
                obj.style.borderColor="red";
                document.getElementById('spanKolicinaIzlaz').style.color="red";
                document.getElementById('spanKolicinaIzlaz').innerHTML="Neispravan unos kolicine!";
            }
            else{
                obj.style.borderColor="green";
                document.getElementById("spanKolicinaIzlaz").style.color="green";
                document.getElementById("spanKolicinaIzlaz").innerHTML="&#10004;!";
            }

        }
        else if(id=="tbKolicinaIzlazEdit"){
            if(!reCena.test(vrednost)){
                obj.style.borderColor="red";
                document.getElementById('spanKolicinaIzlazEdit').style.color="red";
                document.getElementById('spanKolicinaIzlazEdit').innerHTML="Neispravan unos kolicine!";
            }
            else{
                obj.style.borderColor="green";
                document.getElementById("spanKolicinaIzlazEdit").style.color="green";
                document.getElementById("spanKolicinaIzlazEdit").innerHTML="&#10004;!";
            }

        }
        

        
    }

    function proveraEmail(){
        var email    = document.getElementById('tbKorisnickoIme');
        var regEmail =/^[a-zA-Z0-9\.\-]+@[a-zA-Z0-9\.\-]+$/;

        if(!regEmail.test(email.value)){
            email.style.borderColor="red";
            document.getElementById('spanEmail').style.color="red";
            document.getElementById('spanEmail').innerHTML="Neispravan email!";
        }
        else{
            email.style.borderColor="green";
            document.getElementById("spanEmail").style.color="green";
            document.getElementById("spanEmail").innerHTML="&#10004;!";
        }
        
    }

    function proveraLozinka(){
        var lozinka    = document.getElementById('tbLozinka');
        //var regLoznika = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,15})$/;
        var regLoznika = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/;

        if(!regLoznika.test(lozinka.value)){
            lozinka.style.borderColor="red";
            document.getElementById('spanLozinka').style.color="red";
            document.getElementById('spanLozinka').innerHTML="Neispravna lozinka!";
        }
        else{
            lozinka.style.borderColor="green";
            document.getElementById("spanLozinka").style.color="green";
            document.getElementById("spanLozinka").innerHTML="&#10004;!";
        }

    }

    function provera(obj){
        /*alert("kliknuto!");*/
        var naziv      = document.getElementById("tbNameArticle");
        var editInput  = document.getElementById('productName');
        var porez      = document.getElementById('ddlPorez');
        var rabat      = document.getElementById('ddlRabat');
        var kategorija = document.getElementById('ddlKategorija2');
        var jedinica   = document.getElementById('ddlJedinica2');
        var id         = obj.id;

        
        if(id=="edit"){
            if(editInput.value===""){
                editInput.style.borderColor="red";
                document.getElementById("spanNazivEdit").style.color="red";
                document.getElementById("spanNazivEdit").innerHTML="Polje Naziv ne moze biti prazno!";

                document.getElementById("tbNameArticle").style.removeProperty('border');
                document.getElementById("spanNaziv").innerHTML="";

                document.getElementById("ddlPorez").style.removeProperty('border');
                document.getElementById("spanPorez").innerHTML="";
            }
        }
        else if(id=="btnInsertArticle"){
            if(naziv.value===""){
                naziv.style.borderColor="red";
                document.getElementById("spanNaziv").style.color="red";
                document.getElementById("spanNaziv").innerHTML="Polje Naziv Artikla ne moze biti prazno!";

                document.getElementById("spanNazivEdit").style.removeProperty('border');
                document.getElementById("spanNazivEdit").innerHTML="";


                if(porez.options[porez.selectedIndex].value=="0"){
                    document.getElementById("ddlPorez").style.borderColor="red";
                    document.getElementById("spanPorez").style.color="red";
                    document.getElementById("spanPorez").innerHTML="Morate izabrati porez!";
                }
                else{
                    document.getElementById("ddlPorez").style.borderColor="green";
                    document.getElementById("spanPorez").style.color="green";
                    document.getElementById("spanPorez").innerHTML="&#10004;!";
                }
                //provera rabat
                if(rabat.options[rabat.selectedIndex].value=="izaberi"){
                    document.getElementById("ddlRabat").style.borderColor="red";
                    document.getElementById("spanRabat").style.color="red";
                    document.getElementById("spanRabat").innerHTML="Morate izabrati rabat!";
                }
                else{
                    document.getElementById("ddlRabat").style.borderColor="green";
                    document.getElementById("spanRabat").style.color="green";
                    document.getElementById("spanRabat").innerHTML="&#10004;!";
                }
                //procera kategorije
                if(kategorija.options[kategorija.selectedIndex].value=="0"){
                    document.getElementById("ddlKategorija2").style.borderColor="red";
                    document.getElementById("spanKategorija").style.color="red";
                    document.getElementById("spanKategorija").innerHTML="Morate izabrati kategoriju!";
                }
                else{
                    document.getElementById("ddlKategorija2").style.borderColor="green";
                    document.getElementById("spanKategorija").style.color="green";
                    document.getElementById("spanKategorija").innerHTML="&#10004;!";
                }
                //provera jedinice
                if(jedinica.options[jedinica.selectedIndex].value=="0"){
                    document.getElementById("ddlJedinica2").style.borderColor="red";
                    document.getElementById("spanJedinica").style.color="red";
                    document.getElementById("spanJedinica").innerHTML="Morate izabrati jedinicu!";
                }
                else{
                    document.getElementById("ddlJedinica2").style.borderColor="green";
                    document.getElementById("spanJedinica").style.color="green";
                    document.getElementById("spanJedinica").innerHTML="&#10004;!";
                }                      
            }
        }
        
        
        //provera porez
       
    }
    