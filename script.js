document.addEventListener('DOMContentLoaded', () => {
    const errorModal = document.getElementById('errorModal');
    const errorMessage = document.getElementById('errorMessage');
    const closeModal = document.querySelector('.close');

    // Function to show error message
    function showError(message) {
        errorMessage.textContent = message;
        errorModal.style.display = 'block';
    }

    // Close the modal
    closeModal.addEventListener('click', () => {
        errorModal.style.display = 'none';
    });

    // Form submit handler
    document.getElementById('loginForm').addEventListener('submit', async (event) => {
        event.preventDefault();

        const formData = new FormData(event.target);
        const response = await fetch('login.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        if (result.error) {
            showError(result.error);
        } else {
            window.location.href = 'agent/index.php';
        }
    });
});
