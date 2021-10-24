<template>
	<div v-if="this.loaded">

		<table class="table-fixed w-full">
			<tr class="border-b-2">
				<th class="w-1">Id</th>
				<th class="w-2">Name</th>
				<th class="w-2">Created at</th>
				<th class="w-2">Updated at</th>
				<th class="w-2">Deleted at</th>
				<th class="w-3">Actions</th>
			</tr>
			<tr v-for="role in roles" :key="role.id">
				<td>{{ role.id }}</td>
				<td>{{ role.name }}</td>
				<td>{{ role.created_at }}</td>
				<td>{{ role.updated_at }}</td>
				<td>{{ role.deleted_at }}</td>
				<td>edit | delete</td>
			</tr>
		</table>

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