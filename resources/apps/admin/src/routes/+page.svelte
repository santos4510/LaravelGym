<script>
	import { goto } from '$app/navigation';
	import { browser } from '$app/environment';
	import { onMount } from 'svelte';

	onMount(() => {
		if (browser) {
			goto('/auth/login');
		}
	});
</script>

<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-500 to-purple-600">
	<div class="text-center">
		<h1 class="text-4xl font-bold text-white mb-4">LaraGym</h1>
		<p class="text-white text-xl">Cargando...</p>
	</div>
</div>
