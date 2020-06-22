
                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> <?= $prom_name ?></h3> <!-- หัวหลัก -->
                    </div>

                    <section class="section">
                        <div class="row sameheight-container">
                            <div class="col-xl-6 col-md-6 col-xs-12">
                                <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                                    <form action="<?= site_url('process_major'); ?>" method="POST">
                                    <div class="card-block">
                                    
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <label class="control-label">ชื่อสาขา: </label>
                                            <input type="hidden" name="major_id" value="<?= $major_id ?>">
                                            <input type="hidden" name="mode" value="<?= $mode; ?>">
                                            <input required class="form-control" name="major_name" type="text" value="<?= $major_name; ?>">
                                        </div>
                                     </div>
                                     <br>
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <label class="control-label">คณะ: </label>
                                            <select class="form-control" name="faculty_id">
																<option value="">---เลือกคณะ---</option>
																<?php foreach($query as $r){ 
																	if($faculty_id == $r->faculty_id){
																?>
																	<option selected value="<?= $r->faculty_id ?>"><?= $r->faculty_name ?></option>
																<?php }else{ ?>
																	<option value="<?= $r->faculty_id ?>"><?= $r->faculty_name ?></option>
																<?php }
																}
																?>
															</select>
                                        </div>
                                     </div>
                                     <br>
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <input class="btn btn-primary" value="submit" type="submit">
                                        </div>
                                     </div>
                                     </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </article>
                <!-- End Content -->