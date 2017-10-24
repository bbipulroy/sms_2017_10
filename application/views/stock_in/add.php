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

        <div style="display: none;" class="row show-grid" id="crop_type_id_container">
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

        <div style="display: none;" class="row show-grid" id="variety_id_container">
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

        <div style="display: none;" class="row show-grid" id="type_id_container">
            <div class="col-xs-4">
                <label for="type_id" class="control-label pull-right"><?php echo $CI->lang->line('LABEL_TYPE');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select id="type_id" name="item[type_id]" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <option value="1">BULK</option>
                    <option value="2">PACKET</option>
                </select>
            </div>
        </div>

        <div style="display: none;" class="row show-grid" id="pack_size_container">
            <div class="col-xs-4">
                <label for="packsize_id" class="control-label pull-right">Pack Size<span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select id="packsize_id" name="item[packsize_id]" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
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

        <div style="display: none;" class="row show-grid" id="warehouse_container">
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
                <label for="current_stock_id" class="control-label pull-right">Current Stock</label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <label id="current_stock_id"></label>
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label for="name" class="control-label pull-right"><?php echo $this->lang->line('LABEL_QUANTITY');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="item[quantity]" id="quantity" class="form-control float_type_positive" value="<?php echo $item['quantity'];?>"/>
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

        $(document).off('change','#crop_id');
        $(document).off('change','#crop_type_id');
        $(document).off('change','#variety_id');
        $(document).off('change','#type_id');
        $(document).off('change','#packsize_id');
        $(document).off('change','#warehouse_id');

        $(document).on("change","#crop_id",function()
        {
            $("#crop_type_id").val("");
            $("#variety_id").val("");
            $("#type_id").val("");
            $("#packsize_id").val("");
            $("#warehouse_id").val("");
            $("#current_stock_id").val("");
            var crop_id=$('#crop_id').val();
            if(crop_id>0)
            {
                $('#crop_type_id_container').show();
                $('#variety_id_container').hide();
                $('#type_id_container').hide();
                $('#pack_size_container').hide();
                $('#warehouse_container').hide();
                $('#current_stock_container').hide();
                $('#crop_type_id').html(get_dropdown_with_select(system_types[crop_id]));
            }
            else
            {
                $('#crop_type_id_container').hide();
                $('#variety_id_container').hide();
                $('#type_id_container').hide();
                $('#pack_size_container').hide();
                $('#warehouse_container').hide();
                $('#current_stock_container').hide();
            }
        });
        $(document).on("change","#crop_type_id",function()
        {
            $("#variety_id").val("");
            $("#type_id").val("");
            $("#packsize_id").val("");
            $("#warehouse_id").val("");
            $("#current_stock_id").val("");
            var crop_type_id=$('#crop_type_id').val();
            if(crop_type_id>0)
            {
                $('#variety_id_container').show();
                $('#type_id_container').hide();
                $('#pack_size_container').hide();
                $('#warehouse_container').hide();
                $('#current_stock_container').hide();
                $('#variety_id').html(get_dropdown_with_select(system_varieties[crop_type_id]));
            }
            else
            {
                $('#variety_id_container').hide();
                $('#type_id_container').hide();
                $('#pack_size_container').hide();
                $('#warehouse_container').hide();
                $('#current_stock_container').hide();
            }
        });
        $(document).on("change","#variety_id",function()
        {
            $("#type_id").val("");
            $("#packsize_id").val("");
            $("#warehouse_id").val("");
            $("#current_stock_id").val("");
            var variety_id=$('#variety_id').val();
            if(variety_id>0)
            {
                $('#type_id_container').show();
                $('#pack_size_container').hide();
                $('#warehouse_container').hide();
                $('#current_stock_container').hide();
            }
            else
            {
                $('#type_id_container').hide();
                $('#pack_size_container').hide();
                $('#warehouse_container').hide();
                $('#current_stock_container').hide();
            }
        });
        $(document).on("change","#type_id",function()
        {
            $("#packsize_id").val("");
            $("#warehouse_id").val("");
            $("#current_stock_id").val("");
            var type_id=$('#type_id').val();
            if(type_id>0)
            {
                if(type_id==1)
                {
                    $('#pack_size_container').hide();
                    $('#warehouse_container').show();
                    $('#current_stock_container').hide();
                }
                else
                {
                    $('#pack_size_container').show();
                    $('#warehouse_container').hide();
                    $('#current_stock_container').hide();
                }
            }
            else
            {
                $('#pack_size_container').hide();
                $('#warehouse_container').hide();
                $('#current_stock_container').hide();
            }
        });
        $(document).on("change","#packsize_id",function()
        {
            $("#warehouse_id").val("");
            $("#current_stock_id").val("");
            var packsize_id=$('#packsize_id').val();
            if(packsize_id>0)
            {
                $('#warehouse_container').show();
                $('#current_stock_container').hide();
            }
            else
            {
                $('#warehouse_container').hide();
                $('#current_stock_container').hide();
            }
        });
        $(document).on("change","#warehouse_id",function()
        {
            $("#current_stock_id").val("");
            var warehouse_id=$('#warehouse_id').val();
            if(warehouse_id>0)
            {
                $('#current_stock_container').show();
            }
            else
            {
                $('#current_stock_container').hide();
            }
        });
    });
</script>