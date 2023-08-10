<?php
namespace MRBS;

function print_theme_footer()
{
  echo "</div>\n";  // closing the contents div, opened in print_theme_header()
  ?>
  <div class="layout_link">
    <a
      href="Themes/cobotmakerspace/images/layout.png"
      data-lightbox="image-1"
      data-title="Lab Layout">View lab layout</a>
  </div>
  <footer style="width: 100%; text-align: center;">
    <a href="https://wiki.cobotmakerspace.org/legal#privacy_policy">Privacy Policy</a> |
    <a href="https://wiki.cobotmakerspace.org/legal#cookie_policy">Cookie Policy
  </footer>
  <script>
  jQuery(function($) {
    var table = $('.table_container');
    var layout_link = $('.layout_link');
    layout_link.insertBefore(table);
  });
  </script>
  <?php
  echo "</body>\n";
  echo "</html>\n";
}
