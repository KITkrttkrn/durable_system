
                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> <?= $prom_name ?></h3> <!-- หัวหลัก -->
                    </div>

                    <section class="section">
                        <div class="row sameheight-container">
                            <div class="col-xl-6 col-md-6 col-xs-12">
                                <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                                    <form action="<?= site_url('process_course'); ?>" method="POST">
                                    <div class="card-block">
                                    
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <label class="control-label">ชื่อสาขา: </label>
                                            <input type="hidden" name="course_id" value="<?= $course_id ?>">
                                            <input type="hidden" name="mode" value="<?= $mode; ?>">
                                            <input required class="form-control" name="course_name" type="text" value="<?= $course_name; ?>">
                                        </div>
                                     </div>
                                     <br>
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <label class="control-label">คณะ: </label>
                                            <select class="form-control" name="faculty_id" id="faculty">
																<option value="">---เลือกคณะ---</option>
																<?php foreach($query as $r){ 
																	if($faculty_id == $r->faculty_id){
																?>
																	<option selected value="<?= $r->faculty_id ?>"><?= $r->faculty_name ?></option>
																<?php }else{ ?>
																	<option value="<?= $r->faculty_id ?>"><?= $r->faculty_name ?></option>
																<?php }
																}
																?>
															</select>
                                        </div>
                                     </div>
                                     <br>
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <label class="control-label">สาขา: </label>
                                            <select class="form-control" name="major_id" id="majors">
                                                <option value="0">---เลือกสาขา---</option>

                                                <?php 
                                                if(isset($major_id)){
                                                foreach($major as $r){ 
                                                        if($major_id == $r->major_id){
                                                    ?>
                                                        <option selected value="<?= $r->major_id ?>"><?= $r->major_name ?></option>
                                                    <?php }else{ ?>
                                                        <option value="<?= $r->major_id ?>"><?= $r->major_name ?></option>
                                                    <?php }
                                                    }
                                                }
                                                    ?>
											</select>
                                        </div>
                                     </div>
                                     <br>
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <input class="btn btn-primary" value="submit" type="submit">
                                        </div>
                                     </div>
                                     </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </article>
                <!-- End Content -->
                <script type="text/javascript">
$(document).ready(function(){

    $('#faculty').on('change',function(){
        var provinceID = $(this).val(); 
        if(provinceID != 0){
            $.ajax({
                type:'GET',
                url:'<?= site_url('get_major_id'); ?>',
                data:'fac_id='+provinceID,
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