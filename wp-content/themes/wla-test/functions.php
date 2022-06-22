<?php

function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyAlRCQLAadPuh8wllqRJZN9bb9LrgsW914');
}
add_action('acf/init', 'my_acf_init');