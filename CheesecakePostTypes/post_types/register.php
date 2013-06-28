<?php

function projetos_post_type() {
	$post_type = 'projetos';
	$plural = 'Projetos';
	$singular = 'Projeto';

	$labels = array(
		'name'               => __( $plural ),
		'singular_name'      => __( $singular ),
		'add_new'            => __( 'Novo' ),
		'add_new_item'       => __( 'Novo '.$singular ),
		'edit_item'          => __( 'Editar '.$singular ),
		'new_item'           => __( 'Novo '.$singular ),
		'all_items'          => __( 'Todos os '.$plural ),
		'view_item'          => __( 'Ver '.$singular ),
		'search_items'       => __( 'Procurar '.$plural ),
		'not_found'          => __( 'Nenhum '.$singular.' encontrado' ),
		'not_found_in_trash' => __( 'Nenhum '.$singular.' encontrado na lixeira' ), 
		'parent_item_colon'  => '',
		'menu_name'          => $plural
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Cadastro de '.$plural,
		'public'        => true,
		'menu_position' => 4,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'show_in_nav_menus' => true,
		'capability_type' => 'page',
		'hierarchical' => true
	);
	register_post_type( $post_type, $args );	
}
add_action( 'init', 'projetos_post_type' );

?>