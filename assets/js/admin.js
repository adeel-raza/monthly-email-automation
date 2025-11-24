jQuery(document).ready(function($) {
    // Add recipient
    $('#mea-add-recipient').on('click', function() {
        var newRow = $('<div class="mea-recipient-row" style="margin-bottom: 5px;">' +
            '<input type="email" name="mea_recipients[]" value="" class="regular-text" placeholder="email@example.com" />' +
            '<button type="button" class="button mea-remove-recipient">Remove</button>' +
            '</div>');
        $('#mea-recipients-container').append(newRow);
    });
    
    // Remove recipient
    $(document).on('click', '.mea-remove-recipient', function() {
        var container = $('#mea-recipients-container');
        var rows = container.find('.mea-recipient-row');
        
        if (rows.length > 1) {
            $(this).closest('.mea-recipient-row').remove();
        } else {
            // Keep at least one row, just clear it
            $(this).closest('.mea-recipient-row').find('input').val('');
        }
    });
    
    // Validate before save
    $('#post').on('submit', function(e) {
        var hasValidRecipient = false;
        $('#mea-recipients-container input[type="email"]').each(function() {
            var email = $(this).val();
            if (email && email.indexOf('@') > 0) {
                hasValidRecipient = true;
                return false; // break
            }
        });
        
        if (!hasValidRecipient) {
            e.preventDefault();
            alert('Please add at least one valid email recipient.');
            return false;
        }
        
        var subject = $('#mea_subject').val();
        if (!subject || subject.trim() === '') {
            e.preventDefault();
            alert('Please enter an email subject. This field is required.');
            $('#mea_subject').focus();
            return false;
        }
        
        // Validate subject length (recommended max 78 characters for email clients)
        if (subject.length > 78) {
            if (!confirm('Email subject is longer than 78 characters. Some email clients may truncate it. Do you want to continue?')) {
                e.preventDefault();
                $('#mea_subject').focus();
                return false;
            }
        }
    });
    
    // Save recipients list
    $('#mea-save-recipients').on('click', function() {
        var name = $('#mea-save-recipients-name').val().trim();
        if (!name) {
            alert('Please enter a name for this recipient list.');
            return;
        }
        
        // Collect current recipients
        var recipients = [];
        $('#mea-recipients-container input[type="email"]').each(function() {
            var email = $(this).val().trim();
            if (email && email.indexOf('@') > 0) {
                recipients.push(email);
            }
        });
        
        if (recipients.length === 0) {
            alert('Please add at least one recipient before saving.');
            return;
        }
        
        // Disable button
        var $btn = $(this);
        $btn.prop('disabled', true).text('Saving...');
        
        // AJAX request
        $.ajax({
            url: meaAdmin.ajaxUrl,
            type: 'POST',
            data: {
                action: 'mea_save_recipients',
                nonce: meaAdmin.nonce,
                name: name,
                recipients: recipients
            },
            success: function(response) {
                if (response.success) {
                    alert(response.data.message);
                    $('#mea-save-recipients-name').val('');
                    // Reload page to refresh dropdown
                    location.reload();
                } else {
                    alert(response.data.message || 'Error saving recipients.');
                    $btn.prop('disabled', false).text('Save Current Recipients');
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
                $btn.prop('disabled', false).text('Save Current Recipients');
            }
        });
    });
    
    // Load recipients list
    $('#mea-load-recipients').on('click', function() {
        var selectedKey = $('#mea-saved-recipients').val();
        if (!selectedKey) {
            alert('Please select a recipient list to load.');
            return;
        }
        
        var $option = $('#mea-saved-recipients option:selected');
        var recipients = JSON.parse($option.data('recipients') || '[]');
        
        if (recipients.length === 0) {
            alert('This list has no recipients.');
            return;
        }
        
        // Clear existing recipients
        $('#mea-recipients-container').empty();
        
        // Add loaded recipients
        recipients.forEach(function(email) {
            var newRow = $('<div class="mea-recipient-row" style="margin-bottom: 5px;">' +
                '<input type="email" name="mea_recipients[]" value="' + email + '" class="regular-text" placeholder="email@example.com" />' +
                '<button type="button" class="button mea-remove-recipient">Remove</button>' +
                '</div>');
            $('#mea-recipients-container').append(newRow);
        });
        
        // Reset dropdown
        $('#mea-saved-recipients').val('');
    });
    
    // Delete recipients list
    $('#mea-delete-recipients').on('click', function() {
        var selectedKey = $('#mea-saved-recipients').val();
        if (!selectedKey) {
            alert('Please select a recipient list to delete.');
            return;
        }
        
        var $option = $('#mea-saved-recipients option:selected');
        var listName = $option.text();
        
        if (!confirm('Are you sure you want to delete "' + listName + '"? This cannot be undone.')) {
            return;
        }
        
        // Disable button
        var $btn = $(this);
        $btn.prop('disabled', true).text('Deleting...');
        
        // AJAX request
        $.ajax({
            url: meaAdmin.ajaxUrl,
            type: 'POST',
            data: {
                action: 'mea_delete_recipients',
                nonce: meaAdmin.nonce,
                key: selectedKey
            },
            success: function(response) {
                if (response.success) {
                    alert(response.data.message);
                    // Reload page to refresh dropdown
                    location.reload();
                } else {
                    alert(response.data.message || 'Error deleting recipient list.');
                    $btn.prop('disabled', false).text('Delete');
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
                $btn.prop('disabled', false).text('Delete');
            }
        });
    });
});


