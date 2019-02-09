<!-- Begin Content -->
<article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> รายการครุภัณฑ์ สำหรับคำนวณค่าเสื่อมราคา </h3> <!-- หัวหลัก -->
                        <!-- <p class="title-description"> Grid elements </p> --> <!-- หัวรอง -->
                    </div>

                    <section class="section">
					<div class="row">
                            <div class="col-md-12">
                                <div class="card">
								  <div class="card-block">
                            <!-- เฟิสแก้ตั้งแต่ตรงนี้ -->
        <table id="table_id" class="compact row-border cell-border hover order-column" style="width:100%">
    		<thead>
            	<tr>
               		<th><center>ลำดับ</center></th>
                	<th><center>เลขครุภัณฑ์</center></th>
                	<th><center>ชื่อครุภัณฑ์</center></th>
                	<th><center>เพิ่มเติม</center></th>
            	</tr>
        	</thead>
            
    	<tbody>
			<?php 
			$i=1;
    foreach($query as $r) {?>               
            	<tr role="row" class="odd">
	                <td><center><?php echo $i;?></center></td>
	                <td><center><?php echo $r->durable_code;?></center></td>
	                <td><center><?php echo $r->durable_name;?></center></td>
	                <td><center><a href="<?php echo site_url('depreciation_detail/'.$r->durable_id);?>"><button class="btn btn-primary btn-sm">คำนวณ</button></a></center></td>
	                
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