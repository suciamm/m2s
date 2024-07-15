document.querySelector('.php-email-form').addEventListener('submit', function(e) {
    e.preventDefault();
    var form = this;
    var action = form.getAttribute('action'); // Pastikan variabel action didefinisikan di sini
    var formData = new FormData(form);
  
    fetch(action, {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(response => {
      console.log(response); // Tambahkan ini untuk melihat respon dari server
      if (response.trim() === 'success') {
        form.querySelector('.sent-message').style.display = 'block';
        form.reset();
      } else {
        form.querySelector('.error-message').innerText = response;
        form.querySelector('.error-message').style.display = 'block';
      }
    })
    .catch(error => {
      // console.error('Error:', error);
      form.querySelector('.error-message').innerText = 'An error occurred while sending the message. Please try again later.';
      form.querySelector('.error-message').style.display = 'block';
    });
  });
  