
                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> รายการสาขา </h3> <!-- หัวหลัก -->
                        <!-- <p class="title-description"> Grid elements </p> --> <!-- หัวรอง -->
                    </div>

                    <section class="section">
					<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
										<div class="row">
											<div class="col-md-12">
											<a href="<?php echo site_url('add_major');?>" class="btn btn-primary">เพิ่มข้อมูล</a>
											<br>
											<br>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<form action="<?php echo site_url('manage_major');?>" method="POST">
													<div class="form-group">
														<div class="col-md-4">
															<select class="form-control" name="search">
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
														<th><center>รายการสาขา</center></th>
														<th><center>คณะ</center></th>
														<th><center>จัดการ</center></th>
													</tr>
												</thead>
												
											<tbody>
												<?php 
												$i=1;
										foreach ($major as $r) {?>               
													<tr>
														<td><center><?php echo $i ;?></center></td>
														<td><center><?php echo $r->major_name ;?></center></td>
														<td><center><?php echo $r->faculty_name ;?></center></td>
														<td><center><a href="<?php echo site_url('edit_major/'.$r->major_id);?>" ><button class="btn btn-warning btn-sm">แก้ไข</button></a>&nbsp;<button onclick="chkConfirm(<?= $r->major_id ?>)" class="btn btn-danger btn-sm">ลบ</button></center></td>
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
			
			window.location = "<?= site_url('delete_major/'); ?>"+e;

		}
	}
</script>