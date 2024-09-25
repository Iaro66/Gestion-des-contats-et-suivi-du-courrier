document.addEventListener('DOMContentLoaded', function() {

  function toggleField(containerId) {
      const container = document.getElementById(containerId);
      container.style.display = container.style.display === 'none' ? 'block' : 'none';
  }

  document.getElementById('show-porte-button').addEventListener('click', function() {
      toggleField('new-porte-container');
  });

  document.getElementById('show-service-button').addEventListener('click', function() {
      toggleField('new-service-container');
  });

  document.getElementById('show-division-button').addEventListener('click', function() {
      toggleField('new-division-container');
  });

  document.getElementById('show-ministere-button').addEventListener('click', function() {
      toggleField('new-ministere-container');
  });

  // Form validation
  const form = document.querySelector('.crud-form');
  form.addEventListener('submit', function(event) {
      let valid = true;
      const requiredFields = form.querySelectorAll('[required]');
      
      requiredFields.forEach(field => {
          if (!field.value.trim()) {
              valid = false;
              field.classList.add('invalid');
          } else {
              field.classList.remove('invalid');
          }
      });
      
      if (!valid) {
          event.preventDefault();
          alert('Veuillez remplir tous les champs requis.');
      }
  });

  // Search functionality
  document.getElementById('search-input').addEventListener('input', function() {
      const query = this.value.toLowerCase();
      const rows = document.querySelectorAll('#table tbody tr');
      rows.forEach(row => {
          const cells = row.querySelectorAll('td');
          const matched = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(query));
          row.style.display = matched ? '' : 'none';
      });
  });

  // Notification display function
  function showNotification(message, type = 'success') {
      const notification = document.createElement('div');
      notification.className = `notification ${type}`;
      notification.textContent = message;
      document.body.appendChild(notification);
      
      setTimeout(() => {
          notification.remove();
      }, 3000);
  }

    if (window.notificationMessage) {
      showNotification(window.notificationMessage, window.notificationType);
  }
});
