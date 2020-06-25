
                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> รายการห้องเรียน</h3> <!-- หัวหลัก -->
                        <!-- <p class="title-description"> Grid elements </p> --> <!-- หัวรอง -->
                    </div>

                    <section class="section">
					<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
										<div class="row">
											<div class="col-md-12">
											<a href="<?php echo site_url('add_room');?>" class="btn btn-primary">เพิ่มข้อมูล</a>
											<br>
											<br>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<form action="<?php echo site_url('manage_room');?>" method="POST">
													<div class="form-group">
														<div class="col-md-4">
															<select class="form-control" name="search" id="campus">
																<option value="">---เลือกศูนย์การเรียน---</option>
																<?php foreach($query as $r){ 
																	if($search == $r->campus_id){
																?>
																	<option selected value="<?= $r->campus_id ?>"><?= $r->campus_name ?></option>
																<?php }else{ ?>
																	<option value="<?= $r->campus_id ?>"><?= $r->campus_name ?></option>
																<?php }
																}
																?>
															</select>
															
														</div>
														<br>
														<div class="col-md-4">
															<select class="form-control" name="search_building" id="building">
															<option value="0">---เลือกอาคาร---</option>

															<?php 
															if(isset($search_building)){
															foreach($building as $r){ 
																	if($search_building == $r->building_id){
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
														<br>
														<div class="col-md-4">
													<!-- asdffsddfsfsd -->
															<input type="submit" name="btn_search" value="ค้นหา" class="btn btn-primary">
														</div>
													</div>			
													
												</form>
											</div>
										</div>

										<?php if(isset($btn_search) AND $search AND $search != ""){ ?>
										<div class="row">
                            				<div class="col-md-12">
                                                <table id="table_id" class="table compact row-border cell-border hover order-column" style="width:100%">
												<thead>
													<tr>
														<th><center>ลำดับ</center></th>
														<th><center>ห้องเรียน</center></th>
														<th><center>อาคาร</center></th>
														<th><center>ศูนย์การเรียน</center></th>
														<th><center>จัดการ</center></th>
													</tr>
												</thead>
												
											<tbody>
												<?php 
												$i=1;
										foreach ($room as $r) {?>               
													<tr>
														<td><center><?php echo $i ;?></center></td>
														<td><center><?php echo $r->room_name ;?></center></td>
														<td><center><?php echo $r->building_name ;?></center></td>
														<td><center><?php echo $r->campus_name ;?></center></td>
														<td><center><a href="<?php echo site_url('edit_room/'.$r->room_id);?>" ><button class="btn btn-warning btn-sm">แก้ไข</button></a>&nbsp;<button onclick="chkConfirm(<?= $r->room_id ?>)" class="btn btn-danger btn-sm">ลบ</button></center></td>
													</tr>
												<?php 
												$i++;
											}
												?>
											</tbody>
											</table>
                            <!-- เฟิสแก้ตั้งแต่ตรงนี้ -->
									</div>
									</div>
										<?php } ?>
								</div>
                        	</div>
                        </div>
						</div>
                    </section>
                </article>
                <!-- End Content -->
                <script type="text/javascript">
	$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>

<script language="JavaScript">
	function chkConfirm(e)
	{
		if(confirm('ยืนยันการลบข้อมูลนี้')==true)
		{
			
			window.location = "<?= site_url('delete_room/'); ?>"+e;

		}
	}
</script>

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