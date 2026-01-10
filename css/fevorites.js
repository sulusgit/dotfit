document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.fav-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            const icon = this.querySelector('i');
            const courseId = this.dataset.id;

            icon.classList.toggle('fa-regular');
            icon.classList.toggle('fa-solid');

            fetch('/user/add_to_fevo.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                credentials: 'same-origin',
                body: 'id=' + courseId
            });
        });
    });
});
