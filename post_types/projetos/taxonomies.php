<?php

function projetos_taxonomies() {
	$post_type = 'projetos';

	$plural_1 = 'Categorias';
	$singular_1 = 'Categoria';
	$name_1 = $post_type.'_categorias';

	$args_1 = array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( $plural_1, 'taxonomy general name' ),
			'singular_name' => _x( $singular_1, 'taxonomy singular name' ),
			'search_items' =>  __( 'Procurar '.$plural_1 ),
			'all_items' => __( 'Todas '.$plural_1 ),
			'parent_item' => __( $plural_1.' "Pai"' ),
			'parent_item_colon' => __( $singular_1.' "Pai":' ),
			'edit_item' => __( 'Editar '.$singular_1 ),
			'update_item' => __( 'Atualizar '.$singular_1 ),
			'add_new_item' => __( 'Adicionar nova '.$singular_1 ),
			'new_item_name' => __( 'Novo nome de '.$singular_1 ),
			'menu_name' => __( $plural_1 ),
		),
		'rewrite' => array(
			'with_front' => false,
			'hierarchical' => true 
		)
	);
	register_taxonomy($name_1, $post_type, $args_1);

}
add_action( 'init', 'projetos_taxonomies', 0 );