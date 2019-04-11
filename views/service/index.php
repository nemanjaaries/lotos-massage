<div id="service">
    <div id="cover"></div>
    <div class="wrapper">
        <div id="items">
            <?php foreach ($this->types as $type){ ?>
            <div class="item" id="<?php echo $type->id; ?>">
                <img src="<?php echo URL_CURRENT; ?>/images/<?php echo $type->picture; ?>" width="363" height="200"/>
                <h3><?php echo $type->name; ?></h3>
                <p><?php echo $type->text; ?></p>
            </div><!-- end .item -->
            <?php } ?>
        </div><!-- end .item -->

        <div id="anticelulit">
            <?php foreach ($this->types[0]->massages() as $massage) { ?>
                <div class="massage">
                    <h1><?php echo $massage->name; ?></h1>
                    <p>
                        <?php echo $massage->text; ?>
                    </p>
                    <a class="button" href="">rezervisi</a>

                    <div class="hide" >
                        <span class="exit">&times;</span>
                        <p><?php echo $massage->name; ?></p>
                        <form method="post" action="<?php echo URL; ?>service/reserves">
                            <input type="hidden" name="id_massage" value="<?php echo $massage->id; ?>" />                             
                            <p>Datum: <input class="date" type="text" name="date" data-max-year="2018" data-min-year="2018" data-lock="from"  data-format="Y-m-d" data-theme="my-style"/>
                                Vreme: <select class="custom-select" name="id_term">
                                            <option>izaberi datum</option>
                                        </select>
                                <input type="submit" value="rezervisi"/></p>       
                            <p></p>
                            <p></p>
                        </form>
                    </div>

                </div>
            <?php }  ?>
        </div><!-- end #anticelulit -->

        <div id="relax">
            <?php foreach ($this->types[1]->massages() as $massage) { ?>
                <div class="massage">
                    <h1><?php echo $massage->name; ?></h1>
                    
                    <p>
                        <?php echo $massage->text; ?>
                    </p>
                    <a class="button" href="">rezervisi</a>

                   <div class="hide" >
                        <span class="exit">&times;</span>
                        <p><?php echo $massage->name; ?></p>
                        <form method="post" action="<?php echo URL; ?>service/reserves">
                            <input type="hidden" name="id_massage" value="<?php echo $massage->id; ?>" />         
                            <p>Datum: <input class="date" type="text" name="date" data-max-year="2018" data-min-year="2018" data-lock="from"  data-format="Y-m-d" data-theme="my-style"/>
                                Vreme: <select class="custom-select" name="id_term">
                                            <option>izaberi datum</option>
                                        </select>
                                <input type="submit" value="rezervisi"/></p>
                               
                            <p></p>
                            <p></p>
                        </form>
                    </div>

                </div>
            <?php } ?>
        </div><!-- end #relaks -->


        <div id="detox">
            <?php foreach ([$this->types[2]->massages()] as $massage) { ?>
                <div class="massage">
                    <h1><?php echo $massage->name; ?></h1>
                    
                    <p>
                        <?php echo $massage->text; ?>
                    </p>
                    <a class="button" href="">rezervisi</a>

                    <div class="hide" >
                        <span class="exit">&times;</span>
                        <p><?php echo $massage->name; ?></p>
                        <form method="post" action="<?php echo URL; ?>service/reserves">
                            <input type="hidden" name="id_massage" value="<?php echo $massage->id; ?>" />  
                            <p>Datum: <input class="date" type="text" name="date" data-max-year="2018" data-min-year="2018" data-lock="from"  data-format="Y-m-d" data-theme="my-style"/>
                                Vreme: <select class="custom-select" name="id_term">
                                            <option>izaberi datum</option>
                                        </select>
                                <input type="submit" class="res-submit" value="rezervisi"/></p>
                               
                            <p></p>
                            <p></p>
                        </form>
                    </div>

                </div>
            <?php } ?>
        </div><!-- end #detoks -->
    </div>
</div>
