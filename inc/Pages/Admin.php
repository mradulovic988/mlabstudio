<?php 
/**
 * @package mlabstudio
 */
namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\ManagerCallbacks;

/**
* 
*/
class Admin extends BaseController
{
	public $settings;
	public $callbacks;
	public $callbacks_mngr;

	public $pages = array();
	public $subpages = array();

	public function register() 
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();
		$this->callbacks_mngr = new ManagerCallbacks();

		$this->setPages();

		$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'M LabStudio Plugin', 
				'menu_title' => 'M LabStudio', 
				'capability' => 'manage_options', 
				'menu_slug' => 'mlabstudio_plugin',
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-store', 
				'position' => 1
			)
		);
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'mlabstudio_plugin',
				'page_title' => 'Custom Post Types', 
				'menu_title' => 'CPT', 
				'capability' => 'manage_options', 
				'menu_slug' => 'mlabstudio_cpt',
				'callback' => array( $this->callbacks, 'adminCpt' )
			),
			array(
				'parent_slug' => 'mlabstudio_plugin',
				'page_title' => 'Custom Taxonomies', 
				'menu_title' => 'Taxonomies', 
				'capability' => 'manage_options', 
				'menu_slug' => 'mlabstudio_taxonomies',
				'callback' => array( $this->callbacks, 'adminTaxonomy' )
			),
			array(
				'parent_slug' => 'mlabstudio_plugin',
				'page_title' => 'Custom Widgets', 
				'menu_title' => 'Widgets', 
				'capability' => 'manage_options', 
				'menu_slug' => 'mlabstudio_widgets',
				'callback' => array( $this->callbacks, 'adminWidget' )
			)
		);
	}

	public function setSettings() {
	    $args = array();

        foreach ($this->managers as $key => $value) {
            $args[] = array(
				'option_group' => 'mlabstudio_plugin_settings',
				'option_name' => $key,
				'callback' => array( $this->callbacks, 'checkboxSanitize' )
			);
	    }

		$this->settings->setSettings( $args );
	}

	public function setSections() {
		$args = array(
			array(
				'id' => 'mlabstudio_admin_index',
				'title' => 'Settings Manager',
				'callback' => array( $this->callbacks_mngr, 'adminSectionManager' ),
				'page' => 'mlabstudio_plugin'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields() {
        $args = array();

        foreach ($this->managers as $key => $value) {
            $args[] = array(
                'id' => $key,
                'title' => $value,
                'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
                'page' => 'mlabstudio_plugin',
                'section' => 'mlabstudio_admin_index',
                'args' => array(
                    'label_for' => $key,
                    'class'     => 'ui-toggle'
                )
            );
        }

		$this->settings->setFields( $args );
	}
}