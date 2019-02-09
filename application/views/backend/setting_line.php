                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> การตั้งค่าระบบ </h3> <!-- หัวหลัก -->
                    </div>

                    <section class="section">
                        <div class="row sameheight-container">
                            <div class="col-xl-6 col-md-6 col-xs-12">
                                <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                                    <div class="card-header bordered">
                                        <div class="header-block">
                                            <h3 class="title"> Line Notify</h3>
                                        </div>
                                    </div>
                                    
                                    <div class="card-block">
                                    <form action="<?= site_url('process_setting'); ?>" method="POST">
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <label class="control-label"> <b>Token ปัจจุบัน: </b><?= $query[0]->sysvalue; ?> </label>
                                            <input type="hidden" name="viewname" value="setting_line">
                                            <input type="hidden" name="syscode" value="<?= $query[0]->syscode; ?>">
                                            <input class="form-control" name="sysvalue" type="text" value="<?= $query[0]->sysvalue; ?>">
                                        </div>
                                     </div>
                                     <br>
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <input class="btn btn-primary" value="submit" type="submit">
                                        </div>
                                     </div>
                                     </form>
                                     <br>
                                     <br>
                                     <form action="<?= site_url('process_setting'); ?>" method="POST">
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <label class="control-label"> <b>ข้อความ ปัจจุบัน: </b><?= $query2[0]->sysvalue; ?> </label>
                                            <input type="hidden" name="viewname" value="setting_line">
                                            <input type="hidden" name="syscode" value="<?= $query2[0]->syscode; ?>">
                                            <input class="form-control" name="sysvalue" type="text" value="<?= $query2[0]->sysvalue; ?>">
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