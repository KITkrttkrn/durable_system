
                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> รายการการแจ้งปัญหา </h3> <!-- หัวหลัก -->
                        <p class="title-description"></p> <!-- หัวรอง -->
                    </div>

                    <section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                                <table id="table_id" class="compact row-border cell-border hover order-column" style="width:100%"">
                                                    <thead>
                                                        <tr>
                                                            <th><center>ลำดับ</center></th>
                                                            <th><center>เลขครุภัณฑ์</center></th>
                                                            <th><center>หัวข้อ</center></th>
                                                            <th><center>สถานะ</center></th>
                                                            <th><center>จัดการ</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach($query as $r){
                                                    ?>
                                                        <tr>
                                                            <td><center> <?php echo $i; ?></center></td>
                                                            <td><center> <?php echo $r->durable_code; ?></center></td>
                                                            <td><center> <?php echo $r->problem_topic; ?></center> </td>
                                                            <td><center> <?php echo $r->problem_status_name; ?></center> </td>
                                                            <td><center><a class="btn btn-sm btn-primary" href="<?php echo site_url('problem_detail/'.$r->problem_id); ?>">จัดการ</center></a></td>
                                                        </tr>
                                                    <?php $i++;} ?>
                                                    </tbody>
                                                </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </article>
                <!-- End Content -->

                <script type="text/javascript">
	$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>