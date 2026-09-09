<?php

/**
 * Display validation error for a specific field.
 *
 * @param array|null  $errors Array of errors from validation
 * @param string      $field  The field name for which the error needs to be displayed
 * @return string
 */
function display_error($errors, $field)
{
    if (isset($errors[$field])) {
        return '<span class="text-danger">' . $errors[$field] . '</span>';
    }
    return '';
}
