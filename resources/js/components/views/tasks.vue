<template>
	<div>
		<p v-for="task in tasks">
			{{ task }}
		</p>
	</div>
</template>

<script>
export default {
	name: "tasks",
	data: () => {
		return {
			tasks: []
		}
	},
	mounted() {
		axios.get('api/v1/tasks').then(data => {
			this.tasks = data.data
		})
	}
}
</script>

<style scoped>

</style>