<?php
function projetos_meta_boxes() {
    add_meta_box( 'projetos_info', 'Info', 'projetos_info_content', 'projetos', 'normal', 'low' );
    add_meta_box( 'projetos_extra', 'Imagens extra', 'projetos_extra_content', 'projetos', 'normal', 'low' );
}

function projetos_info_content( $post ) {
	wp_nonce_field( FILE_PATH, 'projetos_info_content_nonce' );
	
	$lines_of_code = new Input_text(array('name'=>'Linhas de código', 'input'=>'lines_of_code', 'context'=>'projetos', 'post'=>$post->ID));
	$lines_of_code->render();

	$bitbucket = new Input_text(array('name'=>'Link do bitbucket', 'input'=>'bitbucket', 'context'=>'projetos', 'post'=>$post->ID));
	$bitbucket->render();

	$credits = new Input_text(array('name'=>'Créditos', 'input'=>'credits', 'context'=>'projetos', 'post'=>$post->ID));
	$credits->render();
}

function projetos_extra_content( $post ) {
	wp_nonce_field( FILE_PATH, 'projetos_extra_content_nonce' );

	$field_value = get_post_meta( $post->ID, 'projetos_extra_content', false );
	wp_editor( $field_value[0], 'projetos_extra_content', array( 'textarea_name' => 'projetos_extra_content', 'media_buttons' => true ) );
}

if( class_exists( 'kdMultipleFeaturedImages' ) ) {

        $args = array(
                'id' => 'projetos_capa',
                'post_type' => 'projetos',
                'labels' => array(
                    'name'      => 'Capa externa',
                    'set'       => 'Escolher imagem',
                    'remove'    => 'Remover imagem',
                    'use'       => 'Usar essa imagem',
                )
        );

        new kdMultipleFeaturedImages( $args );
}

add_action( 'add_meta_boxes', 'projetos_meta_boxes' );
?>