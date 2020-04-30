<script>
    var proyek;
    <?php if(isset($proyek)): ?>
    proyek = JSON.parse('<?php echo json_encode($proyek); ?>');
    <?php else: ?>
        $('#errorPageDialog').modal('show');
    <?php endif; ?>

    $(document).ready(function(){
        var table = $('#laporan-table').DataTable({
            "columnDefs" : [{
                "targets" : 2,
                "visible" : false
            }]
        });
        $('#pemeriksaan-btn').on('click', function(){
            table.column(2).visible(true);
            $(this).hide();
            $('#verifikasi-btn').fadeIn();
        }); 

        $('#verifikasi-btn').on('click', function(){
            var id_pekerjaan = [];
            $('.tandai-pekerjaan.active').each(function(){
                var id_elem = $(this).data('id');
                id_pekerjaan.push(id_elem);
            });
            var data = {
                id : id_pekerjaan,
                status : 1
            }

            // send. pekerjaan id's array to pekerjaan table
            // update. status related to pekerjaan id's to 1
            // expect. all proyek from this pengawas (use user id)
            $.ajax({
                url : "<?php echo base_url('api/Proyek/status_pekerjaan'); ?>",
                method : 'POST',
                data : data,
                success : function(responseProyek){
                    var proyek = JSON.stringify(responseProyek.data);
                    id_pekerjaan.forEach(function(id){
                        table.rows('tr[data-id="'+id+'"]').remove().draw();
                    });

                    //send. proyek to pengawas board
                    $.ajax({
                        url : "<?php echo base_url('contractor/pengawas_board'); ?>",
                        method : 'POST',
                        data : {
                            proyek : proyek
                        }
                    })
                }
            });
            table.column(2).visible(false);
            $(this).hide();
            $('#pemeriksaan-btn').fadeIn();
        });

        $('.laporan-table-body').on('click', '.tandai-pekerjaan', function(){
            var id = $(this).data('id');
            if($('.tandai-pekerjaan[data-id="'+id+'"]').hasClass("active")){
                $('.tandai-pekerjaan[data-id="'+id+'"]').html('Belum Selesai');
                $('span[data-id="'+id+'"].status-pekerjaan').removeClass('badge-success').addClass('badge-secondary');
                $('span[data-id="'+id+'"].status-pekerjaan').html('Belum Diperiksa');
            } else {
                $('.tandai-pekerjaan[data-id="'+id+'"]').html('Selesai');
                $('span[data-id="'+id+'"].status-pekerjaan').removeClass('badge-secondary').addClass('badge-success');
                $('span[data-id="'+id+'"].status-pekerjaan').html('Sudah Diperiksa');
            }
        });

    });
</script>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h3">Laporan Proyek</h1>
                    <div class="btn-toolbar mb-2 mb-md-0 mr-3">
                        <button class="btn btn-outline-secondary" id="pemeriksaan-btn">Periksa Laporan</button>
                        <button class="btn btn-outline-secondary" id="verifikasi-btn" style="display:none;">Verifikasi</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm display" width="100%" id="laporan-table">
                        <thead>
                            <th>Pekerjaan</th>
                            <th>Status</th>
                            <th>Pengecekan</th>
                        </thead>
                        <tbody class="laporan-table-body">
                        <?php if(isset($proyek['pekerjaan'])): ?>
                            <?php foreach($proyek['pekerjaan'] as $pekerjaan): ?>
                                <?php if($pekerjaan['status'] == 0): ?>
                                    <tr data-id="<?php echo $pekerjaan['id']; ?>">
                                    <td class="nama-pekerjaan" data-id="<?php echo $pekerjaan['id']; ?>"><?php echo $pekerjaan['nama']; ?></td>
                                    <td><span class="badge badge-secondary status-pekerjaan" data-id="<?php echo $pekerjaan['id']; ?>">Belum Diperiksa</span></td>
                                    <td><button class="btn btn-primary tandai-pekerjaan" data-toggle="button" data-id="<?php echo $pekerjaan['id']; ?>">Belum Selesai</button></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif;?>                     
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    </div>
</body>
</html>