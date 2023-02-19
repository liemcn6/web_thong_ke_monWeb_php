let newCustomerStatisticChart;
let customerSpendingChart;

async function fetchChartData(apiURL, selectedYear) {
  function initChartDataArray(selectedYear) {
    if (selectedYear == new Date().getFullYear()) {
      return Array(new Date().getMonth() + 1).fill(0);
    }

    return Array(12).fill(0);
  }

  const response = await fetch(
    `${apiURL}/${selectedYear}`, {
    method: 'GET'
  });

  const res = await response.json();
  if (res.statusCode === '201') {
    const data = initChartDataArray(selectedYear);

    res.data.forEach((item) => {
      data[(+item.month) - 1] = item.value;
    });

    return data;
  }

  return null;
}

// create chart

(function () {
  window.addEventListener('load', async function () {
    const selectedYear = document.getElementById('new-customer-statistic-select').value;

    const data = await fetchChartData(
      'http://localhost/ltw-customer-management/api/admin/statistic/customer-increasing',
      selectedYear
    );

    if (data) {
      const config = {
        scales: {
          y: {
            ticks: {
              stepSize: 1,
            }
          }
        },
      };

      newCustomerStatisticChart = customConfigChartJs('new-customer-statistic',
        'Tăng trường khách hàng',
        data,
        'Lượng khách hàng mới',
        '#ff5478',
        'rgba(255, 84, 120, 0.5)',
        config
      );
    } else {
      console.log('Fetch new customer statistic error');
    }
  });

  window.addEventListener('load', async function () {
    const selectedYear = document.getElementById('customer-spending-select').value;

    const data = await fetchChartData(
      'http://localhost/ltw-customer-management/api/admin/statistic/total-income',
      selectedYear
    );

    if (data) {
      const config = {
        scales: {
          y: {
            ticks: {
              callback: function (value) {
                return (value / 1000000).toFixed() + 'M';
              }
            }
          }
        },
      };

      customerSpendingChart = customConfigChartJs('customer-spending',
        'Tổng chi tiêu khách hàng',
        data,
        'Chi tiêu',
        '#6464e6',
        'rgba(100, 100, 230, 0.5)',
        config
      );
    } else {
      console.log('Fetch customer spending error');
    }
  });
})();



// update chart on change select year
(function () {
  document.getElementById('new-customer-statistic-select')
    .addEventListener('change', function () {
      updateChart(
        'http://localhost/ltw-customer-management/api/admin/statistic/customer-increasing',
        this.value,
        newCustomerStatisticChart
      )
    });

  document.getElementById('customer-spending-select')
    .addEventListener('change', function () {
      updateChart(
        'http://localhost/ltw-customer-management/api/admin/statistic/total-income',
        this.value,
        customerSpendingChart
      );
    });

  async function updateChart(apiURL, selectedYear, chart) {
    const data = await fetchChartData(apiURL, selectedYear);

    if (data) {
      updateChartData(chart, data);
    }
    else {
      console.log('Update chart error');
    }
  }
})();


// get top spending customer
(function () {
  const topCustomerTable = document.querySelector('#statistic__top-customer tbody');
  const selectCriteria = document.getElementById('top-customer__criteria');

  window.addEventListener('load', updateTopCustomerTable);
  selectCriteria.addEventListener('change', updateTopCustomerTable);

  async function updateTopCustomerTable() {
    const response = await fetch(
      `http://localhost/ltw-customer-management/api/admin/statistic/customer-spending/${selectCriteria.value}`,
      {
        method: 'GET'
      }
    );

    const res = await response.json();
    if (res.statusCode === '201') {
      topCustomerTable.innerHTML = '';
      res.data.forEach((customer) => {
        topCustomerTable.insertAdjacentHTML(
          'beforeend',
          `<tr>
            <td>${customer.fullName}</td>
            <td>${customer.phoneNumber}</td>
            <td>${customer.totalSpending}</td>
          </tr>`
        );
      })
    }
  }
})();