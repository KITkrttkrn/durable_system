 <!-- Begin Content -->
 <?php foreach($query as $row){ ?>
 <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> โปรไฟล์ผู้ใช้ </h3> <!-- หัวหลัก -->
                        <p class="title-description"> </p> <!-- หัวรอง -->
                    </div>

                    <section class="section">
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
                                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $row->user_name; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">นามสกุล</label>
                                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $row->user_surname; ?>">
                                                        </div>
                                                    </div>
                                               </div>
                                               <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Email</label>
                                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $row->user_email; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">วันที่สมัครใช้งาน</label>
                                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $changedate[2]."/".$changedate[1]."/".$changedate[0]; ?>">
                                                        </div>
                                                    </div>
                                               </div>
                                               <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">สาขา</label>
                                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $row->major_name; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">คณะ</label>
                                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $row->faculty_name; ?>">
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
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="#" onclick="window.history.back();" class="btn btn-secondary">ย้อนกลับ</a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="<?php echo site_url('edit_profile/'.$row->user_id);?>" class="btn btn-primary">แก้ไขข้อมูล</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </article>
                <!-- End Content -->
<?php } ?>