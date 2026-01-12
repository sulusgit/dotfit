<?php
//flash_show() function to display flash messages

// Stop if there are no flash messages
if (empty($_SESSION['messages'])) {
    return;
}
?>

<style>
    .flash-bar {
        position: fixed;
        top: 16px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 800px;
        z-index: 9999;
        pointer-events: none;
    }

    .flash-message {
        pointer-events: auto;
    }


    /* Types */
    .flash-success {
        background: #ecfdf5;
        color: #065f46;
    }

    .flash-error {
        background: #fee2e2;
        color: #991b1b;
    }

    .flash-warning {
        background: #fffbeb;
        color: #92400e;
    }

    /* --------OLD------------- */
    /* Wrapper fixed under header */
    /*     .flash-bar {
        position: fixed;
        top: 80px;

        left: 0;
        width: 100%;
        z-index: 9999;
        display: flex;
        justify-content: center;
        pointer-events: none;
        
        backdrop-filter: blur(6px);
    } */

    /* Base flash message style */
    /* Container floats ABOVE everything */
    .flash-container {
        position: fixed;
        top: 80px;
        /* below header */
        left: 50%;
        transform: translateX(-50%);
        z-index: 99999;

        display: flex;
        flex-direction: column;
        gap: 10px;

        pointer-events: none;
        /* doesn't block UI */
    }

    /* Message box */
    .flash-message {
        min-width: 320px;
        max-width: 520px;
        padding: 14px 20px;

        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        text-align: center;

        backdrop-filter: blur(8px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);

        animation: slideDown 0.35s ease, fadeOut 0.4s ease 3s forwards;
        pointer-events: auto;
    }

    /* Types */
    .flash-success {
        background: rgba(20, 120, 110, 0.85);
        color: #ffffff;
    }

    .flash-error {
        background: rgba(160, 40, 40, 0.9);
        color: #ffffff;
    }

    .flash-warning {
        background: rgba(180, 130, 30, 0.9);
        color: #ffffff;
    }

    /* Animations */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }
</style>
<?php
/* function flash_show(): void
{
    if (empty($_SESSION['messages']) || !is_array($_SESSION['messages'])) {
        return;
    } */ ?>

<div class="flash-container">
    <?php if (!empty($_SESSION['messages']) && is_array($_SESSION['messages'])): ?>
        <?php foreach ($_SESSION['messages'] as $type => $messages): ?>
            <?php foreach ($messages as $msg): ?>
                <div class="flash-message flash-<?= htmlspecialchars($type) ?>">
                    <?= htmlspecialchars($msg) ?>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <?php unset($_SESSION['messages']); ?>
    <?php endif; ?>
</div>

<?php
// Remove messages so they show only once
unset($_SESSION['messages']);

?>

<script>
    // Auto-hide flash messages after 3.5s
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            document.querySelectorAll('.flash-message').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(() => el.remove(), 400);
            });
        }, 3500);
    });
</script>

<?php

/*use like this
flash('success', 'Enrollment request sent to admin');
flash('error',   'Something went wrong');
flash('warning', 'You already requested this course');
flash('info',    'Request is pending approval');

php flash_show();?> */