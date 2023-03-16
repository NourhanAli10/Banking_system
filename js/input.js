const inputs = document.querySelectorAll('input');
inputs.forEach(input => {
  input.addEventListener('focus', function() {
    this.placeholder = '';
  });
});
