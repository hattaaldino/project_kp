<div class="container-fluid">
  <div class="row">
    <nav role="breadcrumb" class="col-md-9 ml-sm-auto col-lg-10 px-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <?php foreach ($this->uri->segments as $segment): ?>
                <?php
                if($segment == 'owner' || $segment == 'kontraktor' || $segment == 'pengawas') continue;
                ?>
                <?php
                    $url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)).$segment;
                    $isActive = ($url == $this->uri->uri_string);
                ?>

                <li class="breadcrumb-item <?php echo $isActive? 'active" aria-current="page"' : '' ?>">
                    <?php if($isActive): ?>
                        <?php echo ucfirst($segment) ?>
                    <?php else: ?>
                        <a href="<?php echo site_url($url) ?>"><?php echo ucfirst($segment) ?></a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>
    </nav>
    <script>
        var breaditem = $('ol.breadcrumb').children().length;
        var i;
        for (i = 1; i <= breaditem; i++) {
            var breadcrumbitem = $('li:nth-child('+i+').breadcrumb-item').html().replace(/-/g, ' ');
            $('li:nth-child('+i+').breadcrumb-item').html(breadcrumbitem);
        }
    </script>