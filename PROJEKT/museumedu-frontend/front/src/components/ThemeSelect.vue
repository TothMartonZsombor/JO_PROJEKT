
<template>
  <div class="container py-5">
    <h1 class="text-center retro-title mb-4">Válassz témát</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
      <div class="col" v-for="theme in themes" :key="theme.name">
        <div class="card h-100 shadow retro-card hoverable" style="cursor: pointer;" @click="$emit('select', theme.name)">
          <img :src="getImage(theme.image)" class="card-img-top" :alt="theme.name">
          <div class="card-body text-center">
            <h5 class="card-title">{{ theme.name }}</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const themes = [
  { name: 'Technika', image: 'technika.JPG' },
  { name: 'Iskola', image: 'iskola.JPG' },
  { name: 'Zene', image: 'zene.JPG' },
  { name: 'Háztartás', image: 'haztartas.JPG' }
]

function getImage(fileName) {
  return new URL(`./images/${fileName}`, import.meta.url).href
}
</script>

<style scoped>
.retro-title {
  font-family: 'Shrikhand', cursive;
  font-size: 2.5rem;
  color: #6c1e1e;
}

.retro-card {
  border: 2px solid #e3dccc;
  border-radius: 16px;
  transition: transform 0.2s ease;
}

.hoverable:hover {
  transform: scale(1.02);
}

.card-img-top {
  object-fit: cover;
  height: 200px;
}
</style>
