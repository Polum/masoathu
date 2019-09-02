<?php

namespace App\Traits;
use App\ObserverResponse;


trait MorningIncidentTrait {

    public function morningIncidents()
    {
        $data['incoming_messages'] = $this->reports('incoming_messages');
        $data['reports_generated'] = $this->reports('reports_generated');
        $data['incidence_alert'] = $this->reports('incidence_alert');
        $data['critical_incidences'] = $this->reports('critical_incidences');
        
        $data['quarrelling'] = $this->countReport(59);
        $data['fighting'] = $this->countReport(60);
        $data['none_regulatory'] = $this->countReport(61);
        $data['safety'] = $this->countReport(62);
        
        $data['fainted'] = $this->countReport(63);
        $data['died'] = $this->countReport(64);
        $data['injured'] = $this->countReport(65);
        $data['medical_emergencies'] = $this->countReport(66);
        
        $data['ballot_paper_stuffing_occured'] = $this->template(67);
        $data['pp_barred_from_campaigning'] = $this->template(68);
        $data['harassment_intimidation'] = $this->template(69);
        $data['equipment_malfunction_resource_shortage'] = $this->template(70);
        $data['non-eligible_foreigner_voters'] = $this->template(72);
        $data['persons_voting_twice'] = $this->template(73);
        $data['people_ferried_to_vote_elsewhere'] = $this->template(74);
        $data['buying_snatching_voter_certificates'] = $this->template(75);
        $data['property_distruction_pp_supporters'] = $this->template(76);
        $data['acts_of_violence'] = $this->template(77);
        $data['campaign_barred_favouring_another'] = $this->template(78);
        $data['no_go_zones_set'] = $this->template(79);
        $data['candidate_denied_chance_to_campaign'] = $this->template(80);
        $data['defacings_removing_campaign_materials'] = $this->template(81);
        $data['pp_given_equal_opportunity_to_campaign'] = $this->template(82);


        return $data;
    }
    
}