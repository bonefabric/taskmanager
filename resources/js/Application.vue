<template>
  <div>
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

<style scoped>

</style>