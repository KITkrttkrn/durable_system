                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> แบบฟอร์มการยืมครุภัณฑ์ </h3> <!-- หัวหลัก -->
                        <!-- <p class="title-description"> Grid elements </p> หัวรอง -->
                    </div>

                    <section class="section">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="card " data-exclude="xs,sm,lg">
                                    <div class="card-block">
                                        <form role="form" method="POST" action="<?= site_url('process_borrow'); ?>">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label class="control-label"> รายการครุภัณฑ์ </label>
                                                    <select class="form-control" name="durable_id">
                                                        <option  value=""> เลือกครุภัณฑ์ </option>
                                                        <?php foreach($available_durable as $r){
                                                            echo "<option value=\"".$r->durable_id."\"> ".$r->durable_name." </option>";
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                <label class="control-label"> วันที่คืน </label>
                                                    <input type="date" class="form-control" name="return_date">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <input type="submit" class="btn btn-primary btn-block" value="ยืนยัน">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </section>

                </article>
                <!-- End Content -->
