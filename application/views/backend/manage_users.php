
                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> รายชื่อ users </h3> <!-- หัวหลัก -->
                        <!-- <p class="title-description"> Grid elements </p> --> <!-- หัวรอง -->
                    </div>

                    <section class="section">
					<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                                <table id="table_id" class="table compact row-border cell-border hover order-column" style="width:100%">
    		<thead>
            	<tr>
					<th><center>ลำดับ</center></th>
                	<th><center>ชื่อ</center></th>
                	<th><center>สกุล</center></th>
                    <th><center>ประเภทผู้ใช้</center></th>
					<th><center>สถานะ</center></th>
                	<th><center>แก้ไข</center></th>
            	</tr>
        	</thead>
            
    	<tbody>
			<?php 
			$i=1;
    foreach ($query as $r) {?>               
            	<tr>
					<td><center><?php echo $i ;?></center></td>
	                <td><center><?php echo $r->user_name ;?></center></td>
	                <td><center><?php echo $r->user_surname ;?></center></td>
                    <td><center><?php echo $r->type_user_name;?></center></td>
					<td><center><?php if($r->user_status_id == 'Y') {echo "เปิด";} else if($r->user_status_id == 'N') {echo "ปิด";}?></center></td>
	                <td><center><a href="<?php echo site_url('user_detail/'.$r->user_id);?>"><button class="btn btn-primary btn-sm">เรียกดู</button></a></center></td>
            	</tr>
			<?php 
			$i++;
        }
        	?>
    	</tbody>
    	<!-- <tfoot>
            	<tr>
	                <th><center>ลำดับ</center></th>
	                <th><center>เลขครุภัณฑ์</center></th>
	                <th><center>ชื่อครุภัณฑ์</center></th>
	                <th><center>เพิ่มเติ่ม</center></th>
           		</tr>
            </tfoot> -->
		</table>
                            <!-- เฟิสแก้ตั้งแต่ตรงนี้ -->
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