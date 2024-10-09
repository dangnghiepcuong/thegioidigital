import {
    ClassicEditor,
    Essentials,
    Heading,
    Paragraph,
    Alignment,
    Bold,
    Italic,
    Font,
    List,
    Strikethrough,
    Subscript,
    Superscript,
    BlockQuote,
    Link,
    Image,
    ImageCaption,
    ImageResize,
    ImageStyle,
    ImageToolbar,
    LinkImage,
    ImageUpload,
    Code,
    CodeBlock,
    TodoList,
    SimpleUploadAdapter
} from 'ckeditor5';
import 'ckeditor5/ckeditor5.css';
import { popupPanel } from '/resources/js/animation';
window.popupPanel = popupPanel;

$(document).ready(async function () {
    let productId = $('#product-id').val()
    let description = $('#wysiwyg-product-description').html()

    ClassicEditor
        .create(document.querySelector('#wysiwyg-product-description'),
            {
                plugins: [
                    Essentials,
                    Heading,
                    Paragraph,
                    Alignment,
                    Bold,
                    Italic,
                    Font,
                    List,
                    TodoList,
                    Strikethrough,
                    Subscript,
                    Superscript,
                    BlockQuote,
                    Link,
                    Image,
                    ImageCaption,
                    ImageResize,
                    SimpleUploadAdapter,
                    ImageStyle,
                    ImageToolbar,
                    LinkImage,
                    ImageUpload,
                    Code,
                    CodeBlock,
                ],
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading', 'alignment',
                        '|', 'bold', 'italic', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                        '|', 'bulletedList', 'numberedList', 'todoList', 'blockQuote', '|',
                        '-',
                        'strikethrough', 'subscript', 'superscript',
                        '|', 'link', 'code', 'codeBlock',
                        '|', 'uploadImage', 'imageStyle:block', 'imageStyle:side', 'imageStyle:inline', 'imageResizeEditing',
                        'toggleImageCaption', 'imageTextAlternative',
                    ],
                    toolbar: [
                    ],
                },
                simpleUpload: {
                    uploadUrl: '/admin/products/files/description-images',
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf-token').val(),
                    },
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                },
                fontFamily: {
                    options: [
                        'default',
                        'Ubuntu, Arial, sans-serif',
                        'Ubuntu Mono, Courier New, Courier, monospace'
                    ]
                },
                fontColor: {
                    colorPicker: {
                        format: 'hex'
                    }
                },
                initialData: description,
                language: {
                    ui: 'en',
                    content: 'Vietnamese'
                }
            })
        .then(newEditor => {
            window.productDescriptionEditor = newEditor;
        })
        .catch(error => {
            throw error;
        });

    $('#btn-demo-product-description').on('click', function () {
        const editorData = window.productDescriptionEditor.getData();
        $('#layout-demo-product-description').html(editorData)
        popupPanel('show')
    })
})
