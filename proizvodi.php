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
					  <li><a href="#">Upravljanje</a></li>
					  <li class="active">Proizvodi</li>
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
                            Prikaz artikla  
                            
                        </div>
                        
                        <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Redni broj</th>
                                        <th>Naziv</th>
                                        <th>Jedinica</th>
                                        <th>Kategorija</th>
                                        <th>Porez</th>
                                        <th>Rabat</th>
                                        <th>Akcije</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      
                                <?php
                                
                                    include_once('connection.php');
                                    
                                    $database = new Connection();
                                    $db = $database->open();

                                    $sql='SELECT * FROM proizvodi ORDER BY id_proizvod DESC';
                                    $counter=0;
                                    foreach($db->query($sql) as $row){
                                    
                                        $counter++;
                                    ?>
                                        
                                        <tr>
                                            <td><?php echo $counter; ?></td>                                           
                                            <td><?php echo $row['naziv_proizvod'] ?></td>
                                            <td><?php echo $row['jedinica'] ?></td>
                                            <td><?php echo $row['kategorija'] ?></td>
                                            <td><?php echo $row['porez'] ?>%</td>
                                            <td><?php echo $row['rabat'] ?>%</td>
                                            <td class='action'>
                                                <a href="#edit_<?php echo $row['id_proizvod']?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Izmeni</a>
                                                <a href="#delete_<?php echo $row['id_proizvod']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Izbrisi</a>
                                                
                                            </td>
                                            
                                        </tr>
                                        <?php include('edit_delete_modal.php'); ?>
                    
                                    <?php
                                    }
                                    $database->close();
                         
                                
                                ?>
                         
                                </tbody>
                            </table>
                        </div>
              

                        </div>
                    </div>            
                </div>
            <!--kraj unosa-->        
                <div class="col-md-6 col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Unos artikla
                        </div>
                        <div class="panel-body">
                        <div class="formaArtikli">
                            <form name='formInsert' method='POST' action='insert.php' id='formInsert'  class='insertForm'>
                                    <label class='lblInsert'>Naziv Artikla: </label>
                                    <input type='text'id='tbNameArticle' name='tbNameArticle' class='form-control myInput' onKeyUp="proveraNaziv(this);">
                                    <span id="spanNaziv" class="mojaklasa"></span><br/><br/>

                                    <label class='lblInsert'>Jedinica:</label>
                                    <select name='ddlJedinica' id='ddlJedinica2' class='form-control myInput'onchange='proveraDdlJedinica();'>
                                        <option value='0'>Izaberi jedinicu..</option>
                                        <option value='paket'>Paket</option>
                                        <option value='komad'>Komad</option>
                                        <option value='gram'>Gram</option>
                                    </select>
                                    <span id="spanJedinica" class='mojaklasa'></span><br/><br/>

                                    <label class='lblInsert'>Kategorija:</label>
                                    <select name='ddlKategorija' id="ddlKategorija2" class='form-control myInput'onchange="proveraDdlKategorija();">
                                        <option value='0'>Izaberi kategoriju..</option>
                                        <option value='hrana'>hrana</option>
                                        <option value='higijena'>higijena</option>
                                        <option value='ostalo'>ostalo</option>
                                    </select>
                                    <span id="spanKategorija"></span><br/><br/>
                                
                                    <label class='lblInsert'>Porez:</label>
                                    <select name='ddlPorez' id='ddlPorez' class='form-control myInput'onchange="proveraDdlPorez();">
                                        <option value='0'>Izaberi porez..</option>
                                        <option value='10'>10%</option>
                                        <option value='18'>18%</option>
                                        <option value='20'>20%</option>
                                    </select>
                                    <span id="spanPorez"></span><br/><br/>

                                    <label class='lblInsert'>Rabat:</label>
                                    <select name='ddlRabat' id='ddlRabat' class='form-control myInput' onchange="proveraDdlRabat();">
                                        <option value='izaberi'>Izaberi rabat..</option>
                                        <option value='0'>0%</option>
                                        <option value='6'>6%</option>
                                        <option value='15'>15%</option>
                                    </select>
                                    <span id="spanRabat"></span><br/><br/>
                                    
                                    <div class='btns'>
                                        
                                        <input type='submit' id='btnInsertArticle' name='btnInsertArticle'class='btn btn-primary btnInsertArticle' value='Unesi' onclick='provera(this);'>
                                        <input type='reset' name='btnReset'class='btn btn-danger btnReset' value='Odustani'>
                                    </div>
                                    
                            </form>
                        </div>
                        <div id="probniDiv"></div>

                     
                            <script src="assets/js/provera.js"></script>

                              
                            <script type="text/javascript">

                                $(document).ready(function() {
                                    $("#formInsert").submit(function() {		
                                        $.ajax({
                                            type: "POST",
                                            url: 'insert.php',
                                            data:$("#formInsert").serialize(),
                                            success: function (data) {	
                                                // Inserting html into the result div on success
                                                $('#message').show();
                                                $('#message').html(data);
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