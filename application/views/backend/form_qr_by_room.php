                <!-- Begin Content -->
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title"> การพิมพ์ QrCode ผ่านเลขห้อง </h3> <!-- หัวหลัก -->
                    </div>

                    <section class="section">
                        <div class="row sameheight-container">
                            <div class="col-xl-6 col-md-6 col-xs-12">
                                <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                                    <div class="card-header bordered">
                                        <div class="header-block">
                                            <h3 class="title"> การพิมพ์ QrCode ผ่านเลขห้อง </h3>
                                        </div>
                                    </div>
                                    <form action="<?= site_url('qrcode_by_room'); ?>" method="GET">
                                    <div class="card-block">
                                    
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <label class="control-label">ศูนย์การศึกษา</label>
                                            <select name="campus" id="campus" class="form-control">
                                                <option value="0"> ---โปรดเลือกศูนย์การศึกษา--- </option>
                                                <?php
                                                    foreach($campus as $r){
                                                        echo "<option value=\"".$r->campus_id."\">".$r->campus_name."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                     </div>
                                     <br>
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <label class="control-label">อาคาร</label>
                                            <select name="building" id="building" class="form-control">
                                                <option value="0"> ---โปรดเลือกอาคาร-- </option>
                                            </select>
                                        </div>
                                     </div>
                                     <br>
                                     <div class="row">
                                        <div class="col-xl-12 col-md-12 col-xs-12">
                                            <label class="control-label">ห้อง</label>
                                            <select name="room" id="room" class="form-control">
                                                <option value="0"> ---โปรดเลือกห้อง--- </option>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#campus').on('change',function(){
            var provinceID = $(this).val(); 
            if(provinceID != 0){
                $.ajax({
                    type:'GET',
                    url:'<?= site_url('get_building_id'); ?>',
                    data:'campus_id='+provinceID,
                    success:function(html){
                        $('#building').html(html);
                    }
                }); 
            }else{
                $('#building').html('<option value="0">---โปรดเลือกศูนย์ก่อน---</option>'); 
            }
        });
    });

    $(document).ready(function(){
        $('#building').on('change',function(){
            var provinceID = $(this).val(); 
            if(provinceID != 0){
                $.ajax({
                    type:'GET',
                    url:'<?= site_url('get_room_id'); ?>',
                    data:'building_id='+provinceID,
                    success:function(html){
                        $('#room').html(html);
                    }
                }); 
            }else{
                $('#room').html('<option value="0">---โปรดเลือกอาคารก่อน---</option>'); 
            }
        });
    });
</script>