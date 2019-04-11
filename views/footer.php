<footer class="negative">
            <div id="footer-top">
                <div class="wrapper">
                    <div class="footer-section floatLeft">
                        <p>Kontakt</p>
                        <p>Adresa: Makenzijeva 35, Beograd</p>
                        <p>Broj telefona: 064/333-33-33</p>
                        <p>Email: lotos@gmail.com</p>
                    </div>
                   <a class="button floatRight" href="#">na pocetak</a> 
                </div><!-- end .wrapper -->
            </div><!-- end #footer-top -->
            <div id="footer-bottom">
                <div class="wrapper">
                    <p class="floatLeft">Copyright @ Lotos // privacy / cookie policy</p>    
                </div><!-- end .wrapper -->
            </div><!-- end #footer-bottom -->
        </footer>
        <?php if(isset($this->js)){ foreach($this->js as $js){ ?> 
            <script src="<?php echo URL ;?>views/<?php echo $js; ?>" type="text/javascript"></script>
        <?php }} ?>
    </body>
</html>

