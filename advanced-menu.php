<?php

/*
/* ADD COOKIE TO HIDE/SHOW ITEMS ON ADMIN
/*
*/

if(isset($_GET['adv_menu_items'])){
	setcookie('adv_menu_check',  'enable', time()+31556926);
	wp_redirect( admin_url(), 301 );
        exit;
}

if(isset($_GET['bsc_menu_items'])){
	setcookie('adv_menu_check',  'disable', time()+31556926);
	wp_redirect( admin_url(), 301 );
        exit;
}

// SE O COOKIE ESTÁ SETADO COMO TRUE
if(isset($_COOKIE['adv_menu_check']) && $_COOKIE['adv_menu_check']=='enable') {
	// ADICIONA OPÇÃO DE OCULTAR
	add_menu_page( 'Opções básicas', 'Opções básicas', 'manage_options', get_admin_url().'?bsc_menu_items', '', 'dashicons-admin-settings', 58);
} else {
	// OCULTA OS SEGUINTES LINKS
	add_action( 'admin_menu', 'remove_links_menu', 999 );

	function remove_links_menu() {
		remove_menu_page('link-manager.php'); // Links
		remove_menu_page('plugins.php'); // Plugins
		remove_menu_page('tools.php'); // Ferramentas
		remove_menu_page('options-general.php'); // Configurações
		remove_menu_page('users.php'); // Usuários
		remove_menu_page('wpcf7'); // CONTATO FORM 7
	}
	add_menu_page( 'Opções avançadas', 'Opções Avançadas', 'manage_options', get_admin_url().'?adv_menu_items', '', 'dashicons-admin-settings', 58);
}