import './bootstrap';
import $ from "jquery";
import Alpine from 'alpinejs';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import 'livewire-sortable';
import {loadStripe} from '@stripe/stripe-js';

window.Alpine = Alpine;

Alpine.start();

window.stripe = await loadStripe('pk_test_51OTJ0JEanesbsHoPwTAkRmvRHBHLl7HbgqPf5rbajjhS3pu5lJMTYTI1A0uxB5mwP2MTJucdatWaf9vI5r3oYQqh00JMk1wLUX');

window.$ = window.jQuery = $;

Livewire.on('rerender-ckeditor', function () {
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

            if (!element.hasAttribute('ckeditor-initialized')) {

                element.setAttribute('ckeditor-initialized', 'true');

                ClassicEditor.create(element, {

                    extraPlugins: [SimpleUploadAdapterPlugin],

                }).then((editor) => {

                    editor.model.document.on('change:data', () => {

                        let componentId = Livewire.getByName('column-manager')[0].id;
                        let elementId = editor.sourceElement.getAttribute('id');

                        if (elementId === 'cardDescription') {
                            Livewire.find(componentId).set('cardDescription', editor.getData());
                        } else if (elementId === 'cardActivity') {
                            Livewire.find(componentId).set('cardActivity', editor.getData());
                        }

                    });
                });
            }
        });
    });
});

$(function () {
    Livewire.on('reset-input-field', function () {
        var columnInputField = $('#column-input-field')[0];
        $(columnInputField).val('')
    })
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

Livewire.on('displayPaymentIntentField', function () {
    $(function () {
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#aab7c4',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '18px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        var card = elements.create('card', {
            hidePostalCode: true,
            style: style,
        });
        var htmlElement = $('#card-element');
        if (htmlElement.length > 0) {
            card.mount(htmlElement[0]);
            card.addEventListener('change', function (event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = $(cardButton).data('secret');
            const checkoutSubmitBtn = $("#checkout-submit-btn")[0];

            function toggleFormButtonState(state) {
                $(checkoutSubmitBtn).prop('disabled', state);
            }

            try {

                checkoutSubmitBtn.addEventListener('click', async (e) => {
                    event.preventDefault();
                    toggleFormButtonState(true)
                    const {setupIntent, error} =
                        await stripe.confirmCardSetup(
                            clientSecret, {
                                payment_method: {
                                    card: card,
                                    billing_details: {name: cardHolderName.value}
                                },
                            }
                        );
                    if (error) {
                        var errorElement = $('#card-errors');
                        errorElement.text(error.message);
                        toggleFormButtonState(false);
                    } else {
                        paymentMethodHandler(setupIntent.payment_method);
                    }
                });
            } catch (err) {
                console.log(err);
            } finally {
                toggleFormButtonState(false);
            }

            function paymentMethodHandler(payment_method) {
                var subscriptionForm = $('#subscription-form');
                var hiddenInput = $('<input>').attr('type', 'hidden').attr('name', 'payment_method').val(payment_method);
                subscriptionForm.append(hiddenInput);
                subscriptionForm.submit();
            }
        }
    })

})
