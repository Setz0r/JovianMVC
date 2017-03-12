<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>JovianMVC</title>

    <!-- stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo Config::get('base_url');?>css/sitemain.css" />

    <!-- css overrides -->
    <?php
        $cssoverrides = Config::get('css');
        if ($cssoverrides and count($cssoverrides)>0) {
            echo "\r\n".'    <style type="text/css">'."\r\n";
            foreach($cssoverrides as $css) {
                echo "        {$css}\r\n";
            }
            echo "    </style>\r\n";
        }
                          
    ?>

    <!-- dynamic javascript variables --><?php    
    $jsvars = Config::get('jsvars');
    if ($jsvars && count($jsvars) > 0) {
        echo "\r\n".'    <script type="text/javascript">'."\r\n";
        foreach($jsvars as $jsvar) {
            $key = key($jsvar);
            $value = $jsvar[$key];
            echo "        jmvc.{$key} = '{$value}';\r\n";
        }
        echo '    </script>'."\r\n";
    }    
    
    ?>

</head>
<body>
    <div id="masterContent">
    <div id="content">
        <div class="center">
            <div class="header">
            </div>
