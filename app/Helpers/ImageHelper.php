<?php 


namespace App\Helpers;


use App\Helpers\GravatarHelper;
use App\User;

class ImageHelper{


	public static function getUserImage( $id ){

		$user = User::find($id);
		$avatar_url = "";

		if( !is_null( $user )){
			if ( $user->avatar == NULL ) {
				// return the gravatar image 
				if( GravatarHelper::validate_gravatar( $user->email )){
					$avatar_url = GravatarHelper::gravatar_image( $user->email, 100);
				}else{
					// there is no gravatar image 
					$avatar_url = url('images/defaults/user.jpg');
				}				
			} else {
				// return that image
				$avatar_url = url('images/users/'.$user->avatar);
			}
		}else{
			// return redirect
			session()->flash('User data not found in database');
		}

		return $avatar_url;
	}
}