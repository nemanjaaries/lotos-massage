<div class="wrapper">
    <?php
        if(Session::exists('success')){
    ?>
        <div class="success"><?php echo Session::flash('success') ?></div>
    <?php
        }
    ?>  
    
    <?php
        if(Session::exists('error')){
    ?>
        <div class="error"><?php echo Session::flash('error') ?></div>
    <?php
        }
    ?>     
    
</div>