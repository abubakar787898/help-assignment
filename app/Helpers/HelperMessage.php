<?php

namespace App\Helpers;

class HelperMessage
{

    public static function create($message = '')
    {
        return $message . "Created Successfully";
    }
    public static function update($message = '')
    {
        return $message . "Updated Successfully";
    }
    public static function delete($message = '')
    {
        return $message . "Deleted Successfully";
    }
    public static function restore($message = '')
    {
        return $message . "Record restored successfully";
    }
    public static function error($message = '')
    {
        return $message . "Some error occured";
    }
    public static function complete($message = '')
    {
        return $message . " completed successfully";
    }
    public static function fetch($message = '')
    {
        return $message . "Fetch successfully";
    }
    public static function send($message = '')
    {
        return $message . "Send Successfully";
    }
    public static function notFound($message = '')
    {
        return $message . "Resource not found";
    }
    public static function alreadyExists($message = '')
    {
        return $message . "Already Exists";
    }
    public static function success($message = '')
    {
        return $message . "Operation successfull";
    }
    public static function accessDenied($message = '')
    {
        return $message . "Access denied";
    }
    public static function notificationSend($message = '')
    {
        return $message . "Notification has send";
    }
    public static function loginSuccess($message = '')
    {
        return $message . "Logged In Successfully";
    }
    public static function emailVerify($message = '')
    {
        return "Your Email " . $message . " Verify Successfully";
    }
    public static function alreadyVerify($message = '')
    {
        return "Your Email  " . $message . " already verified";
    }
    public static function emailNotExist($message = '')
    {
        return "Your Email " . $message . " is not exist";
    }
    public static function alreadChangePassword($message = '')
    {
        return "Your Email " . $message . " Password Already Changed. ";
    }
    public static function passwordChanged($message = '')
    {
        return "Your Email " . $message . " Password  Changed Successfully ";
    }
    public static function notificationAlreadySent($message = '')
    {
        return $message . "Notification has already been sent to all recipients";
    }
    public static function notificationNotFound($message = '')
    {
        return $message . "Notification not found";
    }
}
