/**                 
	* Sticky Sidebar Feature Setting                  
	* @package Theme Egg                 
	* @subpackage eggnews-pro                 
	* @since 1.1.11  **/

jQuery(document).ready(function () {
	var wpAdminBar = jQuery('#wpadminbar');
	if (wpAdminBar.length) {
		jQuery("#teg-menu-wrap").sticky({topSpacing: wpAdminBar.height()});
	} else {
		jQuery("#teg-menu-wrap").sticky({topSpacing: 0});
	}
});
