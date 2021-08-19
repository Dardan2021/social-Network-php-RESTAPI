<?php
    function linkCss($cssPath)
    {
        if(!empty($cssPath))
        {
            return "<link rel='stylesheet' href='/php/public/".$cssPath."'>";
        }
    }

    function linkJs($jsPath)
    {
        if(!empty($jsPath))
        {
            return "<script src='/php/public/".$jsPath."'></script>";
        }
    }
?>