<div id="edit-mass">
    <div class="wrapper">
        <div class="form">
            <form action="<?php echo URL; ?>/admin/editMass" method="post">
                <div>
                    <p>kategorija</p>
                    <select class="custom-select" name="id_massage_type">
                        <?php foreach ($this->massType as $type) { ?>
                        <option value="<?php echo $type->id; ?>"<?php if($type->id == $this->massage->id_massage_type){ ?> selected <?php } ?>><?php echo $type->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="text-input">
                    <p>Naziv</p>
                    <input type="text" value="<?php echo $this->massage->name; ?>" name="name_massage"/>
                </div>
                <p>Opis</p>
                <textarea name="text_massage" cols="50" rows="10"><?php echo $this->massage->text; ?></textarea>
                <div class="text-input">
                    <p>Cena</p>
                    <input type="text" value="<?php echo $this->massage->price; ?>" name="price_massage"/>
                </div>
                <input type="hidden" value="<?php echo $this->massage->id; ?>" name="id_massage"/>
                <input type="submit" value="izmeni"/>
            </form>
        </div>
    </div>
</div>
