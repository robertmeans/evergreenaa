<?php
function canManageMeeting($row, $layout_context) {
    $isRestrictedRole = in_array($row['role'], [99, 80, 60, 40]);
    
    $conditions = [
        // President in admin mode
        is_president() && in_admin_mode(),
        
        // Admin conditions
        is_admin() && in_admin_mode() && !declare_manager() && !$isRestrictedRole,
        
        // Owner conditions
        (is_admin() && is_owner($row) && in_admin_mode()),
        (is_owner($row) && !is_admin() && $layout_context !== 'home'),
        (is_owner($row) && is_admin() && $layout_context !== 'home')
    ];
    
    return in_array(true, $conditions, true);
}

function renderManageButtons($row, $layout_context) {
    if (!canManageMeeting($row, $layout_context)) {
        return;
    }

    // Executive's user management button
    if (is_executive() && in_array($layout_context, ['home', 'um-alt'])) {
        if (is_owner($row)) {
            echo '<a class="manage-edit my-stuff">
                    <div class="tooltip">
                        <span class="tooltiptext">My Meeting</span>
                        <i class="far fas fa-user-cog"></i>
                    </div>
                  </a>';
        } else {
            $userUrl = sprintf(
                'user_role.php?id=%s&user=%s',
                h(u($row['id_mtg'])),
                h(u($row['id_user']))
            );
            echo '<a class="manage-edit" href="' . $userUrl . '">
                    <div class="tooltip">
                        <span class="tooltiptext">Manage User</span>
                        <i class="far fas fa-user-cog"></i>
                    </div>
                  </a>';
        }
    }

    // Transfer meeting button
    $transferUrl = 'transfer-meeting.php?id=' . h(u($row['id_mtg']));
    echo '<a class="manage-edit" href="' . $transferUrl . '">
            <div class="tooltip">
                <span class="tooltiptext">Transfer Meeting</span>
                <i class="far fas fa-people-arrows"></i>
            </div>
          </a>';

    // Delete meeting button (if not in delete-mtg context)
    if ($layout_context !== 'delete-mtg') {
        $deleteUrl = 'manage_delete.php?id=' . h(u($row['id_mtg']));
        echo '<a class="manage-delete" href="' . $deleteUrl . '">
                <div class="tooltip right">
                    <span class="tooltiptext">Delete Meeting</span>
                    <i class="far fas fa-minus-circle"></i>
                </div>
              </a>';
    }
}

// Usage
renderManageButtons($row, $layout_context);
?>