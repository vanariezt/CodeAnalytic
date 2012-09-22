<div class="box_chart">
    <center>
        <div id="comdiv" style="margin-top: 10px; margin-left: 8px;" align="center">The chart will appear within this DIV. This text will be replaced by the chart.</div>
    </center>
    
    <script type="text/javascript">
        FusionCharts.setCurrentRenderer('javascript')
        var myChart = new FusionCharts("<?php echo base_url() ?>system/application/plugins/charts/MSLine.swf", "myChartId", "97%", "350", "0", "0");
        myChart.setDataURL('<?php echo base_url() ?>comments_statistic/get_/<?php echo $Y ?>');
        myChart.render("comdiv");
    </script>
</div> 
<div class="history">
    <div id="top_tap"><span><?php echo ca_translate("history"); ?></span></div>
    <p>
        <label><?php echo ca_translate("today")?></label> <?php echo $today ?>
    </p>
    <p>
        <label><?php echo ca_translate("yesterday")?></label> <?php echo $yesterday ?>
    </p>
    <p>
        <label><?php echo ca_translate("last week")?></label> <?php echo $lastWeek ?>
    </p>
    <p>
        <label><?php echo ca_translate("all time")?></label> <?php echo $download ?>
    </p>
</div>



