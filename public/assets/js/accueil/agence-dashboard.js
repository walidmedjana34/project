
const viewsCtx = document.getElementById('viewsChart').getContext('2d');
new Chart(viewsCtx, {
  type: 'line',
  data: {
    labels: [...Array(30).keys()].map(i => i + 1),
    datasets: [{
      label: 'Views',
      data: [120, 130, 125, 110, 100, 105, 120, 135, 130, 120, 115, 110, 95, 85, 90, 100, 115, 130, 140, 160, 180, 200, 220, 240, 230, 220, 215, 210, 205, 200],
      borderColor: '#4361ee',
      backgroundColor: 'rgba(67, 97, 238, 0.05)',
      borderWidth: 2,
      fill: true,
      tension: 0.4
    }]
  },
  options: {
    responsive: true,
    plugins: { 
      legend: { display: false },
      tooltip: {
        backgroundColor: '#1e293b',
        titleFont: { size: 13 },
        bodyFont: { size: 13 },
        padding: 12,
        cornerRadius: 8
      }
    },
    scales: { 
      y: { 
        beginAtZero: true,
        grid: {
          color: 'rgba(0,0,0,0.05)'
        }
      },
      x: {
        grid: {
          display: false
        }
      }
    }
  }
});

const convCtx = document.getElementById('conversionChart').getContext('2d');
new Chart(convCtx, {
  type: 'bar',
  data: {
    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
    datasets: [
      {
        label: 'Views',
        data: [320, 300, 340, 380],
        backgroundColor: 'rgba(67, 97, 238, 0.7)',
        borderRadius: 6,
        borderWidth: 0
      },
      {
        label: 'Visits',
        data: [50, 60, 70, 90],
        backgroundColor: 'rgba(76, 201, 240, 0.7)',
        borderRadius: 6,
        borderWidth: 0
      },
      {
        type: 'line',
        label: 'Conversion Rate',
        data: [15, 18, 20, 24],
        borderColor: '#f8961e',
        borderWidth: 2,
        pointBackgroundColor: '#fff',
        pointBorderColor: '#f8961e',
        pointBorderWidth: 2,
        pointRadius: 5,
        tension: 0.3
      }
    ]
  },
  options: {
    responsive: true,
    plugins: {
      tooltip: {
        backgroundColor: '#1e293b',
        titleFont: { size: 13 },
        bodyFont: { size: 13 },
        padding: 12,
        cornerRadius: 8
      }
    },
    scales: { 
      y: { 
        beginAtZero: true,
        grid: {
          color: 'rgba(0,0,0,0.05)'
        }
      },
      x: {
        grid: {
          display: false
        }
      }
    }
  }
});


const buttons = document.querySelectorAll('.view-toggle button');
buttons.forEach(btn => {
btn.addEventListener('click', () => {
buttons.forEach(b => b.classList.remove('active'));
btn.classList.add('active');
});
});

const tabs = document.querySelectorAll(".visit-tab-button");
const visitCount = document.getElementById("visit-count");
const visitData = {
all: 18,
pending: 3,
confirmed: 5,
completed: 7,
canceled: 3,
};

tabs.forEach(tab => {
tab.addEventListener("click", () => {
  tabs.forEach(t => t.classList.remove("active"));
  tab.classList.add("active");

  const tabType = tab.getAttribute("data-tab");
  visitCount.textContent = `Showing ${visitData[tabType]} visits`;
});
});

