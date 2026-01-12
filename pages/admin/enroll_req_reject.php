<?php $id = (int)($_POST['id'] ?? 0);
$reason = trim($_POST['reason'] ?? '');

_exec(
    "UPDATE enroll_requests
     SET status='rejected'
     WHERE id=?",
    "i",
    [$id],
    $affected
);

/* optional: save reason or send email */
flash('info', 'Request rejected');
?>
<script>
    document.querySelectorAll('.btn-reject').forEach(btn => {
        btn.addEventListener('click', () => {
            const reason = prompt('Reason for rejection:');
            if (!reason) return;

            fetch('<?= url("admin/enroll_reject") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + btn.dataset.id + '&reason=' + encodeURIComponent(reason)
            }).then(() => location.reload());
        });
    });
</script>