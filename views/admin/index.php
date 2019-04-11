<div id="admin">
    <div id="cover"></div>
    <div class="wrapper">
        <div class="nav">
            <ul>
                <li class="nav-btn button">sve rezervacije</li>
                <li class="nav-btn button">masaze</li>
                <li class="nav-btn button">blog</li>
                <li class="nav-btn button">korisnici</li>
            </ul>
        </div>
        <div id="admin-reservation">
            <p class="floatLeft"><input id="search-reservation" type="text" placeholder="Search" autocomplete="off"/> </p>
            <div id="content-reservation" class="clear">
                <table>
                    <tr>
                        <th>korisnik</th>
                        <th>masaza</th>
                        <th>datum</th>
                        <th>vreme</th>
                    </tr>
                    <?php foreach ($this->reservations as $reservation) { ?>
                        <tr>
                            <td><?php echo ucfirst($reservation->user()->name); ?></td>
                            <td><?php echo $reservation->massage()->name; ?></td>
                            <td><?php echo $reservation->date; ?></td>
                            <td><?php echo $reservation->term()->time; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div id="admin-massage">  
            <button class="floatRight button" id="btn-add-mass">New massage</button>
            <div class="hide">
                <form action="<?php echo URL; ?>admin/insertMass" method="post">
                    <div>
                        <p>kategorija</p>
                        <select class="custom-select" name="id_massage_type">
                            <?php foreach ($this->massType as $type) { ?>
                                <option value="<?php echo $type->id; ?>"><?php echo $type->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="text-input">
                        <p>Naziv</p>
                        <input type="text" name="name_massage"/>
                    </div>
                    <div>
                        <p>Opis</p>
                        <textarea name="text_massage" cols="50" rows="10"></textarea>
                    </div>
                    <div class="text-input">
                        <p>Cena</p>
                        <input type="text" name="price_massage"/>
                    </div>
                    <input type="submit" value="unesi"/>
                </form>
            </div>      

            <p class="floatLeft"><input id="search" type="text" placeholder="Search" autocomplete="off"/> </p>
            <div id="content-massage" class="clear">
                <table>
                    <tr>
                        <th>naziv</th>
                        <th>opis</th>
                        <th>cena</th>
                        <th>edit</th>
                        <th>delete</th>
                    </tr>
                    <?php foreach ($this->massages as $massage) { ?>
                        <tr>
                            <td><?php echo ucfirst($massage->name); ?></td>
                            <td><?php echo $massage->text; ?></td>
                            <td><?php echo $massage->price; ?></td>
                            <td><button class="button" onclick="window.location.href = '<?php echo URL; ?>admin/massage/<?php echo $massage->id; ?>'">edit</button></td>
                            <td><button name="<?php echo $massage->id; ?>" class="button delete-mass">delete</button></td>      
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

        <div id="admin-blog">

            <button class="floatRight button" id="btn-add-blog">New blog</button>
            <div class="hide">
                <form action="<?php echo URL; ?>/admin/insertBlog" method="post">
                    <div class="text-input">
                        <p>Naslov</p>
                        <input type="text" name="title_blog"/>
                    </div>
                    <div>
                        <p>Text</p>
                        <textarea name="text_blog" cols="50" rows="15"></textarea>
                    </div>
                    <input type="submit" value="unesi"/>
                </form>
            </div>      

            <p class="floatLeft"><input id="search-blog" type="text" placeholder="Search" autocomplete="off"/> </p>
            <div id="content-blog" class="clear">
                <table>
                    <tr>
                        <th>id</th>
                        <th>title</th>
                        <th>text</th>
                        <th>edit</th>
                        <th>delete</th>
                    </tr>
                    <?php foreach ($this->blogs as $blog) { ?>
                        <tr>
                            <td><?php echo $blog->id; ?></td>
                            <td><?php echo ucfirst($blog->title); ?></td>
                            <td><?php echo $blog->text; ?></td>
                            <td><button class="button" onclick="window.location.href = '<?php echo URL; ?>admin/blog/<?php echo $blog->id; ?>'">edit</button></td>
                            <td><button name="<?php echo $blog->id; ?>" class="button delete-blog">delete</button></td>      
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

        <div id="admin-users">
            <p class="floatLeft"><input id="search-users" type="text" placeholder="Search" autocomplete="off"/></p>
            <div id="content-users" class="clear">
                <table>
                    <tr>
                        <th>id</th>
                        <th>ime</th>
                        <th>email</th>
                        <th>pol</th>
                        <th>status</th>
                    </tr>
                    <?php foreach ($this->users as $user) { ?>
                        <tr>
                            <td><?php echo $user->id; ?></td>
                            <td><a href="<?php echo URL; ?>admin/user/<?php echo $user->id; ?>"><?php echo ucfirst($user->name); ?></a></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->gender; ?></td>
                            <td><?php echo $user->role; ?></td>     
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>


    </div>
</div>
