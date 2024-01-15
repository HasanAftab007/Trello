import './bootstrap';
import $ from "jquery";
import Alpine from 'alpinejs';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

window.Alpine = Alpine;

Alpine.start();

window.$ = window.jQuery = $;
$(function () {

    class MyUploadAdapter {
        constructor(loader, columnId) {
            this.loader = loader;
            this.columnId = columnId;
        }

        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    this._initRequest();
                    this._initListeners(resolve, reject, file);
                    this._sendRequest(file);
                }));
        }

        abort() {
            if (this.xhr) {
                this.xhr.abort();
            }
        }

        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();

            xhr.open('POST', uploadImgUrl, true);
            xhr.setRequestHeader('x-csrf-token', $('meta[name="csrf-token"]').attr('content'));
            xhr.responseType = 'json';
        }

        _initListeners(resolve, reject, file) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${file.name}.`;

            xhr.addEventListener('error', () => reject(genericErrorText));
            xhr.addEventListener('abort', () => reject());
            xhr.addEventListener('load', () => {
                const response = xhr.response;

                if (!response || response.error) {
                    return reject(response && response.error ? response.error.message : genericErrorText);
                }
                resolve({
                    default: response.url
                });
            });
            if (xhr.upload) {
                xhr.upload.addEventListener('progress', evt => {
                    if (evt.lengthComputable) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                });
            }
        }

        _sendRequest(file) {
            const data = new FormData();

            data.append('upload', file);

            data.append('column_id', columnId);

            this.xhr.send(data);
        }

    }

    var columnId = '';

    $(document).on('setcolumnid', function ($e) {
        columnId = $e.detail.value;
    })

    function SimpleUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader, columnId);
        };
    }

    var ck5Elements = $('.ck5');

    ck5Elements.each(function (index, element) {
        ClassicEditor
            .create(element, {
                extraPlugins: [SimpleUploadAdapterPlugin],
            })
            .then((editor) => {
                editor.model.document.on('change:data', () => {
                    let componentId = Livewire.getByName('column-manager')[0].id;
                    let elementId = editor.sourceElement.getAttribute('id');
                    if (elementId === 'cardDescription') {
                        Livewire.find(componentId).set('cardDescription', editor.getData());
                    } else if (elementId === 'cardActivity') {
                        Livewire.find(componentId).set('cardActivity', editor.getData());
                    }
                })
            })
            .catch(error => {
                console.error(error);
            });
    });
});

Livewire.on('reset-input-field', function () {
    var columnInputField = $('#column-input-field')[0];
    $(columnInputField).val('')
})

$(function () {
    $(document).on('reset-input-title-field', function () {
        var columnInputField = $('#column-title-input-field')[0];
        $(columnInputField).val('')
    });
});

$(function () {
    $(document).on('reset-field', function () {
        var columnInputField = $('#column-input-field')[0];
        $(columnInputField).val('')
    });
});

