<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_in extends Root_Controller
{
    private $message;
    public $permissions;
    public $controller_url;
    public function __construct()
    {
        parent::__construct();
        $this->permissions=User_helper::get_permission('Stock_in');
        $this->controller_url='stock_in';
    }
    public function index($action='list',$id=0)
    {
        if($action=='list')
        {
            $this->system_list();
        }
        elseif($action=='get_items')
        {
            $this->system_get_items();
        }
        elseif($action=='add')
        {
            $this->system_add();
        }
        elseif($action=='edit')
        {
            $this->system_edit($id);
        }
        elseif($action=='save')
        {
            $this->system_save();
        }
        else
        {
            $this->system_list();
        }
    }
    private function system_list()
    {
        if(isset($this->permissions['action0']) && ($this->permissions['action0']==1))
        {
            $data['title']='Stock List';
            $ajax['status']=true;
            $ajax['system_content'][]=array('id'=>'#system_content','html'=>$this->load->view($this->controller_url.'/list',$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=site_url($this->controller_url);
            $this->json_return($ajax);
        }
        else
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line('YOU_DONT_HAVE_ACCESS');
            $this->json_return($ajax);
        }
    }

    private function system_get_items()
    {
        $items=array();
        $bulk=$this->config->item('table_sms_bulk');
        $packet=$this->config->item('table_sms_packet');
        $warehouse=$this->config->item('table_login_basic_setup_warehouse');
        $packsize=$this->config->item('table_login_setup_classification_vpack_size');
        $varieties=$this->config->item('table_login_setup_classification_varieties');
        $crop_types=$this->config->item('table_login_setup_classification_crop_types');
        $crops=$this->config->item('table_login_setup_classification_crops');

        //To increase performance
        $query="SELECT t.*, w.name as warehouse_name, ps.name as packsize_name, v.name as variety_name, ct.name as crop_type_name, cr.name as crop_name
		From (SELECT CONCAT(b.id,'_Bulk') as id,'Bulk' as type,b.variety_id,'NULL' as packsize_id,b.warehouse_id,b.quantity,b.purpose,b.status
		FROM $bulk as b
		WHERE b.purpose = 'stock_in'
		UNION ALL
		SELECT CONCAT(p.id,'_Pack') as id,'Packet' as type, p.variety_id,p.packsize_id,p.warehouse_id,p.quantity,p.purpose,p.status
		FROM $packet as p
		WHERE p.purpose = 'stock_in') t
		LEFT JOIN $warehouse as w on w.id = t.warehouse_id
		LEFT JOIN $packsize as ps on ps.id = t.packsize_id
		LEFT JOIN $varieties as v on v.id = t.variety_id
		LEFT JOIN $crop_types as ct on ct.id = v.crop_type_id
		LEFT JOIN $crops as cr on cr.id = ct.crop_id";
        $query=$this->db->query($query);
        $items=$query->result_array();
        foreach($items as &$item)
        {
            if($item['packsize_name'])
            {
                $item['packsize_name']=$item['packsize_name'].' gm';
            }
            else
            {
                $item['packsize_name']='';
            }
        }
        //print_r($items);exit;
        $this->json_return($items);
    }
    private function system_add()
    {
        if(isset($this->permissions['action1']) && ($this->permissions['action1']==1))
        {
            $data['title']="Stock In Here";
            $data["item"] = Array(
                'id' => 0,
                'crop_id'=>0,
                'crop_type_id'=>0,
                'variety_id'=>0,
                'type'=>'',
                'packsize_id' => '',
                'warehouse_id' => '',
                'quantity' => '',
                'remarks' => ''
            );
            $data['crops']=Query_helper::get_info($this->config->item('table_login_setup_classification_crops'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $data['crop_types']=array();
            $data['varieties']=array();
            $data['warehouses']=Query_helper::get_info($this->config->item('table_login_basic_setup_warehouse'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $data['packs']=Query_helper::get_info($this->config->item('table_login_setup_classification_vpack_size'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $ajax['system_page_url']=site_url($this->controller_url."/index/add");
            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load->view($this->controller_url."/add",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $this->json_return($ajax);
        }
        else
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->json_return($ajax);
        }
    }
    private function system_edit($id)
    {

    }
    private function system_save()
    {
        $id = $this->input->post("id");
        $user = User_helper::get_user();
        $time=time();
        if($id>0)
        {
            if(!(isset($this->permissions['action2']) && ($this->permissions['action2']==1)))
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                $this->json_return($ajax);
            }
        }
        else
        {
            if(!(isset($this->permissions['action1']) && ($this->permissions['action1']==1)))
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                $this->json_return($ajax);
            }
        }
        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->message;
            $this->json_return($ajax);
        }
        else
        {
            $data=$this->input->post('item');
            $data['factor']=1;
            $data['purpose']='stock_in';
            $data['status']=$this->config->item('system_status_active');
            $this->db->trans_start();  //DB Transaction Handle START
            if($id>0)
            {
               //edit;
            }
            else
            {
                if($data['type_id']==1)
                {
                    unset($data['type_id']);
                    unset($data['packsize_id']);
                    $data['user_created'] = $user->user_id;
                    $data['date_created'] = time();
                    Query_helper::add($this->config->item('table_sms_bulk'),$data);
                }
                else
                {
                    unset($data['type_id']);
                    $data['transfer_id']=NULL;
                    $data['user_created'] = $user->user_id;
                    $data['date_created'] = time();
                    Query_helper::add($this->config->item('table_sms_packet'),$data);
                }
            }
            $this->db->trans_complete();   //DB Transaction Handle END
            if ($this->db->trans_status() === TRUE)
            {
                $save_and_new=$this->input->post('system_save_new_status');
                $this->message=$this->lang->line("MSG_SAVED_SUCCESS");
                if($save_and_new==1)
                {
                    $this->system_add();
                }
                else
                {
                    $this->system_list();
                }
            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("MSG_SAVED_FAIL");
                $this->json_return($ajax);
            }
        }
    }
    private function check_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('item[variety_id]',$this->lang->line('LABEL_VARIETY'),'required');
        $this->form_validation->set_rules('item[type_id]',$this->lang->line('LABEL_TYPE'),'required');
        $this->form_validation->set_rules('item[warehouse_id]',$this->lang->line('LABEL_WAREHOUSE'),'required');
        $this->form_validation->set_rules('item[quantity]',$this->lang->line('LABEL_QUANTITY'),'required');
        $item=$this->input->post('item');

        if($item['type_id']=='2')
        {
            $this->form_validation->set_rules('item[packsize_id]','Pack Size','required');
        }
        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }
}