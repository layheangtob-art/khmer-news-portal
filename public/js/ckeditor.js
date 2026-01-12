import {
    DecoupledEditor,
    Essentials,
    Bold,
    Italic,
    Underline,
    Strikethrough,
    Code,
    Subscript,
    Superscript,
    Font,
    Paragraph,
    Heading,
    List,
    Indent,
    IndentBlock,
    HorizontalLine,
    BlockQuote,
    Link,
    Table,
    TableToolbar,
    Image,
    ImageToolbar,
    ImageCaption,
    ImageStyle,
    ImageUpload,
    MediaEmbed,
    FindAndReplace
} from 'ckeditor5';

let editor;
let previousEditorContent;

document.addEventListener('DOMContentLoaded', () => {
    const initialContent = document.querySelector('#contentInput')?.value ?? '';
    const editorElement = document.querySelector('#editor');
    if (!editorElement) return;

DecoupledEditor
    .create(editorElement, {
        plugins: [
            Essentials,
            // Text styles
            Bold, Italic, Underline, Strikethrough, Code, Subscript, Superscript,
            // Fonts
            Font,
            // Structure
            Paragraph, Heading, List, Indent, IndentBlock, HorizontalLine, BlockQuote,
            // Links & media
            Link,
            Table, TableToolbar,
            Image, ImageToolbar, ImageCaption, ImageStyle, ImageUpload,
            MediaEmbed,
            // Utilities
            FindAndReplace
        ],
        toolbar: {
            items: [
                'heading', '|',
                'bold', 'italic', 'underline', 'strikethrough', 'code', 'subscript', 'superscript', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|',
                'horizontalLine', 'blockQuote', '|',
                'link', 'insertTable', 'imageUpload', 'mediaEmbed', '|',
                'findAndReplace', '|',
                'undo', 'redo'
            ]
        },
        image: {
            upload: {
                types: ['jpeg', 'jpg', 'png', 'gif']
            },
            toolbar: [
                'imageTextAlternative', 'toggleImageCaption', 'imageStyle:inline', 'imageStyle:block', 'imageStyle:side'
            ]
        },
        table: {
            contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
        }
    })
    .then(ed => {
        editor = ed;
        window.editor = ed;
        
        // Configure custom upload adapter
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new CustomUploadAdapter(loader);
        };
        
        const toolbarContainer = document.querySelector('#toolbar-container');
        if (toolbarContainer) {
            toolbarContainer.appendChild(editor.ui.view.toolbar.element);
        }
        editor.setData(initialContent);
        previousEditorContent = editor.getData();

        const submitBtn = document.getElementById('CKsubmitButton');
        const formEl = document.getElementById('form');

        async function handleSubmit(event) {
            event.preventDefault();

            const formData = new FormData(formEl);
            const editorData = editor.getData();
            formData.set('content', editorData);

            const confirmResult = await Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                confirmButtonText: 'Yes, submit it!',
                showCancelButton: true,
                cancelButtonText: 'No, cancel',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success mx-1',
                    cancelButton: 'btn btn-secondary mx-1'
                },
            });

            if (!confirmResult.isConfirmed) return;

            try {
                const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch(formEl.getAttribute('action'), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    credentials: 'same-origin',
                    body: formData
                });

                const data = await response.json();
                if (response.ok && data.success) {
                    showAlert('success', data.message, data.redirect_url);
                } else {
                    const message = data?.message || 'Error';
                    showAlert('error', message);
                }
            } catch (err) {
                showAlert('error', err?.message || 'Error');
            }
        }

        // Intercept both button click and plain form submit (Enter key, etc.)
        if (submitBtn) submitBtn.addEventListener('click', handleSubmit);
        if (formEl) formEl.addEventListener('submit', handleSubmit);

        const discardBtn = document.getElementById('CKdiscardButton');
        if (discardBtn) {
            discardBtn.addEventListener('click', function(event) {
                event.preventDefault();
                const form = document.getElementById('form');
                showDiscardConfirmation(form);
            });
        }

    })
    .catch(error => {
        console.error('Error initializing CKEditor:', error);
    });
});

function showDiscardConfirmation(form) {
    Swal.fire({
        title: 'Discard changes?',
        text: 'Are you sure you want to discard all changes?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, discard it',
        cancelButtonText: 'No, cancel',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-danger mx-1',
            cancelButton: 'btn btn-secondary mx-1'
        },
        reverseButtons: true
    }).then((discardResult) => {
        if (discardResult.isConfirmed) {
            if (form) {
                form.reset();
                const inputFile = form.querySelector('input[type="file"]');
                const imagePreview = document.getElementById('imagePreview');
                if (inputFile) inputFile.value = '';
                if (imagePreview) {
                    imagePreview.src = '';
                    imagePreview.style.display = 'none';
                }
            }
            editor.setData(previousEditorContent);

            Swal.fire({
                title: 'Changes discarded',
                text: '',
                icon: 'info',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-info',
                },
            });
        }
    });
}

function showAlert(type, message, redirectUrl = null) {
    Swal.fire({
        icon: type,
        title: type === 'success' ? 'Success' : 'Error',
        text: message,
        buttonsStyling: false,
        customClass: {
            confirmButton: type === 'success' ? 'btn btn-success' : 'btn btn-danger',
        },
    }).then((result) => {
        if (result.isConfirmed && type === 'success' && redirectUrl) {
            window.location.href = redirectUrl;
        }
    });
}

// Custom Upload Adapter for CKEditor
class CustomUploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        return this.loader.file
            .then(file => new Promise((resolve, reject) => {
                const data = new FormData();
                data.append('upload', file);

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                
                fetch('/news/upload-image', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: data
                })
                    .then(async (response) => {
                        let result = null;
                        try {
                            result = await response.json();
                        } catch {
                            result = null;
                        }

                        if (!response.ok) {
                            const message =
                                result?.error?.message ||
                                result?.message ||
                                `Upload failed (${response.status})`;
                            throw new Error(message);
                        }

                        if (result?.url) {
                            resolve({ default: result.url });
                            return;
                        }

                        throw new Error(result?.error?.message || 'Upload failed');
                    })
                    .catch(error => {
                        reject(error);
                    });
            }));
    }

    abort() {
        // Reject promise returned from upload() method.
    }
}
