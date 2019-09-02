$(function () {
    getGenderChart();
    $('.incoming_messages').html(dashboardData.incoming_messages);
    $('.reports_generated').html(dashboardData.reports_generated);
    $('.incidence_alert').html(dashboardData.incidence_alert);
    $('.critical_incidences').html(dashboardData.critical_incidences);
});


function getGenderChart() {
    var on_time_overall = echarts.init(document.getElementById('polling_station_opened_on_time'));
    var long_queues_overall = echarts.init(document.getElementById('long_queues'));
    var electral_commission_officials_overall = echarts.init(document.getElementById('electral_commision_officials_present'));
    var security_personel_present_overall = echarts.init(document.getElementById('security_personel_present'));
    
    var order_maintained_overall = echarts.init(document.getElementById('order_maintained_overall'));
    var male_female_bar_chart_overall = echarts.init(document.getElementById('male_female_bar_chart_overall')); 
    var Q50_bar_overall = echarts.init(document.getElementById('Q50_bar_overall'));
    var Q47_chart_overall = echarts.init(document.getElementById('Q47_chart_overall'));
    var Q47_bar_overall = echarts.init(document.getElementById('Q47_bar_overall'));
    
    
    var voting_resources_overall = echarts.init(document.getElementById('voting_resources_overall'));
    var sealed_ballot_papers_overall = echarts.init(document.getElementById('sealed_ballot_papers_overall'));
    var show_voter_registration_certificate_overall = echarts.init(document.getElementById('show_voter_registration_certificate_overall'));
    var ticked_voter_after_identification_overall = echarts.init(document.getElementById('ticked_voter_after_identification'));
    var other_station_voters_allowed_overall = echarts.init(document.getElementById('other_station_voters_allowed'));
    var registration_certificate_embossed_overall = echarts.init(document.getElementById('registration_certificate_embossed'));
    var voter_procedure_explained_overall = echarts.init(document.getElementById('voter_procedure_explained'));
    var voters_given_privacy_overall = echarts.init(document.getElementById('voters_given_privacy'));
    var voters_not_given_three_different_ballot_papers_overall = echarts.init(document.getElementById('voters_not_given_three_different_ballot_papers'));
    var voters_given_ballot_papers_after_mistake_overall = echarts.init(document.getElementById('voters_given_ballot_papers_after_mistake'));
    var voters_kept_spoiled_ballot_papers_overall = echarts.init(document.getElementById('voters_kept_spoiled_ballot_papers'));
    var voters_fingers_wiped_before_overall = echarts.init(document.getElementById('voters_fingers_wiped_before'));
    var voters_fingers_inked_after_overall = echarts.init(document.getElementById('voters_fingers_inked_after'));
    var observers_overall = echarts.init(document.getElementById('observers'));
    var voting_que_moving_along_overall = echarts.init(document.getElementById('voting_que_moving_along'));
    var station_spacious_adequate_overall = echarts.init(document.getElementById('station_spacious_adequate'));
    var station_shaded_protected_overall = echarts.init(document.getElementById('station_shaded_protected'));
    var disabled_given_priority_overall = echarts.init(document.getElementById('disabled_given_priority'));
    var pregnant_women_priotized_overall = echarts.init(document.getElementById('pregnant_women_priotized'));
    var elderly_given_priority_overall = echarts.init(document.getElementById('elderly_given_priority'));
    var incidents_occured_overall = echarts.init(document.getElementById('incidents_occured'));
    var injuries_occured_overall = echarts.init(document.getElementById('injuries_occured'));

// CHART DATA OPTIONS

    on_time_pie_options = pieTemplate(["Yes", "No"], "Opened on time", dashboardData.open_time);
    long_queues_pie_options = pieTemplate(["Yes", "No"], "Long Queues", dashboardData.long_queue);
    ECO_pie_options = pieTemplate(["Male", "Female"], "Electoral Commission Officials", dashboardData.total_ECO);
    security_personel_present_options = pieTemplate(["Female", "Male"], "Security personnel present", {"female": dashboardData.party_representatives[0], "male": dashboardData.party_representatives[1]});
    
    Q50_bar_overall_options = barTemplate({Independence:pr[0], DPP:pr[1], MCP:pr[2], MMD:pr[3], PP:pr[4], TPM:pr[5], UDF:pr[6], UP:pr[7], UTM:pr[8]});
    order_maintained_options = pieTemplate(["Yes", "No"], "Order maintained", dashboardData.maintained_order);
    safe_convinient_location_options = pieTemplate(["Yes", "No"], "Safe and convinient location", dashboardData.convinient_polling_location);
    sealed_ballot_papers_options = pieTemplate(["Yes", "No"], "Sealed ballot papers", dashboardData.sealed_ballot_paper_packages);
    media_airing_voting_information_options = pieTemplate(["Yes", "No"], "Local media airing voting information", dashboardData.media_airing_voting_information);
    voting_resources_options = barTemplate({"ballot papers":vr[0], "ballot boxes":vr[1], "Embossig devices":vr[2], "Ink bottles":vr[3], pens:vr[4], "Voter list": vr[5]});
    
    show_voter_registration_certificate_options = pieTemplate(["Yes", "No"], "Voters asked to show registration certificate", dashboardData.show_voter_registration_certificate);
    unregistered_voters_not_allowed_options = pieTemplate(["Yes", "No"], "Voters without registration certificate not allowed to vote", dashboardData.unregistered_voters_not_allowed);
    other_station_voters_allowed_options = pieTemplate(["Yes", "No"], "Other station voters allowed", dashboardData.other_station_voters_allowed);
    ticked_voter_after_identification_options = pieTemplate(["Yes", "No"], "Voter names ticked off", dashboardData.ticked_voter_after_identification);
    registration_certificate_embossed_options = pieTemplate(["Yes", "No"], "Registration certificates embossed", dashboardData.registration_certificate_embossed);
    
    voter_procedure_explained_options = pieTemplate(["Yes", "No"], "Voter procedure explained", dashboardData.voter_procedure_explained);
    voters_given_privacy_options = pieTemplate(["Yes", "No"], "Voters were given privacy", dashboardData.voters_given_privacy);
    campaign_at_polling_station_options = pieTemplate(["Yes", "No"], "Campaign at polling station", dashboardData.campaining_around_polling_stations);
    soliciting_to_buy_votes_options = pieTemplate(["Yes", "No"], "Soliciting at polling station", dashboardData.soliciting_to_buy_votes);
    
    people_at_polling_station_options = barTemplate({"People at pollistation": dashboardData.people_at_polling_station[0], "Sent back": dashboardData.people_at_polling_station[1], "Attempt to vote twice": dashboardData.people_at_polling_station[2]});
    cs_informing_about_voting_options = pieTemplate(["Yes", "No"], "Civil Society organization informing people about voting in wards", dashboardData.cs_informing_about_voting);
    heard_local_media_airing_results_options = pieTemplate(["Yes", "No"], "Local media airing voting information outside their news coverage", dashboardData.heard_local_media_airing_results);
    pp_conduct_voter_mobilization_campaign_options = pieTemplate(["Yes", "No"], "political party conduct voter mobilisation campaign in your area", dashboardData.pp_conduct_voter_mobilization_campaign);
    
    witnessed_challenges_faced_by_women_options = pieTemplate(["Yes", "No"], "Challenges faced by woment intending to vote", dashboardData.witnessed_challenges_faced_by_women);
    disabled_and_elderly_assisted_options = pieTemplate(["Yes", "No"], "Disabled and elderly were assisted during voting at centres", dashboardData.disabled_and_elderly_assisted);
    persons_lodged_compalaint_options = pieTemplate(["Yes", "No"], "People lodged complaints at polling stations", dashboardData.persons_lodged_compalaint);
    
    voters_not_given_three_different_ballot_papers_options = pieTemplate(["Yes", "No"], "Voters given 3 different ballot papers", dashboardData.voters_not_given_three_different_ballot_papers);
    voters_given_ballot_papers_after_mistake_options = pieTemplate(["Yes", "No"], "Some voter were given new ballot papers", dashboardData.voters_given_ballot_papers_after_mistake);
    voters_kept_spoiled_ballot_papers_options = pieTemplate(["Yes", "No"], "Some voters kept spoiled ballot papers", dashboardData.voters_kept_spoiled_ballot_papers);
    
    voters_fingers_wiped_before_options = pieTemplate(["Yes", "No"], "Voter fingers were wiped", dashboardData.voters_fingers_wiped_before);
    voters_fingers_inked_after_options = pieTemplate(["Yes", "No"], "Voter fingers were inked", dashboardData.voters_fingers_inked_after);
    
    voting_que_moving_along_options = pieTemplate(["Yes", "No"], "Voting queue was moving along", dashboardData.voting_que_moving_along);
    station_spacious_adequate_options = pieTemplate(["Yes", "No"], "Polling station was spacious", dashboardData.station_spacious_adequate);
    station_shaded_protected_options = pieTemplate(["Yes", "No"], "Polling station was shaded", dashboardData.station_shaded_protected);
    
    disabled_given_priority_options = pieTemplate(["Yes", "No"], "Disabled were given priority", dashboardData.disabled_given_priority);
    pregnant_women_priotized_options = pieTemplate(["Yes", "No"], "Pregnant women were given priority", dashboardData.pregnant_women_priotized);
    elderly_given_priority_options = pieTemplate(["Yes", "No"], "Elderly were given priority", dashboardData.elderly_given_priority);
    
    cw_observer_perform_duties_options = pieTemplate(["Yes", "No"], "Common Wealth observers were able to perfom their duties", dashboardData.cw_observer_perform_duties);
    nice_observer_perform_duties_options = pieTemplate(["Yes", "No"], "NICE observers were able to perfom their duties", dashboardData.nice_observer_perform_duties);
    un_observer_perform_duties_options = pieTemplate(["Yes", "No"], "UN observers were able to perfom their duties", dashboardData.un_observer_perform_duties);
    all_party_observer_perform_duties_options = pieTemplate(["Yes", "No"], "All party observers were able to perfom their duties", dashboardData.all_party_observer_perform_duties);
    
    observers_options = barTemplate({"Commonwealth": 3000, "NICE": 5000, "UN Observer": 3200});

    incidents_occured_options = barTemplate({"Quarelling": incidences[0], "Fighting": incidences[1], "non-regulatory": incidences[2], "Safety": incidences[3],
    "medical emergencies": incidences[4], "ballot paper stuffing": incidences[5], "party intimidation/harrassment": incidences[7],
    "Equipment malfunction": incidences[8], "medical emergencies": incidences[4]});
    
    
    injuries_occured_options = barTemplate({"Fainted/Collapsed": dashboardData.critical_incidents[0], "died": dashboardData.critical_incidents[1], "injured": dashboardData.critical_incidents[2]});

    order_maintained_overall.setOption(order_maintained_options);
    Q50_bar_overall.setOption(Q50_bar_overall_options);
    male_female_bar_chart_overall.setOption(safe_convinient_location_options);
    Q47_bar_overall.setOption(campaign_at_polling_station_options);
    Q47_chart_overall.setOption(soliciting_to_buy_votes_options);
    on_time_overall.setOption(on_time_pie_options);
    electral_commission_officials_overall.setOption(ECO_pie_options);
    security_personel_present_overall.setOption(security_personel_present_options);
    long_queues_overall.setOption(long_queues_pie_options);
    voting_resources_overall.setOption(voting_resources_options);
    sealed_ballot_papers_overall.setOption(sealed_ballot_papers_options);
    show_voter_registration_certificate_overall.setOption(show_voter_registration_certificate_options);
    ticked_voter_after_identification_overall.setOption(ticked_voter_after_identification_options);
    other_station_voters_allowed_overall.setOption(other_station_voters_allowed_options);
    registration_certificate_embossed_overall.setOption(registration_certificate_embossed_options);
    voter_procedure_explained_overall.setOption(voter_procedure_explained_options);
    voters_given_privacy_overall.setOption(voters_given_privacy_options);
    voters_not_given_three_different_ballot_papers_overall.setOption(voters_not_given_three_different_ballot_papers_options);
    voters_given_ballot_papers_after_mistake_overall.setOption(voters_given_ballot_papers_after_mistake_options);
    voters_kept_spoiled_ballot_papers_overall.setOption(voters_kept_spoiled_ballot_papers_options);
    voters_fingers_wiped_before_overall.setOption(voters_fingers_wiped_before_options);
    voters_fingers_inked_after_overall.setOption(voters_fingers_inked_after_options);
    observers_overall.setOption(observers_options);
    voting_que_moving_along_overall.setOption(voting_que_moving_along_options);
    station_spacious_adequate_overall.setOption(station_spacious_adequate_options);
    station_shaded_protected_overall.setOption(station_shaded_protected_options);
    disabled_given_priority_overall.setOption(disabled_given_priority_options);
    pregnant_women_priotized_overall.setOption(pregnant_women_priotized_options);
    elderly_given_priority_overall.setOption(elderly_given_priority_options);
    incidents_occured_overall.setOption(incidents_occured_options);
    injuries_occured_overall.setOption(injuries_occured_options);

}