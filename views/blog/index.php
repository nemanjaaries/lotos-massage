<div id="blog">
    <div class="wrapper">
        <?php foreach ($this->blogs as $blog){ ?>
        <div class="one-blog">
            <h2><a href="<?php echo URL; ?>blog/oneBlog/<?php echo $blog->id; ?>"><?php echo $blog->title ?></a></h2>
            <p><?php 
            if(strlen($blog->text)> 400){
                echo substr($blog->text, 0, 400)."...";
            }else{
            echo $blog->text;
            }?>
            </p>
            <span><?php echo $blog->created_at ?></span>
        </div>
        <?php } ?>
    </div>
</div>