<!-- ============================================================ Access Denied Page ============================================================ -->
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
	<div class="card p-5 shadow-sm text-center" style="max-width: 500px; border-radius: 1rem;">
		<h1 class="text-danger mb-3">Access Denied</h1>
		<p class="mb-4"><?= isset($message) ? $message : "You are not authorized to view this page." ?></p>
		<p>Redirecting to login in <span id="countdown">10</span> seconds...</p>
		<a href="<?= site_url('Login_page') ?>" class="btn btn-primary">Go to Login Now</a>
	</div>
</div>
<!-- =========================================== end Access Denied Page =========================================== -->

<!-- ============================================================ Countdown Script ============================================================ -->
<script>
	let seconds = 10; // total countdown time
	const countdownEl = document.getElementById('countdown');

	const interval = setInterval(() => {
		seconds--;
		countdownEl.textContent = seconds;

		if (seconds <= 0) {
			clearInterval(interval);
			window.location.href = "<?= site_url('Login_page') ?>";
		}
	}, 1000);
</script>
<!-- =========================================== end Countdown Script =========================================== -->