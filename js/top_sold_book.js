fetch('get_top_sold_book.php')
.then(response => response.text())
.then(data => {
    document.getElementById('topSoldBook').innerHTML = data;
})
.catch(error => console.error('Error fetching top sold book:', error));