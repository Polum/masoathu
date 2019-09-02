<?php

namespace App\Traits;
use App\ObserverResponse;


trait AfternoonIncidentTrait {

    public function afternoonIncidents()
    {
        $data['incoming_messages'] = $this->reports('incoming_messages');
        $data['reports_generated'] = $this->reports('reports_generated');
        $data['incidence_alert'] = $this->reports('incidence_alert');
        $data['critical_incidences'] = $this->reports('critical_incidences');
        
        $data['quarrelling'] = $this->countReport(143);
        $data['fighting'] = $this->countReport(144);
        $data['none_regulatory'] = $this->countReport(145);
        $data['safety'] = $this->countReport(146);
        
        $data['fainted'] = $this->countReport(147);
        $data['died'] = $this->countReport(148);
        $data['injured'] = $this->countReport(149);
        $data['medical_emergencies'] = $this->countReport(150);
        
        $data['ballot_paper_stuffing_occured'] = $this->template(151);
        $data['pp_barred_from_campaigning'] = $this->template(152);
        $data['harassment_intimidation'] = $this->template(153);
        $data['equipment_malfunction_resource_shortage'] = $this->template(154);
        $data['non-eligible_foreigner_voters'] = $this->template(156);
        $data['persons_voting_twice'] = $this->template(157);
        $data['people_ferried_to_vote_elsewhere'] = $this->template(158);
        $data['buying_snatching_voter_certificates'] = $this->template(160);
        $data['property_distruction_pp_supporters'] = $this->template(161);
        $data['acts_of_violence'] = $this->template(162);
        $data['campaign_barred_favouring_another'] = $this->template(163);
        $data['no_go_zones_set'] = $this->template(164);
        $data['candidate_denied_chance_to_campaign'] = $this->template(165);
        $data['defacings_removing_campaign_materials'] = $this->template(166);
        $data['pp_given_equal_opportunity_to_campaign'] = $this->template(167);


        return $data;
    }
    
}