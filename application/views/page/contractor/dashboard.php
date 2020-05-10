          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="content">
              <h1 class="h3 pb-2 mb-3 border-bottom">Proyek</h1>
              <?php if(isset($proyek)): ?>
                <?php foreach($proyek as $listproyek): ?>
                  <div class="card mb-2 col-md-9">
                    <div class="card-body" data-id="<?php echo $listproyek['id']; ?>">
                      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                        <h5 class="mb-0" data-id="<?php echo $listproyek['id']; ?>"><?php echo ucwords($listproyek['nama']); ?></h5>
                        <a href="<?php echo base_url('contractor/kontraktor_data_proyek'); ?>" class="card-link detail-proyek-kontraktor" data-id="<?php echo $listproyek['id']; ?>">lihat detail</a>
                      </div>
                    </div>
                  </div>
                <?php endforeach;?>
              <?php endif;?>
            </div>
        </main>
    </div>
    </div>
<script>
  $(document).ready(function(){
    $('.detail-proyek-kontraktor').on('click', function(){
      var id = $(this).data('id');

      // send. id proyek to proyek table
      // expect. proyek data related to id proyek from proyek table
      $.ajax({
        url : "<?php echo base_url('api/Proyek/proyek'); ?>",
        method : 'POST',
        data : {id : id},
        success : function(responseProyek){
          var proyek = JSON.stringify(responseProyek.data[0]);

          // send. proyek to laporan_proyek
          $.ajax({
            url : "<?php echo base_url('contractor/kontraktor_data_proyek'); ?>",
            method : 'POST',
            data : {proyek : proyek},
            success : function(){
              window.location.href = "<?php echo base_url('kontraktor/dashboard/proyek'); ?>";
            }
          });
        }
      });
    });
  });
</script>
</body>
</html>