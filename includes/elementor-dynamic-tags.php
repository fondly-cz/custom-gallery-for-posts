<?php

use ElementorPro\Modules\DynamicTags\Tags\Base\Data_Tag;
use ElementorPro\Modules\DynamicTags\Module;


class CGP_Elementor_Gallery_Tag extends Data_Tag
{

    public function get_name()
    {
        return 'cgp-gallery-tag';
    }

    public function get_title()
    {
        return __('Custom Gallery', 'plugin-name');
    }

    public function get_categories()
    {
        return [Module::GALLERY_CATEGORY];
    }

    public function get_group()
    {
        return Module::POST_GROUP;
    }

    public function get_value(array $options = [])
    {
        $post_id = get_the_ID();

        if ($post_id !== false) {

            $images = get_post_meta($post_id, '_cgp_gallery', true);

            if (!empty($images)) {
                $value = [];
                foreach ($images as $image_id) {
                    $value[] =
                        [
                            'id' => $image_id,
                        ];
                }
                return $value;
            }
        }

        return [];
    }
}
