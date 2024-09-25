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

/*--------------------------------------------------------------
	>>> Results Filter
	----------------------------------------------------------------*/
jQuery(document).ready(function ($) {
  // Show loader function
  function showLoader() {
    $("#fixtures-results-page").html(
      '<div class="loader">Loading Results...</div>'
    );
  }

  // Hide loader function
  function hideLoader() {
    $(".loader").remove();
  }

  // Function to filter Results by team
  function filterResults(team_result_id, team_result_name) {
    // Show loader while fetching data

    showLoader();

    // Update selected team name
    $("#selected-result-team").text(team_result_name);
    $("#selected-result-team-big-name").text(team_result_name);

    // Perform AJAX request to get filtered Results
    $.ajax({
      url: ajax_filter.ajax_url, // WordPress AJAX URL
      type: "POST",
      data: {
        action: "filter_result_by_team_result",
        team_result_id: team_result_id,
        nonce: ajax_filter.nonce,
      },
      success: function (response) {
        // Replace the fixtures container with the new data
        hideLoader();
        $("#fixtures-results-page").html(response);
      },
      error: function () {
        hideLoader();
        alert("There was an error fetching the Results.");
      },
    });
  }

  // Make the first team selected by default
  var first_result_team = $(".filter-result-options-item a").first();
  $(".filter-result-options-item").first().addClass("is-active");
  var first_result_team_id = first_result_team.data("team-result-id");

  var first_result_team_name = first_result_team.text();
  // Trigger default filtering on page load
  filterResults(first_result_team_id, first_result_team_name);

  // Handle team filter click
  $(".filter-result-options-item a").on("click", function (e) {
    e.preventDefault();

    var team_result_id = $(this).data("team-result-id");
    var team_result_name = $(this).text();

    // Set the clicked team as active
    $(".filter-result-options-item").removeClass("is-active");
    $(this).parent().addClass("is-active");

    // Filter fixtures for the selected team
    filterResults(team_result_id, team_result_name);

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

/*--------------------------------------------------------------
	>>> Table Filter
	----------------------------------------------------------------*/
jQuery(document).ready(function ($) {
  // Show loader function
  function showLoader() {
    $("#league-table-results").html(
      '<div class="loader">Loading League Table...</div>'
    );
  }

  // Hide loader function
  function hideLoader() {
    $(".loader").remove();
  }

  // Function to filter table by team
  function filterleaguetable(league_table_id, league_table_name) {
    // Show loader while fetching data

    showLoader();

    // Update selected league table name
    $("#selected-league-table").text(league_table_name);
    $("#selecte-league-table").text(league_table_name);
    $("#selected-league-table-name").text(league_table_name);

    // Perform AJAX request to get filtered fixtures
    $.ajax({
      url: ajax_filter.ajax_url, // WordPress AJAX URL
      type: "POST",
      data: {
        action: "filter_league_table_by_team",
        league_table_id: league_table_id,
        nonce: ajax_filter.nonce,
      },
      success: function (response) {
        // Replace the fixtures container with the new data
        hideLoader();
        $("#league-table-results").html(response);
      },
      error: function () {
        hideLoader();
        alert("There was an error fetching the league table.");
      },
    });
  }

  // Make the first team selected by default
  var league_table_data = $(".filter-options-item a").first();
  $(".filter-options-item").first().addClass("is-active");
  var league_table_data_id = league_table_data.data("league_table-id");
  var league_table_data_name = league_table_data.text();

  // Trigger default filtering on page load
  filterleaguetable(league_table_data_id, league_table_data_name);

  // Handle team filter click
  $(".filter-options-item a").on("click", function (e) {
    e.preventDefault();

    var league_table_data_id = $(this).data("league_table-id");
    var league_table_data_name = $(this).text();

    // Set the clicked team as active
    $(".filter-options-item").removeClass("is-active");
    $(this).parent().addClass("is-active");

    // Filter fixtures for the selected team
    filterleaguetable(league_table_data_id, league_table_data_name);

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

// JavaScript function to handle team selection and update the displayed team
function change_league_table(element) {
  var selectedTeam = element.innerText;
  document.getElementById("selected-league-table").innerText = selectedTeam;
  document.getElementById("selecte-league-table").innerText = selectedTeam;
  document.getElementById("selected-league-table-name").innerText =
    selectedTeam;

  // Perform your AJAX call or other actions to update fixtures based on selected team
}

// JavaScript function to handle team selection and update the displayed team
function changeTeam(element) {
  var selectedTeam = element.innerText;
  document.getElementById("selected-team").innerText = selectedTeam;
  document.getElementById("selected-team-big-name").innerText = selectedTeam;

  // Perform your AJAX call or other actions to update fixtures based on selected team
}
