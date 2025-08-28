<?php
/**
 * Side Tab Manager view - Complete side navigation tab management system
 */

// Get current settings and items
$settings = get_option('adverto_side_tab_settings', array(
    'enabled' => 1,
    'position' => 'right',
    'background_color' => '#4285f4',
    'text_color' => '#ffffff',
    'hover_color' => '#3367d6'
));

$items = get_option('adverto_side_tab_items', array());
?>

<div class="adverto-container">
    <div class="adverto-header">
        <h1>
            <span class="material-icons">tab</span>
            <?php _e('Side Tab Manager', 'adverto-master'); ?>
        </h1>
        <div class="adverto-breadcrumb">
            <a href="<?php echo admin_url('admin.php?page=adverto-master'); ?>"><?php _e('Dashboard', 'adverto-master'); ?></a>
            <span> / </span>
            <span><?php _e('Side Tab Manager', 'adverto-master'); ?></span>
        </div>
    </div>

    <div class="adverto-content">
        <!-- Configuration Section -->
        <div class="adverto-card">
            <div class="adverto-card-header">
                <h2>
                    <span class="material-icons">settings</span>
                    <?php _e('Side Tab Configuration', 'adverto-master'); ?>
                </h2>
                <p><?php _e('Configure the appearance and behavior of your side navigation tab', 'adverto-master'); ?></p>
            </div>
            
            <div class="adverto-card-content">
                <form id="side-tab-settings-form">
                    <div class="adverto-form-grid">
                        <div class="adverto-form-group">
                            <label class="adverto-checkbox">
                                <input type="checkbox" id="side-tab-enabled" <?php checked($settings['enabled'], 1); ?>>
                                <span class="adverto-checkbox-mark"></span>
                                <?php _e('Enable Side Tab', 'adverto-master'); ?>
                            </label>
                            <small class="adverto-field-help"><?php _e('Show the side tab on your website', 'adverto-master'); ?></small>
                        </div>
                        
                        <div class="adverto-form-group">
                            <label for="side-tab-position"><?php _e('Position', 'adverto-master'); ?></label>
                            <select id="side-tab-position" class="adverto-select">
                                <option value="right" <?php selected($settings['position'], 'right'); ?>><?php _e('Right Side', 'adverto-master'); ?></option>
                                <option value="left" <?php selected($settings['position'], 'left'); ?>><?php _e('Left Side', 'adverto-master'); ?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="adverto-form-grid">
                        <div class="adverto-form-group">
                            <label for="background-color"><?php _e('Background Colour', 'adverto-master'); ?></label>
                            <div class="adverto-color-input">
                                <input type="color" id="background-color" value="<?php echo esc_attr($settings['background_color']); ?>">
                                <input type="text" id="background-color-text" value="<?php echo esc_attr($settings['background_color']); ?>" class="adverto-input">
                            </div>
                        </div>
                        
                        <div class="adverto-form-group">
                            <label for="text-color"><?php _e('Text Colour', 'adverto-master'); ?></label>
                            <div class="adverto-color-input">
                                <input type="color" id="text-color" value="<?php echo esc_attr($settings['text_color']); ?>">
                                <input type="text" id="text-color-text" value="<?php echo esc_attr($settings['text_color']); ?>" class="adverto-input">
                            </div>
                        </div>
                        
                        <div class="adverto-form-group">
                            <label for="hover-color"><?php _e('Hover Colour', 'adverto-master'); ?></label>
                            <div class="adverto-color-input">
                                <input type="color" id="hover-color" value="<?php echo esc_attr($settings['hover_color']); ?>">
                                <input type="text" id="hover-color-text" value="<?php echo esc_attr($settings['hover_color']); ?>" class="adverto-input">
                            </div>
                        </div>
                    </div>
                    
                    <div class="adverto-form-actions">
                        <button type="submit" id="save-settings-btn" class="adverto-btn adverto-btn-primary">
                            <span class="material-icons">save</span>
                            <?php _e('Save Settings', 'adverto-master'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Side Tab Items Management -->
        <div class="adverto-card">
            <div class="adverto-card-header">
                <h2>
                    <span class="material-icons">list</span>
                    <?php _e('Side Tab Items', 'adverto-master'); ?>
                </h2>
                <p><?php _e('Add, edit, and reorder items in your side tab', 'adverto-master'); ?></p>
                <button type="button" id="add-item-btn" class="adverto-btn adverto-btn-primary">
                    <span class="material-icons">add</span>
                    <?php _e('Add New Item', 'adverto-master'); ?>
                </button>
            </div>
            
            <div class="adverto-card-content">
                <div id="side-tab-items" class="side-tab-items">
                    <?php if (empty($items)): ?>
                        <div class="adverto-empty-state" id="empty-state">
                            <span class="material-icons">inbox</span>
                            <h3><?php _e('No Items Yet', 'adverto-master'); ?></h3>
                            <p><?php _e('Add your first side tab item to get started', 'adverto-master'); ?></p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($items as $item): ?>
                            <div class="side-tab-item" data-id="<?php echo esc_attr($item['id']); ?>">
                                <div class="item-handle">
                                    <span class="material-icons">drag_handle</span>
                                </div>
                                <div class="item-preview">
                                    <?php if (!empty($item['icon'])): ?>
                                        <img src="<?php echo esc_url($item['icon']); ?>" alt="Icon" class="item-icon">
                                    <?php else: ?>
                                        <span class="material-icons item-icon-placeholder">link</span>
                                    <?php endif; ?>
                                    <div class="item-info">
                                        <strong><?php echo esc_html($item['text']); ?></strong>
                                        <small><?php echo esc_html($item['link']); ?></small>
                                    </div>
                                </div>
                                <div class="item-actions">
                                    <button type="button" class="adverto-btn adverto-btn-small edit-item-btn">
                                        <span class="material-icons">edit</span>
                                    </button>
                                    <button type="button" class="adverto-btn adverto-btn-small adverto-btn-danger delete-item-btn">
                                        <span class="material-icons">delete</span>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Live Preview -->
        <div class="adverto-card">
            <div class="adverto-card-header">
                <h2>
                    <span class="material-icons">preview</span>
                    <?php _e('Live Preview', 'adverto-master'); ?>
                </h2>
                <p><?php _e('See how your side tab will look on your website', 'adverto-master'); ?></p>
            </div>
            
            <div class="adverto-card-content">
                <div class="preview-container">
                    <div class="preview-screen">
                        <div class="preview-header">Your Website</div>
                        <div class="preview-content">
                            <p>This is a preview of how your side tab will appear on your website.</p>
                        </div>
                        
                        <!-- Live Preview Side Tab -->
                        <div id="preview-side-tab" class="preview-side-tab right">
                            <button class="preview-tab-toggle">
                                <span class="preview-toggle-icon">›</span>
                            </button>
                            <div class="preview-tab-items">
                                <!-- Items will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics -->
        <div class="adverto-card">
            <div class="adverto-card-header">
                <h2>
                    <span class="material-icons">analytics</span>
                    <?php _e('Side Tab Analytics', 'adverto-master'); ?>
                </h2>
                <p><?php _e('Track engagement with your side tab', 'adverto-master'); ?></p>
            </div>
            
            <div class="adverto-card-content">
                <div id="analytics-data" class="analytics-stats">
                    <div class="stat-card">
                        <span class="material-icons">mouse</span>
                        <h3 id="total-clicks">-</h3>
                        <p><?php _e('Total Clicks', 'adverto-master'); ?></p>
                    </div>
                    <div class="stat-card">
                        <span class="material-icons">people</span>
                        <h3 id="unique-visitors">-</h3>
                        <p><?php _e('Unique Visitors', 'adverto-master'); ?></p>
                    </div>
                    <div class="stat-card">
                        <span class="material-icons">schedule</span>
                        <h3 id="last-click">-</h3>
                        <p><?php _e('Last Click', 'adverto-master'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Item Modal -->
<div id="item-modal" class="adverto-modal">
    <div class="adverto-modal-content">
        <div class="adverto-modal-header">
            <h3 id="modal-title"><?php _e('Add New Item', 'adverto-master'); ?></h3>
            <button type="button" class="adverto-modal-close">
                <span class="material-icons">close</span>
            </button>
        </div>
        
        <form id="item-form" class="adverto-modal-body">
            <input type="hidden" id="item-id" value="">
            
            <div class="adverto-form-group">
                <label for="item-text"><?php _e('Text', 'adverto-master'); ?></label>
                <input type="text" id="item-text" class="adverto-input" placeholder="<?php _e('e.g., Contact Us', 'adverto-master'); ?>" required>
            </div>
            
            <div class="adverto-form-group">
                <label for="item-link"><?php _e('Link URL', 'adverto-master'); ?></label>
                <input type="url" id="item-link" class="adverto-input" placeholder="<?php _e('https://example.com/contact', 'adverto-master'); ?>" required>
            </div>
            
            <div class="adverto-form-group">
                <label for="item-target"><?php _e('Link Target', 'adverto-master'); ?></label>
                <select id="item-target" class="adverto-select">
                    <option value="_self"><?php _e('Same Window', 'adverto-master'); ?></option>
                    <option value="_blank"><?php _e('New Window', 'adverto-master'); ?></option>
                </select>
            </div>
            
            <div class="adverto-form-group">
                <label for="item-icon"><?php _e('Icon URL (Optional)', 'adverto-master'); ?></label>
                <input type="url" id="item-icon" class="adverto-input" placeholder="<?php _e('https://example.com/icon.png', 'adverto-master'); ?>">
                <small class="adverto-field-help"><?php _e('Recommended size: 24x24 pixels', 'adverto-master'); ?></small>
            </div>
        </form>
        
        <div class="adverto-modal-footer">
            <button type="button" class="adverto-btn adverto-btn-secondary adverto-modal-close">
                <?php _e('Cancel', 'adverto-master'); ?>
            </button>
            <button type="submit" form="item-form" id="save-item-btn" class="adverto-btn adverto-btn-primary">
                <span class="material-icons">save</span>
                <?php _e('Save Item', 'adverto-master'); ?>
            </button>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    let currentItems = <?php echo json_encode($items); ?>;
    let currentSettings = <?php echo json_encode($settings); ?>;
    let isEditing = false;
    
    // Initialize
    loadAnalytics();
    updatePreview();
    initializeSortable();
    
    // Colour input synchronisation
    $('input[type="color"]').on('change', function() {
        const textInput = $(this).siblings('input[type="text"]');
        textInput.val($(this).val());
        updatePreview();
    });
    
    $('input[type="text"][id$="-color-text"]').on('input', function() {
        const colorInput = $(this).siblings('input[type="color"]');
        const value = $(this).val();
        if (/^#[0-9A-Fa-f]{6}$/.test(value)) {
            colorInput.val(value);
            updatePreview();
        }
    });
    
    // Settings form
    $('#side-tab-settings-form').on('submit', function(e) {
        e.preventDefault();
        saveSettings();
    });
    
    // Settings change listeners for live preview
    $('#side-tab-enabled, #side-tab-position').on('change', updatePreview);
    
    // Add item
    $('#add-item-btn').on('click', function() {
        openItemModal();
    });
    
    // Edit item
    $(document).on('click', '.edit-item-btn', function() {
        const itemId = $(this).closest('.side-tab-item').data('id');
        const item = currentItems.find(i => i.id === itemId);
        if (item) {
            openItemModal(item);
        }
    });
    
    // Delete item
    $(document).on('click', '.delete-item-btn', function() {
        const itemId = $(this).closest('.side-tab-item').data('id');
        if (confirm('<?php _e('Are you sure you want to delete this item?', 'adverto-master'); ?>')) {
            deleteItem(itemId);
        }
    });
    
    // Modal controls
    $('.adverto-modal-close').on('click', closeItemModal);
    $('#item-modal').on('click', function(e) {
        if (e.target === this) {
            closeItemModal();
        }
    });
    
    // Item form
    $('#item-form').on('submit', function(e) {
        e.preventDefault();
        saveItem();
    });
    
    // Preview tab toggle
    $('#preview-side-tab .preview-tab-toggle').on('click', function() {
        $('#preview-side-tab').toggleClass('collapsed');
    });
    
    function saveSettings() {
        const $btn = $('#save-settings-btn');
        const originalText = $btn.text();
        
        $btn.prop('disabled', true).html('<span class="material-icons spinning">save</span> Saving...');
        
        const settings = {
            enabled: $('#side-tab-enabled').is(':checked'),
            position: $('#side-tab-position').val(),
            background_color: $('#background-color').val(),
            text_color: $('#text-color').val(),
            hover_color: $('#hover-color').val()
        };
        
        $.post(ajaxurl, {
            action: 'adverto_save_side_tab_settings',
            nonce: '<?php echo wp_create_nonce('adverto_nonce'); ?>',
            ...settings
        }, function(response) {
            if (response.success) {
                currentSettings = settings;
                updatePreview();
                showNotification(response.data.message, 'success');
            } else {
                showNotification(response.data, 'error');
            }
        }).always(function() {
            $btn.prop('disabled', false).html('<span class="material-icons">save</span>' + originalText.replace('Saving...', 'Save Settings'));
        });
    }
    
    function openItemModal(item = null) {
        isEditing = !!item;
        
        if (isEditing) {
            $('#modal-title').text('<?php _e('Edit Item', 'adverto-master'); ?>');
            $('#item-id').val(item.id);
            $('#item-text').val(item.text);
            $('#item-link').val(item.link);
            $('#item-target').val(item.target);
            $('#item-icon').val(item.icon || '');
        } else {
            $('#modal-title').text('<?php _e('Add New Item', 'adverto-master'); ?>');
            $('#item-form')[0].reset();
            $('#item-id').val('');
        }
        
        $('#item-modal').addClass('active');
    }
    
    function closeItemModal() {
        $('#item-modal').removeClass('active');
    }
    
    function saveItem() {
        const itemData = {
            text: $('#item-text').val(),
            link: $('#item-link').val(),
            target: $('#item-target').val(),
            icon: $('#item-icon').val()
        };
        
        if (!itemData.text || !itemData.link) {
            showNotification('<?php _e('Please fill in all required fields.', 'adverto-master'); ?>', 'error');
            return;
        }
        
        const $btn = $('#save-item-btn');
        const originalText = $btn.text();
        
        $btn.prop('disabled', true).html('<span class="material-icons spinning">save</span> Saving...');
        
        const action = isEditing ? 'adverto_update_side_tab_item' : 'adverto_add_side_tab_item';
        const requestData = {
            action: action,
            nonce: '<?php echo wp_create_nonce('adverto_nonce'); ?>',
            ...itemData
        };
        
        if (isEditing) {
            requestData.item_id = $('#item-id').val();
        }
        
        $.post(ajaxurl, requestData, function(response) {
            if (response.success) {
                if (isEditing) {
                    // Update existing item
                    const itemId = $('#item-id').val();
                    const itemIndex = currentItems.findIndex(i => i.id === itemId);
                    if (itemIndex !== -1) {
                        currentItems[itemIndex] = {...currentItems[itemIndex], ...itemData};
                    }
                } else {
                    // Add new item
                    currentItems.push(response.data.item);
                }
                
                refreshItemsList();
                updatePreview();
                closeItemModal();
                showNotification(response.data.message, 'success');
            } else {
                showNotification(response.data, 'error');
            }
        }).always(function() {
            $btn.prop('disabled', false).html('<span class="material-icons">save</span>' + originalText.replace('Saving...', 'Save Item'));
        });
    }
    
    function deleteItem(itemId) {
        $.post(ajaxurl, {
            action: 'adverto_delete_side_tab_item',
            nonce: '<?php echo wp_create_nonce('adverto_nonce'); ?>',
            item_id: itemId
        }, function(response) {
            if (response.success) {
                currentItems = currentItems.filter(i => i.id !== itemId);
                refreshItemsList();
                updatePreview();
                showNotification(response.data.message, 'success');
            } else {
                showNotification(response.data, 'error');
            }
        });
    }
    
    function refreshItemsList() {
        const container = $('#side-tab-items');
        
        if (currentItems.length === 0) {
            container.html(`
                <div class="adverto-empty-state" id="empty-state">
                    <span class="material-icons">inbox</span>
                    <h3><?php _e('No Items Yet', 'adverto-master'); ?></h3>
                    <p><?php _e('Add your first side tab item to get started', 'adverto-master'); ?></p>
                </div>
            `);
            return;
        }
        
        container.empty();
        currentItems.forEach(function(item) {
            const iconHtml = item.icon ? 
                `<img src="${item.icon}" alt="Icon" class="item-icon">` : 
                '<span class="material-icons item-icon-placeholder">link</span>';
                
            const itemHtml = $(`
                <div class="side-tab-item" data-id="${item.id}">
                    <div class="item-handle">
                        <span class="material-icons">drag_handle</span>
                    </div>
                    <div class="item-preview">
                        ${iconHtml}
                        <div class="item-info">
                            <strong>${item.text}</strong>
                            <small>${item.link}</small>
                        </div>
                    </div>
                    <div class="item-actions">
                        <button type="button" class="adverto-btn adverto-btn-small edit-item-btn">
                            <span class="material-icons">edit</span>
                        </button>
                        <button type="button" class="adverto-btn adverto-btn-small adverto-btn-danger delete-item-btn">
                            <span class="material-icons">delete</span>
                        </button>
                    </div>
                </div>
            `);
            
            container.append(itemHtml);
        });
        
        initializeSortable();
    }
    
    function initializeSortable() {
        if (typeof Sortable !== 'undefined') {
            const container = document.getElementById('side-tab-items');
            if (container && !container.classList.contains('sortable-initialized')) {
                container.classList.add('sortable-initialized');
                
                Sortable.create(container, {
                    handle: '.item-handle',
                    animation: 150,
                    onEnd: function(evt) {
                        const itemIds = Array.from(container.children).map(item => item.dataset.id);
                        reorderItems(itemIds);
                    }
                });
            }
        }
    }
    
    function reorderItems(itemIds) {
        $.post(ajaxurl, {
            action: 'adverto_reorder_side_tab_items',
            nonce: '<?php echo wp_create_nonce('adverto_nonce'); ?>',
            item_ids: itemIds
        }, function(response) {
            if (response.success) {
                // Update current items order
                const reorderedItems = [];
                itemIds.forEach(function(id) {
                    const item = currentItems.find(i => i.id === id);
                    if (item) {
                        reorderedItems.push(item);
                    }
                });
                currentItems = reorderedItems;
                updatePreview();
            }
        });
    }
    
    function updatePreview() {
        const previewTab = $('#preview-side-tab');
        const previewItems = previewTab.find('.preview-tab-items');
        
        // Update position
        previewTab.removeClass('left right').addClass(currentSettings.position || 'right');
        
        // Update colors
        const bgColor = $('#background-color').val() || currentSettings.background_color;
        const textColor = $('#text-color').val() || currentSettings.text_color;
        const hoverColor = $('#hover-color').val() || currentSettings.hover_color;
        
        previewTab.css({
            'background-color': bgColor,
            'color': textColor
        });
        
        // Update items
        previewItems.empty();
        
        if (currentItems.length === 0) {
            previewItems.html(`
                <div class="preview-tab-item">
                    <span class="preview-icon">📞</span>
                    <span>Contact</span>
                </div>
                <div class="preview-tab-item">
                    <span class="preview-icon">💬</span>
                    <span>Chat</span>
                </div>
            `);
        } else {
            currentItems.forEach(function(item) {
                const iconHtml = item.icon ? 
                    `<img src="${item.icon}" class="preview-icon" alt="${item.text}">` : 
                    '<span class="preview-icon">🔗</span>';
                    
                previewItems.append(`
                    <div class="preview-tab-item">
                        ${iconHtml}
                        <span>${item.text}</span>
                    </div>
                `);
            });
        }
        
        // Update hover effect
        previewItems.find('.preview-tab-item').on('mouseenter', function() {
            $(this).css('background-color', hoverColor);
        }).on('mouseleave', function() {
            $(this).css('background-color', '');
        });
        
        // Show/hide based on enabled status
        const enabled = $('#side-tab-enabled').is(':checked');
        previewTab.toggle(enabled);
    }
    
    function loadAnalytics() {
        $.post(ajaxurl, {
            action: 'adverto_get_side_tab_stats',
            nonce: '<?php echo wp_create_nonce('adverto_nonce'); ?>'
        }, function(response) {
            if (response.success) {
                const stats = response.data;
                $('#total-clicks').text(stats.total_clicks || 0);
                $('#unique-visitors').text(stats.unique_visitors || 0);
                
                if (stats.last_click) {
                    const lastClick = new Date(stats.last_click);
                    $('#last-click').text(lastClick.toLocaleDateString());
                } else {
                    $('#last-click').text('<?php _e('Never', 'adverto-master'); ?>');
                }
            }
        });
    }
    
    function showNotification(message, type = 'info') {
        if (type === 'error') {
            alert('Error: ' + message);
        } else {
            alert(message);
        }
    }
});
</script>

<style>
.adverto-color-input {
    display: flex;
    gap: 8px;
    align-items: center;
}

.adverto-color-input input[type="color"] {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.adverto-color-input input[type="text"] {
    flex: 1;
}

.side-tab-items {
    min-height: 100px;
}

.side-tab-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    margin-bottom: 12px;
    background: var(--card-background);
    transition: all 0.2s ease;
}

.side-tab-item:hover {
    border-color: var(--primary-color);
    box-shadow: 0 2px 8px rgba(66, 133, 244, 0.1);
}

.item-handle {
    cursor: grab;
    color: var(--text-secondary);
}

.item-handle:active {
    cursor: grabbing;
}

.item-preview {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
}

.item-icon, .item-icon-placeholder {
    width: 24px;
    height: 24px;
    object-fit: contain;
    color: var(--text-secondary);
}

.item-info strong {
    display: block;
    color: var(--text-primary);
    margin-bottom: 4px;
}

.item-info small {
    color: var(--text-secondary);
    font-size: 12px;
}

.item-actions {
    display: flex;
    gap: 8px;
}

.preview-container {
    background: #f5f5f5;
    border-radius: 8px;
    padding: 20px;
    position: relative;
}

.preview-screen {
    background: white;
    border-radius: 8px;
    min-height: 300px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.preview-header {
    background: #e0e0e0;
    padding: 12px 16px;
    font-weight: 500;
    border-bottom: 1px solid #ccc;
}

.preview-content {
    padding: 40px 20px;
    text-align: center;
    color: #666;
}

.preview-side-tab {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    transition: transform 0.3s ease;
    z-index: 10;
    font-size: 12px;
}

.preview-side-tab.right {
    right: 0;
}

.preview-side-tab.left {
    left: 0;
    flex-direction: row-reverse;
}

.preview-side-tab.right.collapsed {
    transform: translateY(-50%) translateX(calc(100% - 30px));
}

.preview-side-tab.left.collapsed {
    transform: translateY(-50%) translateX(calc(-100% + 30px));
}

.preview-tab-toggle {
    width: 30px;
    height: 30px;
    border: none;
    background: inherit;
    color: inherit;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.preview-toggle-icon {
    transition: transform 0.3s ease;
}

.preview-side-tab.right.collapsed .preview-toggle-icon {
    transform: rotate(180deg);
}

.preview-side-tab.left .preview-toggle-icon {
    transform: rotate(180deg);
}

.preview-side-tab.left.collapsed .preview-toggle-icon {
    transform: rotate(0deg);
}

.preview-tab-items {
    display: flex;
    flex-direction: column;
    background: inherit;
}

.preview-tab-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 8px 10px;
    transition: background-color 0.3s ease;
    cursor: pointer;
}

.preview-tab-item:not(:last-child) {
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
}

.preview-icon {
    width: 16px;
    height: 16px;
    margin-bottom: 4px;
    object-fit: contain;
}

.preview-tab-item span:last-child {
    font-size: 10px;
    font-weight: 500;
    line-height: 1.2;
}

.analytics-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.stat-card {
    text-align: center;
    padding: 24px;
    background: var(--card-background);
    border: 1px solid var(--border-color);
    border-radius: 8px;
}

.stat-card .material-icons {
    font-size: 32px;
    color: var(--primary-color);
    margin-bottom: 12px;
}

.stat-card h3 {
    font-size: 32px;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 8px 0;
}

.stat-card p {
    color: var(--text-secondary);
    margin: 0;
    font-size: 14px;
}

.spinning {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>
