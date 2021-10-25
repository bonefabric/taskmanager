<template>
	<button class="p-1 pl-5 pr-5 border-2 border-blue-900 bg-blue-200 hover:bg-blue-800 hover:text-white w-32" @click.stop="clicked"><slot></slot></button>
</template>

<script>
/** Button reloading */
const RELOADING = 700;

export default {
	name: "uiButton",
	data() {
		return {
			disabled: false,
		}
	},
	methods: {
		clicked: function () {
			if (this.disabled) {
				return;
			}
			setTimeout(() => {
				this.disabled = false;
			}, RELOADING);
			this.$emit('click');
			this.disabled = true;
		}
	}
}
</script>

<style scoped>

</style>