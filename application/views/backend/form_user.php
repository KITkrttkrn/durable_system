                <!-- Begin Content -->
                <article class="content forms-page">
                    <div class="title-block">
                        <h3 class="title"> <?php echo $prom_form; ?> </h3>
                    </div>

                    <section class="section">
                        <div class="row sameheight-container">
                        	<div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="card card-block sameheight-item">
                                    <form role="form" method="POST" action="<?= site_url('save_user'); ?>">
                                    <input type="hidden" class="form-control" name="mode" id="mode" value="<?php echo $mode; ?>">
                                    <?php if($user_id != ""){ ?>
                                    <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                                    <?php }?>
                                    <?php if($type_user_id != ""){ ?>
                                    <input type="hidden" class="form-control" name="type_user_id" id="type_user_id" value="<?php echo $type_user_id; ?>">
                                    <?php }?>
                                    <?php if($register_date != ""){ ?>
                                    <input type="hidden" class="form-control" name="register_date" id="register_date" value="<?php echo $register_date; ?>">
                                    <?php }?>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="control-label"> ชื่อ </label>
                                            <input name="user_name" value="<?php echo $user_name; ?>" placeholder="ชื่อ" type="text" class="form-control"> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="control-label"> นามสกุล </label>
                                            <input name="user_surname" value="<?php echo $user_surname; ?>" placeholder="นามสกุล" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="control-label"> Email </label>
                                            <input name="user_email" value="<?php echo $user_email; ?>" placeholder="กรอก Email" type="text" class="form-control"> 
                                        </div>
                                    </div>
                                    <?php if($user_password != ""){ ?>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="control-label"> รหัสผ่าน </label>
                                            <div class="form-group">
                                             <input name="user_password" id="u_pass" value="<?php echo $user_password ?>" placeholder="กรอกรหัสผ่าน" type="password" class="form-control"> 
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="control-label"> กรอกรหัสผ่านอีกครั้ง </label>
                                            <div class="form-group">
                                             <input name="user_password2" id="u_pass2" value="<?php echo $user_password ?>" placeholder="กรอกรหัสผ่านอีกครั้ง" type="password" class="form-control"> 
                                            </div>
                                            <font color="red">
										<div class="registrationFormAlert" id="divCheckPasswordMatch">&nbsp;</div>
										</font>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="row">

           <?php 
           echo "<div class=\"controls col-md-12\">";
           echo "<label for=\"faculty\">คณะ</label>";
       	   echo "<select class=\"form-control\" id=\"faculty\" name=\"faculty_id\">";
           echo	"<option value=\"0\">---เลือกคณะ---</option>";
		    foreach($query_faculty as $r){
		            	if($r->faculty_id == $faculty_id){
		            		echo '<option value="'.$r->faculty_id.'" selected>'.$r->faculty_name.'</option>';
		            	}else{ 
		                	echo '<option value="'.$r->faculty_id.'">'.$r->faculty_name.'</option>';
		                }
		            }
		                     echo "</select>";
				 echo "</div>";
        	?>
        </div>
                                    <div class="row">
                                    	<div class="form-group col-md-12">
                                        <div class="controls">
				                            <label for="major_id">สาขา</label>
											  <select class="form-control" name="major_id" id="majors">
												<option value="0">---เลือกสาขา---</option>
                                                <?php if(isset($major_id)){ 
                                                    		    foreach($query_major as $r_m){
                                                                    if($r_m->major_id == $major_id){
                                                                    
                                                                        echo "<option value=\"".$r_m->major_id."\" selected>".$r_m->major_name."</option>"; 
                                                                    }else{ 
                                                                        echo '<option value="'.$r_m->major_id.'">'.$r_m->major_name.'</option>';
                                                                    }
                                                                }

                                                    } ?>
											  </select>
				                        </div>
				                    	</div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit">บันทึก</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </section>
                </article>
                <!-- End Content -->

<script type="text/javascript">
$(document).ready(function(){

    $('#faculty').on('change',function(){
        <?php if($faculty_id){ ?> 
        var provinceID = <?php echo $faculty_id; ?> 
        <?php }else{ ?>
        var provinceID = $(this).val(); 
        <?php } ?> 
        if(provinceID != 0){
            $.ajax({
                type:'GET',
                url:'<?= site_url('get_major_id'); ?>',
                data:'pro_id='+provinceID,
                success:function(html){
                    $('#majors').html(html);
                }
            }); 
        }else{
            $('#majors').html('<option value="0">---โปรดเลือกคณะก่อน---</option>'); 
        }
    });
});

</script>

<script type="text/javascript">
 $(document).ready(function () {
   $("#u_pass, #u_pass2").keyup(checkPasswordMatch);
});
 function checkPasswordMatch() {
    var password = $("#u_pass").val();
    var confirmPassword = $("#u_pass2").val();
    var $result = $("#divCheckPasswordMatch");
		$result.text("");
    if (password != confirmPassword){
		$result.text("***รหัสผ่านทั้งสองไม่ตรงกัน");
        $result.css("color", "red");		
	}else{
		$result.text("***รหัสผ่านทั้งสองตรงกัน");
        $result.css("color", "green");	
	}	
}
 </script>