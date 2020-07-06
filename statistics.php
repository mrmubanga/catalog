<?php
include 'core/init.php';
include 'includes/layout/header.php';

if (logged_in() == true) {
include 'includes/addons/loggedin.php';
} else {
include 'includes/layout/clientnavmenu.php';
}
$id = $_POST['id'];
$records = array();
if ($results = $db->query("SELECT * FROM `product`,`pricehist` WHERE `pricehist`.`prod_id` = $id AND `product`.`prod_id` = $id AND `product`.`user_id`=`pricehist`.`user_id` ORDER BY `prodName`")) {
	if ($results->num_rows) {
		while ($row = $results->fetch_object()) {
			$records[] = $row;
		}
		$results->free();
	}
}
if (!count($records)) {
  echo "<br/>";
  echo "<div class='alert alert-info' role='alert'><p><i class='glyphicon glyphicon-info-sign'></i> No Records</p></div>";
} else {
echo "

    <script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>
    <script type=\"text/javascript\">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Price in K'],";
$yuio = 1;
foreach ($records as $r) {
  $yuio = $yuio + 1;
  $ppp = escape($r->price);
  $zxc1 = escape($r->oldPrice);
  echo "['".escape($r->date)."',". escape($r->oldPrice)."],";
  $zxc = $zxc1+escape($r->oldPrice);
      }
      $cvb = $zxc+$ppp;
      $zxc = $zxc*2;
      $yuio=($cvb/$zxc)*100;
      $yuio=intval($yuio);
    echo "['Today',  $ppp]
        ]);

        var options = {
          title: '$r->prodName Price Statistics',
          hAxis: {title: 'Timeline',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

    <div id=\"chart_div\" style=\"width: 950px; height: 500px;\"></div>
    <hr/><div><strong>Probability Of A Drop <u>$yuio %</u></strong></div>


";
}

       ?>
<?php  include 'includes/layout/footer.php';?>