function customConfigChartJs(containerId, chartTitle, data, dataLabel, bgColor, borderColor, configOptions) {
  const labels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
    'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12',];

  const dataObj = {
    labels: labels,
    datasets: [
      {
        label: dataLabel,
        fill: false,
        backgroundColor: bgColor,
        borderColor: borderColor,
        data: data
      }
    ]
  };

  const config = {
    type: 'line',
    data: dataObj,
    options: {
      plugins: {
        title: {
          display: true,
          text: chartTitle
        },
      },
      interaction: {
        mode: 'index',
        intersect: false
      },
      scales: {
        x: {
          display: true,
        },
        y: {
          display: true,
        }
      },
    }
  };

  Object.assign(config.options, configOptions);

  return new Chart(
    document.getElementById(containerId),
    config
  );
}

function updateChartData(chart, data) {
  chart.data.datasets[0].data = data;
  chart.update();

  return chart;
}