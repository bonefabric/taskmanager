<template>
	<div id="application">
		<topMenu></topMenu>
		<router-view></router-view>
	</div>
</template>

<script>
import topMenu from "./components/menus/topMenu";

export default {
	name: "Application",
	components: {
		topMenu
	}
}
</script>

<style scoped lang="scss">
#application {
	min-width: 100vw;
	min-height: 100vh;
}
</style>