<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       none
 * @since      1.0.0
 *
 * @package    Csv_importer
 * @subpackage Csv_importer/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Csv_importer
 * @subpackage Csv_importer/includes
 * @author     Petruk O <2184765@gmail.com>
 */
class Csv_importer {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Csv_importer_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'csv_importer';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Csv_importer_Loader. Orchestrates the hooks of the plugin.
	 * - Csv_importer_i18n. Defines internationalization functionality.
	 * - Csv_importer_Admin. Defines all hooks for the admin area.
	 * - Csv_importer_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-csv_importer-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-csv_importer-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-csv_importer-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-csv_importer-public.php';

		$this->loader = new Csv_importer_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Csv_importer_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Csv_importer_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Csv_importer_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Csv_importer_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Csv_importer_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}

function admin_generate_menu() {
    // Add main menu
    add_menu_page('CSV importer module', 'CSV importer', 'manage_options', 'form_add_csv_entries', 'form_add_csv_entries' );
    add_submenu_page( 'form_add_csv_entries', 'Form to add CSV and share to users', 'Edit All entries', 'manage_options', 'edit_all_csv_entries', 'edit_all_csv_entries' );
}
add_action( 'admin_menu', 'admin_generate_menu' );

//form page in admin panel
function form_add_csv_entries() {
    
    global $wpdb;
    $table = $wpdb->get_blog_prefix() . 'import_csv';
    
    if ( isset($_POST['action']) ) {
        
        $file = $_FILES['csvfile']['tmp_name'];
        
        $content = file($file);

        foreach ($content as $string) {

            $string = explode (',', $string);
            
            //find dublicates
            $duplicate = $wpdb->get_row("SELECT id FROM ".$table." WHERE english_text = '".$string[0]."' ");
            
            $inputData = array(
                'english_text'   => $string[0],
                'french_text'    => $string[1],
                'arabic_text'    => $string[2],
                'dublicate'      => boolval($duplicate->id)
            );
        
            echo $wpdb->insert( $table, $inputData );
        }

        echo '<h2 class="successful-send-form">Successful added.</h2>';

    } else {
        
        include_once( dirname( __FILE__ ) .'/views/send_csv_form.php');

    }
        
        
    
}

//edit page in admin panel
function edit_all_csv_entries() {
    
    global $wpdb;
    $table = $wpdb->get_blog_prefix() . 'import_csv';
    
    $action = isset($_GET['action']) ? $_GET['action'] : null ;
		
		switch ($action) {
		
			case 'edit':
				
				$data['single-csv-entries'] = $wpdb->get_row("SELECT * FROM " . $table . " WHERE ID = '". (int)$_GET['id']."'", ARRAY_A);
				include_once(dirname( __FILE__ ) .'/views/edit_single_csv.php');
                break;
			
			case 'submit':
                
				$inputData = array(
					'english_text' 	  	  => strip_tags($_POST['english_text']),
					'french_text' 	  	  => strip_tags($_POST['french_text']),
					'arabic_text' 	  	  => strip_tags($_POST['arabic_text']),
				);
			
				$editId=intval($_POST['id']);
			
				if ($editId == 0) return false;
			
				// Обновляем существующую запись
				$wpdb->update( $table, $inputData, array( 'id' => $editId ));
				
				// Show list entries
				show_all_entries();
			    break;
			
			case 'delete':
			
				// Delete entries
				$wpdb->query("DELETE FROM ".$table." WHERE ID= '". (int)$_GET['id'] ."'");
				
				// Show list entries
				show_all_entries();
			    break;
                
            case 'back':
                show_all_entries();
			     break;
                
			default:
				// Show list entries
				show_all_entries();
		}
}
function show_all_entries() {
    global $wpdb;
    $table = $wpdb->get_blog_prefix() . 'import_csv';
    $data['all_csv-entries'] = $wpdb->get_results("SELECT * FROM " . $table . "", ARRAY_A);
    include_once( dirname( __FILE__ ) .'/views/edit_all_csv.php');
}