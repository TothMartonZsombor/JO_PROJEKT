
<template>
  <div class="container py-5">
    <h1 class="text-center retro-title mb-4">{{ theme }} témájú tárgyak</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      <div class="col" v-for="item in filteredItems" :key="item.id">
        <div class="card h-100 shadow retro-card">
          <img :src="getImageUrl(item.image_path)" class="card-img-top" :alt="item.name">
          <div class="card-body">
            <h5 class="card-title">{{ item.name }}</h5>
            <p class="card-text">{{ item.story }}</p>
            <p class="text-muted">Év: {{ item.year }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const items = ref([])
const route = useRoute()
const theme = route.params.theme

onMounted(async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/items')
    items.value = response.data
  } catch (error) {
    console.error("Nem sikerült lekérni az itemeket:", error)
  }
})

const filteredItems = computed(() =>
  items.value.filter(i => i.theme === theme)
)

function getImageUrl(path) {
  if (!path) return '';
  return 'http://localhost:8000/' + path;
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
}

.card-img-top {
  object-fit: cover;
  height: 200px;
}
</style>
