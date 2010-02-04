<?php
/*
Plugin Name: Tag images
Plugin URI: http://wordpress.org/extend/plugins/tag-images/
Description: Allows you to have an image to represent a tag
Version: 1.2
Author: Chris Northwood
Author URI: http://www.pling.org.uk/
*/

function get_tag_image($term, $show_if_no_image = true)
{
    $im = get_option('tag-' . $term->term_id . '-image');
    if ($im === FALSE)
    {
        if ($show_if_no_image)
        {
            return '<a href="' . get_tag_link($term->term_id) . '">' . $term->name . '</a>';
        }
    }
    else
    {
        return '<a href="' . get_tag_link($term->term_id) . '"><img src="' . $im . '" alt="' . $term->name . '" title="' . $term->name . '" /></a>';
    }
}

function tagimage_menu_init()
{
    add_options_page('Images for Tags', 'Images for Tags', 'manage_options', __FILE__, 'tagimage_admin');
}

add_action('admin_menu', 'tagimage_menu_init');

function tagimage_admin()
{
    if (isset($_POST['tag-id']) && isset($_FILES['new-image']))
    {
        $uploaded = wp_handle_upload($_FILES['new-image'], array('test_form' => false));
        if (!isset($uploaded['error']))
        {
            update_option('tag-' . $_POST['tag-id'] . '-image', $uploaded['url']);
            $message = 'Successfully updated tag image.';
        }
        else
        {
            $message = 'Tag image update failed: ' . $uploaded['error'];
        }
    }
?>
<div class="wrap">
<h2>Images for Tags</h2>
<?php
    if (isset($message))
    {
        echo '<div id="message" class="updated fade below-h2"><p>' . $message . '</p></div>';
    }
?>
<table class="form-table">

<tr>
    <th scope="col">Tag Name</th>
    <th scope="col">Current Image</th>
    <th scope="col" colspan="2">New Image</th>
</tr>

<?php
    foreach (get_tags() as $this_tag)
    {
?>

<form enctype="multipart/form-data" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<tr valign="top">
    <th scope="row"><input type="hidden" name="tag-id" value="<?php echo $this_tag->term_id; ?>" /><?php echo $this_tag->name; ?></th>
    <td><?php echo get_tag_image($this_tag); ?></td>
    <td><input type="file" name="new-image" /></td>
    <td class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></td>
</tr>
</form>

<?php
    }
?>

</table>

</div>

<?php
}

?>
