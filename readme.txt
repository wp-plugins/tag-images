=== Tag Images ===
Contributors: chrisnorthwood
Tags: images, tag, admin, tags
Requires at least: 2.7
Tested up to: 2.9.1
Stable tag: 1.2

== Description ==

This plugin adds a panel to the Options screen in the admin that allows you to assign an image to a tag.

In order to make use of the image, you must alter your theme to include it where appropriate. In it's simplest case, this is simply something like `echo get_tag_image($tag)` or `<?php foreach (get_the_tags() as $tag) echo get_tag_image($tag); ?>`, or something.

== Installation ==

Install your plugin as per usual. However, on its own, it does nothing other than add the admin panel. You must use add the functions as described in the description to your theme where you want to use it.

To assign images, simply go to the "Tag Images" panel in your options and you will see all your tags listed, and any images for them. You can simply replace an image or upload one.

== Changelog ==

= 1.2 =

* Make the feature added in 1.1 actually work

= 1.1 =

* Added the ability to suppress tags without an image from showing