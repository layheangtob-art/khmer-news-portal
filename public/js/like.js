document.addEventListener('turbo:load', function() {
    const likeBtns = document.querySelectorAll('.like-btn');
    
    likeBtns.forEach(btn => {
        // Remove previous event listeners if turbo caches the page
        const newBtn = btn.cloneNode(true);
        btn.parentNode.replaceChild(newBtn, btn);
        
        newBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // prevent bubbling if inside a card link
            
            const formId = this.getAttribute('data-form-id');
            const form = document.getElementById(formId);
            const url = form.action;
            const token = form.querySelector('input[name="_token"]').value;
            
            const icon = this.querySelector('.like-icon');
            const countSpan = this.querySelector('.like-count');
            
            // Simple click animation
            this.style.transform = 'scale(0.9)';
            setTimeout(() => this.style.transform = 'scale(1)', 150);

            fetch(url, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(async (response) => {
                const contentType = response.headers.get('content-type') || ''

                if (!response.ok) {
                    const bodyText = await response.text()
                    throw new Error(`Request failed (${response.status}): ${bodyText.slice(0, 200)}`)
                }

                if (!contentType.includes('application/json')) {
                    const bodyText = await response.text()
                    throw new Error(`Expected JSON but received: ${bodyText.slice(0, 200)}`)
                }

                return await response.json()
            })
            .then(data => {
                if(data.success) {
                    countSpan.textContent = data.likes;
                    if(this.classList.contains('btn-link')) {
                        // List view button style
                        if(data.has_liked) {
                            icon.classList.remove('far', 'text-muted');
                            icon.classList.add('fas', 'text-primary');
                        } else {
                            icon.classList.remove('fas', 'text-primary');
                            icon.classList.add('far', 'text-muted');
                        }
                    } else {
                        // Detail view button style
                        if(data.has_liked) {
                            this.classList.remove('btn-outline-primary');
                            this.classList.add('btn-primary', 'text-white');
                            icon.classList.remove('far');
                            icon.classList.add('fas');
                        } else {
                            this.classList.remove('btn-primary', 'text-white');
                            this.classList.add('btn-outline-primary');
                            icon.classList.remove('fas');
                            icon.classList.add('far');
                        }
                    }
                }
            })
            .catch(err => {
                console.error('Error:', err)
                alert(err.message || 'Something went wrong')
            });
        });
    });
});
