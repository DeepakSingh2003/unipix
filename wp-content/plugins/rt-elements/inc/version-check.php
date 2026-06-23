<?php
function reactheme_plugin_update_check($transient) {
    // Check if the transient already contains update data for our plugin
    if (empty($transient->checked)) {
        return $transient;
    }

    // Your plugin slug and URL to check for the latest version info
    $plugin_slug = 'rt-elements';
    $update_url = 'https://themewant.com/products/plugins/unipix/version-check.json';

    // Get current plugin version
    $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin_slug . '/' . $plugin_slug . '.php');
    $current_version = $plugin_data['Version'];

    // Request the latest version info from your server
    $response = wp_remote_get($update_url);
    if (is_wp_error($response) || wp_remote_retrieve_response_code($response) != 200) {
        return $transient; // Exit if the request fails
    }

    $remote_data = json_decode(wp_remote_retrieve_body($response));

    // Validate remote data structure
    if (!is_object($remote_data) || 
        !isset($remote_data->new_version) || 
        !isset($remote_data->changelog) || 
        !isset($remote_data->download_url)) {
        return $transient;
    }

    if (version_compare($current_version, $remote_data->new_version, '<')) {
        $transient->response[$plugin_slug . '/' . $plugin_slug . '.php'] = (object) [
            'slug' => $plugin_slug,
            'new_version' => $remote_data->new_version,
            'url' => $remote_data->changelog,
            'package' => $remote_data->download_url
        ];
    }

    return $transient;
}
add_filter('pre_set_site_transient_update_plugins', 'reactheme_plugin_update_check');

// Add filter for plugin information screen
function reactheme_plugin_info_screen($res, $action, $args) {
    if ($action !== 'plugin_information') {
        return $res;
    }

    if ('rt-elements' !== $args->slug) {
        return $res;
    }

    $remote_url = 'https://themewant.com/products/plugins/unipix/version-check.json';
    $remote_response = wp_remote_get($remote_url);

    if (!is_wp_error($remote_response) && wp_remote_retrieve_response_code($remote_response) === 200) {
        $remote_data = json_decode(wp_remote_retrieve_body($remote_response));

        if (is_object($remote_data) && isset($remote_data->name)) {
            $res = new stdClass();
            $res->name = $remote_data->name;
            $res->slug = 'rt-elements';
            $res->version = $remote_data->new_version;
            $res->tested = $remote_data->tested;
            $res->requires = $remote_data->requires;
            $res->author = $remote_data->author;
            $res->author_profile = $remote_data->author_homepage;
            $res->download_link = $remote_data->download_url;
            $res->trunk = $remote_data->download_url;
            $res->requires_php = $remote_data->requires_php;
            $res->last_updated = $remote_data->last_updated;
            $res->sections = [
                'description' => $remote_data->sections->description,
                'installation' => $remote_data->sections->installation,
                'changelog' => $remote_data->sections->changelog
            ];
            
            if (!empty($remote_data->banners)) {
                $res->banners = [
                    'low' => $remote_data->banners->low,
                    'high' => $remote_data->banners->high
                ];
            }
        }
    }

    return $res;
}
add_filter('plugins_api', 'reactheme_plugin_info_screen', 20, 3);