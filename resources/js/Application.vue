<template>
	<div id="application" class="bg-blue-50">
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
	display: flex;
	flex-direction: column;
}

</style>