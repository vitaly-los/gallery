<?php

abstract class Message
{

    /**
     * 
     * @param type output formatted error message
     * @return string and unset session error message
     */
    public static function outputErrorMessage($messages)
    {
        $output = '<div class="alert alert-danger">';
        $output .= '<strong>Some error(s) occured:<br />';
        foreach ($messages as $message) {
            $output .= $message . '<br />';
        }
        $output .= '</strong></div>';
        unset($_SESSION['error']);
        return $output;
    }

    /**
     * 
     * @param type output formatted success message
     * @return string and unset session success message
     */
    public static function outputSuccessMessage($message)
    {
        $output = '<div class="alert alert-success">';
        $output .= '<strong>' . $message . '</strong>';
        $output .= '</div>';
        unset($_SESSION['success']);
        return $output;
    }

}
