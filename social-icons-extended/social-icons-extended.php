<?php
/**
 * Plugin Name: Social Icons Extended
 * Description: Add additional Social Icon options to the Social Icons plugin
 * Version: 0.1.0
 * Author: Rolf Chen
 * URI: https://www.dataestate.com.au
 */

 function social_icon_enqueue() {
  wp_enqueue_script(
    'social-icons-extended-script',
    plugins_url('build/index.js', __FILE__)
  );
 }

 function social_icon_frontend_styles() {
  wp_enqueue_style(
    'social-icons-extended-styles',
    plugins_url('build/style-index.css', __FILE__)
  );
 }

 /**
  * Code referenced from https://cameronjonesweb.com.au/blog/adding-a-custom-icon-to-the-social-links-block-should-not-be-this-hard/
  */
 function social_icon_rendered($block_content, $block) {
  // var_dump($block);
  if ($block['blockName'] === 'core/social-link' && in_array($block['attrs']['service'], ['tripadvisor'])) {
      $icon = '<svg width="24" height="24" viewBox="0 0 24 24"><path d="M22.0384 8.7834L24 6.64929H19.6501C17.4724 5.16175 14.8424 4.29541 11.9982 4.29541C9.15752 4.29541 6.5349 5.16362 4.36082 6.64929H0L1.96156 8.7834C0.759216 9.8804 0.00546801 11.4606 0.00546801 13.2151C0.00546801 16.5261 2.68993 19.2105 6.00096 19.2105C7.57384 19.2105 9.00684 18.6039 10.0766 17.6122L11.9982 19.7045L13.9198 17.614C14.9896 18.6057 16.4208 19.2105 17.9937 19.2105C21.3047 19.2105 23.9928 16.5261 23.9928 13.2151C23.9945 11.4587 23.2408 9.87862 22.0384 8.7834ZM6.00273 17.2726C3.76145 17.2726 1.94525 15.4564 1.94525 13.2151C1.94525 10.9738 3.76149 9.15754 6.00273 9.15754C8.24397 9.15754 10.0602 10.9738 10.0602 13.2151C10.0602 15.4564 8.24397 17.2726 6.00273 17.2726ZM12 13.097C12 10.4271 10.0584 8.135 7.49569 7.15602C8.88148 6.57661 10.4017 6.25515 11.9982 6.25515C13.5947 6.25515 15.1166 6.57661 16.5025 7.15602C13.9416 8.13683 12 10.4271 12 13.097ZM17.9955 17.2726C15.7542 17.2726 13.938 15.4564 13.938 13.2151C13.938 10.9738 15.7542 9.15754 17.9955 9.15754C20.2368 9.15754 22.053 10.9738 22.053 13.2151C22.053 15.4564 20.2367 17.2726 17.9955 17.2726ZM17.9955 11.0864C16.8204 11.0864 15.8686 12.0381 15.8686 13.2133C15.8686 14.3884 16.8204 15.3401 17.9955 15.3401C19.1706 15.3401 20.1223 14.3884 20.1223 13.2133C20.1223 12.0399 19.1706 11.0864 17.9955 11.0864ZM8.12956 13.2151C8.12956 14.3902 7.17783 15.3419 6.00273 15.3419C4.82764 15.3419 3.87591 14.3902 3.87591 13.2151C3.87591 12.0399 4.82764 11.0882 6.00273 11.0882C7.17783 11.0864 8.12956 12.0399 8.12956 13.2151Z"/></svg>';
      $before = explode( '<svg', $block_content );
			$after = explode( '</svg>', $before[1] );
			$block_content = $before[0] . $icon . $after[1];
      // echo 'We got this icon';
  }

  return $block_content;
 }

 add_action('enqueue_block_editor_assets', 'social_icon_enqueue');
 add_action('wp_enqueue_scripts', 'social_icon_frontend_styles');
 add_filter('render_block', 'social_icon_rendered', 10, 2);
