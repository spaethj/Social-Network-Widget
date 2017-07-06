<?php

/**
 * Class Social_Network_Widget
 */
class Social_Network_Widget extends WP_Widget {
    public $snw_title;
    public $snw_position;

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {

        // social networks list
        $this->snw_title = array(
            'title',
            'twitter',
            'linkedin',
            'viadeo',
            'youtube',
            'newsletter',
            'flux RSS',
            'google play',
            'app store'
        );

        $widget_ops = array(
            'classname' => 'Social Network Widget',
            'description' => 'Display social media and applications store information on your website with these simple widgets.',
        );
        parent::__construct( 'social_network_widget', 'Social Network Widget', $widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {

        echo '<aside class="widget sn_widget">';
        if ($instance['title']) {
            echo '<div class="block-title">
                    <span>' . $instance['title'] . '</span>
                </div>';
        }

        $slice_items = array_slice($this->snw_title, 1);
        $slice_instances = array_slice($instance, 1);

        echo '<ul>';
        foreach (array_combine( $slice_items, $slice_instances ) as $slice_item=>$slice_instance ){
            echo '<li id="'. str_replace(' ', '-', $slice_item ) .'"><a href="'. $slice_instance .'" title="'. ucwords($slice_item) .'" target="_blank">' . ucwords($slice_item) . '</a></li>';
        }
        echo '</ul>
        </aside>';
    }

    /**
     * Outputs the options form on admin
     *
     * @see WP_Widget::form()
     * @param array $instance The widget options
     * @return string|void
     */
    public function form( $instance ) {

        echo '<p>';
        foreach ($this->snw_title as $item) {
            if (!$instance){
                $instance = null;
            }
            echo '<label for="' . $this->get_field_id($item) . '">' . ucfirst($item) . '</label>' .
                '<input class="widefat" id="' . $this->get_field_id($item) . '" name="' . $this->get_field_name($item) . '" type="text" value="' . esc_attr($instance[$item]) . '" />';
        }
        echo '</p>';
    }

    /**
     * Processing widget options on save
     *
     * @see WP_Widget::update()
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        foreach ($this->snw_title as $item){
            $instance[$item] = $new_instance[$item];
        }

        return $instance;
    }
}
