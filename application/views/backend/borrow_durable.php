                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> เช่ายืมครุภัณฑ์ </h3> <!-- หัวหลัก -->
                        <!-- <p class="title-description"> Grid elements </p> หัวรอง -->
                    </div>

                    <section class="section">
                        <div class="row">
                            <div class="col-md-2 col-xs-12">
                                <a href="<?= site_url('borrowing'); ?>" class="btn btn-block btn-primary">ยืมครุภัณฑ์</a>
                            </div>

                            <div class="col-md-2 col-xs-12">
                                <a href="<?= site_url('return'); ?>" class="btn btn-block btn-danger">คืนครุภัณฑ์</a>
                            </div>

                            <div class="col-md-10">
                            </div>
                        </div>
                    </section>

                    <section class="section">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card " data-exclude="xs,sm,lg">
                                    <div class="card-header bordered">
                                        <div class="header-block">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#avai_tab" role="tab" data-toggle="tab">รายการครุภัณฑ์ที่สามารถยืมได้</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#his_tab" role="tab" data-toggle="tab">รายการครุภัณฑ์ที่กำลังถูกยืม</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#borrowing_tab" role="tab" data-toggle="tab">ประวัติการยืมครุภัณฑ์ที่ผ่านมา</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="card-block">
                                    <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active fade show" id="avai_tab">
                                            <table id="available_table" class="table compact row-border cell-border hover order-column" style="width:100%">
    		<thead>
            	<tr>
					<th><center>ลำดับ</center></th>
                	<th><center>ชื่อครุภัณฑ์</center></th>
            	</tr>
        	</thead>
            
    	<tbody>
			<?php 
			$i=1;
    foreach ($available_durable as $available_r) {?>               
            	<tr>
					<td><center><?php echo $i ;?></center></td>
	                <td><center><?php echo $available_r->durable_name ;?></center></td>
            	</tr>
			<?php 
			$i++;
        }
        	?>
    	</tbody>
		</table>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="his_tab">
                                            <table id="borrowing_table" class="table compact row-border cell-border hover order-column" style="width:100%">
    		<thead>
            	<tr>
					<th><center>ลำดับ</center></th>
                	<th><center>ชื่อครุภัณฑ์</center></th>
                	<th><center>วันที่ยืม</center></th>
                    <th><center>วันกำหนดคืน</center></th>
                    <th><center>วันที่คืน</center></th>
                    <th><center>สถานะ</center></th>
                    <th><center>ผู้ยืม</center></th>
            	</tr>
        	</thead>
            
    	<tbody>
			<?php 
			$i=1;
    foreach ($borrowing as $borrowing_r) {?>               
            	<tr>
					<td><center><?php echo $i ;?></center></td>
	                <td><center><?php echo $borrowing_r->durable_name ;?></center></td>
	                <td><center><?php echo $borrowing_r->borrow_date ;?></center></td>
                    <td><center><?php echo $borrowing_r->due_date;?></center></td>
                    <td><center><?php echo $borrowing_r->return_date;?></center></td>
                    <td><center><?php echo $borrowing_r->borrow_status_name;?></center></td>
                    <td><center><?php echo $borrowing_r->user_name;?></center></td>
            	</tr>
			<?php 
			$i++;
        }
        	?>
    	</tbody>
		</table>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="borrowing_tab">
                                            <table id="his_table" class="table compact row-border cell-border hover order-column" style="width:100%">
    		<thead>
            	<tr>
					<th><center>ลำดับ</center></th>
                	<th><center>ชื่อครุภัณฑ์</center></th>
                	<th><center>วันที่ยืม</center></th>
                    <th><center>วันกำหนดคืน</center></th>
					<th><center>วันที่คืน</center></th>
                	<th><center>สถานะการยืม</center></th>
            	</tr>
        	</thead>
            
    	<tbody>
			<?php 
			$i=1;
    foreach ($borrow_his as $his_r) {?>               
            	<tr>
					<td><center><?php echo $i ;?></center></td>
	                <td><center><?php echo $his_r->durable_name ;?></center></td>
	                <td><center><?php echo $his_r->borrow_date ;?></center></td>
                    <td><center><?php echo $his_r->due_date;?></center></td>
                    <td><center><?php echo $his_r->return_date;?></center></td>
                    <td><center><?php echo $his_r->borrow_status_name;?></center></td>
            	</tr>
			<?php 
			$i++;
        }
        	?>
    	</tbody>
		</table>
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
    $('#his_table').DataTable();
} );
</script>

<script type="text/javascript">
$(document).ready( function () {
    $('#borrowing_table').DataTable();
} );
</script>

<script type="text/javascript">
$(document).ready( function () {
    $('#available_table').DataTable();
} );
</script>