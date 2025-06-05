 // Fetch the top users data from the server
 fetch('get_top_users.php')
 .then(response => response.json())
 .then(data => {
     if (data.error) {
         console.error(data.error);
         alert('Failed to load user data.');
         return;
     }

     // Prepare data for the chart
     const userNames = data.map(user => user.user_name);
     const totalQuantities = data.map(user => user.total_quantity);

     // Create the chart
     const ctx = document.getElementById('topUsersChart').getContext('2d');
     new Chart(ctx, {
         type: 'bar',
         data: {
             labels: userNames, // X-axis labels
             datasets: [{
                 label: 'Total Quantity',
                 data: totalQuantities, // Y-axis data
                 backgroundColor: [
                     'rgba(75, 192, 192, 0.2)',
                     'rgba(54, 162, 235, 0.2)',
                     'rgba(255, 206, 86, 0.2)',
                     'rgba(153, 102, 255, 0.2)',
                     'rgba(255, 159, 64, 0.2)',
                     'rgba(255, 99, 132, 0.2)',
                     'rgba(233, 196, 106, 0.2)',
                     'rgba(42, 157, 143, 0.2)',
                     'rgba(231, 111, 81, 0.2)',
                     'rgba(244, 162, 97, 0.2)'
                 ],
                 borderColor: [
                     'rgba(75, 192, 192, 1)',
                     'rgba(54, 162, 235, 1)',
                     'rgba(255, 206, 86, 1)',
                     'rgba(153, 102, 255, 1)',
                     'rgba(255, 159, 64, 1)',
                     'rgba(255, 99, 132, 1)',
                     'rgba(233, 196, 106, 1)',
                     'rgba(42, 157, 143, 1)',
                     'rgba(231, 111, 81, 1)',
                     'rgba(244, 162, 97, 1)'
                 ],
                 borderWidth: 1
             }]
         },
         options: {
             responsive: true,
             plugins: {
                 legend: {
                     display: true,
                     position: 'top'
                 }
             },
             scales: {
                 y: {
                     beginAtZero: true,
                     title: {
                         display: true,
                         text: 'Quantity'
                     }
                 },
                 x: {
                     title: {
                         display: true,
                         text: 'User Names'
                     }
                 }
             }
         }
     });
 })
 .catch(error => {
     console.error('Error fetching user data:', error);
     alert('Failed to load user data.');
 });