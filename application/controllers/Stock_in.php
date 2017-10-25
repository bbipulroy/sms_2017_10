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

        $this->db->select('stock_in.*');
        $this->db->select('variety.name variety_name');
        $this->db->select('type.name crop_type_name');
        $this->db->select('crop.name crop_name');
        $this->db->select('pack.name pack_name');
        $this->db->select('warehouse.name warehouse_name');
        $this->db->from($this->config->item('table_sms_stock_in').' stock_in');
        $this->db->join($this->config->item('table_login_setup_classification_varieties').' variety','variety.id = stock_in.variety_id','INNER');
        $this->db->join($this->config->item('table_login_setup_classification_crop_types').' type','type.id = variety.crop_type_id','INNER');
        $this->db->join($this->config->item('table_login_setup_classification_crops').' crop','crop.id = type.crop_id','INNER');
        $this->db->join($this->config->item('table_login_setup_classification_vpack_size').' pack','pack.id = stock_in.pack_size_id','LEFT');
        $this->db->join($this->config->item('table_login_basic_setup_warehouse').' warehouse','warehouse.id = stock_in.warehouse_id','INNER');
        $this->db->where('stock_in.status',$this->config->item('system_status_active'));
        $this->db->or_where('stock_in.status',$this->config->item('system_status_delete'));
        $this->db->order_by('stock_in.date_created','DESC');
        $items=$this->db->get()->result_array();
        foreach($items as &$item)
        {
            if(!$item['pack_name'])
            {
                $item['pack_name']='Bulk';
                $item['quantity']=number_format($item['quantity'],3);
            }
            else
            {
                $item['pack_name']=$item['pack_name'].' gm';
            }
        }
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
                'pack_size_id' => '',
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
            $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load->view($this->controller_url."/add_edit",$data,true));
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
        $time = time();
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
            $this->db->trans_start();  //DB Transaction Handle START
            if($id>0)
            {
               //edit;
            }
            else
            {
                $data['status']=$this->config->item('system_status_active');
                $data['user_created'] = $user->user_id;
                $data['date_created'] = time();
                Query_helper::add($this->config->item('table_sms_stock_in'),$data);

                $result=Query_helper::get_info($this->config->item('table_sms_stock_summary'),'*',array('variety_id ='.$data['variety_id'],'pack_size_id ='.$data['pack_size_id'],'warehouse_id ='.$data['warehouse_id']),1);
                if($result)
                {
                    $s_data['in_stock'] = $data['quantity']+$result['in_stock'];
                    $s_data['current_stock'] = $data['quantity']+$result['current_stock'];
                    $s_data['date_updated'] = $time;
                    $s_data['user_updated'] = $user->user_id;
                    Query_helper::update($this->config->item('table_sms_stock_summary'),$s_data,array('id='.$result['id']));
                }
                else
                {
                    $s_data['variety_id'] = $data['variety_id'];
                    $s_data['pack_size_id'] = $data['pack_size_id'];
                    $s_data['warehouse_id'] = $data['warehouse_id'];
                    $s_data['in_stock'] = $data['quantity'];
                    $s_data['current_stock'] = $data['quantity'];
                    $s_data['date_updated'] = $time;
                    $s_data['user_updated'] = $user->user_id;
                    Query_helper::add($this->config->item('table_sms_stock_summary'),$s_data);
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
        $this->form_validation->set_rules('item[pack_size_id]','Pack Size','required');
        $this->form_validation->set_rules('item[warehouse_id]',$this->lang->line('LABEL_WAREHOUSE'),'required');
        $this->form_validation->set_rules('item[quantity]',$this->lang->line('LABEL_QUANTITY'),'required');
        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }
}