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
                                    		<div class="col-md-6">
		                                        <div class="form-group">
		                                            <label class="control-label">สถานะปัญหา</label>
		                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $query[0]->problem_status_name; ?>">
		                                        </div>
		                                    </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">รายละเอียดปัญหา</label>
                                                    <textarea type="text" readonly="readonly" class="form-control" value="<?php echo $query[0]->problem_detail; ?>"></textarea> 
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
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-block">
                                    	<div class="row">
                                    		<div class="col-md-6">
		                                        <a href="#" onclick="window.history.back();" class="btn btn-secondary">ย้อนกลับ</a>
		                                    </div>
                                            <div class="col-md-6">
                                                <a href="<?= site_url('report/'.$query[0]->problem_id); ?>" class="btn btn-primary">พิมพ์รายงาน</a>
                                            </div>
		                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </article>
                <!-- End Content -->