<div id="one-blog">
    <div class="wrapper">
        <div class="one-blog">
            <h2><?php echo $this->blog->title; ?></h2>
            <p><?php echo $this->blog->text; ?></p>
            <span><?php echo $this->blog->created_at; ?></span>
            <a href="" id="btn-com" class="button">Ostavi komentar</a>   
            <div id="form-komentar">
                <form method="post" action="<?php echo URL; ?>blog/sentComment">
                    <textarea name="text_comment"></textarea>
                    <input type="hidden" name="id_blog"
                           value="<?php echo $this->blog->id; ?>" />
                    <input type="hidden" name="id_user" value="<?php echo Session::get("id"); ?>" />
                    <br>
                    <input type="submit" value="posalji"/>
                </form>
            </div>
        </div>
        <div id="all-comments">      
            <?php foreach ($this->comments as $comment) { ?>
                <div class="one-comment">
                    <p><?php echo $comment->user()->name; ?></p>
                    <p><?php echo $comment->text; ?></p>
                    <span><?php echo $comment->created_at; ?></span>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

