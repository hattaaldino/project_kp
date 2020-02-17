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
                        if($kontraktor['id'] == $listproyek['id_kontraktor']){
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
                        echo"<option value='",$listkontraktor['id'],"'>",$listkontraktor['nama'],"</option";
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
        $.ajax({
          url:"",
          method:'POST',
          data: {id : id},
          success: function(responseProyek){
            var proyek = JSON.parse(responseProyek.data[0]);
            $.ajax({
              url: "",
              method: 'POST',
              data: {id : proyek.id},
              success: function(responseKontraktor){
                var kontraktor = responseKontraktor.data;
                $.ajax({
                  url:"<?php echo base_url('contractor/owner_edit_proyek'); ?>",
                  method:'POST',
                  data: {kontraktor : kontraktor}
                });
              }
            });
            $.ajax({
              url: "",
              method: 'POST',
              data: {id : proyek.id},
              success: function(responsePengawas){
                var pengawas = responsePengawas.data;
                $.ajax({
                  url:"<?php echo base_url('contractor/owner_edit_proyek'); ?>",
                  method:'POST',
                  data: {pengawas : pengawas}
                });
              }
            });
            $.ajax({
              url:"<?php echo base_url('contractor/owner_edit_proyek'); ?>",
              method:'POST',
              data: {proyek : responseProyek.data[0]},
              success: function(){
                window.location.href="<?php echo base_url('owner/dashboard/edit-proyek'); ?>";
              }
            });
          }
        });
      });

      $('#table-proyek-body').on('click', '.detail-proyek-btn', function(){
        var id = $(this).attr("data-id");
        $.ajax({
          url:"",
          method:'POST',
          data: {id : id},
          success: function(responseProyek){
            var proyek = responseProyek.data[0];
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
        $.ajax({
          url:"",
          method:'POST',
          data: {
            id : id,
            id_kontraktor : gantikontraktor
          },
          success: function(kontraktor){
            $('select[data-id="'+id+'"]').hide();
            var kontraktor = JSON.parse(kontraktor.data[0]);
            var namakontraktor = kontraktor.nama;
            $('span[data-id="'+id+'"]').html(namakontraktor).fadeIn();
          }
        });
      });

      $('.edit-pengawas-btn').on('click', function(){
        var id = $(this).attr("data-id");
        $.ajax({
          url:"",
          method:'POST',
          data: {id : id},
          success: function(responsePengawas){
            var pengawas = responsePengawas.data[0];
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
        $.ajax({
          url:"",
          methos:'POST',
          data: {id : id},
          success: function(){
            tabelProyek.row("tr[data-id='"+id+"']").remove().draw();
          }
        });
      });

    });
</script>    
</body>
</html>