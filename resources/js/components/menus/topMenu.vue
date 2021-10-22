<template>
  <div id="top-menu" class="bg-blue-900 text-white h-20 flex items-center pl-10 pr-10">
    <router-link :to="{name: 'index'}" exact class="pl-5 pr-5">Main</router-link>
    <router-link :to="{name: 'tasks'}" class="pl-5 pr-5">Tasks</router-link>
  </div>
</template>

<script>
export default {
  name: "topMenu"
}
</script>

<style scoped lang="scss">
.router-link-active {
	text-decoration: underline;
}
</style>