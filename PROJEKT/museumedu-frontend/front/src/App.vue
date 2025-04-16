
<template>
  <div id="app">
    <router-view @select="goToTheme"></router-view>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
const router = useRouter()

function goToTheme(theme) {
  router.push(`/theme/${theme}`)
}
</script>

<style>
body {
  background: linear-gradient(to bottom, #fdf6e3, #f5e4c3);
  font-family: 'Open Sans', sans-serif;
}
</style>
