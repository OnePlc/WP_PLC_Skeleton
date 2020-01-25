<article class="plc-admin-page-elementor plc-admin-page" style="padding: 10px 40px 40px 40px;">
    <h1><?=__('Elementor Settings','wp-plc-skeleton')?></h1>
    <p>Here you find the elementor settings for the skeleton</p>

    <h3>Elementor Widgets</h3>
    <!-- Enable Skeleton Slider -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bElementorSkeletonSliderActive = get_option( 'plcskeleton_elementor_skeleton_slider_active', false ); ?>
            <input name="plcskeleton_elementor_skeleton_slider_active" type="checkbox" <?=($bElementorSkeletonSliderActive == 1)?'checked':''?> class="plc-settings-value" />
            <span class="plc-settings-slider"></span>
        </label>
        <span>Enable Skeleton Slider</span>
    </div>
    <!--Enable Skeleton Slider -->

    <hr/>
    <button class="plc-admin-settings-save plc-admin-btn plc-admin-btn-primary" plc-admin-page="page-elementor">Save Elementor Settings</button>
    <!-- Save Button -->
</article>