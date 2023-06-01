import './bootstrap';
import Alpine from 'alpinejs';
import jQuery from 'jquery';
import swal from 'sweetalert2';
import Quill from 'quill';

window.Alpine = Alpine;
Alpine.start();

window.Quill = Quill;

window.$ = jQuery;

window.Swal = swal;
