        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 id="judulproyek" class="h3"></h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button class="btn btn-outline-secondary verifikasi-pekerjaan">Verifikasi</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm display" width="100%" id="pekerjaan-table">
                        <thead>
                            <th>Pekerjaan</th>
                            <th>Cek Selesai</th>
                            <th>Dokumentasi</th>
                        </thead>
                        <tbody class="laporan-table-body">
                        <?php if(isset($proyek['pekerjaan'])): ?>
                            <?php foreach($proyek['pekerjaan'] as $pekerjaan): ?>
                                <?php if($pekerjaan['status'] == -1): ?>
                                    <tr data-id="<?php echo $pekerjaan['id']; ?>">
                                    <td class="nama-pekerjaan" data-id="<?php echo $pekerjaan['id']; ?>"><?php echo $pekerjaan['nama']; ?></td>
                                    <td><button class="btn btn-primary tandai-pekerjaan" data-toggle="button" data-id="<?php echo $pekerjaan['id']; ?>">Belum Selesai</button></td>
                                    <td><button class="btn btn-dark dokumentasi-projek" data-id="<?php echo $pekerjaan['id']; ?>">+</button></td>
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
<script>
    var proyek;
    <?php if(isset($proyek)): ?>
    proyek = JSON.parse('<?php echo json_encode($proyek); ?>');
    <?php else: ?>
    proyek = {
        id : '',
        nama : '',
        lokasi : '',
        tanggal_awal : '',
        tanggal_akhir : '',
        pekerjaan : [{
            id : '',
            nama : '',
            volume : '',
            bobot : '', 
            tanggal_selesai : '',
            status : null,
            dokumentasi : ['']
        }],
        id_owner: '',
        id_pengawas : '',
        id_kontraktor : ''
    };
    <?php endif; ?>
    $(document).ready(function(){
        var table = $('#pekerjaan-table').DataTable();
        $('.tandai-pekerjaan').on('click', function(){
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

        $('.dokumentasi-projek').on('click', function(){
            var id = $(this).data('id');
            $('#dokumentasiProyekModal').data('idKerja', id);
            $('#dokumentasiProyekModal').modal('show');
        });

        $('#dokumentasi-proyek-button').on('click', function{
            var id_pekerjaan = $('#dokumentasiProyekModal').data('idKerja');
            var images = [];
            var files = $('input#dokumentasi-proyek').prop('files');
            var reader = new FileReader;
            reader.onload = (function(){
                images.push(reader.result);
            });
            if(files){
                files.each(function(img){
                    reader.readDataAsURL(img);
                });
            }

            $.ajax({
                url : "",
                method : 'POST',
                data : {
                    id : id_pekerjaan,
                    dokumentasi : images
                },
                success : function(){
                    $('#dokumentasiProyekModal').modal('hide');
                }
            });
        });

        $('#verifikasi-pekerjaan').on('click', function(){
            var id_pekerjaan = [];
            $('.tandai-pekerjaan.active').each(function(){
                var id_elem = $(this).data('id');
                id_pekerjaan.push(id_elem);
            });
            var data = {
                id : id_pekerjaan,
                status : 0
            }
            $.ajax({
                url : "",
                method : 'POST',
                data : data,
                success : function(responseProyek){
                    id_pekerjaan.forEach(function(id){
                        table.rows('tr[data-id="'+id+'"]').remove().draw();
                    });

                    var proyek = responseProyek.data[0];
                    $.ajax({
                        url : "<?php echo base_url('contractor/kontraktor_data_proyek'); ?>",
                        method : 'POST',
                        data : {proyek : proyek}
                    })
                }
            });
        });
    });
</script>
</body>
</html>