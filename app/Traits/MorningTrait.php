<?php

namespace App\Traits;
use App\ObserverResponse;


trait MorningTrait {

    public function morningTemplate()
    {
        $data['incoming_messages'] = $this->reports('incoming_messages');
        $data['reports_generated'] = $this->reports('reports_generated');
        $data['incidence_alert'] = $this->reports('incidence_alert');
        $data['critical_incidences'] = $this->reports('critical_incidences');
        
        $data['open_time'] = $this->ontime();
        $data['long_queue'] = $this->template(2);
        $data['total_ECO'] = $this->maleFemale(3, 4);
        $data['security_personnel_present'] = $this->maleFemale(5, 6);

        $data['party_representatives'] = $this->valueLooper(range(7, 15));
        $data['maintained_order'] = $this->template(16);
        $data['convinient_polling_location'] = $this->template(17);
        $data['sealed_ballot_paper_packages'] = $this->template(18);
        $data['media_airing_voting_information'] = $this->template(19);
        $data['voting_resources'] = $this->valueLooper(range(20, 25));
        
        $data['show_voter_registration_certificate'] = $this->template(26);
        $data['unregistered_voters_not_allowed'] = $this->template(27);
        $data['other_station_voters_allowed'] = $this->template(28);
        $data['ticked_voter_after_identification'] = $this->template(29);
        $data['registration_certificate_embossed'] = $this->template(30);

        $data['voter_procedure_explained'] = $this->template(31);
        $data['voters_given_privacy'] = $this->template(32);
        $data['campaining_around_polling_stations'] = $this->template(33);
        $data['soliciting_to_buy_votes'] = $this->template(34);
        
        $data['people_at_polling_station'] = $this->valueLooper([35, 36, 37]);
        $data['cs_informing_about_voting'] = $this->template(38);
        $data['heard_local_media_airing_results'] = $this->template(39);
        $data['pp_conduct_voter_mobilization_campaign'] = $this->template(40);
        
        $data['witnessed_challenges_faced_by_women'] = $this->template(41);
        $data['disabled_and_elderly_assisted'] = $this->template(42);
        $data['persons_lodged_compalaint'] = $this->template(43);

        $data['voters_not_given_three_different_ballot_papers'] = $this->template(44);
        $data['voters_given_ballot_papers_after_mistake'] = $this->template(45);
        $data['voters_kept_spoiled_ballot_papers'] = $this->template(46);

        $data['voters_fingers_wiped_before'] = $this->template(47);
        $data['voters_fingers_inked_after'] = $this->template(48);

        $data['voting_que_moving_along'] = $this->template(49);
        $data['station_spacious_adequate'] = $this->template(50);
        $data['station_shaded_protected'] = $this->template(51);

        $data['disabled_given_priority'] = $this->template(52);
        $data['pregnant_women_priotized'] = $this->template(53);
        $data['elderly_given_priority'] = $this->template(54);
        
        $data['cw_observer_perform_duties'] = $this->template(55);
        $data['nice_observer_perform_duties'] = $this->template(56);
        $data['un_observer_perform_duties'] = $this->template(57);
        $data['all_party_observer_perform_duties'] = $this->template(58);

        $data['incidences'] = $this->valueLooper(array_merge(range(59, 62), range(67, 80)));
        $data['critical_incidents'] = $this->valueLooper(range(63, 66));

        return $data;
    }
    
}