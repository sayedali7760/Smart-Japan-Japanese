<?php
class Report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_requisition($institution, $position)
    {
        $query = $this->db->select('r.*,p.name,i.name as inst_name,u.name as user_name')
            ->from('requisitions as r')
            ->where('r.is_active', 1)
            ->where('r.inst_id', $institution)
            ->where('r.req_for', $position)
            ->join('positions p', 'p.position_id= r.req_for', 'left')
            ->join('institution i', 'i.institution_id= r.inst_id', 'left')
            ->join('user_details u', 'r.created_user= u.id', 'left')
            ->get()
            ->result();
        return $query;
    }
    public function get_resume_details($position)
    {
        $query = $this->db->select('r.*,p.name')
            ->from('resumes as r')
            ->where('r.verify_status', 1)
            ->where('r.post_applied_for', $position)
            ->join('positions p', 'p.position_id= r.post_applied_for', 'left')
            ->get()
            ->result();
        return $query;
    }
    public function get_interview_scheduled_details($institution, $position)
    {
        // $inst_id = $this->session->userdata('inst_ids');
        // $inst_ids = $str_arr = explode(",", $inst_id);

        $query = $this->db->select('R.*,P.*,S.inst_id,I.date as interview_date,S.position_id,I.time as interview_time,I.interview_level,I.location,I.contact_person,I.interview_with,I.interview_for,I.contact,I.work_location,I.mode,I.landmark,IS.name as institution_name,P.name as position,OFS.status_id as offer_letter_status')
            ->from('resumes as R')
            ->where('R.verify_status', 1)
            ->where('M.status', 3)
            ->where('R.selected_institution', $institution)
            ->where('R.post_applied_for', $position)
            ->join('requisitions as S', '(S.req_for = R.post_applied_for AND S.inst_id = R.selected_institution)', 'left')
            ->join('requisition_resume_mapping as M', 'M.resume_id = R.resume_id', 'left')
            ->join('positions as P', 'P.position_id = R.post_applied_for', 'left')
            ->join('interview_schedule as I', 'R.resume_id = I.resume_id and I.interview_level_status=1', 'left')
            ->join('institution as IS', 'R.selected_institution = IS.institution_id', 'left')
            ->join('offerletter_status as OFS', 'R.resume_id = OFS.resume_id', 'left')
            ->group_by('R.resume_id')
            ->get()
            ->result();
        return $query;
    }
    public function get_md_approve_details($institution, $status)
    {


        $query = $this->db->select('R.*,P.*,MA.approved_rejected_status,IS.name as institution_name,S.position_id')
            ->from('resumes as R')
            ->where('MA.approved_rejected_status', $status)
            ->where('R.selected_institution', $institution)
            ->join('requisitions as S', 'S.req_for = R.post_applied_for', 'left')
            ->join('positions as P', 'P.position_id = R.post_applied_for', 'left')
            ->join('institution as IS', 'R.selected_institution = IS.institution_id', 'left')
            ->join('management_approval as MA', 'R.resume_id = MA.resume_id', 'inner')
            ->group_by('R.resume_id')
            ->order_by('R.firstname', 'ASC')
            ->get()
            ->result();
        return $query;
    }
}
