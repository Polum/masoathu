<?php

namespace App\Traits;


trait EveningTrait {

    public function eveningTemplate()
    {
        $data['incoming_messages'] = $this->reports('incoming_messages');
        $data['reports_generated'] = $this->reports('reports_generated');
        $data['incidence_alert'] = $this->reports('incidence_alert');
        $data['critical_incidences'] = $this->reports('critical_incidences');
        
        $data['still_open'] = $this->template(169);
        $data['voting_queues_present'] = $this->template(170);
        $data['total_ECO'] = $this->maleFemale(171, 172);
        $data['security_personnel_present'] = $this->maleFemale(173, 174);
        
        $data['party_representatives'] = $this->valueLooper(range(175, 183));
        $data['maintained_order'] = $this->template(184);
        $data['convinient_polling_location'] = $this->template(185);
        $data['sealed_ballot_paper_packages'] = $this->template(186);
        $data['media_airing_voting_information'] = $this->template(187);
        $data['voting_resources'] = $this->valueLooper(range(188, 193));
        
        $data['show_voter_registration_certificate'] = $this->template(194);
        $data['unregistered_voters_not_allowed'] = $this->template(195);
        $data['other_station_voters_allowed'] = $this->template(196);
        $data['ticked_voter_after_identification'] = $this->template(197);
        $data['registration_certificate_embossed'] = $this->template(198);
        
        $data['ballot_boxes_guarded'] = $this->template(141);
        
        $data['voter_procedure_explained'] = $this->template(199);
        $data['voters_given_privacy'] = $this->template(200);
        $data['campaining_around_polling_stations'] = $this->template(201);
        $data['soliciting_to_buy_votes'] = $this->template(202);
        
        $data['people_at_polling_station'] = $this->valueLooper([203, 204, 205]);
        $data['cs_informing_about_voting'] = $this->template(206);
        $data['heard_local_media_airing_results'] = $this->template(207);
        $data['pp_conduct_voter_mobilization_campaign'] = $this->template(208);
        
        $data['witnessed_challenges_faced_by_women'] = $this->template(209);
        $data['disabled_and_elderly_assisted'] = $this->template(210);
        $data['persons_lodged_compalaint'] = $this->template(211);
        
        $data['voters_not_given_three_different_ballot_papers'] = $this->template(212);
        $data['voters_given_ballot_papers_after_mistake'] = $this->template(213);
        $data['voters_kept_spoiled_ballot_papers'] = $this->template(214);
        
        $data['voters_fingers_wiped_before'] = $this->template(215);
        $data['voters_fingers_inked_after'] = $this->template(216);

        $data['observers_able_to_observe'] = $this->template(169);
        $data['party_representatives_able_to_observe'] = $this->template(170);
        $data['ballot_paper_stuffing_occured'] = $this->template(179);
        $data['ballot_paper_counted_at_station'] = $this->template(181);
        $data['adequate_lighting'] = $this->template(182);
        $data['ballot_boxes_transported_offsite'] = $this->template(183);



        $data['disabled_given_priority'] = $this->template(45);
        $data['pregnant_women_priotized'] = $this->template(46);
        $data['elderly_given_priority'] = $this->template(47);

        return $data;
    }
}