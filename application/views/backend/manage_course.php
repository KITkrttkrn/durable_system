
                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> รายการหลักสูตร </h3> <!-- หัวหลัก -->
                        <!-- <p class="title-description"> Grid elements </p> --> <!-- หัวรอง -->
                    </div>

                    <section class="section">
					<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
										<div class="row">
											<div class="col-md-12">
											<a href="<?php echo site_url('add_course');?>" class="btn btn-primary">เพิ่มข้อมูล</a>
											<br>
											<br>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<form action="<?php echo site_url('manage_course');?>" method="POST">
													<div class="form-group">
														<div class="col-md-4">
															<select class="form-control" name="search" id="faculty">
																<option value="">---เลือกคณะ---</option>
																<?php foreach($query as $r){ 
																	if($search == $r->faculty_id){
																?>
																	<option selected value="<?= $r->faculty_id ?>"><?= $r->faculty_name ?></option>
																<?php }else{ ?>
																	<option value="<?= $r->faculty_id ?>"><?= $r->faculty_name ?></option>
																<?php }
																}
																?>
															</select>
															
														</div>
														<br>
														<div class="col-md-4">
															<select class="form-control" name="search_major" id="majors">
															<option value="0">---เลือกสาขา---</option>

															<?php 
															if(isset($search_major)){
															foreach($major as $r){ 
																	if($search_major == $r->major_id){
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
														<th><center>หลักสูตร</center></th>
														<th><center>สาขา</center></th>
														<th><center>คณะ</center></th>
														<th><center>จัดการ</center></th>
													</tr>
												</thead>
												
											<tbody>
												<?php 
												$i=1;
										foreach ($course as $r) {?>               
													<tr>
														<td><center><?php echo $i ;?></center></td>
														<td><center><?php echo $r->course_name ;?></center></td>
														<td><center><?php echo $r->major_name ;?></center></td>
														<td><center><?php echo $r->faculty_name ;?></center></td>
														<td><center><a href="<?php echo site_url('edit_course/'.$r->course_id);?>" ><button class="btn btn-warning btn-sm">แก้ไข</button></a>&nbsp;<button onclick="chkConfirm(<?= $r->course_id ?>)" class="btn btn-danger btn-sm">ลบ</button></center></td>
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
			
			window.location = "<?= site_url('delete_course/'); ?>"+e;

		}
	}
</script>

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