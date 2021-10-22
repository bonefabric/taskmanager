<template>
  <div id="top-menu" class="bg-red-800">
    <router-link :to="{name: 'index'}">Main</router-link>
    <router-link :to="{name: 'tasks'}">Tasks</router-link>
  </div>
</template>

<script>
export default {
  name: "topMenu"
}
</script>

<style scoped>

</style>