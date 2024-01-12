import './bootstrap';
import $ from "jquery";
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.$ = window.jQuery = $;

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

