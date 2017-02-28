<?php
/**
 * Customizer: Image Radio Custom Control
 *
 * @see ttps://developer.wordpress.org/reference/classes/wp_customize_control/
 * @package Essay
 */


class Bean_Image_Radio_Control extends WP_Customize_Control {
     

     /**
     * Set the $type variable to be used in the Customizer. 
     *
     * @param WP_Customize_Manager $wp_customize the Customizer object.
     */
     public $type = 'image_radio';


     /**
     * Enqueue neccessary custom control stylesheet.
     */
     public function enqueue() {
          wp_enqueue_style('image-radio', get_theme_file_uri( '/inc/customizer/custom-controls/image-radio/image-radio.css' ) );
     } //enqueue


     /**
     * Render the control’s content.
     * Allows the content to be overriden without having to rewrite the wrapper in $this->render().
     * 
     * @see https://developer.wordpress.org/reference/classes/wp_customize_control/render_content/
     */

     public function render_content() {

          $name = '_customize-image-radios-' . $this->id; ?>

          <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

          <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>

          <?php foreach ( $this->choices as $value => $label ) { ?>

               <input id="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>" class="image-radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
                    <label for="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>">
                    <img src="<?php echo esc_html($this->choices[$value]); ?>"/>
               </label>
          <?php
          }
     } // render_content


} // Bean_Image_Radio_Control