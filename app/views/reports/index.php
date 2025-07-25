<?php require_once VIEWS . DS . 'templates/header_private.php'; ?>

<h1 class="mb-4">Admin Reports</h1>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                All Reminders with Users
            </div>
            <div class="card-body">
                <?php if (!empty($all_reminders)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Subject</th>
                                    <th>Created At</th>
                                    <th>User</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_reminders as $reminder): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($reminder['id']); ?></td>
                                        <td><?= htmlspecialchars($reminder['subject']); ?></td>
                                        <td><?= htmlspecialchars($reminder['created_at']); ?></td>
                                        <td><?= htmlspecialchars($reminder['username']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>No reminders found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                Users with Most Reminders
            </div>
            <div class="card-body">
                <?php if (!empty($users_with_most_reminders)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Reminder Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users_with_most_reminders as $user_data): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user_data['username']); ?></td>
                                        <td><?= htmlspecialchars($user_data['reminder_count']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>No users with reminders found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                Total Logins by Username
            </div>
            <div class="card-body">
                <?php if (!empty($total_logins_by_username)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Login Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($total_logins_by_username as $login_data): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($login_data['username']); ?></td>
                                        <td><?= htmlspecialchars($login_data['login_count']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>No login data found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                Login Counts Chart
            </div>
            <div class="card-body">
                <canvas id="loginChart"></canvas>
            </div>
        </div>
    </div>
</div>

<?php require_once VIEWS . DS . 'templates/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('loginChart').getContext('2d');
    const loginChart = new Chart(ctx, {
        type: 'bar', // You can change this to 'line', 'pie', etc.
        data: {
            labels: <?= $login_chart_labels; ?>, // Data passed from PHP
            datasets: [{
                label: '# of Logins',
                data: <?= $login_chart_data; ?>, // Data passed from PHP
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1 // Ensure integer steps for counts
                    }
                }
            }
        }
    });
});
</script>