<?php
/*
Plugin Name: WPPM Example Plugin
Plugin URI: http://hotsource.io/
Description: Example Plugin using WPPM Package Management
Author: Matthew Zalewski @ HotSource.io
Author URI: http://www.hotsource.io/
Version: 1.0
License: GNU General Public License v2.0 or later
License URI: http://www.opensource.org/licenses/gpl-license.php
*/
require_once __DIR__ . "/vendor/hotsource/wppm/wppm.php";
if ( ! WPPM::autoload( __FILE__ ) )
      return;

class MyPostType extends \WPPostType\PostType
{
    function __construct()
    {
        // set post type name: 'my-post-type'
        // - archive page: yoursite.com/my-post-type
        // - single page: yoursite.com/my-post-type/post-slug
        parent::__construct('my-post-type', array(
            // second argument of `register_post_type()`
            // see: http://codex.wordpress.org/Function_Reference/register_post_type
            'supports' => array('title', 'editor'),
            'has_archive' => true
        ));
    }

    // compose edit screen
    public function onAddMetaBoxes()
    {
        // create 'Info' box
        add_meta_box(
            'my-post-type-info',
            'Info',
            array($this, 'addMetaInfo'),
            $this->name
        );
    }

    public function addMetaInfo($post)
    {
        // input tags for custom fields: 'nickname' and 'birth_year'
        ?>
        <p>
            Nickname<br>
            <input type="text" name="nickname" value="<?php echo esc_attr($post->nickname) ?>"></input><br>
        </p>
        <p>
            Birth Year<br>
            <input type="number" name="birth_year" value="<?php echo esc_attr($post->birth_year) ?>"></input>
        </p>
        <?php
    }

    public function onCheckedSavePost($post_id, $post)
    {
        $params = stripslashes_deep($_POST);

        // save custom values in a custom way
        if (isset($params['nickname'])) {
            $value = trim($params['nickname']);
            update_post_meta($post_id, 'nickname', $value);
        }
        if (isset($params['birth_year'])) {
            $value = intval($params['birth_year']);
            update_post_meta($post_id, 'birth_year', $value);
        }
    }
}

// register 'my-post-type'
new MyPostType();