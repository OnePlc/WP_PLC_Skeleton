<?php
class WPPLC_Skeleton_Slider extends \Elementor\Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_name() {
        return 'wpplcskeletonslider';
    }

    public function get_title() {
        return __('Skeleton Slider', 'wp-plc-skeleton');
    }

    public function get_icon() {
        return 'fa fa-images';
    }

    public function get_categories() {
        return ['wp-plc-skeleton'];
    }

    protected function render() {
        # Get Elementor Widgets Settings
        $aSettings = $this->get_settings_for_display();

        # Get Connection Data from onePlace Core
        $sHost = get_option('plcconnect_server_url');
        $sHostKey = get_option('plcconnect_server_key');

        if($sHost == '') {
            echo 'oneplace not connected!';
        } else {
            $sJsonInfo = file_get_contents($sHost.'/skeleton/api/list/0?authkey='.$sHostKey);
            $oCatInfo = json_decode($sJsonInfo);

            if(!is_object($oCatInfo)) {
                echo 'could not load skeletons';
                if(is_user_logged_in()) {
                    echo '<pre>'.$sJsonInfo.'</pre>';
                }
            } else {
                if($oCatInfo->state == 'success') {
                    // get items
                    $aItems = $oCatInfo->results;

                    // Generate Elementor Unique ID for Slider
                    $sSliderID = \ Elementor\Utils::generate_random_string();

                    // Load Template
                    include __DIR__.'/../../view/partials/article-slider.php';
                } else {
                    echo 'Error: '.$oCatInfo->message;
                }
            }
        }
    }

    protected function _content_template() {

    }

    protected function _register_controls() {

    }
}