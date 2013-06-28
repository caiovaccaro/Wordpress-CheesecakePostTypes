<?php
function projetos_info_content_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	return;

	if ( !wp_verify_nonce( $_POST['projetos_info_content_nonce'], FILE_PATH ) )
	return;

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	}
	$lines_of_code = $_POST['projetos_lines_of_code'];
	$bitbucket = $_POST['projetos_bitbucket'];
	$credits = $_POST['projetos_credits'];

	update_post_meta( $post_id, 'projetos_lines_of_code', $lines_of_code );
	update_post_meta( $post_id, 'projetos_bitbucket', $bitbucket );
	update_post_meta( $post_id, 'projetos_credits', $credits );
}
add_action( 'save_post', 'projetos_info_content_save' );
?>