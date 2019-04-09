
                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> <?= $prom_name ?></h3> <!-- หัวหลัก -->
                    </div>

                    <section class="section">
                        <div class="row sameheight-container">
                            <div class="col-xl-6 col-md-6 col-xs-12">
                                <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                                    <form action="<?= site_url('process_room'); ?>" method="POST">
                                    <div class="card-block">
                                    
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <label class="control-label">ชื่อห้องเรียน: </label>
                                            <input type="hidden" name="room_id" value="<?= $room_id ?>">
                                            <input type="hidden" name="mode" value="<?= $mode; ?>">
                                            <input required class="form-control" name="room_name" type="text" value="<?= $room_name; ?>">
                                        </div>
                                     </div>
                                     <br>
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <label class="control-label">ศูนย์การเรียน: </label>
                                            <select class="form-control" name="campus_id" id="campus">
																<option value="">---เลือกศูนย์การเรียน---</option>
																<?php foreach($query as $r){ 
																	if($campus_id == $r->campus_id){
																?>
																	<option selected value="<?= $r->campus_id ?>"><?= $r->campus_name ?></option>
																<?php }else{ ?>
																	<option value="<?= $r->campus_id ?>"><?= $r->campus_name ?></option>
																<?php }
																}
																?>
															</select>
                                        </div>
                                     </div>
                                     <br>
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <label class="control-label">อาคาร: </label>
                                            <select class="form-control" name="building_id" id="building">
                                                <option value="0">---เลือกอาคาร---</option>

                                                <?php 
                                                if(isset($building_id)){
                                                foreach($building as $r){ 
                                                        if($building_id == $r->building_id){
                                                    ?>
                                                        <option selected value="<?= $r->building_id ?>"><?= $r->building_name ?></option>
                                                    <?php }else{ ?>
                                                        <option value="<?= $r->building_id ?>"><?= $r->building_name ?></option>
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
        $('#campus').on('change',function(){
            var provinceID = $(this).val(); 
            if(provinceID != 0){
                $.ajax({
                    type:'GET',
                    url:'<?= site_url('get_building_id'); ?>',
                    data:'campus_id='+provinceID,
                    success:function(html){
                        $('#building').html(html);
                    }
                }); 
            }else{
                $('#building').html('<option value="0">---โปรดเลือกศูนย์ก่อน---</option>'); 
            }
        });
    });

</script>