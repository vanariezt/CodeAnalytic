<?php if (!defined('BASEPATH'))    exit('no direct script user allowed');

/**
 * CodeAnalytic
 *
 * An open source application development cms support for php 4.3 and newest
 *
 * @package		CodeAnalytic
 * @author		CodeAnalytic Team Web Developer
 * @copyright           Copyright (c) 2012 , CodeAnalytic, Inc.
 * @license		http://codeanalytic.com/application-license
 * @link		http://codeanalytic.com
 * @since		Version 0.1
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * Views 
 *
 * @package		CodeAnalytic
 * @subpackage          View
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/view/user_statistic_index
 */ 
?>
<div class="box_chart">   
    <center>
        <div id="chartdiv" style="margin-top: 10px;" align="center">The chart will appear within this DIV. This text will be replaced by the chart.</div>
    </center>

    <script type="text/javascript">
        FusionCharts.setCurrentRenderer('javascript')
        var myChart = new FusionCharts("<?php echo base_url() ?>system/application/plugins/charts/MSLine.swf", "myChartId", "100%", "400", "0", "0");
        myChart.setDataURL('<?php echo base_url() ?>users_statistic/get_/<?php echo $Y . '/' . $m ?>');
        myChart.render("chartdiv");
    </script>
   
</div> 