jQuery(document).ready(function ($) {
  // Show loader function
  function showLoader() {
    $("#fixtures-results").html(
      '<div class="loader">Loading fixtures...</div>'
    );
  }

  // Hide loader function
  function hideLoader() {
    $(".loader").remove();
  }

  // Function to filter fixtures by team
  function filterFixtures(team_id, team_name) {
    // Show loader while fetching data

    showLoader();

    // Update selected team name
    $("#selected-team").text(team_name);
    $("#selected-team-big-name").text(team_name);

    // Perform AJAX request to get filtered fixtures
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
        hideLoader();
        $("#fixtures-results").html(response);
      },
      error: function () {
        hideLoader();
        alert("There was an error fetching the fixtures.");
      },
    });
  }

  // Make the first team selected by default
  var first_team = $(".filter-options-item a").first();
  $(".filter-options-item").first().addClass("is-active");
  var first_team_id = first_team.data("team-id");
  var first_team_name = first_team.text();

  // Trigger default filtering on page load
  filterFixtures(first_team_id, first_team_name);

  // Handle team filter click
  $(".filter-options-item a").on("click", function (e) {
    e.preventDefault();

    var team_id = $(this).data("team-id");
    var team_name = $(this).text();

    // Set the clicked team as active
    $(".filter-options-item").removeClass("is-active");
    $(this).parent().addClass("is-active");

    // Filter fixtures for the selected team
    filterFixtures(team_id, team_name);

    // Close the dropdown after selection
    $(".filter-select-trigger").attr("aria-expanded", "false");
    $("#filter-options").attr("aria-hidden", "true");
  });

  // Toggle dropdown on click
  $(".filter-select-trigger").on("click", function (e) {
    e.preventDefault();
    var expanded = $(this).attr("aria-expanded") === "true" || false;
    $(this).attr("aria-expanded", !expanded);
    $("#filter-options").attr("aria-hidden", expanded);
  });
});
