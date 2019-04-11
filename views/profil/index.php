<div id="profil">
    <div class="wrapper">
        <div id="profil-nav">
            <ul>
                <li class="nav-btn button">rezervacije</li>
                <li class="nav-btn button">obavestenja</li>
            </ul>
        </div>
        <div id="ress">
            <table>
                <thead>
                    <tr>
                        <td>Masaza</td>
                        <td>Datum</td>
                        <td>Vreme</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->reservations as $reservation) { ?>
                        <tr>
                            <td><?php echo $reservation->massage()->name ?></td>
                            <td><?php echo $reservation->date ?></td>
                            <td><?php echo $reservation->term()->time ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div id="notice">
           
        </div>

    </div>
</div>
