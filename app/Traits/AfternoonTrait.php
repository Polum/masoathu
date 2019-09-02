<?php

namespace App\Traits;


trait AfternoonTrait {

    public function afternoonTemplate()
    {
        $data['incoming_messages'] = $this->reports('incoming_messages');
        $data['reports_generated'] = $this->reports('reports_generated');
        $data['incidence_alert'] = $this->reports('incidence_alert');
        $data['critical_incidences'] = $this->reports('critical_incidences');
        
        $data['still_open'] = $this->template(85);
        $data['voting_queues_present'] = $this->template(86);
        $data['total_ECO'] = $this->maleFemale(87, 88);
        $data['security_personnel_present'] = $this->maleFemale(89, 90);
        
        $data['party_representatives'] = $this->valueLooper(range(87, 99));
        $data['maintained_order'] = $this->template(100);
        $data['convinient_polling_location'] = $this->template(101);
        $data['sealed_ballot_paper_packages'] = $this->template(102);
        $data['media_airing_voting_information'] = $this->template(103);
        $data['voting_resources'] = $this->valueLooper(range(104, 109));
        
        $data['show_voter_registration_certificate'] = $this->template(110);
        $data['unregistered_voters_not_allowed'] = $this->template(111);
        $data['other_station_voters_allowed'] = $this->template(112);
        $data['ticked_voter_after_identification'] = $this->template(113);
        $data['registration_certificate_embossed'] = $this->template(114);
        
        $data['ballot_boxes_guarded'] = $this->template(81);
        
        $data['voter_procedure_explained'] = $this->template(115);
        $data['voters_given_privacy'] = $this->template(116);
        $data['campaining_around_polling_stations'] = $this->template(117);
        $data['soliciting_to_buy_votes'] = $this->template(118);
        
        $data['people_at_polling_station'] = $this->valueLooper([119, 120, 121]);
        $data['cs_informing_about_voting'] = $this->template(122);
        $data['heard_local_media_airing_results'] = $this->template(123);
        $data['pp_conduct_voter_mobilization_campaign'] = $this->template(124);
        
        $data['witnessed_challenges_faced_by_women'] = $this->template(125);
        $data['disabled_and_elderly_assisted'] = $this->template(126);
        $data['persons_lodged_compalaint'] = $this->template(127);

        $data['voters_not_given_three_different_ballot_papers'] = $this->template(128);
        $data['voters_given_ballot_papers_after_mistake'] = $this->template(129);
        $data['voters_kept_spoiled_ballot_papers'] = $this->template(130);

        $data['voters_fingers_wiped_before'] = $this->template(131);
        $data['voters_fingers_inked_after'] = $this->template(132);

        $data['voting_que_moving_along'] = $this->template(133);
        $data['station_spacious_adequate'] = $this->template(134);
        $data['station_shaded_protected'] = $this->template(135);

        $data['disabled_given_priority'] = $this->template(136);
        $data['pregnant_women_priotized'] = $this->template(137);
        $data['elderly_given_priority'] = $this->template(138);
        
        $data['cw_observer_perform_duties'] = $this->template(139);
        $data['nice_observer_perform_duties'] = $this->template(140);
        $data['un_observer_perform_duties'] = $this->template(141);
        $data['all_party_observer_perform_duties'] = $this->template(142);

        $data['observers_able_to_observe'] = $this->template(169);
        $data['party_representatives_able_to_observe'] = $this->template(170);
        $data['ballot_paper_stuffing_occured'] = $this->template(179);

        return $data;
    }
}