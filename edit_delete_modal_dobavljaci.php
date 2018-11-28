<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['id_dobavljac']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Izmena dobavljaca</h4></center>
                </div>
                <div class="modal-body">
    			<div class="container-fluid">
                <form method="POST" name='editForm' id='editForm' action="crudProizvodi.php">
                <!--<form method="POST" name='editForm' action="edit.php">-->
    				<div class="row form-group">
    					<div class="col-sm-2">
    						<label class="control-label" style="position:relative; top:7px;">Naziv:</label>
    					</div>
    					<div class="col-sm-10">
    						<input type="text" class="form-control" name="dobavljac" value="<?php echo $row['naziv_dobavljac']; ?>">
    					</div>
    				</div>
    		
    		
                    <input type='hidden' value='<?php echo $row['id_dobavljac']?>' name='getId'>
                </div> 
    			</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Odustani</button>
                    <button type="submit" name="editDobavljac" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Izmeni</button>
                   <!-- <input type="submit" name="edit" value='Izmeni' class="btn btn-success"><span class="glyphicon glyphicon-check"></span> -->
                    <br/><br/><br/>
                   
                    
                </form>
                    <!--POZIV AJAXA...ne funkcionise-->
                <script type='text/javascript'>
                  /*  $(document).ready(function() {
                        $("#editForm").submit(function() {		
                            $.ajax({
                                type: "POST",
                                url: 'edit.php',
                                data:$("#editForm").serialize(),
                                success: function (data) {	
                                    // Inserting html into the result div on success
                                    $('#message').show();
                                    $('#message').html(data);
                                }                        
                            });
                            return false;
                        });
                    });*/
                </script>
     
                </div>
     
            </div>
        </div>
    </div>

     <!-- Delete -->
     <div class="modal fade" id="delete_<?php echo $row['id_dobavljac']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Izbrisi Dobavljaca</h4></center>
                </div>
            <form action='crudProizvodi.php' method='POST'>
                <div class="modal-body">	
                	<p class="text-center">Da li ste sigurni da zelite da obrisete dobavljaca?</p>
    				<h2 class="text-center"><?php echo $row['naziv_dobavljac'];?></h2>
    			</div>
                <input type='hidden' value='<?php echo $row['id_dobavljac']?>' name='getIddelete'>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Odustani</button>
                    
                    <button type="submit" name="deleteDobavljac" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Izbrisi</button>
                </div>
            </form>
            </div>
        </div>
    </div>