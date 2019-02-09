
                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> รายละเอียดค่าเสื่อมราคาครุภัณฑ์ </h3> <!-- หัวหลัก -->
                        <p class="title-description"> <?php echo $query[0]->durable_code." ".$query[0]->durable_name; ?> </p> <!-- หัวรอง -->
                    </div>

                    <section class="section">
                        <div class="row sameheight-container">
                            <div class="col-md-6">
                                <div class="card sameheight-item items">
                                    <div class="card-header bordered">
                                            <div class="col-md-12">
                                                <br>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>ชื่อครุภัณฑ์ :</strong></td>
                                                            <td class="text-right"><?php echo $query[0]->durable_name; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>เลขครุภัณฑ์ :</strong></td>
                                                            <td class="text-right"><?php echo $query[0]->durable_code; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>                                      
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row sameheight-container">

                            <div class="col-md-6">
                                <div class="card sameheight-item items">
                                    <div class="card-header bordered">
                               				<div class="col-md-12">
                               					<br>
                               					<table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>ต้นทุนการซื้อสินทรัพย์</strong></td>
                                                            <td class="text-right"><?php echo $query[0]->price; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>มูลค่าซาก</strong></td>
                                                            <td class="text-right"><?php echo $query[0]->scrap_value; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>ฐานการคิดค่าเสื่อมราคา</strong></td>
                                                            <td class="text-right"><?php echo $query[0]->price - $query[0]->scrap_value; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>ปีสำหรับอายุการใช้งาน</strong></td>
                                                            <td class="text-right"><?php echo $query[0]->durable_age; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>ค่าเสื่อมราคาต่อปี</strong></td>
                                                            <td class="text-right"><?php echo ($query[0]->price - $query[0]->scrap_value)/$query[0]->durable_age; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                               				</div>                                 		
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                            <div class="col-md-12">
                                <div class="card sameheight-item items">
                                    <div class="card-header bordered">
                                            <div class="col-md-12">
                                                <br>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center"><strong>รอบระยะเวลา</strong></td>
                                                            <td class="text-center"><strong>การคำนวณยอดค่าเสื่อมราคารายปี</strong></td>
                                                            <td class="text-center"><strong>มูลค่าตามบัญชีสุทธิ ณ สิ้นปี</strong></td>
                                                        </tr>
                                                        <?php 
                                                        $price_value = $query[0]->price;
                                                        for($i = 1;$i <= $query[0]->durable_age;$i++){
                                                            $result_value = ($query[0]->price - $query[0]->scrap_value) / $query[0]->durable_age;
                                                            $price_value = $price_value - $result_value;
                                                        ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo "ปีที่ ".$i; ?></td>
                                                            <td class="text-center"><?php echo "(".$query[0]->price." - ".$query[0]->scrap_value.") / ".$query[0]->durable_age; ?></td>
                                                            <td class="text-center"><?php echo $price_value; ?></td>
                                                        </tr>
                                                        <?php 
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
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