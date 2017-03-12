
        </div>
    </div>
    </div>
    <!-- site scripts -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <!-- view scripts -->
    <?php
    //load in javascripts
    $scripts = Config::get('scripts');
    if ($scripts) {    
        foreach($scripts as $script) {
            echo '    <script type="text/javascript" src="'.Config::get('base_url').$script.'"></script>'."\r\n";
        }
    }
    ?>

    <!-- user scripts -->
    <script type="text/javascript" src="<?php echo Config::get('base_url');?>views/shared/main.js"></script>

</body>
</html>
