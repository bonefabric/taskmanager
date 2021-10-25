<template>
	<div v-if="this.loaded">

		<!--	Top control panel	-->
		<div>
			<uiButton class="mb-10" @click="createRoleClick">Create role</uiButton>
		</div>
		<!--	End	-->

		<!--	Main table	-->
		<table class="table table-fixed w-full bg-blue-200">
			<tr class="bg-blue-900 text-white">
				<th class="w-3 p-2">Name</th>
				<th class="w-2 p-2">Created at</th>
				<th class="w-2 p-2">Updated at</th>
				<th class="w-2 p-2">Deleted at</th>
				<th class="w-3 p-2">Actions</th>
			</tr>
			<tr v-for="role in roles" :key="role.id" class="text-center hover:bg-blue-300">
				<td class="p-2"><a @click="openRoleClick(role)" class="cursor-pointer underline">{{ role.name }}</a></td>
				<td class="p-2">{{ role.created_at }}</td>
				<td class="p-2">{{ role.updated_at }}</td>
				<td class="p-2">{{ role.deleted_at }}</td>
				<td class="p-2 flex justify-around">
					<uiButton @click="editRoleClick(role)">Edit</uiButton>
					<uiButton @click="deleteRoleClick(role)">Delete</uiButton>
				</td>
			</tr>
		</table>
		<!--	End	-->

		<!--	Popup	-->
		<div v-if="popupCreate || popupOpen || popupEdit" class="z-40 bg-transparent fixed left-0 right-0 top-0 bottom-0 w-full h-full">
			<div class="z-50">
				<uiButton @click="closePopup">Close</uiButton>

			</div>
		</div>
		<!--	End	-->

	</div>

	<!-- Preloader	-->
	<div v-else>
		Loading...
	</div>

</template>

<script>
import {mapGetters} from "vuex";
import uiButton from "../ui/uiButton";

export default {
	name: "roles",
	data() {
		return {
			popupCreate: false,
			popupOpen: false,
			popupEdit: false,
		}
	},
	methods: {
		openRoleClick: function (role) {
			this.popupOpen = true;
			console.log(role)
		},
		createRoleClick: function () {
			console.log('create')
		},
		editRoleClick: function (role) {
			console.log('edit' + role.id)
		},
		deleteRoleClick: function (role) {
			console.log('delete' + role.id)
		},
		closePopup: function () {
			this.popupCreate = false;
			this.popupOpen = false;
			this.popupEdit = false;
		}
	},
	computed: {
		...mapGetters({
			roles: 'application_roles_data',
			loaded: 'application_roles_loaded',
		}),
	},
	mounted() {
		this.$store.dispatch('application_roles_load');
	},
	components: {
		uiButton,
	}
}
</script>

<style scoped>

</style>