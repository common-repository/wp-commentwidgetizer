=== WP CommentWidgetizer ===
Contributors: phd38
Donate link: http://www.photos-dauphine.com/wp-commentwidgetizer
Tags: widget, comments, guestbook
Requires at least: 2.7
Tested up to: 2.9.2
Stable tag: 1.0.0


== Description ==

**WP CommentWidgetizer** is a simple widget that takes one of the approved comments made on any page or post of your site and displays it in the sidebar.

It can be used to manage guest books, or more simply to randomly export to your homepage comments spread deeper in your site pages in order to make it visible to your visitors not reaching the post or page holding those comments.

You can see the *CommentWidgetizer* widget used as guestbook homepage exporter [here](http://www.photos-dauphine.com/ "Check out here the WP CommentWidgetizer widget in action"). French reading visitors will get additional insights on this [widget genesis page](http://www.photos-dauphine.com/wp-commentwidgetizer "WP CommentWidgetizer widget page").


== Installation ==

To install the **WP CommentWidgetizer** plugin just follow this simple 10-step recipe :

1. Download the plugin and expand it to an empty directory of your local disk drive.
2. Copy the local *wp-commentwidgetizer* folder created by the unzipper onto your server plugins folder (*wp-content/plugins/*).
3. Login into the WordPress administration area and click on the *Plugins* left menu. Expand the *Installed* view.
4. Locate the *CommentWidgetizer* plugin and click on the *Activate* link. Check that the plugin is actually listed as activated.
5. Go to *Appearance > Widget*. The *CommentWidgetizer* widget appears in the left pane, drag and drop it to the right sidebar at the place you want it to appear.
6. In the sidebar, click on the bottom arrow located at the right of the widget to expand it.
7. Fill the text fields : Title and Text (optional)
8. Fill in the *Post or page IDs* field : you list here the IDs of posts or pages from where you want the comments to be taken from. In case of multiple pages or posts, separate the IDs with a comma (CSV format). Pages and posts IDs can be found from the *Page > Modify* or *Posts > Modify*. Place your mouse over the page or post holding the comments you want to display in the widget, and look at the browser status bar. You should see something like *http://www.mysite.com/wp-admin/post.php?action=edit&post=2027*. In this case the ID is 2027. By default the value is set to 0 ; in this case all the comments existing and approved will be considered.
9. Save your settings.
10. You are done, check now your sidebar rendering, you should see the comments randomly selected from the source(s) you indicated.

If you are interested in seeing the widget in action, you can go and have a look [here](http://www.photos-dauphine.com "Check out here the WP CommentWidgetizer widget in action").

  
More information on this widget utilization can be found [there](http://www.photos-dauphine.com/wp-commentwidgetizer "WP CommentWidgetizer Home").


== Frequently Asked Questions ==

= Pre-requisite =

Make sure you have some comments posted in your site ; otherwise this widget will display a frustrating *No comment yet available*.

= How can I guess the page or post ID of the page or post I want the comments to be sourced from ? =

Pages and posts IDs can be found from the *Page > Modify* or *Posts > Modify*. Place your mouse over the page or post holding the comments you want to display in the widget, and look at the browser status bar. You should see something like *http://www.mysite.com/wp-admin/post.php?action=edit&post=2027*. In this case the ID is 2027.

= What happens if I keep the page/ post ID equal to the default value set to 0 ? =

All the comments from your site will be considered for the selection. This is the default value for the plugin.

= Are also the non approved comments considered by the widget =

No. The selection will be done among the approved comments only.

= Does this widget modify the WordPress database ? =

Nope. You can relax, no risk of corruption.

= What are the available languages ? =

The plugin is developped in english, and provided with a french (optional) localization.


== Screenshots ==

1. CommentWidgetizer widget configuration
2. A possible implementation of CommentWidgetizer as guest book


== Changelog ==

= 1.0.0 =
- First release. CommentWidgetizer concept implemented.
