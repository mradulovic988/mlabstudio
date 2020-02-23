<?php
/**
 * @package MarkoPlugin
 */

namespace Inc\Api\Callbacks;
use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function adminDashboard() {
        return require_once ("$this->plugin_path/templates/admin.php");
    }

    public function adminCpt() {
        return require_once ("$this->plugin_path/templates/cpt.php");
    }

    public function adminTaxonomies() {
        return require_once ("$this->plugin_path/templates/taxonomies.php");
    }

    public function adminWidgets() {
        return require_once ("$this->plugin_path/templates/widgets.php");
    }
}