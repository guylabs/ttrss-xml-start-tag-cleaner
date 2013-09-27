<?php

/**
 * Plugin which removes everything before the '<xml' start tag of a feed.
 */
class Xml_Start_Tag_Cleaner extends Plugin {

        private $host;

        function about() {
                return array("0.1.0",
                        "Removes everything before the '<xml' start tag of a feed.",
                        "guylabs");
        }

        function init($host) {
                $this->host = $host;
                $host->add_hook($host::HOOK_FEED_FETCHED, $this);
        }

        /**
         * After the feed is fetched, clean the '<?xml' start tag of the $feed_data.
         */
        function hook_feed_fetched($feed_data, $fetch_url, $owner_uid, $feed) {
                _debug("xml_start_tag_cleaner: Removing everything before XML start tag '<?xml'.");
                $feed_data_cleaned = strstr($feed_data, "<?xml");
                _debug("xml_start_tag_cleaner: Removed the following data: ".strstr($feed_data, "<?xml", true));
                return $feed_data_cleaned;
        }

        function api_version() {
                return 2;
        }

}
?>
