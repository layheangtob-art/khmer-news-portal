// Multiple Images Preview Handler
document.addEventListener('DOMContentLoaded', function() {
    // Main image preview
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
            }
        });
    }

    // Additional images preview
    const additionalImagesInput = document.getElementById('additionalImagesInput');
    const additionalImagesPreview = document.getElementById('additionalImagesPreview');

    if (additionalImagesInput && additionalImagesPreview) {
        additionalImagesInput.addEventListener('change', function(e) {
            // Clear previous previews
            additionalImagesPreview.innerHTML = '';

            const files = Array.from(e.target.files);
            
            if (files.length > 0) {
                // Hide existing images when new ones are selected
                const existingImages = document.getElementById('existingImages');
                if (existingImages) {
                    existingImages.style.opacity = '0.5';
                    const replaceNote = document.createElement('div');
                    replaceNote.className = 'alert alert-info mt-2';
                    replaceNote.innerHTML = '<small><i class="fas fa-info-circle"></i> The images below will replace your current additional images when you save.</small>';
                    additionalImagesPreview.appendChild(replaceNote);
                }

                files.forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const colDiv = document.createElement('div');
                            colDiv.className = 'col-md-3 mb-3';
                            
                            const imgContainer = document.createElement('div');
                            imgContainer.className = 'position-relative';
                            
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-fluid rounded border';
                            img.style.cssText = 'max-width: 150px; height: 100px; object-fit: cover;';
                            
                            const removeBtn = document.createElement('button');
                            removeBtn.type = 'button';
                            removeBtn.className = 'btn btn-danger btn-sm position-absolute';
                            removeBtn.style.cssText = 'top: 5px; right: 5px; padding: 2px 6px;';
                            removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                            removeBtn.onclick = function() {
                                removeImageFromInput(additionalImagesInput, index);
                                colDiv.remove();
                            };
                            
                            const fileName = document.createElement('small');
                            fileName.className = 'text-muted d-block mt-1';
                            fileName.textContent = file.name;
                            
                            imgContainer.appendChild(img);
                            imgContainer.appendChild(removeBtn);
                            colDiv.appendChild(imgContainer);
                            colDiv.appendChild(fileName);
                            additionalImagesPreview.appendChild(colDiv);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            } else {
                // Show existing images again if no new files selected
                const existingImages = document.getElementById('existingImages');
                if (existingImages) {
                    existingImages.style.opacity = '1';
                }
            }
        });
    }

    // Function to remove image from file input
    function removeImageFromInput(input, indexToRemove) {
        const dt = new DataTransfer();
        const files = input.files;
        
        for (let i = 0; i < files.length; i++) {
            if (i !== indexToRemove) {
                dt.items.add(files[i]);
            }
        }
        
        input.files = dt.files;
        
        // Trigger change event to update preview
        input.dispatchEvent(new Event('change'));
    }
});