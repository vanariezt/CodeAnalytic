<div class="box_chart">
    <center>
        <div id="chartdiv1" style="margin-top: 10px;" align="center">The chart will appear within this DIV. This text will be replaced by the chart.</div>
    </center>
    <script type="text/javascript">
        FusionCharts.setCurrentRenderer('javascript')
        var myChart = new FusionCharts("<?php echo base_url() ?>system/application/plugins/charts/MSLine.swf", "myChartId", "100%", "400", "0", "0");
        myChart.setDataURL('<?php echo base_url() ?>members_statistic/get_/<?php echo "$Y/$m/" ?>');
        myChart.render("chartdiv1");
    </script>
</div>

