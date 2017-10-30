<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI=& get_instance();
$action_buttons=array();
$action_buttons[]=array(
    'label'=>$CI->lang->line("ACTION_BACK"),
    'href'=>site_url($CI->controller_url)
);
$action_buttons[]=array(
    'type'=>'button',
    'label'=>$CI->lang->line("ACTION_SAVE"),
    'id'=>'button_action_save',
    'data-form'=>'#save_form'
);
$action_buttons[]=array(
    'type'=>'button',
    'label'=>$CI->lang->line("ACTION_SAVE_NEW"),
    'id'=>'button_action_save_new',
    'data-form'=>'#save_form'
);
$action_buttons[]=array(
    'type'=>'button',
    'label'=>$CI->lang->line("ACTION_CLEAR"),
    'id'=>'button_action_clear',
    'data-form'=>'#save_form'
);
$CI->load->view('action_buttons',array('action_buttons'=>$action_buttons));
?>
<form id="save_form" action="<?php echo site_url($CI->controller_url.'/index/save');?>" method="post">
    <input type="hidden" id="id" name="id" value="<?php echo $item['id']; ?>" />
    <input type="hidden" id="system_save_new_status" name="system_save_new_status" value="0" />
    <div class="row widget">
        <div class="widget-header">
            <div class="title">
                <?php echo $title; ?>
            </div>
            <div class="clearfix"></div>
        </div>


        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label for="crop_id" class="control-label pull-right"><?php echo $CI->lang->line('LABEL_CROP_NAME');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select id="crop_id" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <?php
                    foreach($crops as $crop)
                    {?>
                        <option value="<?php echo $crop['value']?>"><?php echo $crop['text'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div style="display:none;" class="row show-grid" id="crop_type_id_container">
            <div class="col-xs-4">
                <label for="crop_type_id" class="control-label pull-right"><?php echo $CI->lang->line('LABEL_CROP_TYPE');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select id="crop_type_id" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <?php
                    foreach($crop_types as $crop_type)
                    {?>
                        <option value="<?php echo $crop_type['value']?>"><?php echo $crop_type['text'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div style="display:none;" class="row show-grid" id="variety_id_container">
            <div class="col-xs-4">
                <label for="variety_id" class="control-label pull-right"><?php echo $CI->lang->line('LABEL_VARIETY');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select id="variety_id" name="item[variety_id]" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <?php
                    foreach($varieties as $variety)
                    {?>
                        <option value="<?php echo $variety['value']?>"><?php echo $variety['text'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div style="display:none;" class="row show-grid" id="pack_size_id_container">
            <div class="col-xs-4">
                <label for="pack_size_id" class="control-label pull-right">Pack Size<span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select id="pack_size_id" name="item[pack_size_id]" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <option value="0">Bulk</option>
                    <?php
                    foreach($packs as $pack)
                    {?>
                        <option value="<?php echo $pack['value']?>"><?php echo $pack['text'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div style="display:none;" class="row show-grid" id="warehouse_id_container">
            <div class="col-xs-4">
                <label for="warehouse_id" class="control-label pull-right"><?php echo $this->lang->line('LABEL_WAREHOUSE'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select id="warehouse_id" name="item[warehouse_id]" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <?php
                    foreach($warehouses as $warehouse)
                    {?>
                        <option value="<?php echo $warehouse['value']?>"><?php echo $warehouse['text'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div style="display:none;" class="row show-grid" id="current_stock_container">
            <div class="col-xs-4">
                <label class="control-label pull-right">Current Stock</label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <label id="current_stock_id"></label>
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label for="quantity" class="control-label pull-right"><?php echo $this->lang->line('LABEL_QUANTITY');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="item[quantity]" id="quantity" class="form-control float_type_positive" value="<?php echo $item['quantity'];?>"/>
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_DATE_STOCK_OUT');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="item[date_stock_out]" id="date_stock_out" class="form-control datepicker" value="<?php echo System_helper::display_date($item['date_stock_out']);?>"/>
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label for="purpose" class="control-label pull-right"><?php echo $this->lang->line('LABEL_PURPOSE'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select id="purpose" name="item[purpose]" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <option value="<?php echo $CI->config->item('system_purpose_short_inventory'); ?>"><?php echo $CI->lang->line('LABEL_STOCK_OUT_PURPOSE_SHORT');?></option>
                    <option value="<?php echo $CI->config->item('system_purpose_rnd'); ?>"><?php echo $CI->lang->line('LABEL_STOCK_OUT_PURPOSE_RND');?></option>
                    <option value="<?php echo $CI->config->item('system_purpose_sample'); ?>"><?php echo $CI->lang->line('LABEL_STOCK_OUT_PURPOSE_SAMPLE');?></option>
                    <option value="<?php echo $CI->config->item('system_purpose_demonstration'); ?>"><?php echo $CI->lang->line('LABEL_STOCK_OUT_PURPOSE_DEMONSTRATION');?></option>
                </select>
            </div>
        </div>

        <div style="display: none;" class="row show-grid" id="division_id_container">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_DIVISION_NAME');?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select id="division_id" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <?php
                    foreach($divisions as $division)
                    {?>
                        <option value="<?php echo $division['value']?>"><?php echo $division['text'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div style="display: none;" class="row show-grid" id="zone_id_container">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_ZONE_NAME');?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select id="zone_id" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                </select>
            </div>
        </div>
        <div style="display: none;" class="row show-grid" id="territory_id_container">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_TERRITORY_NAME');?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select id="territory_id" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                </select>
            </div>
        </div>
        <div style="display: none;" class="row show-grid" id="district_id_container">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_DISTRICT_NAME');?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select id="district_id" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                </select>
            </div>
        </div>
        <div style="display: none;" class="row show-grid" id="customer_id_container">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_CUSTOMER_NAME');?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select id="customer_id" name="item[customer_id]" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                </select>
            </div>
        </div>
        <div class="row show-grid" style="display: none;" id="customer_name_container">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CUSTOMER_NAME');?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="item[customer_name]" id="customer_name" class="form-control" value=""/>
            </div>
        </div>

        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label for="remarks" class="control-label pull-right"><?php echo $CI->lang->line('LABEL_REMARKS');?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <textarea name="item[remarks]" id="remarks" class="form-control"><?php echo $item['remarks'] ?></textarea>
            </div>
        </div>

    </div>

    <div class="clearfix"></div>
</form>
<script type="text/javascript">

    jQuery(document).ready(function()
    {
        system_preset({controller:'<?php echo $CI->router->class; ?>'});

        $(".datepicker").datepicker({dateFormat : display_date_format});
        $(document).off('change','#crop_id');
        $(document).off('change','#crop_type_id');
        $(document).off('change','#variety_id');
        $(document).off('change','#pack_size_id');
        $(document).off('change','#warehouse_id');

        $(document).on("change","#crop_id",function()
        {
            $("#crop_type_id").val("");
            $("#variety_id").val("");
            $("#pack_size_id").val("");
            $("#warehouse_id").val("");
            $("#current_stock_id").text("");
            var crop_id=$('#crop_id').val();
            if(crop_id>0)
            {
                $('#crop_type_id_container').show();
                $('#variety_id_container').hide();
                $('#pack_size_id_container').hide();
                $('#warehouse_id_container').hide();
                $('#current_stock_container').hide();
                $('#crop_type_id').html(get_dropdown_with_select(system_types[crop_id]));
            }
            else
            {
                $('#crop_type_id_container').hide();
                $('#variety_id_container').hide();
                $('#pack_size_id_container').hide();
                $('#warehouse_id_container').hide();
                $('#current_stock_container').hide();
            }
        });
        $(document).on("change","#crop_type_id",function()
        {
            $("#variety_id").val("");
            $("#pack_size_id").val("");
            $("#warehouse_id").val("");
            $("#current_stock_id").text("");
            var crop_type_id=$('#crop_type_id').val();
            if(crop_type_id>0)
            {
                $('#variety_id_container').show();
                $('#pack_size_id_container').hide();
                $('#warehouse_id_container').hide();
                $('#current_stock_container').hide();
                $('#variety_id').html(get_dropdown_with_select(system_varieties[crop_type_id]));
            }
            else
            {
                $('#variety_id_container').hide();
                $('#pack_size_id_container').hide();
                $('#warehouse_id_container').hide();
                $('#current_stock_container').hide();
            }
        });
        $(document).on("change","#variety_id",function()
        {
            $("#pack_size_id").val("");
            $("#warehouse_id").val("");
            $("#current_stock_id").text("");
            var variety_id=$('#variety_id').val();
            if(variety_id>0)
            {
                $('#pack_size_id_container').show();
                $('#warehouse_id_container').hide();
                $('#current_stock_container').hide();
            }
            else
            {
                $('#pack_size_id_container').hide();
                $('#warehouse_id_container').hide();
                $('#current_stock_container').hide();
            }
        });
        $(document).on("change","#pack_size_id",function()
        {
            $("#warehouse_id").val("");
            $("#current_stock_id").text("");
            var pack_size_id=$('#pack_size_id').val();
            if(pack_size_id == '')
            {
                $('#warehouse_id_container').hide();
                $('#current_stock_container').hide();
            }
            else
            {
                $('#warehouse_id_container').show();
                $('#current_stock_container').hide();
            }
        });
        $(document).on("change","#warehouse_id",function()
        {
            $("#current_stock_id").text("");
            var variety_id=$('#variety_id').val();
            var pack_size_id=$('#pack_size_id').val();
            var warehouse_id=$('#warehouse_id').val();
            if(warehouse_id>0)
            {
                $('#current_stock_container').show();
                $.ajax({
                    url: "<?php echo site_url('common_controller/get_current_stock'); ?>",
                    type: 'POST',
                    datatype: "JSON",
                    data:{
                        warehouse_id:warehouse_id,
                        pack_size_id:pack_size_id,
                        variety_id:variety_id
                    },
                    success: function (data, status)
                    {
                        $("#current_stock_id").text(data);
                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });

            }
            else
            {
                $('#current_stock_container').hide();
            }
        });

        $(document).off('change', '#purpose');
        $(document).on('change','#purpose',function()
        {
            $('#division_id').val('');
            $('#zone_id').val('');
            $('#territory_id').val('');
            $('#district_id').val('');
            $('#customer_id').val('');
            $('#customer_name').val('');
            var purpose=$('#purpose').val();
            $('#division_id_container').hide();
            $('#zone_id_container').hide();
            $('#territory_id_container').hide();
            $('#district_id_container').hide();
            $('#customer_id_container').hide();
            $('#customer_name_container').hide();
            if(purpose=='<?php echo $CI->config->item('system_purpose_sample'); ?>')
            {
                $('#division_id_container').show();
            }
        });
        $(document).off('change', '#division_id');
        $(document).on('change','#division_id',function()
        {
            $('#zone_id').val('');
            $('#territory_id').val('');
            $('#district_id').val('');
            $('#customer_id').val('');
            $('#customer_name').val('');
            var division_id=$('#division_id').val();
            $('#zone_id_container').hide();
            $('#territory_id_container').hide();
            $('#district_id_container').hide();
            $('#customer_id_container').hide();
            $('#customer_name_container').hide();
            if(division_id>0)
            {
                if(system_zones[division_id]!==undefined)
                {
                    $('#zone_id_container').show();
                    $('#zone_id').html(get_dropdown_with_select(system_zones[division_id]));
                }
            }

        });
        $(document).off('change', '#zone_id');
        $(document).on('change','#zone_id',function()
        {
            $('#territory_id').val('');
            $('#district_id').val('');
            $('#customer_id').val('');
            $('#customer_name').val('');
            var zone_id=$('#zone_id').val();
            $('#territory_id_container').hide();
            $('#district_id_container').hide();
            $('#customer_id_container').hide();
            $('#customer_name_container').hide();
            if(zone_id>0)
            {
                if(system_territories[zone_id]!==undefined)
                {
                    $('#territory_id_container').show();
                    $('#territory_id').html(get_dropdown_with_select(system_territories[zone_id]));
                }
            }
        });
        $(document).off('change', '#territory_id');
        $(document).on('change','#territory_id',function()
        {
            $('#district_id').val('');
            $('#customer_id').val('');
            $('#customer_name').val('');
            $('#district_id_container').hide();
            $('#customer_id_container').hide();
            $('#customer_name_container').hide();
            var territory_id=$('#territory_id').val();
            if(territory_id>0)
            {
                if(system_districts[territory_id]!==undefined)
                {
                    $('#district_id_container').show();
                    $('#customer_name_container').show();
                    $('#district_id').html(get_dropdown_with_select(system_districts[territory_id]));
                }

            }
        });
        $(document).off('change', '#district_id');
        $(document).on('change','#district_id',function()
        {
            $('#customer_id').val('');
            $('#customer_name').val('');
            var district_id=$('#district_id').val();
            $('#customer_id_container').hide();
            $('#customer_name_container').hide();
            if(district_id>0)
            {
                if(system_customers[district_id]!==undefined)
                {
                    $('#customer_id_container').show();
                    $('#customer_id').html(get_dropdown_with_select(system_customers[district_id]));
                }
            }
            else
            {
                $('#customer_name_container').show();
            }
        });
    });
</script>
