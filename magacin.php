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
					  <li class="active">Dobavljaci</li>
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
                           Magacin 
                            
                        </div>
                        
                        <div class="panel-body">
                        <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Redni broj</th>
                                            <th>Proizvod</th>
                                            <th>Kolicina</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                    <?php
                                    include_once('connection.php');
                                    
                                    $database = new Connection();
                                    $db = $database->open();

                                    $sql='SELECT * FROM magacin m LEFT JOIN proizvodi p ON m.proizvod_id=p.id_proizvod';
                                    $counter=0;

                                    foreach($db->query($sql) as $row){
                                    
                                        $counter++;
                                    ?>
                                        
                                        <tr>
                                            <td><?php echo $counter; ?></td>
                                            <td><?php echo $row['naziv_proizvod'] ?></td>
                                            <?php
                                            if($row['jedinica']!='gram'){
                                            ?>
                                                <td><?php   echo ($row['kolicina_magacin']/1);?></td>
                                        
                                            <?php
                                            }
                                            else{
                                                echo"<td>".$row['kolicina_magacin']."g</td>";
                                            }
                                            ?>
                                            
                                        </tr>
                                        
                    
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