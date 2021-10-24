<template>
	<div v-if="this.loaded">
		{{ roles }}
	</div>
	<div v-else>
		Loading...
	</div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
	name: "roles",
	computed: {
		...mapGetters({
			roles: 'application_roles_data',
			loaded: 'application_roles_loaded',
		}),
	},
	mounted() {
		this.$store.dispatch('application_roles_load');
	}
}
</script>

<style scoped>

</style>