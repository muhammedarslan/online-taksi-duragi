<?php

new_session();
global $db;

if ( $_SESSION['Durak']->id == '18' ){
	header("Location:/DurakYonetim/Profil");
	exit;
} 

require_once CDIR.'/class.upload.php';
if ( $_FILES['image']['size'] > 0  ) {
	$image = new Upload( $_FILES[ 'image' ] );

	if ( $image->uploaded ) {

		$image->image_convert = 'jpg';
		$image->file_new_name_body = random(16);
		$image->image_convert = 'jpg';
		$image->image_resize = true;
		$image->image_x = 400;
		$image->image_y = 400;

		$image->allowed = array ( 'image/*' );

		$image->Process( ROOT_DIR.'/media/avatars' );
		if ( $image->processed ) {
			$avs =  $image->file_dst_name;

			$query = $db->prepare("UPDATE users SET
				avatar = :bir
				WHERE id = :iki");
			$update = $query->execute(array(
				"bir" => $avs,
				"iki" => $_SESSION['Durak']->id
			));
			if ( $update ){
				$_SESSION['Durak']->avatar = $avs;
			}
			
		}
	}

}

header("Location:/DurakYonetim/Profil");