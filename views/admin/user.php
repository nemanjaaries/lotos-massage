<div id="user">
    <div class="wrapper">
        <div id="user-info">         
            <table>
                <tr>
                    <td>Ime</td>
                    <td><?php echo ucfirst($this->user->name); ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $this->user->email; ?></td>
                </tr>
                <tr>
                    <td>Pol</td>
                    <td><?php echo $this->user->gender; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><?php echo $this->user->role; ?></td>
                </tr>
            </table>
        </div>
        
        <div class="admin-nav">
            <ul>
                <li class="nav-btn button">rezervacije</li>
                <li class="nav-btn button">prepiska</li>
            </ul>
        </div>
        
        <div id="ress">
            <table>
                <tr>
                    <th>masaza</th>
                    <th>datum</th>
                    <th>vreme</th>
                </tr>
                <?php foreach ($this->reservations as $reservation){ ?>
                <tr>
                    <td><?php echo $reservation->massage()->name; ?></td>
                    <td><?php echo $reservation->date; ?></td>
                    <td><?php echo $reservation->term()->time; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        
        <div id="corr">
            
        </div>
    </div>
</div>

