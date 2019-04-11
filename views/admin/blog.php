<div id="edit-mass">
    <div class="wrapper">

        <div class="form">
            <form action="<?php echo URL; ?>/admin/editBlog" method="post">   
                <div class="text-input">
                    <p>Title</p>
                    <input type="text" value="<?php echo $this->blog->title; ?>" name="title_blog"/>
                </div>
                <p>Text</p>
                <textarea name="text_blog" cols="50" rows="10"><?php echo $this->blog->text; ?></textarea>
                <input type="hidden" value="<?php echo $this->blog->id; ?>" name="id_blog"/>
                <input type="submit" value="izmeni"/>
            </form>
        </div>
    </div>
</div>
