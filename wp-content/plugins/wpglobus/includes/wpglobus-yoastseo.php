<?php
/**
 * File: wpglobus-yoastseo.php
 *
 * @package WPGlobus\Yoast
 */

if ( defined('WPSEO_VERSION') && defined('WPSEO_PREMIUM_PLUGIN_FILE') ) {
	/**
	 * Start with Yoast SEO Premium.
	 */
	if ( version_compare( WPSEO_VERSION, '3.9', '>=' ) ) {
		/**
		 * Support Yoast SEO Premium version 3.9 or later.
		 * Version of file must be latest.
		 */
		require_once 'vendor/class-wpglobus-yoastseo41.php';
		WPGlobus_YoastSEO::controller();
	} else {
		require_once 'vendor/class-wpglobus-yoastseo38.php';
		WPGlobus_YoastSEO::controller();		
	}
	
} else {

	if ( defined( 'WPSEO_VERSION' ) ) {

		if ( version_compare( WPSEO_VERSION, '3.8', '>=' ) ) {

			if ( version_compare( WPSEO_VERSION, '4.0', '>=' ) ) {
				
				$version = '40';
				$version = version_compare( WPSEO_VERSION, '4.1', '>=' ) ? '41' : $version;
				$version = version_compare( WPSEO_VERSION, '4.4', '>=' ) ? '44' : $version;
				
				require_once "vendor/class-wpglobus-yoastseo$version.php";
				WPGlobus_YoastSEO::controller();
				
			} else {
				
				require_once 'vendor/class-wpglobus-yoastseo38.php';
				WPGlobus_YoastSEO::controller();
			
			}
			
		} else if ( version_compare( WPSEO_VERSION, '3.4', '>=' ) ) {

			require_once 'vendor/class-wpglobus-yoastseo34.php';
			WPGlobus_YoastSEO::controller();

		} else {

			if ( version_compare( WPSEO_VERSION, '3.0.0', '<' ) ) {
				require_once 'vendor/class-wpglobus-wpseo.php';
				WPGlobus_WPSEO::controller();
			} else {
				if ( version_compare( WPSEO_VERSION, '3.2.0', '<' ) ) {
					require_once 'vendor/class-wpglobus-yoastseo30.php';
					WPGlobus_YoastSEO::controller();
				} else {
					if ( version_compare( WPSEO_VERSION, '3.3.0', '>=' ) ) {
						require_once 'vendor/class-wpglobus-yoastseo33.php';
						WPGlobus_YoastSEO::controller();
					} else {
						require_once 'vendor/class-wpglobus-yoastseo32.php';
						WPGlobus_YoastSEO::controller();
					}
				}
			}

		}

	}

} // class

# --- EOF