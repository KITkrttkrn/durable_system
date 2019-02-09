               <!-- Begin Content -->
               <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> <?php echo $query[0]->user_name." ".$query[0]->user_surname; ?> </h3> <!-- หัวหลัก -->
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
                                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $query[0]->user_name; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">นามสกุล</label>
                                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $query[0]->user_surname; ?>">
                                                        </div>
                                                    </div>
                                               </div>
                                               <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Email</label>
                                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $query[0]->user_email; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">วันที่สมัครใช้งาน</label>
                                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $query[0]->register_date; ?>">
                                                        </div>
                                                    </div>
                                               </div>
                                               <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">สาขา</label>
                                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $query[0]->major_name; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">คณะ</label>
                                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $query[0]->faculty_name; ?>">
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
                                            <form action="<?= site_url('process_user_detail'); ?>" method="POST">
                                            <div class="col-md-12">
                                                <input type="hidden" name="user_id" value="<?php echo $query[0]->user_id; ?>">
                                                <label class="control-label">สถานะผู้ใช้งาน</label><br>
                                                <label>
                                                <input <?php if($query[0]->user_status_id == 'Y'){ echo "checked";} ?> class="radio" type="radio" name="user_status" value="Y"> <span>เปิดใช้งาน</span></label>
                                                <label>
                                                <input <?php if($query[0]->user_status_id == 'N'){ echo "checked";} ?> class="radio" type="radio" name="user_status" value="N"> <span>ปิดใช้งาน</span></label>
                                                
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="col-md-6">
                                    <a href="#" onclick="window.history.back();" class="btn btn-secondary">ย้อนกลับ</a>
                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </article>
                <!-- End Content -->