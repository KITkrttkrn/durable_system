                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> แบบฟอร์มการคืนครุภัณฑ์ </h3> <!-- หัวหลัก -->
                        <!-- <p class="title-description"> Grid elements </p> หัวรอง -->
                    </div>

                    <section class="section">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="card " data-exclude="xs,sm,lg">
                                    <div class="card-block">
                                        <form role="form" method="POST" action="<?= site_url('process_return'); ?>">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label class="control-label"> รายการครุภัณฑ์ที่ยืม </label>
                                                    <select class="form-control" name="borrow_id">
                                                        <option  value=""> เลือกครุภัณฑ์ </option>
                                                        <?php foreach($borrow_his as $r){
                                                            echo "<option value=\"".$r->borrow_id."\"> ".$r->durable_name." </option>";
                                                        } ?>
                                                    </select>
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
