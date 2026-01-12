/**
 * Search functionality for Khmer news portal - Title focused
 */
$(document).ready(function() {
    let searchTimeout;
    const searchInput = $('#searchInput');
    const searchLoading = $('#searchLoading');
    const searchDefault = $('#searchDefault');
    const searchResults = $('#searchResults');
    const searchResultsList = $('#searchResultsList');
    const searchResultsCount = $('#searchResultsCount');
    const noResults = $('#noResults');

    // Get the current base URL dynamically
    const baseUrl = window.location.origin;

    // Reset search state when modal is shown
    $('#searchModal').on('shown.bs.modal', function () {
        searchInput.focus();
        resetSearch();
    });

    // Search input event handler
    searchInput.on('input', function() {
        const query = $(this).val().trim();
        
        // Clear previous timeout
        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }

        // Reset if empty
        if (query === '') {
            resetSearch();
            return;
        }

        // Show loading and delay search
        showLoading();
        searchTimeout = setTimeout(function() {
            performSearch(query);
        }, 300); // Reduced delay for better responsiveness
    });

    // Handle enter key
    searchInput.on('keypress', function(e) {
        if (e.which === 13) { // Enter key
            e.preventDefault();
            const query = $(this).val().trim();
            if (query !== '') {
                if (searchTimeout) {
                    clearTimeout(searchTimeout);
                }
                performSearch(query);
            }
        }
    });

    function resetSearch() {
        hideAll();
        searchDefault.removeClass('d-none');
        searchInput.val('');
    }

    function showLoading() {
        hideAll();
        searchLoading.removeClass('d-none');
    }

    function hideAll() {
        searchDefault.addClass('d-none');
        searchLoading.addClass('d-none');
        searchResults.addClass('d-none');
        noResults.addClass('d-none');
    }

    function performSearch(query) {
        console.log('Searching for:', query);
        
        $.ajax({
            url: baseUrl + "/search",
            method: 'GET',
            data: { q: query },
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            success: function(response) {
                console.log('Search response:', response);
                hideAll();
                
                if (response.success && response.data && response.data.length > 0) {
                    displayResults(response.data, response.message);
                } else {
                    showNoResults();
                }
            },
            error: function(xhr, status, error) {
                console.error('Search error:', error, xhr.responseText);
                hideAll();
                showNoResults();
            }
        });
    }

    function showNoResults() {
        noResults.removeClass('d-none');
    }

    function displayResults(results, message) {
        searchResultsCount.text(message);
        searchResultsList.empty();

        results.forEach(function(item) {
            // Use highlighted title if available, otherwise use regular title
            const displayTitle = item.highlighted_title || escapeHtml(item.title);
            const matchTypeIcon = item.match_type === 'title' 
                ? '<i class="fas fa-star text-warning me-1" title="Title match"></i>' 
                : '<i class="fas fa-file-alt text-info me-1" title="Content match"></i>';

            const resultHtml = `
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 search-result-card">
                        ${item.image ? `
                            <div class="position-relative" style="height: 180px; overflow: hidden;">
                                <img src="${item.image}" 
                                     class="card-img-top w-100 h-100" 
                                     style="object-fit: cover;" 
                                     alt="${escapeHtml(item.title)}"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="card-img-top bg-light align-items-center justify-content-center" style="height: 180px; display: none;">
                                    <i class="fas fa-newspaper fa-2x text-muted"></i>
                                </div>
                            </div>
                        ` : `
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                <i class="fas fa-newspaper fa-2x text-muted"></i>
                            </div>
                        `}
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-primary">${escapeHtml(item.category)}</span>
                                <small class="text-muted">${escapeHtml(item.created_at)}</small>
                            </div>
                            <h6 class="card-title mb-2">
                                ${matchTypeIcon}
                                <a href="${item.url}" class="text-decoration-none text-dark stretched-link">
                                    ${displayTitle}
                                </a>
                            </h6>
                            <p class="card-text text-muted small mb-2">${escapeHtml(item.content)}</p>
                            <div class="mt-auto">
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>${escapeHtml(item.author)}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            searchResultsList.append(resultHtml);
        });

        searchResults.removeClass('d-none');
    }

    // Helper function to escape HTML for security
    function escapeHtml(text) {
        if (!text) return '';
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    // Close modal when clicking on a result
    $(document).on('click', '.stretched-link', function() {
        $('#searchModal').modal('hide');
    });

    // Add hover effect for search result cards
    $(document).on('mouseenter', '.search-result-card', function() {
        $(this).addClass('shadow-lg');
    }).on('mouseleave', '.search-result-card', function() {
        $(this).removeClass('shadow-lg');
    });
});