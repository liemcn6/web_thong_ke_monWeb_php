// insert membership list to filter modal

(function () {
  window.onload = async function () {
    const selectElement = document.getElementById('filter-membership');

    const response = await fetch(
      'http://localhost/ltw-customer-management/api/admin/membership/all',
      {
        method: 'GET'
      }
    )

    const res = await response.json();
    if (res.statusCode === '201') {
      res.data.forEach((membership) => {
        const optionElement = document.createElement('option');
        optionElement.value = membership.id;
        optionElement.innerText = membership.name;

        selectElement.insertAdjacentElement('beforeend', optionElement);
      });
    } else {
      console.log(res.error);
    }
  }
})();

// search

(function () {
  const searchInput = document.getElementById('quick-search-input');
  const tableBody = document.querySelector('.search-result table tbody');
  let timeOutId = null;

  searchInput.addEventListener('keyup', function () {
    clearTimeout(timeOutId);
    timeOutId = setTimeout(search, 300);
  });

  async function search() {
    const value = searchInput.value;

    const response = await fetch(`http://localhost/ltw-customer-management/api/admin/customer?fullname=${value}`, {
      method: 'GET',
    });

    const res = await response.json();
    if (res.statusCode === '201') {
      updateUrlSearchParam(new URLSearchParams({ 'fullname': value }));

      removeAllChild(tableBody);
      res.data.forEach((customer) => {
        insertCustomerToTable(tableBody, customer);
      });
    }
  }
})();


// filter

(function () {
  const tableBody = document.querySelector('.search-result table tbody');

  // apply filter
  document.getElementById('apply-filter-btn').addEventListener('click', async () => {
    const searchParam = createURLSearchParam([
      { key: 'email', value: document.getElementById('filter-email').value },
      { key: 'membershipid', value: document.getElementById('filter-membership').value },
      { key: 'fullname', value: document.getElementById('filter-fullname').value },
      { key: 'id', value: document.getElementById('filter-customerid').value },
      { key: 'orderby', value: document.getElementById('sort-select').value },
      { key: 'ordertype', value: document.getElementById('sort-type-select').value },
    ]);

    const response = await fetch(
      `http://localhost/ltw-customer-management/api/admin/customer?${searchParam.toString()}`,
      {
        method: 'GET'
      }
    );

    const res = await response.json();
    if (res.statusCode === '201') {
      updateUrlSearchParam(searchParam);

      removeAllChild(tableBody);
      res.data.forEach((customer) => {
        insertCustomerToTable(tableBody, customer);
      })
    }
  });

  // clear filter
  document.getElementById('clear-filter-btn').addEventListener('click', async function () {
    window.location.search = '';
  })
})();

function insertCustomerToTable(tableBody, customer) {
  tableBody.insertAdjacentHTML(
    'beforeend',
    `<tr class="search-result__item" onclick="window.location.href='customer/${customer.id}'">
        <td class="client-id">${customer.id}</td>
        <td class="client-name">${customer.fullName}</td>
        <td class="client-gender">${customer.gender === 'male' ? 'Nam' : "Nữ"}</td>
        <td>
          <span class="client-membership">
            ${customer.membership.id === 1 ? 'Chưa có nhóm' : customer.membership.name}
          </span>
        </td>
        <td class="client-spending">
          ${new Intl.NumberFormat('vi-VN').format(customer.totalSpending)}
          <sup>đ</sup>
        </td>
      </tr>`
  );
}

function removeAllChild($parentElement) {
  while ($parentElement.firstChild) {
    $parentElement.removeChild($parentElement.firstChild);
  }
}

function createURLSearchParam(params) {
  const searchParam = new URLSearchParams(window.location.search);

  params.forEach((param) => {
    searchParam.set(param.key, param.value);
  })

  return searchParam;
}

function updateUrlSearchParam(searchParam) {
  history.pushState('update', 'param',
    `${window.location.origin}${window.location.pathname}?${searchParam.toString()}`
  );
}

// pagination

(function () {
  const currentPageElement = document.getElementById('current-page');

  let currentPage = +(new URLSearchParams(window.location.search).get('page')) || 1;
  currentPageElement.value = currentPage;

  document.getElementById('pagination-prev').addEventListener('click', () => {
    if (currentPage <= 1) return;

    currentPage -= 1;
    const searchParams = new URLSearchParams(window.location.search);
    searchParams.set('page', currentPage);
    window.location.search = searchParams.toString();
  });

  document.getElementById('pagination-next').addEventListener('click', () => {
    currentPage += 1;
    const searchParams = new URLSearchParams(window.location.search);
    searchParams.set('page', currentPage);
    window.location.search = searchParams.toString();
  });
})();