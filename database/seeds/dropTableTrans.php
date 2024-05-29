<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DropTableTrans extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('TRUNCATE TABLE trans_wp_scafolding_permit_item CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_scafolding_permit_inspected CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_scafolding_permit CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_type CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_hot_item CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_hot CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_hazard_item CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_hazard_condition CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_hazard CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_general_item CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_general CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_excavation CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_electrical CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_confined_item CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_confined_entry CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_confined_condition CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_confined CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_atmospheric_testing CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request_atmospheric CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_request CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_jsa_who CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_jsa_file CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_jsa_checklist CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_jsa_attendece CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp_jsa CASCADE');
        DB::statement('TRUNCATE TABLE trans_wp CASCADE');
        DB::statement('TRUNCATE TABLE trans_tbm_file CASCADE');
        DB::statement('TRUNCATE TABLE trans_tbm CASCADE');
        DB::statement('TRUNCATE TABLE trans_reg_accident_st_action CASCADE');
        DB::statement('TRUNCATE TABLE trans_reg_accident_party CASCADE');
        DB::statement('TRUNCATE TABLE trans_reg_accident_mechanism CASCADE');
        DB::statement('TRUNCATE TABLE trans_reg_accident_lt_action CASCADE');
        DB::statement('TRUNCATE TABLE trans_reg_accident_causes_detail CASCADE');
        DB::statement('TRUNCATE TABLE trans_reg_accident_causes CASCADE');
        DB::statement('TRUNCATE TABLE trans_reg_accident_agent CASCADE');
        DB::statement('TRUNCATE TABLE trans_reg_accident CASCADE');
        DB::statement('TRUNCATE TABLE trans_regulations CASCADE');
        DB::statement('TRUNCATE TABLE trans_quiz_answer CASCADE');
        DB::statement('TRUNCATE TABLE trans_quiz CASCADE');
        DB::statement('TRUNCATE TABLE trans_policy_site CASCADE');
        DB::statement('TRUNCATE TABLE trans_policy_reviews CASCADE');
        DB::statement('TRUNCATE TABLE trans_policy_lampiran CASCADE');
        DB::statement('TRUNCATE TABLE trans_policy CASCADE');
        DB::statement('TRUNCATE TABLE trans_offline_training CASCADE');
        DB::statement('TRUNCATE TABLE trans_man_power_detail CASCADE');
        DB::statement('TRUNCATE TABLE trans_man_power CASCADE');
        DB::statement('TRUNCATE TABLE trans_kpi_revisions CASCADE');
        DB::statement('TRUNCATE TABLE trans_kpi_leading CASCADE');
        DB::statement('TRUNCATE TABLE trans_kpi_lagging CASCADE');
        DB::statement('TRUNCATE TABLE trans_kpi CASCADE');
        DB::statement('TRUNCATE TABLE trans_inspection_visit_pic CASCADE');
        DB::statement('TRUNCATE TABLE trans_inspection_visit_file CASCADE');
        DB::statement('TRUNCATE TABLE trans_inspection_visit_detail CASCADE');
        DB::statement('TRUNCATE TABLE trans_inspection_visit CASCADE');
        DB::statement('TRUNCATE TABLE trans_industrial_inspection CASCADE');
        DB::statement('TRUNCATE TABLE trans_industrial_hazardous CASCADE');
        DB::statement('TRUNCATE TABLE trans_induction_record CASCADE');
        DB::statement('TRUNCATE TABLE trans_induction_participant CASCADE');
        DB::statement('TRUNCATE TABLE trans_induction_files CASCADE');
        DB::statement('TRUNCATE TABLE trans_induction_failed CASCADE');
        DB::statement('TRUNCATE TABLE trans_induction_answer CASCADE');
        DB::statement('TRUNCATE TABLE trans_hse_plan_revision CASCADE');
        DB::statement('TRUNCATE TABLE trans_hse_plan_file CASCADE');
        DB::statement('TRUNCATE TABLE trans_hse_plan CASCADE');
        DB::statement('TRUNCATE TABLE trans_hnmr_reporting_solvedpic CASCADE');
        DB::statement('TRUNCATE TABLE trans_hnmr_reporting_evidences CASCADE');
        DB::statement('TRUNCATE TABLE trans_hnmr_reporting CASCADE');
        DB::statement('TRUNCATE TABLE trans_hnmr_monitoring CASCADE');
        DB::statement('TRUNCATE TABLE trans_hnmr_action CASCADE');
        DB::statement('TRUNCATE TABLE trans_hira_steps CASCADE');
        DB::statement('TRUNCATE TABLE trans_hira CASCADE');
        DB::statement('TRUNCATE TABLE trans_equipment_file CASCADE');
        DB::statement('TRUNCATE TABLE trans_equipment CASCADE');
        DB::statement('TRUNCATE TABLE trans_emergency_drill_problems CASCADE');
        DB::statement('TRUNCATE TABLE trans_emergency_drill_participants CASCADE');
        DB::statement('TRUNCATE TABLE trans_emergency_drill_mitigation CASCADE');
        DB::statement('TRUNCATE TABLE trans_emergency_drill CASCADE');
        DB::statement('TRUNCATE TABLE trans_documents CASCADE');
        DB::statement('TRUNCATE TABLE trans_bulletin_site CASCADE');
        DB::statement('TRUNCATE TABLE trans_bulletin_reviews CASCADE');
        DB::statement('TRUNCATE TABLE trans_bulletin_lampiran CASCADE');
        DB::statement('TRUNCATE TABLE trans_bulletin CASCADE');
        DB::statement('TRUNCATE TABLE trans_bbs_detail CASCADE');
        DB::statement('TRUNCATE TABLE trans_bbs CASCADE');
        DB::statement('TRUNCATE TABLE trans_audit_file CASCADE');
        DB::statement('TRUNCATE TABLE trans_audit_all_user CASCADE');
        DB::statement('TRUNCATE TABLE trans_audit CASCADE');
        DB::statement('TRUNCATE TABLE trans_accident_incident_type CASCADE');
        DB::statement('TRUNCATE TABLE trans_accident_incident_file CASCADE');
        DB::statement('TRUNCATE TABLE trans_accident_incident_approver CASCADE');
        DB::statement('TRUNCATE TABLE trans_accident_incident_action_plan CASCADE');
        DB::statement('TRUNCATE TABLE trans_accident_incident CASCADE');
        DB::statement('TRUNCATE TABLE jobs_notification CASCADE');
        DB::statement('TRUNCATE TABLE jobs_deadline CASCADE');
        DB::statement('TRUNCATE TABLE jobs CASCADE');
        Model::reguard();
    }
}
