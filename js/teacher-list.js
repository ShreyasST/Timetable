document.addEventListener('DOMContentLoaded', function() {
    initializeFilters();
    initializeSearch();
    initializeActions();
});

function initializeFilters() {
    const filters = document.querySelectorAll('select[id$="Filter"]');
    filters.forEach(filter => {
        filter.addEventListener('change', applyFilters);
    });
    
    document.getElementById('resetFilters').addEventListener('click', resetFilters);
}

function initializeSearch() {
    const searchInput = document.getElementById('teacherSearch');
    searchInput.addEventListener('input', debounce(searchTeachers, 300));
}

function initializeActions() {
    const actionButtons = document.querySelectorAll('.action-buttons button');
    actionButtons.forEach(button => {
        button.addEventListener('click', handleAction);
    });
}

function applyFilters() {
    // Add filter logic
}

function resetFilters() {
    // Reset all filters
}

function searchTeachers(e) {
    const searchTerm = e.target.value.toLowerCase();
    // Add search logic
}

function handleAction(e) {
    const action = e.currentTarget.classList.contains('view-btn') ? 'view' :
                  e.currentTarget.classList.contains('edit-btn') ? 'edit' :
                  'delete';
    
    // Handle different actions
    console.log(`Action ${action} clicked`);
}

// Utility function for debouncing
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
} 