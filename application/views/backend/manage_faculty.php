
                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> รายการคณะ </h3> <!-- หัวหลัก -->
                        <!-- <p class="title-description"> Grid elements </p> --> <!-- หัวรอง -->
                    </div>

                    <section class="section">
					<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
										<div class="row">
                            			<div class="col-md-12">
										<a href="<?php echo site_url('add_faculty/');?>" class="btn btn-primary">เพิ่มข้อมูล</a>
										<br>
										<br>
										</div>
										</div>
										<div class="row">
                            				<div class="col-md-12">
                                                <table id="table_id" class="table compact row-border cell-border hover order-column" style="width:100%">
												<thead>
													<tr>
														<th><center>ลำดับ</center></th>
														<th><center>รายการคณะ</center></th>
														<th><center>จัดการ</center></th>
													</tr>
												</thead>
												
											<tbody>
												<?php 
												$i=1;
										foreach ($query as $r) {?>               
													<tr>
														<td><center><?php echo $i ;?></center></td>
														<td><center><?php echo $r->faculty_name ;?></center></td>
														<td><center><a href="<?php echo site_url('edit_faculty/'.$r->faculty_id);?>" ><button class="btn btn-warning btn-sm">แก้ไข</button></a>&nbsp;<button onclick="chkConfirm(<?= $r->faculty_id ?>)" class="btn btn-danger btn-sm">ลบ</button></center></td>
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
			
			window.location = "<?= site_url('delete_faculty/'); ?>"+e;

		}
	}
</script>