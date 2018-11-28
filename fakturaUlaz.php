<?php
    include('header.php');
    include('navbar_side.php');
?>
       
  <div id="page-wrapper">
		    <div class="header"> 
                <h1 class="page-header">
                    Dashboard <small>Zdravo Ana!</small>
                </h1>
				    <ol class="breadcrumb">
					  <li><a href="#">Pocetna</a></li>
					  <li><a href="#">Faktura</a></li>
					  <li class="active">Faktura ulaza robe</li>
					</ol> 
									
		    </div>
            <div name='message' id='message'>
                <?php
                    if( !empty( $_REQUEST['Message'] ) )
                    {
                        echo sprintf( '<p>%s</p>', $_REQUEST['Message'] );
                    }

                   
                ?>
            </div>
            <div id="page-inner">

            <div class="row"> 
                <div class="col-md-6 col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Izaberite vremenski period
                        </div>
                        
                        <div class="panel-body">
                        <form name='formInsert' method='POST' action='fakturaUlazAjax.php' id='formInsert'  class='fakturaForm'>
                                <?php include_once('connection.php');?>
                                <div class='form-group timeline'>
                                    <label class='lblInsert'>Od:</label>
                                    <input type='date' name='odDatuma' class='form-control fakturaInput'>
                                </div>
                                
                                <div class='form-group timeline'>
                                    <label class='lblInsert'>do:</label>
                                    <input type='date' name='doDatuma' class='form-control fakturaInput'>
                                </div>

                                <div class='cleaner'></div>
                          
                                <div class='btnsFaktura'>
                                   <center> <input type='submit' id='btnPrikazFaktura' name='btnPrikazFaktura'class='btn btn-primary btnPrikazFaktura' value='Unesi'></center>
                                </div>
                          
                            </form>
              
                            <script type="text/javascript">

                                $(document).ready(function() {
                                    $("#formInsert").submit(function() {		
                                        $.ajax({
                                            type: "POST",
                                            url: 'fakturaUlazAjax.php',
                                            data:$("#formInsert").serialize(),
                                            success: function (data) {	
                                                // Inserting html into the result div on success
                                                $('#ajaxIzlaz').show();
                                                $('#ajaxIzlaz').html(data);
                                            }
                                            /*error: function(jqXHR, text, error){
                                            // Displaying if there are any errors
                                                $('#ajaxDiv').html(error);        
                                        }*/   
                                    });
                                        return false;
                                    });
                                });

                            </script>
                       

                        </div>
                    </div>            
                </div>
            <!--kraj unosa-->        
                <div class="col-md-6 col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            FAKTURA
                        </div>
                        <div class="panel-body" id='ajaxIzlaz'>
                     
                       
                              
                        </div>
                    </div>            
                </div>
            <!--kraj izmene--> 
                
            </div>
            <!--kraj row-a za unos/izmenu artikla-->

          <!--  <div class="row"> 
                <div class="col-md-6 col-sm-12 col-xs-12 insertArticle">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Prikaz artikla
                        </div>
                        
                        <div class="panel-body">

                        </div>
                    </div>            
                </div>
                
            </div>-->
            
            <!--kraj row-a za prikaz-->
<?php
    include('footer.php');
?>