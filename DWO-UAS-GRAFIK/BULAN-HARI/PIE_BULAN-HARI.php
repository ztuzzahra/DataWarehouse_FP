<?php
	$conn = mysqli_connect("localhost", "root","","whsakila2021");

	// Query Chart Pertama 

	// Query Sum
	$total = $conn->query("SELECT SUM(amount) AS total FROM fakta_pendapatan");
	$tot_amount = mysqli_fetch_row($total);

	//echo $tot_amount[0];

	//query untuk ambil penjualan berdasarkan bulan
	//query teknik gak jelas

	$kategori = $conn->query("SELECT CONCAT('name:',t.bulan) as name, CONCAT('y:', SUM(fp.amount)*100/" . $tot_amount[0] .") as y, CONCAT('drilldown:', t.bulan) as drilldown 
		FROM time t 
		JOIN fakta_pendapatan fp ON (t.time_id = fp.time_id) 
		GROUP BY name");
		// echo $sql;
	while($row = mysqli_fetch_all($kategori)) {
		$data[] = $row;
	}


	$json_all_kat = json_encode($data);

	//CHART KEDUA (DRILL DOWN)

	//query untuk tahu SUM(Amount) semua bulan
	$hasil_kat = $conn->query("SELECT t.bulan bulan, sum(fp.amount) as tot_kat
			FROM fakta_pendapatan fp
			JOIN time t ON (t.time_id = fp.time_id)
			GROUP BY bulan");
	while ($row = mysqli_fetch_all($hasil_kat)) {
		$tot_all_kat[] = $row;
	}

	//print_R($tot_all_kat);
	//function untuk nyari total_per_kat

	//echo count($tot_per_kat[0]);
	//echo $tot_per_kat[0][0][1];

	function cari_tot_kat($kat_dicari, $tot_all_kat){
		$counter = 0;
		//echo $tot_all_kat[0];
		while ( $counter < count($tot_all_kat[0]) ) {
			if ($kat_dicari == $tot_all_kat[0][$counter][0]) {
				$tot_kat = $tot_all_kat[0][$counter][1];
				return $tot_kat;
			}
			$counter++;
		}
	}

	//query untuk ambil penjualan di bulan berdasarkan nama hari (clean)
	$det_kat = $conn->query("SELECT t.bulan bulan,
			t.namahari as namahari,
			sum(fp.amount) as pendapatan_kat
			FROM time t
			JOIN fakta_pendapatan fp ON (t.time_id = fp.time_id)
			GROUP BY bulan, namahari");
	$i = 0;
	while ($row = mysqli_fetch_all($det_kat)) {
		//echo $row;
		$data_det[] = $row;
		
	}

	//print_r($data_det);

	//PERSIAPAN DATA DRILL DOWN - TEKNIK CLEAN
	$i = 0;

	//inisiasi string DATA
	$string_data = "";
	$string_data .= '{nama:"' . $data_det[0][$i][0] . '", id:"' . $data_det[0][$i][0] . '", data: [';


	// echo cari_tot_kat("Action", $tot_all_kat);
	foreach($data_det[0] as $a){
		

		if($i < count($data_det[0])-1){
			if($a[0] != $data_det[0][$i+1][0]){
				$string_data .= '["' . $a[1] . '", ' . $a[2]*100/cari_tot_kat($a[0], $tot_all_kat) . ']]},';

				$string_data .= '{name:"' . $data_det[0][$i+1][0] . '", id:"' . $data_det[0][$i+1][0] . '", data: [';
			}
			else{
				$string_data .= '["' . $a[1] . '", ' . 
					$a[2]*100/cari_tot_kat($a[0], $tot_all_kat) . '], ';
			}
		}
		else{

				$string_data .= '["' . $a[1] . '", ' .
					$a[2]*100/cari_tot_kat($a[0], $tot_all_kat). ']]}';

		}


		$i = $i+1;

	}




?>



<html>
<head>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js">
</script>
<link rel="stylesheet" href="css.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js">
	</script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        
    </p>
</figure>

<script type="text/javascript">
// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Presentase Nilai Penjualan (WH Sakila) - Semua Bulan'
    },
    subtitle: {
        text: 'Klik bar untuk melihat detil nilai penjualan perbulan berdasarkan nama hari'
    },
   accessibility: {
		announceNewData: {
			enabled: true
		},
		point: {
			valueSuffix: '%'
		}
	},
    plotOptions: {
		series:{
			dataLabels: {
				enabled: true,
				format:'{point.name}: {point.y:.1f}%'
			}
		}
	},

    tooltip: {
		headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
		pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
	},

	series: [
		{
			name: "Pendapatan By Month",
			colorByPoint: true,
			data: 
				<?php
					//TEKNIK GAK JELAS :D

					$datanya = $json_all_kat;
					$data1 = str_replace('["', '{"',$datanya);
					$data2 = str_replace('"]', '"}',$data1);
					$data3 = str_replace('[[', '[', $data2);
					$data4 = str_replace(']]', ']', $data3);
					$data5 = str_replace(':', '" : "', $data4);
					$data6 = str_replace('"name"', 'name', $data5);
					$data7 = str_replace('"drilldown"', 'drilldown', $data6);
					$data8 = str_replace('"y"', 'y', $data7);
					$data9 = str_replace('",', ',', $data8);
					$data10 = str_replace(',y', '",y', $data9);
					$data11 = str_replace(',y : "', ',y : ', $data10);
					echo $data11;
				?>

		}
	],
   drilldown: {
		series: [

				<?php
					//TEKNIK CLEAN
				echo $string_data;

				?>



		]
	}
});
</script>
</head>
</html>
