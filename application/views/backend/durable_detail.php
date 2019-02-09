<!-- Begin Content -->
<article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> รายละเอียดครุภัณฑ์ </h3> <!-- หัวหลัก -->
                        <p class="title-description"> <?php echo $durable[0]->durable_code." ".$durable[0]->durable_name; ?> </p> <!-- หัวรอง -->
                    </div>

                    <section class="section">
                        <div class="row sameheight-container">
                        	<div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="card sameheight-item items">
                                    <div class="card-header bordered img-resize">
                                     	<img width="100%" src="<?php echo RES_DURABLE."/".$durable[0]->picture_path; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row sameheight-container">
                            <div class="col-md-12">
                                <div class="card sameheight-item items">
                                    <div class="card-header bordered">
                               				<div class="col-md-12">
                               					<br>
                               					<div class="row">
		                                    		<div class="col-md-6">
				                                        <div class="form-group">
				                                            <label class="control-label">ชื่อ</label>
				                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $durable[0]->durable_name; ?>">
				                                        </div>
				                                    </div>
				                                    <div class="col-md-6">
				                                        <div class="form-group">
				                                            <label class="control-label">รหัสครุภัณฑ์</label>
				                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $durable[0]->durable_code; ?>">
				                                        </div>
				                                    </div>
		                                       </div>
		                                       <div class="row">
		                                    		<div class="col-md-6">
				                                        <div class="form-group">
				                                            <label class="control-label">ราคา</label>
				                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $durable[0]->price; ?>">
				                                        </div>
				                                    </div>
				                                    <div class="col-md-6">
				                                        <div class="form-group">
				                                            <label class="control-label">วันที่เริ่มใช้งาน</label>
				                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $durable[0]->use_date; ?>">
				                                        </div>
				                                    </div>
		                                       </div>
		                                       <div class="row">
		                                    		<div class="col-md-6">
				                                        <div class="form-group">
				                                            <label class="control-label">วันที่เพิ่มเข้าระบบ</label>
				                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $durable[0]->add_date; ?>">
				                                        </div>
				                                    </div>
				                                    <div class="col-md-6">
				                                        <div class="form-group">
				                                            <label class="control-label">ประเภทของครุภัณฑ์</label>
				                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $durable[0]->cat_name; ?>">
				                                        </div>
				                                    </div>
		                                       </div>
		                                       <div class="row">
		                                    		<div class="col-md-6">
				                                        <div class="form-group">
				                                            <label class="control-label">ผู้ดูแล</label>
				                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $durable[0]->user_name." ".$durable[0]->user_surname; ?>">
				                                        </div>
				                                    </div>
				                                    <div class="col-md-6">
				                                        <div class="form-group">
				                                            <label class="control-label">สถานะครุภัณฑ์</label>
				                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $durable[0]->durable_status_name; ?>">
				                                        </div>
				                                    </div>
		                                       </div>
		                                       <div class="row">
		                                    		<div class="col-md-6">
				                                        <div class="form-group">
				                                            <label class="control-label">ตำแหน่ง</label>
				                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $durable[0]->room_name; ?>">
				                                        </div>
				                                    </div>
		                                    		<div class="col-md-6">
				                                        <div class="form-group">
				                                            <label class="control-label">รายละเอียดเพิ่มเติม</label>
				                                            <textarea type="text" readonly="readonly" class="form-control" value="<?php echo $durable[0]->description; ?>"></textarea>
				                                        </div>
				                                    </div>
				                                </div>
                               				</div>                                 		
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                     <section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">

                                            <h3 class="title"> ประวัติการแจ้งปัญหา </h3>
                                        </div>
                                        <section class="example">
                                            <div class="table-flip-scroll">
                                                <table class="table table-striped table-bordered table-hover flip-content">
                                                    <thead class="flip-header">
                                                        <tr>
                                                            <th>ลำดับ</th>
                                                            <th>หัวข้อปัญหา</th>
                                                            <th>สถานะของปัญหา</th>
                                                            <th>เพิ่มเติม</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                        <?php
                                        $count_report = 1;
                                       	foreach($report as $reports){
                                         ?>
   
                                                        <tr class="odd gradeX">
                                                            <td><?php echo $count_report; ?></td>
                                                            <td><?php echo $reports->problem_topic; ?></td>
                                                            <td><?php echo $reports->problem_status_name; ?></td>
                                                            <td class="center"><a href="<?php echo site_url('report_detail/'.$reports->problem_id); ?>" class="btn btn-primary">เรียกดู</a></td>
                                                        </tr>
                                        <?php
                                        $count_report++;
                                    	}
                                         ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

					<section class="section">
                        <div class="row sameheight-container">
                            <div class="col-md-2">
                                <div class="sameheight-item items">
                                    <div class="row">
                                    <br>
                                        <div class="col-md-12">
                                            <a target="_blank" href="<?= site_url('qrcode/'.$durable[0]->durable_id); ?>" class="btn btn-primary">พิมพ์ QrCode</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row sameheight-container">
                            <div class="col-md-2">
                                <div class="sameheight-item items">
                                    <div class="row">
                                    <br>
                                        <div class="col-md-12">
                                            <a href="#" onclick="window.history.back();" class="btn btn-secondary">ย้อนกลับ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </article>
                <!-- End Content -->