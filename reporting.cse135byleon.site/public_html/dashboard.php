<?php
include 'inc/config.php';

if (!$identifier) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel='stylesheet' href='style.css'>
    <style>
      .container {
	  text-align: center;
      }
      .centered {
	  display: inline-block;
      }
    </style>
</head>

<body>
<?php
    setup_tab(basename(__FILE__));
?>

    <h2>Welcome, <?= $identifier ?><?= $is_admin ? ' (admin)' : '' ?>!</h2>
    <div class='container'>
      <div id='hour-chart' class='centered'></div>
    </div>
    <div class='container'>
      <div id='ua-chart' class='centered'></div>
    </div>

    
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
      // Line Chart on #users over 24 hours
      fetch('/api/visithour')
      .then (response => response.json())
      .then (json => {
        let total = new Array(24).fill(0);
	json.forEach(row => {
	   total[row['hr']] = row['cnt'];
	});
	
	var myConfig = {
	    type: "line",
	    title: { text: '#Users over a day' },
	    legend: {},
	    'scale-x': { values: Array.from(total.keys()) },
	    series: [ { values: total } ],
	};
	zingchart.render({
	    id: 'hour-chart',
	    data: myConfig,
	    height: 400,
	    width: '70%'
	});
      });
    </script>
      
    <script>
      // Pie Chart on User Agents
      fetch('/api/useragent')
      .then (response => response.json())
      .then (json => {
	let firefox = 0;
	let chrome= 0;
	let opera = 0;
	let edge = 0;
	let safari = 0;
	let others = 0;
	json.forEach(row => {
	    let ua = row['ua'];
	    let cnt = row['cnt'];
	    if (ua.includes('E')) {
	       edge = cnt;
	    } else if (ua.includes('O')) {
	       opera = cnt;
	    } else if (ua.includes('F')) {
	       firefox = cnt;
	    } else if (ua.includes('CS')) {
	       chrome = cnt;
	    } else if (ua.includes('S')) {
	       safari = cnt;
	    } else {
	       others = cnt;
	    }
	});
	var myConfig = {
	    type: "pie",
	    legend: {},
	    title:  { text: "User Agents" },
	    series: []
	};
	if (firefox) {
	    myConfig.series.push({ values: [firefox], text: "firefox" });
	}
	if (chrome) {
	    myConfig.series.push({ values: [chrome], text: "chrome" });
	}
	if (opera) {
	    myConfig.series.push({ values: [opera], text: "opera" });
	}
	if (edge) {
	    myConfig.series.push( { values: [edge], text: "edge" } );
	}
	if (safari) {
	    myConfig.series.push( { values: [safari], text: "safari" } );
	}
	if (others) {
	    myConfig.series.push( { values: [others], text: "others" } );
	}
	zingchart.render({
	    id: 'ua-chart',
	    data: myConfig,
	    height: 400,
	    width: 500
	});
    });
    </script>
</body>
</html>
