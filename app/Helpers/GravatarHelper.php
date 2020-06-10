<?php

namespace App\Helpers;



class GravatarHelper
{

  /**
  * validate_gravatar
  *
  * Check if the email has any gravatar image or not
  *
  * @param  string $email Email of the User
  * @return boolean true, if there is an image. false otherwise
  */
  public static function validate_gravatar($email) {
    $hash = md5($email); //hash email
    $uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404'; //develop a uri
    $headers = @get_headers($uri); //checks something ##
    if (!preg_match("|200|", $headers[0])) {
      $has_valid_avatar = FALSE;
    } else {
      $has_valid_avatar = TRUE;
    }
    return $has_valid_avatar; //returning if there is any valid gravatar
  }

  /**
  * gravatar_image
  *
  *  Get the Gravatar Image From An Email address
  *
  * @param  string $email User Email
  * @param  integer $size  size of image
  * @param  string $d     type of image if not gravatar image
  * @return string        gravatar image URL
  */
  public static function gravatar_image($email, $size=0, $d="") {
    $hash = md5($email); //hash email
    $image_url = 'http://www.gravatar.com/avatar/' . $hash. '?s='.$size.'&d='.$d; //making url
    return $image_url; //return url
  }

}