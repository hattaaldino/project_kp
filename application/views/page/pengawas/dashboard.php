    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="content">
        <h1 id="judulproyek" class="h3 pb-2 mb-3 border-bottom">Data Proyek</h1>
          <div class="table-responsive">
            <table class="table table-striped table-sm display" style="width:100%" id="table-proyek-pengawas">
              <thead>
                <tr>
                  <th>Nama Proyek</th>
                  <th>Nama Kontraktor</th>
                  <th>Lihat Detail</th>
                </tr>
              </thead>
              <tbody id="table-proyek-pengawas-body">
                <?php if(isset($proyek)): ?>
                  <?php foreach ($proyek as $listproyek): ?>
                    <tr data-id='<?php echo $listproyek['id']; ?>'>
                    <td class='nama-proyek-pengawas' data-id='<?php echo $listproyek['id']; ?>'><?php echo $listproyek['nama']; ?></td>
                    <td class='nama-kontraktor-pengawas' data-id='<?php echo $listproyek['id']; ?>'>
                    <?php
                      if(isset($kontraktor)){
                        foreach($kontraktor as $kontraktor){
                          if($kontraktor['id'] == $listproyek['id_kontraktor']){
                            echo $kontraktor['nama'];
                          }
                        }
                      }
                    ?>
                    </td>
                    <td>
                    <button class='btn btn-sm text-muted detail-proyek-pengawas-btn' data-id='<?php echo $listproyek['id']; ?>'>Lihat Detail</button>
                    </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
      </div>
    </main>
  </div>
</div>
<script>
  $('#table-proyek-pengawas').DataTable();
  $('button.detail-proyek-pengawas-btn').on('click', function(){
    var id = $(this).data('id');
    $.ajax({
      url : "",
      method : 'POST',
      data : {id : id},
      success : function(responseProyek){
        var proyek = responseProyek.data[0];
        $.ajax({
          url : "<?php echo base_url('contractor/pengawas_lihat_laporan');?>",
          method : 'POST',
          data : {proyek : proyek},
          success : function(){
            window.location.href = "<?php echo base_url('pengawas/dashboard/laporan-proyek'); ?>";
          }
        })
      }
    });
  });
</script>
</body>
</html>