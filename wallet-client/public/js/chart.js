var data = [];
var lastDate = new Date().getTime();
var XAXISRANGE = 60000;

function getNewSeries(lastDate, yrange) {
    var newDate = lastDate + 1000; 
    lastDate = newDate;
    var newValue = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
    data.push({
        x: newDate,
        y: newValue
    });
    if (data.length > 10) data.shift();
}

getNewSeries(lastDate, { min: 10, max: 90 });


  
var options = {
      series: [{
        name: "Desktops",
        data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
    }],
      chart: {
      height: 350,
      type: 'line',
      zoom: {
        enabled: false
      }
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'straight'
    },
    title: {
      text: 'Product Trends by Month',
      align: 'left'
    },
    grid: {
      row: {
        colors: ['#f3f3f3', 'transparent'], 
        opacity: 0.5
      },
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
    }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
  

    const sidebarBurgerMenu = document.querySelector('.sidebar-burger-menu');
const sidebar = document.querySelector('.sidebar');

sidebarBurgerMenu.addEventListener('click', () => {
    sidebar.classList.toggle('active-s');
    sidebarBurgerMenu.classList.toggle('active-s');
});

document.addEventListener('click', (e) => {
    if (!sidebar.contains(e.target) && !sidebarBurgerMenu.contains(e.target)) {
        sidebar.classList.remove('active-s');
        sidebarBurgerMenu.classList.remove('active-s');
    }
});

// Handle window resize
window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('active-s');
        sidebarBurgerMenu.classList.remove('active-s');
    }
});
