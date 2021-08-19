<?php
    function anchor($href, $value, $option)
    {
        if (array_key_exists('class', $option))
        {
            $class = $option['class'];
        }
        else
        {
            $class = null;
        }

        if (array_key_exists('id', $option))
        {
            $id = $option['id'];
        }
        else
        {
            $id = null;
        }

        $url = BASE_URL."/".$href;

        return "<a href='".$url."' class='".$class."' id='".$id."'>'.$value.'</a>";
    }
?>