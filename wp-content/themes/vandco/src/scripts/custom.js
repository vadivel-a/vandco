/*global $ */
import $ from 'jquery';

document.addEventListener("DOMContentLoaded", () => {
  if ($(".search-toggle").length > 0) {
    $(document).on('click', '.search-toggle', function() {
        $(".search-container").toggleClass("active");
        document.querySelector('.cookcodesmenu_btn').click();
        $(".search-field").focus();
    });
  }
});