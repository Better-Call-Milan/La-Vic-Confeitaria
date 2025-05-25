document.addEventListener('DOMContentLoaded', function () {
    const filter = document.getElementById('categoryFilter');
    const products = document.querySelectorAll('.product-card');

    filter.addEventListener('change', function () {
      const selected = this.value;

      products.forEach(product => {
        const category = product.dataset.category;

        if (selected === 'all' || category === selected) {
          product.style.display = '';
        } else {
          product.style.display = 'none';
        }
      });
    });
  });