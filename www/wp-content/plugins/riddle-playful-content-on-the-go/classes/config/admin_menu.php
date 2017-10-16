<?php
// Hook for adding admin menus
add_action('admin_menu', 'configs');

// action function for above hook
function configs() {
    // Add a new top-level menu (ill-advised):
    add_menu_page(__('Riddle','riddle-admin-menu'), __('Riddle','riddle-admin-menu'), 'manage_options', 'riddle-list', 'Controller\Admin::page_riddle_list' );
    // Add sub-menu
    add_submenu_page('riddle-list',__('Riddle creation','riddle-admin-menu'), __('Creation','riddle-creation'), 'manage_options', 'riddle-creation', 'Controller\Admin::page_riddle_create');
    add_submenu_page('riddle-list', __('Settings','riddle-admin-menu'), __('Settings','riddle-admin-menu'), 'manage_options', 'riddle-settings', 'Controller\Admin::page_riddle_settings');
}
