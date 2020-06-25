                <!-- Begin Content -->
                <article class="content forms-page">
                    <div class="title-block">
                        <h3 class="title"> <?php echo $prom_form; ?> </h3>
                    </div>

                    <section class="section">
                        <div class="row sameheight-container">
                            <div class="col-md-12">
                                <div class="card card-block sameheight-item">
                                <?php echo form_open_multipart('save_durable');?>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">เลขครุภัณฑ์</label>
                                            <input type="hidden" name="user_id" value="<?php echo $query_user; ?>" >
                                            <input required name="durable_code" value="<?php echo $durable_code; ?>" placeholder="เลขครุภัณฑ์" type="text" class="form-control"> 
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">ชื่อครุภัณฑ์</label>
                                            <input required name="durable_name" value="<?php echo $durable_name; ?>" placeholder="ชื่อครุภัณฑ์" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">วันที่เริ่มใช้งาน</label>
                                            <input required name="use_date" value="<?php echo $use_date; ?>" placeholder="วันที่เริ่มใช้งาน" type="date" id="datepicker" class="form-control"> 
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">ประเภทครุภัณฑ์</label>
                                            <div class="form-group">
                                            <select name="cat_id" class="form-control">
                                                <option value=""><?php echo "--ประเภทครุภัณฑ์--"; ?></option>
                                            <?php 
                                            foreach ($query_cat as $r_cat)
                                            {
                                                if($cat_id == $r_cat->cat_id){
                                                    echo "<option value=\"".$r_cat->cat_id."\" selected>".$r_cat->cat_name."</option>"; 
                                                }else{
                                                    echo "<option value=\"".$r_cat->cat_id."\">".$r_cat->cat_name."</option>";
                                                }
                                                
                                            }
                                            ?>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">รูปภาพครุภัณฑ์</label>
                                            <div class="col-md-2">
                                            <div class="img-resize"><img id="blah" src="<?php echo $img_path_img.$picture_path; ?>"  alt="your image"/></div>
                                            </div>
                                            <div class="col-md-10">
                                                <span>
                                                    <input type="file" id="imgInp" name="com_img"/>
                                                    <input type="hidden" name="picture_path" value="<?php echo $picture_path;?>">
                                                </span>                                     
                                            </div>
                                            
                                            </div>
                                        <div class="form-group col-md-6">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label class="control-label">คณะ</label>
                                                    <div class="form-group">
                                                    <select name="faculty_id" class="form-control" id="faculty">
                                                        <option value="">---คณะ---</option>
                                                    <?php 
                                                    foreach($query_faculties as $r) 
                                                    {
                                                        if(isset($result[0]->faculty_id) AND $result[0]->faculty_id == $r->faculty_id){
                                                            echo "<option value=\"".$r->faculty_id."\" selected>".$r->faculty_name."</option>";
                                                        }else{
                                                            echo "<option value=\"".$r->faculty_id."\">".$r->faculty_name."</option>";
                                                        }
                                                        
                                                    }
                                                    ?>
                                                    </select>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label class="control-label">สาขา</label>
                                                    <div class="form-group">
                                                    <select name="major_id" class="form-control" id="major">
                                                        <option value="">---สาขา---</option>
                                                        <?php 

                                                    if(isset($query_majors)){
                                                    foreach($query_majors as $r) 
                                                    {
                                                        if(isset($result[0]->major_id) AND $result[0]->major_id == $r->major_id){
                                                            echo "<option value=\"".$r->major_id."\" selected>".$r->major_name."</option>";
                                                        }else{
                                                            echo "<option value=\"".$r->major_id."\">".$r->major_name."</option>";
                                                        }
                                                        
                                                    }
                                                }
                                                    ?>
                                                    </select>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label class="control-label">หลักสูตร</label>
                                                    <div class="form-group">
                                                    <select name="course_id" class="form-control" id="course">
                                                        <option value="">---หลักสูตร---</option>
                                                        <option value="0">ไม่มีหลักสูตร</option>
                                                        
                                                        <?php 
                                                if(isset($query_course)){
                                                    foreach($query_course as $r) 
                                                    {
                                                        if(isset($result[0]->course_id) AND $result[0]->course_id == $r->course_id){
                                                            echo "<option value=\"".$r->course_id."\" selected>".$r->course_name."</option>";
                                                        }else{
                                                            echo "<option value=\"".$r->course_id."\">".$r->course_name."</option>";
                                                        }
                                                        
                                                    }
                                                }
                                                    ?>
                                                        
                                                    </select>
                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">ราคาครุภัณฑ์</label>
                                            <input required name="price" value="<?php echo $price; ?>" placeholder="ราคาครุภัณฑ์" type="text" class="form-control"> 
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">มูลค่าซากครุภัณฑ์</label>
                                            <input required name="scrap_value" value="<?php echo $scrap_value; ?>" placeholder="มูลค่าซากครุภัณฑ์" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">อายุขัยครุภัณฑ์</label>
                                            <input name="durable_age" value="<?php echo $durable_age; ?>" placeholder="อายุขัยครุภัณฑ์" type="text" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">ห้องของครุภัณฑ์</label>
                                            <div class="form-group">
                                            <select name="room_id" class="form-control">
                                                <option value=""><?php echo "--ห้องของครุภัณฑ์--"; ?></option>
                                                <option value="0"><?php echo "ไม่มีห้อง"; ?></option>
                                            <?php 
                                            foreach($query_room as $r_room) 
                                            {
                                                if($room_id == $r_room->room_id){
                                                    echo "<option value=\"".$r_room->room_id."\" selected>".$r_room->room_name."</option>";
                                                }else{
                                                    echo "<option value=\"".$r_room->room_id."\">".$r_room->room_name."</option>";
                                                }
                                                
                                            }
                                            ?>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">สถานะครุภัณฑ์</label>
                                            <div class="form-group">
                                            <select name="durable_status_id" class="form-control">
                                            <?php 
                                            foreach($query_durable_status as $r_durable_status) 
                                            {
                                                if($durable_status_id == $r_durable_status->durable_status_id){
                                                    echo "<option value=\"".$r_durable_status->durable_status_id."\" selected>".$r_durable_status->durable_status_name."</option>";
                                                }else{
                                                    echo "<option value=\"".$r_durable_status->durable_status_id."\">".$r_durable_status->durable_status_name."</option>";
                                                }
                                            }
                                            ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">สามารถยืมครุภัณฑ์</label>
                                            <div class="form-group">
                                            <select name="can_borrow" class="form-control">
                                                <option value=""> --โปรดเลือก-- </option>       
                                                <option value="Y" <?php if($can_borrow == 'Y'){ echo "selected"; } ?>>ได้</option>
                                                <option value="N" <?php if($can_borrow == 'N'){ echo "selected"; } ?>>ไม่ได้</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group col-md-6">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="control-label">รายละเอียดครุภัณฑ์</label>
                                            <textarea rows="10" name="description" placeholder="รายละเอียดครุภัณฑ์" type="text" class="form-control"><?php echo $description; ?></textarea> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <input name="mode" value="<?php echo $mode ?>" type="hidden" class="form-control">
                                            <input name="durable_id" value="<?php echo $durable_id ?>" type="hidden" class="form-control">
                                            <button class="btn btn-primary" type="submit">บันทึก</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
                <!-- End Content -->

         <!-- validate image file -->
        <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
            }
            }

            $("#imgInp").change(function() {
            readURL(this);
            });
        </script>

<script type="text/javascript">
$(document).ready(function(){

    $('#faculty').on('change',function(){
        var facID = $(this).val(); 
        if(facID != 0){
            $.ajax({
                type:'GET',
                url:'<?= site_url('get_major_id'); ?>',
                data:'fac_id='+facID,
                success:function(html){
                    $('#major').html(html);
                }
            }); 
        }else{
            $('#major').html('<option value="0">---โปรดเลือกคณะก่อน---</option>'); 
        }
    });
});

$(document).ready(function(){

$('#major').on('change',function(){
    var majorID = $(this).val(); 
    if(majorID != 0){
        $.ajax({
            type:'GET',
            url:'<?= site_url('get_course_id'); ?>',
            data:'major_id='+majorID,
            success:function(html){
                $('#course').html(html);
            }
        }); 
    }else{
        $('#course').html('<option value="0">---โปรดเลือกสาขาก่อน---</option>'); 
    }
});
});

</script>