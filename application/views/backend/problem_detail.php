                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> รายละเอียดการแจ้งปัญหา </h3> <!-- หัวหลัก -->
                        <p class="title-description"> </p> <!-- หัวรอง -->
                    </div>

                    <section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                    	<div class="row">
                                    		<div class="col-md-6">
		                                        <div class="form-group">
		                                            <label class="control-label">หัวข้อปัญหา</label>
		                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $query[0]->problem_topic; ?>">
		                                        </div>
		                                    </div>
		                                    <div class="col-md-6">
		                                        <div class="form-group">
		                                            <label class="control-label">ชื่อครุภัณฑ์</label>
		                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $query[0]->durable_name; ?>">
		                                        </div>
		                                    </div>
                                       </div>
                                       <div class="row">
                                    		<div class="col-md-12">
		                                        <div class="form-group">
		                                            <label class="control-label">รายละเอียดปัญหา</label>
		                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $query[0]->problem_detail; ?>">
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
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-block">
                                    	<div class="row">
                                    		<div class="col-md-12">
		                                        <div class="form-group">
		                                            <label class="control-label">หัวข้อปัญหา</label>
		                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $query[0]->problem_status_name; ?>">
		                                        </div>
		                                    </div>
		                                </div>
                                    	<div class="row">
                                    		<div class="col-md-12">
                                    			<form method="POST" action="<?= site_url('process_problem_status'); ?>">
                                    				<input type="hidden" name="problem_id" value="<?php echo $query[0]->problem_id; ?>">
			                                        <div class="form-group">
			                                            <label class="control-label">จัดการสถานะของหัวข้อปัญหา</label>
			                                            <select name="problem_status_id" class="form-control form-control-lg">
			                                            <?php
			                                            foreach($query2 as $r2){
                                                               echo "<option value=\"".$r2->problem_status_id."\">".$r2->problem_status_name."</option>";
			                                            }
			                                             ?>    
			                                            </select>
			                                        </div>
			                                        <div class="form-group">
			                                        	<button type="submit" class="btn btn-primary">ยืนยัน</button>
			                                        </div>
		                                    	</form>
		                                    </div>
                                       </div>
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
                                                <a href="#" onclick="window.history.back();" class="btn btn-secondary">ย้อนกลับ</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>

                </article>
                <!-- End Content -->