<?php
/**
 * Plugin Name: Excerpt After Title
 * Plugin URI: https://github.com/NefariousCreations/excerpt-after-title
 * Description: A basic JS function to move the manual excerpt box after the title field.
 * Version: 1.0.0
 * Author: Nefarious Creations
 * Author URI: https://nefariouscreations.com.au
 */

/**
 * Move the post excerpt before the main WYSIWYG content editor and add a description.
 */
add_action('admin_footer', function () {

  if ( ('post' == get_current_screen()->id) or ('page' == get_current_screen()->id) ) {
    ?>

    <script type="text/javascript">
      jQuery(function ($) {
        $(document).ready(function () {


            /**
             * Gutenberg Changes
             */

            /**
             * Move the post excerpt to below the main title.
             */
            if ($('.gutenberg-editor-page button:contains("Excerpt")').length) {
                // Move excerpt before main editor
                $('.editor-post-title').after($('button:contains("Excerpt")').closest(".components-panel__body").addClass("is-opened post-excerpt").removeClass('components-panel__body'));
                // Remove the panel button and header
                $('.post-excerpt .components-panel__body-title').remove();
                // Change the instruction text
                $('.post-excerpt label').html('Write an excerpt <i>(Important)</i>');
            }

            /**
             * Classic Editor Changes
             */

            /**
             * Move the post excerpt above the main content editor.
             */
            if ($('body:not(.gutenberg-editor-page) #postexcerpt').length) {
                // Add description class to default instructions
                $('#postexcerpt .inside p').addClass('description');
                // Add additional instructions
                $('#postexcerpt .inside').prepend("<hr><h3>Excerpt</h3><p>This excerpt is used throughout the website, by search engines and social media. The excerpt is a brief introduction to the article that is will be seen anywhere the post / page appears, <strong>so make sure you add one</strong>.</p>");
                // Move excerpt before main editor
                $('#postdivrich').before($('#postexcerpt .inside').addClass('post-excerpt'));
            }

            /**
             *  Add title before post content editor
             */
            $('body:not(.gutenberg-editor-page) #postdivrich').before("<hr><h3>Post Content</h3>");

        });
      });
    </script>

    <style type="text/css">

        /**
        * Post Excerpt Styles (Gutenberg)
        */
        .gutenberg-editor-page .post-excerpt {
          margin-bottom: 32px;
          border-bottom: 1px solid #e2e4e7;
        }
        .gutenberg-editor-page .post-excerpt > div {
          margin-left: auto;
          margin-right: auto;
          max-width: 732px;
          padding: 0 62px 32px;
        }
        .gutenberg-editor-page .post-excerpt textarea {
          min-height: 180px;
          height: fit-content;
          padding: 12px 14px;
          font-size: 16px !important;
          line-height: 1.65 !important;
        }
        /**
         * Post Excerpt Styles (Classic)
         */
        body:not(.gutenberg-editor-page) #postexcerpt {
          display: none;
        }
        body:not(.gutenberg-editor-page) #excerpt {
          min-height: 10em;
        }

    </style>

    <?php
  }
});