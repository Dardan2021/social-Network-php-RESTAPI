<?php

function formInput($fields = array())
{
    if (array_key_exists('name', $fields))
    {
        $name = $fields['name'];
    }
    else
    {
        $name = null;
    }

    if (array_key_exists('id', $fields))
    {
        $id = $fields['id'];
    }
    else
    {
        $id = null;
    }

    if (array_key_exists('class', $fields))
    {
        $class = $fields['class'];
    }
    else
    {
        $class = null;
    }

    if (array_key_exists('value', $fields))
    {
        $value = $fields['value'];
    }
    else
    {
        $value = null;
    }

    if (array_key_exists('placeholder', $fields))
    {
        $placeholder = $fields['placeholder'];
    }
    else
    {
        $placeholder = null;
    }

    if (array_key_exists('type', $fields))
    {
        if ($fields['type'] == 'text')
        {
            $type = 'text';
        }
        else if ($fields['type'] == 'password')
        {
            $type = 'password';
        }
        else if ($fields['type'] == 'email')
        {
            $type = 'email';
        }
        else if ($fields['type'] == 'file')
        {
            $type = 'file';
        }
        else if ($fields['type'] == 'submit')
        {
            $type = 'submit';
        }
    }
    else
    {
        $type = null;
    }

    if ($type == 'file')
    {
        return "<input type='" . $type . "'name='" . $name . "' id='" . $id . "' class='" . $class . "'>";
    }
    else if ($type == 'submit')
    {
        return "<input type='" . $type . "'name='" . $name . "' id='" . $id . "' class='" . $class . "' value='" . $value . "'>";
    }
    else if ($class == 'submit-button')
    {
        return "<button name='" . $name . "' id='" . $id . "' class='" . $class . "'>$value</button>";
    }
    else
    {
        return "<input type='" . $type . "'name='" . $name . "' placeholder='" . $placeholder . "' value='" . $value . "' id='" . $id . "' class='" . $class . "'>";
    }
}

function formOpen($action, $method, $option)
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

    return '<form method="'.$method.'" action="' . BASE_URL . "/" . $action . '" id="'.$id.'" enctype="multipart/form-data">';
}

function formClose()
{
    return '</form>';
}
?>