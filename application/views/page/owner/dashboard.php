    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h3">Daftar Proyek</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button data-toggle="modal" data-target="#createProject" class="btn btn-sm btn-outline-secondary">+ Buat Proyek</button>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-sm display" style="width:100%" id="table-proyek">
            <thead>
              <tr>
                <th>Nama Proyek</th>
                <th>Edit Proyek</th> 
                <th>Nama Kontraktor</th>
                <th>Edit Kontraktor</th>
                <th>Lihat Detail</th>
                <th>Hapus Proyek</th>
              </tr>
            </thead>
            <tbody id="table-proyek-body">
              <?php if(isset($proyek)): ?>
                <?php foreach ($proyek as $listproyek): ?>
                  <tr data-id='<?php echo $listproyek['id']; ?>'>
                  <td class='nama-proyek' data-id='<?php echo $listproyek['id']; ?>'><?php echo $listproyek['nama']; ?></td>
                  <td>
                  <button class='btn btn-sm btn-outline-secondary edit-proyek-btn' data-id='<?php echo $listproyek['id']; ?>'>Edit Proyek</button>
                  </td>
                  <td>
                  <span class='nama-kontraktor' data-id='<?php echo $listproyek['id']; ?>'>
                  <?php
                    if(isset($kontraktor)){
                      foreach($kontraktor as $kontraktor){
                        if($kontraktor['id'] == $listproyek['kontraktorID']){
                          echo $kontraktor['nama'];
                          break;
                        }
                      }
                    }
                  ?>
                  </span>
                  <select class='custom-select kontraktor-editor' style='display:none;' data-id='<?php echo $listproyek['id']; ?>'>
                  <?php 
                    if(isset($kontraktor)){
                      foreach($kontraktor as $listkontraktor) {
                        echo"<option value='",$listkontraktor['id'],"'>",$listkontraktor['nama'],"</option>";
                      }
                    }
                  ?>
                  </select>
                  </td>
                  <td>
                  <button class='btn btn-sm btn-outline-secondary edit-kontraktor-btn' data-id='<?php echo $listproyek['id']; ?>'>Edit Kontraktor</button>
                  </td>
                  <td>
                  <button class='btn btn-sm text-muted detail-proyek-btn' data-id='<?php echo $listproyek['id']; ?>'>Lihat Detail</button>
                  </td>
                  <td>
                  <button class='btn btn-sm btn-danger hapus-proyek-btn' data-id='<?php echo $listproyek['id']; ?>'>Hapus Proyek</button>
                  </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Daftar Pengawas</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <a href="<?php echo base_url('owner/dashboard/buat-pengawas'); ?>" type="button" class="btn btn-sm btn-outline-secondary">+ Buat Akun Pengawas</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
        <table class="table" style="width:100%" id="table-pengawas">
            <thead>
              <tr>
                <th>Nama Pengawas</th>
                <th>Edit Pengawas</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(isset($pengawas)){
                  foreach($pengawas as $listpengawas) {
                    echo"<tr data-id='",$listpengawas['id'],"'>\n
                    <td class='nama-pengawas' data-id='",$listpengawas['id'],"'>",$listpengawas['nama'],"<td>\n
                    <td>
                    <button class='btn btn-sm btn-outline-secondary edit-pengawas-btn' data-id='",$listpengawas['id'],"'>Edit Pengawas</button>
                    </td>\n
                    </tr>\n";
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</div>
<!---->
<script> 
  $(document).ready(function(){

      var tabelProyek = $('#table-proyek').DataTable();

      var tabelPengawas = $('#table-pengawas').DataTable();

      $('#table-proyek-body').on('click', '.edit-proyek-btn', function(){
        var id = $(this).attr("data-id");
        
        // send. id proyek to proyek table
        // expect. proyek data related to id proyek
        $.ajax({
          url:"<?php echo base_url('api/Proyek/proyek'); ?>",
          method:'POST',
          data: {id : id},
          success: function(responseProyek){
            var proyek = JSON.stringify(responseProyek.data[0]);
            
            // expect. all kontraktor in kontraktor table
            $.ajax({
              url: "<?php echo base_url('api/Users/kontraktorall'); ?>",
              method:'GET',
              success: function(responseKontraktor){
                var kontraktor = JSON.stringify(responseKontraktor.data);
                // send. kontraktor to owner_edit_proyek
                $.ajax({
                  url:"<?php echo base_url('contractor/owner_edit_proyek'); ?>",
                  method:'POST',
                  data: {kontraktor : kontraktor}
                });
              }
            });
            // expect. all pengawas related to owner id (use user id)
            $.ajax({
              url: "<?php echo base_url('api/Users/pengawas_byowner'); ?>",
              method: 'GET',
              success: function(responsePengawas){
                var pengawas = JSON.stringify(responsePengawas.data);
                // send. pengawas to owner_edit_proyek
                $.ajax({
                  url:"<?php echo base_url('contractor/owner_edit_proyek'); ?>",
                  method:'POST',
                  data: {pengawas : pengawas}
                });
              }
            });
            // send proyek to owner_edit_proyek
            $.ajax({
              url:"<?php echo base_url('contractor/owner_edit_proyek'); ?>",
              method:'POST',
              data: {proyek : proyek},
              success: function(){
                window.location.href="<?php echo base_url('owner/dashboard/edit-proyek'); ?>";
              }
            });
          }
        });
      });

      $('#table-proyek-body').on('click', '.detail-proyek-btn', function(){
        var id = $(this).attr("data-id");
        
        // send. proyek id to proyek table
        // expect. proyek related to proyek id from proyek table
        $.ajax({
          url:"<?php echo base_url('api/Proyek/proyek'); ?>",
          method:'POST',
          data: {id : id},
          success: function(responseProyek){
            var proyek = JSON.stringify(responseProyek.data[0]);

            // send. proyek data to owner_monitoring
            $.ajax({
              url:"<?php echo base_url('contractor/owner_monitoring'); ?>",
              method:'POST',
              data: {proyek : proyek},
              success: function(){
                window.location.href="<?php echo base_url('owner/dashboard/proyek'); ?>";
              }
            });
          }
        });
      });

      $('#table-proyek-body').on('click', '.edit-kontraktor-btn', function(){
        var id = $(this).attr("data-id");
        $('span[data-id="'+id+'"]').hide();
        $('select[data-id="'+id+'"]').fadeIn().focus();
      });

      $('#table-proyek-body').on('change', '.kontraktor-editor', function(){
        var id = $(this).attr("data-id");
        var gantikontraktor = $(this).val();
        
        // send. id proyek and id kontraktor to proyek table
        // update. id kontraktor from proyek that have id proyek from proyek table
        // expect. kontraktor related to id kontraktor from kontraktor table
        $.ajax({
          url:"<?php echo base_url('api/Proyek/kontraktor_proyek'); ?>",
          method:'POST',
          data: {
            id : id,
            kontraktorID : gantikontraktor
          },
          success: function(kontraktor){
            $('select[data-id="'+id+'"]').hide();
            var kontraktor = kontraktor.data[0];
            var namakontraktor = kontraktor.nama;
            $('span[data-id="'+id+'"]').html(namakontraktor).fadeIn();
          }
        });
      });

      $('.edit-pengawas-btn').on('click', function(){
        var id = $(this).attr("data-id");
        
        // send. id pengawas to pengawas table
        // expect. pengawas data related to id pengawas
        $.ajax({
          url:"<?php echo base_url('api/Users/pengawas'); ?>",
          method:'POST',
          data: {id : id},
          success: function(responsePengawas){
            var pengawas = JSON.stringify(responsePengawas.data[0]);
            
            // send. pengawas data to owner_edit_pengawas
            $.ajax({
              url:"<?php echo base_url('contractor/owner_edit_pengawas'); ?>",
              method:'POST',
              data: {pengawas : pengawas},
              success: function(){
                window.location.href="<?php echo base_url('owner/dashboard/edit-pengawas'); ?>";
              }
            });
          }
        });
      });

      $('#table-proyek-body').on('click', '.hapus-proyek-btn', function(){
        var id = $(this).attr("data-id");
        
        // send. id proyek to proyek table
        // delete. proyek related to id proyek from proyek table
        $.ajax({
          url:"<?php echo base_url('api/Proyek/proyek'); ?>",
          method:'DELETE',
          data: {id : id},
          success: function(){
            tabelProyek.row("tr[data-id='"+id+"']").remove().draw();
          }
        });
      });

      $('#createProject').on('click', function(){
        var idProyek;
        var nama = $('#buatNamaProject').val();
        var lokasi = $('#buatLokasiProject').val();
        var tanggal_awal = $('#inputAwalProject').val();
        var tanggal_akhir = $('#inputAkhirProject').val();
        var pengawasID = $('#inputPengawasProject').val();
        var kontraktorID = $('#inputKontraktorProject').val();
        
        let form_proyek = new FormData();
        form_proyek.append('nama', nama);
        form_proyek.append('lokasi', lokasi);
        form_proyek.append('tanggal_awal', tanggal_awal);
        form_proyek.append('tanggal_akhir', tanggal_akhir);
        form_proyek.append('pengawasID', pengawasID);
        form_proyek.append('kontraktorID', kontraktorID);
        
        // send. form_proyek to proyek table
        // expect. proyek data related to inserted proyek from proyek table and kontraktor related to id kontraktor from kontraktor table
        $.ajax({
          url : "<?php echo base_url('api/Proyek'); ?>",
          method:'POST',
          data : form_proyek,
          processData: false,
          contentType: false,
          success: function(responseProyek){
            let proyek = responseProyek.data['proyek'];
            let kontraktor = responseProyek.data['kontraktor'];
            idProyek = proyek.id;

            let row = "<tr data-id='"+idProyek+"'>";
            row += "<td class='nama-proyek' data-id='"+idProyek+"'>"+proyek.nama+"</td>\n";
            row += "<td> <button class='btn btn-sm btn-outline-secondary edit-proyek-btn' data-id='"+idProyek+"'>Edit Proyek </button> </td>\n";
            row += "<td> <span class='nama-kontraktor' data-id='"+idProyek+"'>";
            row += kontraktor.nama;
            row += "</span>";
            row += "<select class='custom-select kontraktor-editor' style='display:none;' data-id='"+idProyek+"'>";
            row += <?php 
                if(isset($kontraktor)){
                  foreach($kontraktor as $listkontraktor) {
                    $option .= "<option value='" . $listkontraktor['id'] . "'>" . $listkontraktor['nama'] . "</option";
                  }

                  echo $option;
                }
              ?>;
            row += "</select>\n<\td>";
            row += "<td> <button class='btn btn-sm btn-outline-secondary edit-kontraktor-btn' data-id='"+idProyek+"'> Edit Kontraktor</button>\n";
            row += "<td> <button class='btn btn-sm text-muted detail-proyek-btn' data-id='"+idProyek+"'>Lihat Detail</button> </td>";
            row += "<td> <button class='btn btn-sm btn-danger hapus-proyek-btn' data-id='"+idProyek+"'>Hapus Proyek</button> </td>";
            row += "</tr>";

            let rowlist = $(row);
            rowlist.prependTo("#table-proyek-body");

            tabelProyek.destroy();

            tabelProyek = $('#table-proyek').DataTable();
          }
        });

        // send. id proyek and pekerjaan array to pekerjaan table
        // expect. all proyek related to owner id (use user id)
        $.ajax({
          url : "<?php echo base_url('api/Proyek/pekerjaan'); ?>",
          method:'POST',
          data : {
            id_proyek : idProyek,
            pekerjaan : JSON.stringify(pekerjaan)
            },
          success: function(responseProyek){
            var proyek = responseProyek.data;
          }
        })
      });

    });
</script>    

<!--Project Excel Parser -->
<script>
  $(document).on('ready', function(){
    const unit = ['bh', 'bln', 'btg', 'kg', 'ls', 'm', 'm\'', 'm1', 'm2', 'm3', 'unit'];

			var pekerjaan = [];

			function validWork (work){
				if(typeof work[5] === 'string'){	
					if(unit.includes(work[5].toLowerCase())){
						let data = {
							nama : work[1],
							volume : work[4],
							bobot : work[9],
              status : -1
						}
						pekerjaan.push(data);
					}
				}
			}

			function projectExtraction (workbook){
				var sheetName = workbook.SheetNames[0];
				var volumeSheet = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName], {header:1});
				volumeSheet.forEach(elem => {
					validWork(elem);
				});
			}

			var do_file = (function() {
				return function do_file(files) {
					var f = files[0];
					var reader = new FileReader();
					reader.onload = function(e) {
						var data = e.target.result;
						data = new Uint8Array(data);
						projectExtraction(XLSX.read(data, {type:'array'}));
					};
					reader.readAsArrayBuffer(f);
				};
			})();

			$('#drop').on('dragover dragenter', function(e){
				e.stopPropagation();
				e.preventDefault();
				e.originalEvent.dataTransfer.dropEffect = 'copy';
			});
      
      $('#drop').on('drop', function(e){
				e.stopPropagation();
				e.preventDefault();
				do_file(e.originalEvent.dataTransfer.files);
			});
      
      $('#xlf').on('change', function(e){
				do_file(e.target.files);
			});
  });
</script>
</body>
</html>