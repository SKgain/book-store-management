document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
    const target = this.getAttribute('href');
    if (target.startsWith('#')) {
        e.preventDefault();
        document.querySelector(target).scrollIntoView({
        behavior: 'smooth',
         block: 'start'
      });
            }
                 });
                       });
