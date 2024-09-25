document.addEventListener('DOMContentLoaded', () => {
    function setupCustomSelect(selectId, searchInputId, hiddenInputId) {
        const selectContainer = document.getElementById(selectId);
        const selectedItem = selectContainer.querySelector('.select-selected');
        const itemsContainer = selectContainer.querySelector('.select-items');
        const searchInput = document.getElementById(searchInputId);
        const hiddenInput = document.getElementById(hiddenInputId);


        selectedItem.addEventListener('click', () => {
            const isExpanded = selectContainer.getAttribute('aria-expanded') === 'true';
            selectContainer.setAttribute('aria-expanded', !isExpanded);
            itemsContainer.style.display = isExpanded ? 'none' : 'block';
        });


        let debounceTimer;
        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const filter = searchInput.value.toLowerCase();
                const items = itemsContainer.querySelectorAll('.select-item');
                items.forEach(item => {
                    const text = item.textContent || item.innerText;
                    item.style.display = text.toLowerCase().includes(filter) ? '' : 'none';
                });
            }, 300);
        });

        // Select item
        itemsContainer.addEventListener('click', (event) => {
            if (event.target.classList.contains('select-item')) {
                selectedItem.textContent = event.target.textContent;
                hiddenInput.value = event.target.getAttribute('data-value');
                itemsContainer.style.display = 'none';
                selectContainer.setAttribute('aria-expanded', 'false');
            }
        });

    
        document.addEventListener('click', (event) => {
            if (!selectContainer.contains(event.target)) {
                itemsContainer.style.display = 'none';
                selectContainer.setAttribute('aria-expanded', 'false');
            }
        });
    }

    setupCustomSelect('portebatiment-select', 'portebatiment-search', 'portebatiment');
});
