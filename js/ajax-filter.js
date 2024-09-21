jQuery(document).ready(function ($) {
  $(".filter-options-item a").on("click", function (e) {
    e.preventDefault();

    var team_id = $(this).data("team-id");
    $("#selected-team-name").text($(this).text());

    $.ajax({
      url: ajax_filter.ajax_url, // WordPress AJAX URL
      type: "POST",
      data: {
        action: "filter_fixtures_by_team",
        team_id: team_id,
        nonce: ajax_filter.nonce,
      },
      success: function (response) {
        // Replace the fixtures container with the new data
        $("#fixtures-results").html(response);
      },
      error: function () {
        alert("There was an error fetching the fixtures.");
      },
    });
  });
});
