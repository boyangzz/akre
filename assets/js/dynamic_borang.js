/**
 * AKRE — Dynamic Borang Logic (Layer 3: Frontend)
 * Handles jenjang-based visibility of form fields and menu items
 */
var AKRE = AKRE || {};

AKRE.Borang = {
    currentJenjang: null,

    init: function() {
        this.currentJenjang = $('#jenjang-selector').val() || $('body').data('jenjang') || null;
        this.bindEvents();
    },

    bindEvents: function() {
        var self = this;
        // Jenjang selector change (on identitas page)
        $(document).on('change', '#jenjang-selector', function() {
            self.currentJenjang = $(this).val();
            self.refreshVisibility();
        });
    },

    /**
     * Hide/show elements based on jenjang
     * Usage: add data-jenjang='["S1","S2","S3"]' to any element
     */
    refreshVisibility: function() {
        var jenjang = this.currentJenjang;
        $('[data-jenjang]').each(function() {
            var allowed = $(this).data('jenjang');
            if (Array.isArray(allowed) && allowed.indexOf(jenjang) === -1) {
                $(this).hide().find('input, select, textarea').prop('disabled', true);
            } else {
                $(this).show().find('input, select, textarea').prop('disabled', false);
            }
        });
    },

    /**
     * Confirm delete action
     */
    confirmDelete: function(url, name) {
        if (confirm('Apakah Anda yakin ingin menghapus "' + name + '"?')) {
            window.location.href = url;
        }
    }
};

$(document).ready(function() {
    AKRE.Borang.init();

    // Enable Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(el) { return new bootstrap.Tooltip(el); });

    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        $('.alert-dismissible').fadeOut(500);
    }, 5000);
});
