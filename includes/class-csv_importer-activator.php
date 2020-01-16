<?php

/**
 * Fired during plugin activation
 *
 * @link       none
 * @since      1.0.0
 *
 * @package    Csv_importer
 * @subpackage Csv_importer/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Csv_importer
 * @subpackage Csv_importer/includes
 * @author     Petruk O <2184765@gmail.com>
 */
class Csv_importer_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        global $wpdb;

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $table = $wpdb->get_blog_prefix() . 'import_csv';

        $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

        // structure DB table
        $sql = "CREATE TABLE {$table} (
            id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            english_text TEXT NOT NULL default '',
            french_text TEXT NOT NULL default '',
            arabic_text TEXT NOT NULL default '',
            dublicate BOOLEAN NOT NULL default false,
            PRIMARY KEY (id)
        ){$charset_collate};";

        // Check table exist
        if ( $wpdb->get_var("show tables like ".$table) != $table ) {
            dbDelta($sql);
        }
	}
}
