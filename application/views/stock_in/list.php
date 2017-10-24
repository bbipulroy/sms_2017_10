<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI=& get_instance();
$action_buttons=array();
if(isset($CI->permissions['action1']) && ($CI->permissions['action1']==1))
{
    $action_buttons[]=array(
        'label'=>$CI->lang->line('ACTION_NEW'),
        'href'=>site_url($CI->controller_url.'/index/add')
    );
}
if(isset($CI->permissions['action2']) && ($CI->permissions['action2']==1))
{
    $action_buttons[]=array(
        'type'=>'button',
        'label'=>$CI->lang->line('ACTION_EDIT'),
        'class'=>'button_jqx_action',
        'data-action-link'=>site_url($CI->controller_url.'/index/edit')
    );
}
if(isset($CI->permissions['action4']) && ($CI->permissions['action4']==1))
{
    $action_buttons[]=array(
        'type'=>'button',
        'label'=>$CI->lang->line("ACTION_PRINT"),
        'class'=>'button_action_download',
        'data-title'=>"Print",
        'data-print'=>true
    );
}
if(isset($CI->permissions['action5']) && ($CI->permissions['action5']==1))
{
    $action_buttons[]=array(
        'type'=>'button',
        'label'=>$CI->lang->line("ACTION_DOWNLOAD"),
        'class'=>'button_action_download',
        'data-title'=>"Download"
    );
}
$action_buttons[]=array(
    'label'=>$CI->lang->line("ACTION_REFRESH"),
    'href'=>site_url($CI->controller_url.'/index/list')

);
$CI->load->view('action_buttons',array('action_buttons'=>$action_buttons));
?>

<div class="row widget">
    <div class="widget-header">
        <div class="title">
            <?php echo $title; ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-xs-12" style="margin-bottom: 20px;">
        <div class="col-xs-12" style="margin-bottom: 20px;">
            <label class="checkbox-inline"><input type="checkbox" class="system_jqx_column" value="crop_name"><?php echo $CI->lang->line('LABEL_CROP_NAME'); ?></label>
            <label class="checkbox-inline"><input type="checkbox" class="system_jqx_column" value="crop_type_name"><?php echo $CI->lang->line('LABEL_CROP_TYPE'); ?></label>
            <label class="checkbox-inline"><input type="checkbox" class="system_jqx_column" checked value="variety_name"><?php echo $CI->lang->line('LABEL_VARIETY'); ?></label>
            <label class="checkbox-inline"><input type="checkbox" class="system_jqx_column" checked value="warehouse_name"><?php echo $CI->lang->line('LABEL_WAREHOUSE'); ?></label>
            <label class="checkbox-inline"><input type="checkbox" class="system_jqx_column" checked value="type"><?php echo $CI->lang->line('LABEL_TYPE'); ?></label>
            <label class="checkbox-inline"><input type="checkbox" class="system_jqx_column" checked value="packsize_name">Pack Size</label>
            <label class="checkbox-inline"><input type="checkbox" class="system_jqx_column" checked value="quantity"><?php echo $CI->lang->line('LABEL_QUANTITY'); ?></label>
            <label class="checkbox-inline"><input type="checkbox" class="system_jqx_column" checked value="purpose"><?php echo $CI->lang->line('LABEL_PURPOSE'); ?></label>
            <label class="checkbox-inline"><input type="checkbox" class="system_jqx_column" checked value="status"><?php echo $CI->lang->line('STATUS'); ?></label>
        </div>
    </div>
    <div class="col-xs-12" id="system_jqx_container">

    </div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
    $(document).ready(function ()
    {
        system_preset({controller:'<?php echo $CI->router->class; ?>'});

        var url = "<?php echo base_url($CI->controller_url.'/index/get_items');?>";

        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
                { name: 'id', type: 'string' },
                { name: 'crop_name', type: 'string' },
                { name: 'crop_type_name', type: 'string' },
                { name: 'variety_name', type: 'string' },
                { name: 'warehouse_name', type: 'string' },
                { name: 'packsize_name', type: 'string' },
                { name: 'type', type: 'string' },
                { name: 'quantity', type: 'string' },
                { name: 'purpose', type: 'string' },
                { name: 'status', type: 'string' }
            ],
            id: 'id',
            url: url
        };

        var dataAdapter = new $.jqx.dataAdapter(source);
        // create jqxgrid.
        $("#system_jqx_container").jqxGrid(
            {
                width: '100%',
                source: dataAdapter,
                pageable: true,
                filterable: true,
                sortable: true,
                showfilterrow: true,
                columnsresize: true,
                pagesize:50,
                pagesizeoptions: ['20', '50', '100', '200','300','500'],
                selectionmode: 'singlerow',
                altrows: true,
                autoheight: true,
                columns: [
                    { text: '<?php echo $CI->lang->line('LABEL_CROP_NAME'); ?>', dataField: 'crop_name',width:'200',hidden:true},
                    { text: '<?php echo $CI->lang->line('LABEL_CROP_TYPE'); ?>', dataField: 'crop_type_name',width:'200',hidden:true},
                    { text: '<?php echo $CI->lang->line('LABEL_VARIETY'); ?>', dataField: 'variety_name',width:'250'},
                    { text: '<?php echo $CI->lang->line('LABEL_WAREHOUSE'); ?>', dataField: 'warehouse_name',filtertype: 'list',width:'210'},
                    { text: '<?php echo $CI->lang->line('LABEL_TYPE'); ?>', dataField: 'type',filtertype: 'list',width:'150'},
                    { text: 'Pack Size', dataField: 'packsize_name',filtertype: 'list',width:'150'},
                    { text: '<?php echo $CI->lang->line('LABEL_QUANTITY').' in Kg/Packet'; ?>', dataField: 'quantity',width:'200'},
                    { text: '<?php echo $CI->lang->line('LABEL_PURPOSE'); ?>', filtertype: 'list',dataField: 'purpose',width:'150'},
                    { text: '<?php echo $CI->lang->line('STATUS'); ?>', dataField: 'status',filtertype: 'list',width:'150',cellsalign: 'right'}
                ]
            });
    });
</script>
