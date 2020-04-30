<script>
    var proyek;
    <?php if(isset($proyek) && isset($pengawas) && isset($kontraktor)): ?>
        proyek = JSON.parse('<?php echo json_encode($proyek); ?>');
    <?php else: ?>
        $('#errorPageDialog').modal('show');
    <?php endif; ?>

    var idproyek = proyek.id;
    var idpengawas = proyek['pengawasID'];
    var idkontraktor = proyek['kontraktorID'];
    var pengawas;
    var kontraktor;
    if(proyek['pengawasID']){
        // send. id pengawas to pengawas table
        // expect. pengawas data related to id pengawas from pengawas table
        $.ajax({
            url : "<?php echo base_url('api/Users/pengawas'); ?>",
            method : "POST",
            data : {id : idpengawas},
            success : function(response){
                pengawas = response.data[0];
            }
        });
    } else{
        pengawas = {
            id : '',
            nama : '',
            username : '',
            role : '',
            alamat : '',
            telepon : '',
            profile : ''
        }
    }

    if(proyek['kontraktorID']){
        // send. id kontraktor to kontraktor table
        // expect. kontraktor data related to id kontraktor from kontraktor table
        $.ajax({
            url : "<?php echo base_url('api/Users/kontraktor'); ?>",
            method : "POST",
            data : {id : kontraktorID},
            success : function(response){
                kontraktor = response.data[0];
            }
        });
    } else{
        kontraktor = {
            id : '',
            nama : '',
            username : '',
            role : '',
            alamat : '',
            telepon : '',
            profile : ''
        }
    }
    $(document).ready(function(){
        // set pengawas profile
        if(pengawas.profile){
            $("img.gambar-pengawas").attr("src", pengawas.profile);
        } else {
            $('img.gambar-pengawas').attr('src', 'https://www.sackettwaconia.com/wp-content/uploads/default-profile.png');
        }

        // set pengawas name
        if(pengawas.nama){
            $("#nama-pengawas").html(pengawas.nama);
        } else {
            $("#nama-pengawas").html("No Name");
        }

        // set kontraktor profile
        if(kontraktor.profile){
            $("img.gambar-kontraktor").attr("src", kontraktor.profile);
        } else {
            $('img.gambar-kontraktor').attr('src', 'https://www.sackettwaconia.com/wp-content/uploads/default-profile.png');
        }

        // set kontraktor name
        if(kontraktor.nama){
            $("#nama-kontraktor").html(kontraktor.nama);
        } else {
            $("#nama-kontraktor").html("No Name");
        }
    });
    $(document).ready(function(){
        $('#tablepekerjaan').DataTable();

        $('#editnamaproyekbtn').on('click', function(){
            var namaproyekbaru = $('.edit-nama-proyek').val();
            if(namaproyekbaru){
                proyek.nama = namaproyekbaru;
                $('#nama-proyek').html(namaproyekbaru);
            }
            $('#editNamaProyekModal').modal('hide');
        });
        $('#editawalproyekbtn').on('click', function(){
            var tglawalproyekbaru = $('.edit-awal-proyek').val();
            if(tglawalproyekbaru){
                proyek['tanggal_awal'] = tglawalproyekbaru;
                $('#tanggal-awal-proyek').html(tglawalproyekbaru);
            }
            $('#editAwalProyekModal').modal('hide');
        });
        $('#editakhirproyekbtn').on('click', function(){
            var tglakhirproyekbaru = $('.edit-akhir-proyek').val();
            if(tglakhirproyekbaru){
                proyek['tanggal_akhir'] = tglakhirproyekbaru;
                $('#tanggal-selesai-proyek').html(tglakhirproyekbaru);
            }
            $('#editAkhirProyekModal').modal('hide');
        });
        $('#editlokasiproyekbtn').on('click', function(){
            var lokasiproyekbaru = $('.edit-lokasi-proyek').val();
            if(lokasiproyekbaru){
                proyek['lokasi'] = lokasiproyekbaru;
                $('#lokasi-proyek').html(lokasiproyekbaru);
            }
            $('#editLokasiProyekModal').modal('hide');
        });

        $('.edit-pekerjaan').on('click', function(){
            var idEdit = $(this).data('id');
            $('input#editnamapekerjaan').attr('placeholder', $(this).siblings('.nama-pekerjaan').val());
            $('input#editvolumepekerjaan').attr('placeholder', $(this).siblings('.volume-pekerjaan').val());
            $('input#editbobotpekerjaan').attr('placeholder', $(this).siblings('.bobot-pekerjaan').val());
            $('#editPekerjaanModal').data('idKerja', idEdit);
            $('#editPekerjaanModal').modal('show');
        });

        $('#editpekerjaanbtn').on('click', function(){
            var idPekerjaan = $('#editPekerjaanModal').data('idKerja');
            
            var ada = false;
            var changingWork = [];
            changingWork.forEach(elem => {
                if(elem == idPekerjaan)
                    ada = true;
            });
            if(!ada)
            {
                changingWork.push(idPekerjaan);
            }

            var namaPekerjaanBaru = $('input#editnamapekerjaan').val();
            var volumePekerjaanBaru =  $('input#editvolumepekerjaan').val();
            var bobotPekerjaanBaru = $('input#editbobotpekerjaan').val();
            if(namaPekerjaanBaru){
                (proyek['pekerjaan']).find(data => data.id == idPekerjaan).nama = namaPekerjaanBaru;
                $('td.nama-pekerjaan[data-id="'+idPekerjaan+'"]').html(namaPekerjaanBaru);
            }
            if(volumePekerjaanBaru){
                (proyek['pekerjaan']).find(data => data.id == idPekerjaan).volume = volumePekerjaanBaru;
                $('td.volume-pekerjaan[data-id="'+idPekerjaan+'"]').html(volumePekerjaanBaru);
            }
            if(bobotPekerjaanBaru){
                (proyek['pekerjaan']).find(data => data.id == idPekerjaan).bobot = bobotPekerjaanBaru;
                $('td.bobot-pekerjaan[data-id="'+idPekerjaan+'"]').html(bobotPekerjaanBaru);
            }

            $('#editPekerjaanModal').modal('hide');
        });

        $('#editkontraktorproyekbtn').on('click', function(){
            var kontraktorSelected = $('#editKontraktorProyek').val();
            
            // send. id kontraktor to kontraktor table
            // expect. kontraktor data related to id kontraktor from kontraktor table
            $.ajax({
                url : "<?php echo base_url('api/Users/kontraktor'); ?>",
                method : "POST",
                data : {id : kontraktorSelected},
                success : function(response){
                    kontraktor = response.data[0];
                }
            });

            if(kontraktor.profile)
                $('img.gambar-kontraktor').attr('src', kontraktor.profile);
            else
                $('img.gambar-kontraktor').attr('src', 'https://www.sackettwaconia.com/wp-content/uploads/default-profile.png');

            $('#nama-kontraktor').html(kontraktor.nama);
            $('#editKontraktorProyekModal').modal('hide');
        });

        $('#editpengawasproyekbtn').on('click', function(){
            var pengawasSelected = $('#editPengawasProyek').val();

            // send. id pengawas to kontraktor table
            // expect. pengawas data related to id pengawas from pengawas table
            $.ajax({
                url : "<?php echo base_url('api/Users/pengawas'); ?>",
                method : "POST",
                data : {id : pengawasSelected},
                success : function(response){
                    pengawas = response.data[0];
                }
            });

            if(pengawas.profile)
                $('img.gambar-pengawas').attr('src', pengawas.profile);
            else
                $('img.gambar-pengawas').attr('src', 'https://www.sackettwaconia.com/wp-content/uploads/default-profile.png');

            $('#nama-pengawas').html(pengawas.nama);
            $('#editPengawasProyekModal').modal('hide');
        });

        $('#konfirmasi-perubahan-proyek').on('click', function(){
            changingWork.forEach(elem => {
                 let pekerjaanBerubah = (proyek['pekerjaan']).find(data => data.id == elem);
                 let list = "<tr data-id='"+pekerjaanBerubah['id']+"'>\n";
                 list += "<td class='nama-pekerjaan' data-id='"+pekerjaanBerubah['id']+"'>"+pekerjaanBerubah['nama']+"</td>\n";
                 list += "<td class='volume-pekerjaan' data-id='"+pekerjaanBerubah['id']+"'>"+pekerjaanBerubah['volume']+"</td>\n";
                 list += "<td class='bobot-pekerjaan' data-id='"+pekerjaanBerubah['id']+"'>"+pekerjaanBerubah['bobot']+"</td>\n";
                 list += "</tr>\n";

                 let listdata = $(list);
                 listdata.prependTo(".body-table-pekerjaan-berubah");
            });

            $('#table-pekerjaan-yang-diedit').DataTable();
            $('#konfirmasiPerubahanProyekModal').modal('show');
        });

        $('#konfirmasiPerubahanProyekBtn').on('click', function(){
            var id = proyek.id;
            var nama = proyek.nama;
            var tanggal_awal = proyek['tanggal_awal'];
            var tanggal_akhir = proyek['tanggal_akhir'];
            var lokasi = proyek['lokasi'];
            var pekerjaan = [];
            changingWork.forEach(elem => {
                let pekerjaanBerubah = (proyek['pekerjaan']).find(data => data.id == elem);
                pekerjaan.push(pekerjaanBerubah);
            });
            var kontraktorID = kontraktor.id;
            var pengawasID = pengawas.id;

            var updateProyek = {
                id : id,
                nama : nama,
                tanggal_awal : tanggal_awal,
                tanggal_akhir : tanggal_akhir,
                lokasi : lokasi,
                pengawasID : pengawasID,
                kontraktorID : kontraktorID
            }

            // send. pekerjaan array to pekerjaan table
            // update. pekerjaan related to pekerjaan's array in pekerjaan table
            $.ajax({
                url : "<?php echo base_url('api/Proyek/change_pekerjaan'); ?>",
                method : "POST",
                data : {pekerjaan : JSON.stringify(pekerjaan)}
            });

            // send. updateProyek to proyek table
            // update. proyek related to id proyek in proyek table
            // expect. all proyek from owner id (use user id)
            $.ajax({
                url : "<?php echo base_url('api/Proyek/change_proyek'); ?>",
                method : 'POST',
                data : updateProyek,
                success : function(responseProyek){
                    var proyek = JSON.stringify(responseProyek.data);
                    // send. proyek to owner_board
                    $.ajax({
                        url : "<?php echo base_url('owner_board'); ?>",
                        method : 'POST',
                        data : {proyek : proyek}
                    });
                }
            });

            $('#konfirmasiPerubahanProyekModal').modal('hide');
        });
    });
</script>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h3">Edit Data Proyek</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button id="konfirmasi-perubahan-proyek" class="btn btn-sm btn-outline-secondary">Simpan Semua Perubahan</button>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
             <h4 class="mb-2">Data Proyek</h4> 
             <div class="mt-3">
                <div class="d-flex flex-wrap flex-md-nowrap align-items-center">  
                    <p class="mb-0 pr-1"><strong>Nama Proyek</strong></p>
                    <button class="edit-data-profil" data-toggle="modal" data-target="#editNamaProyekModal">Edit</button>
                </div>  
                <?php if(isset($proyek['nama'])): ?>
                <p id="nama-proyek"><?php echo $proyek['nama']; ?></p>
                <?php else: ?>
                <p id="nama-proyek" class="text-muted">Anda Belum Mendaftarkan Nama Proyek Ini</p>
                <?php endif; ?>  
            </div>
            <div>
                <div class="d-flex flex-wrap flex-md-nowrap align-items-center">  
                    <p class="mb-0 pr-1"><strong>Tanggal Mulai Proyek</strong></p>
                    <button class="edit-data-profil" data-toggle="modal" data-target="#editAwalProyekModal">Edit</button>
                </div>
                <?php if(isset($proyek['tanggal_awal'])): ?>
                <p id="tanggal-awal-proyek"><?php echo $proyek['tanggal_awal']; ?></p>
                <?php else: ?>
                <p id="tanggal-awal-proyek" class="text-muted">Anda Belum Mendaftarkan Tanggal Awal Proyek ini</p>
                <?php endif; ?>
            </div>
            <div>
                <div class="d-flex flex-wrap flex-md-nowrap align-items-center">  
                    <p class="mb-0 pr-1"><strong>Tanggal Selesai Proyek</strong></p>
                    <button class="edit-data-profil" data-toggle="modal" data-target="#editAkhirProyekModal">Edit</button>
                </div>
                <?php if(isset($proyek['tanggal_akhir'])): ?>
                <p id="tanggal-selesai-proyek"><?php echo $proyek['tanggal_akhir']; ?></p>
                <?php else: ?>
                <p id="tanggal-selesai-proyek" class="text-muted">Anda Belum Mendaftarkan Tanggal Akhir Proyek ini</p>
                <?php endif; ?>
            </div>
            <div>
                <div class="d-flex flex-wrap flex-md-nowrap align-items-center">  
                    <p class="mb-0 pr-1"><strong>Lokasi Proyek</strong></p>
                    <button class="edit-data-profil" data-toggle="modal" data-target="#editLokasiProyekModal">Edit</button>
                </div>
                <?php if(isset($proyek['lokasi'])): ?>
                <p id="lokasi-proyek"><?php echo $proyek['lokasi']; ?></p>
                <?php else: ?>
                <p id="lokasi-proyek" class="text-muted">Anda Belum Mendaftarkan Lokasi Proyek ini</p>
                <?php endif; ?>
            </div>
          </div>
          <div class="col-md-6">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-2">Data Pekerjaan Proyek</h4> 
            </div>
            <div class="table-responsive mt-3">
              <table class="table" style="width: 100%;" id="tablepekerjaan">
                <thead>
                  <tr>
                    <th>Nama Pekerjaan</th>
                    <th>Volume</th>
                    <th>Bobot</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    if(isset($proyek['pekerjaan'])){
                        foreach($proyek['pekerjaan'] as $pekerjaan) {
                            echo"<tr data-id='",$pekerjaan['id'],"'>\n
                            <td class='nama-pekerjaan' data-id='",$pekerjaan['id'],"'>",$pekerjaan['nama'],"</td>\n
                            <td class='volume-pekerjaan' data-id='",$pekerjaan['id'],"'>",$pekerjaan['volume'],"</td>\n
                            <td class='bobot-pekerjaan' data-id='",$pekerjaan['id'],"'>",$pekerjaan['bobot'],"</td>\n
                            <td><button class='btn btn-sm btn-outline-secondary edit-pekerjaan' data-id='",$pekerjaan['id'],"'>Edit</button></td>\n
                            </tr>\n";
                        }
                    }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4 pt-2">
                <h4 class="mb-2 px-2">Penanggung Jawab Proyek</h4> 
                <div class="row mt-3">
                    <div class="col-md-6 text-center">
                        <div class="data-pjproyek mb-3">
                            <img class="gambar-kontraktor" width="100%">
                            <div class="container">
                                <p class="lead mt-2 mb-0" style="font-size:15px;">Kontraktor</p>
                                <p class="text-muted" id="nama-kontraktor"></p>
                            </div>
                        </div>
                        <div>
                            <button class="edit-data-profil mt-1" data-toggle="modal" data-target="#editKontraktorProyekModal">Ganti Kontraktor</button>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="data-pjproyek mb-3">
                            <img class="gambar-pengawas" width="100%">
                            <div class="container">
                                <p class="lead mt-2 mb-0" style="font-size:15px;">Pengawas</p>
                                <p class="text-muted" id="nama-pengawas"></p>
                            </div>
                        </div>
                        <div>
                            <button class="edit-data-profil mt-1" data-toggle="modal" data-target="#editPengawasProyekModal">Ganti Pengawas</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>  
    </main>
  </div>
</div>
</body>
</html>