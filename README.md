# Social Network Widget
Social Network Widget is a widget for Wordpress how allow to add button for social media and applications store information on your website.

The widget is register in file ignored by Github. The widget can then be registered using the widgets_init hook:

```php
add_action( 'widgets_init', function(){
    register_widget( 'Recent_Taxonomy_Posts' );
});
```