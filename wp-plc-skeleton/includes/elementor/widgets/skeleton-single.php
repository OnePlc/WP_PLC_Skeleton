<?php

use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;

class WPPLC_Skeleton_Single extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_name() {
        return 'wpplcskeletonsingle';
    }

    public function get_title() {
        return __('Skeleton Single', 'wp-plc-skeleton');
    }

    public function get_icon() {
        return 'fa fa-image';
    }

    public function get_categories() {
        return ['wp-plc-skeleton'];
    }

    protected function render() {
        # Get Elementor Widgets Settings
        $aSettings = $this->get_settings_for_display();

        //$aSettings['slides_per_view'] = 3;
        # Set default values

        # Get Connection Data from onePlace Core
        $sHost = get_option('plcconnect_server_url');
        $sHostKey = get_option('plcconnect_server_key');

        if($sHost == '') {
            echo 'oneplace not connected!';
        } else {
            $iSkeletonID = get_query_var('skeleton_id');
            if(!is_numeric($iSkeletonID) || empty($iSkeletonID)) {
                echo 'invalid skeleton id provided';
            } else {
                $sJsonInfo = file_get_contents($sHost . '/skeleton/api/get/'.$iSkeletonID.'?authkey=' . $sHostKey);
                $oCatInfo = json_decode($sJsonInfo);

                if (!is_object($oCatInfo)) {
                    echo 'could not load skeletons';
                    if (is_user_logged_in()) {
                        echo '<pre>' . $sJsonInfo . '</pre>';
                    }
                } else {
                    if ($oCatInfo->state == 'success') {
                        # Generate Elementor Unique ID for View
                        $sSliderID = \ Elementor\Utils::generate_random_string();

                        # Get skeleton
                        $oSkeleton = $oCatInfo->oItem;

                        # Load Template
                        include __DIR__ . '/../../view/partials/skeleton-single.php';
                    } else {
                        echo 'Error: ' . $oCatInfo->message;
                    }
                }
            }
        }
    }

    protected function _content_template() {

    }

    protected function _register_controls() {
    }
}