<script>
	const btn = document.querySelector("button.mobile-menu-button");
	const menu = document.querySelector(".mobile-menu");

	btn.addEventListener("click", () => {
		menu.classList.toggle("hidden");
	});
</script>
@if(session()->has('session'))
<script>
	const btnProfile = document.querySelector("button.profile-menu-button");
	const menuProfile = document.querySelector(".profile-menu");
	
	btnProfile.addEventListener("click", () => {
		menuProfile.classList.toggle("hidden");
	});
</script>
@endif