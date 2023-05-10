function Open(props){
    var page = document.getElementById(props);
    if(page.style.display == 'none'){
        page.style.display = 'block';
    }else{
        page.style.display = 'none';
    }
}

function increaseCount(a, b) {
    var input = b.previousElementSibling;
    var value = parseInt(input.value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    input.value = value;
  }
  
  function decreaseCount(a, b) {
    var input = b.nextElementSibling;
    var value = parseInt(input.value, 10);
    if (value > 1) {
      value = isNaN(value) ? 0 : value;
      value--;
      input.value = value;
    }
  }

function Alert(){
    Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'logout'
        }).then((result) => {
        if (result.isConfirmed) {
            route('/logout');
        }
    })
}

function chart(){
    const data = {
        labels: ['Red', 'Orange', 'Yellow', 'Green', 'Blue'],
        datasets: [
          {
            label: 'Dataset 1',
            data: Utils.numbers(NUMBER_CFG),
            backgroundColor: Object.values(Utils.CHART_COLORS),
          }
        ]
      };
    const config = {
        type: 'pie',
        data: data,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: 'Chart.js Pie Chart'
            }
          }
        },
      };
}