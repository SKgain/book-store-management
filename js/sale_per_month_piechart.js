 // Fetch the data for the pie chart
 fetch('get_pie_chart_data.php')
 .then(response => response.json())
 .then(data => {
     // Extract labels and values from the JSON response
     const labels = data.map(item => item.month);
     const values = data.map(item => item.total);

     // Render the pie chart
     const ctx = document.getElementById('pieChart').getContext('2d');
     new Chart(ctx, {
         type: 'pie',
         data: {
             labels: labels,
             datasets: [{
                 label: 'Books Sold',
                 data: values,
                 backgroundColor: [
                     'rgba(255, 99, 132, 0.6)',
                     'rgba(54, 162, 235, 0.6)',
                     'rgba(255, 206, 86, 0.6)',
                     'rgba(75, 192, 192, 0.6)',
                     'rgba(153, 102, 255, 0.6)',
                     'rgba(255, 159, 64, 0.6)',
                     'rgba(99, 255, 132, 0.6)',
                     'rgba(235, 54, 162, 0.6)',
                     'rgba(86, 206, 255, 0.6)',
                     'rgba(192, 75, 192, 0.6)',
                     'rgba(255, 153, 102, 0.6)',
                     'rgba(64, 159, 255, 0.6)'
                 ],
                 borderColor: 'rgba(255, 255, 255, 1)',
                 borderWidth: 1
             }]
         },
         options: {
             responsive: true,
             plugins: {
                 legend: {
                     position: 'top',
                 },
                 title: {
                     display: true,
                     text: 'Books Sold Per Month'
                 }
             }
         }
     });
 })
 .catch(error => console.error('Error fetching pie chart data:', error));