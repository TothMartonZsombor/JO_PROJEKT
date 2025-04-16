
<template>
  <div class="container py-5">
    <h1 class="text-center retro-title mb-4">Új tárgy hozzáadása</h1>

    <div v-if="message" :class="'alert ' + (success ? 'alert-success' : 'alert-danger')" role="alert">
      {{ message }}
    </div>

    <form @submit.prevent="submitItem" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Név</label>
        <input type="text" v-model="form.name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Téma</label>
        <select v-model="form.theme" class="form-select" required>
          <option disabled value="">Válassz témát</option>
          <option v-for="cat in categories" :key="cat.id" :value="cat.name">{{ cat.name }}</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Év</label>
        <input type="number" v-model="form.year" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Történet</label>
        <textarea v-model="form.story" class="form-control" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Kép feltöltése</label>
        <input type="file" @change="handleFileUpload" class="form-control" required>
      </div>

      <button class="btn btn-success" type="submit">Mentés</button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const form = ref({
  name: '',
  theme: '',
  year: '',
  story: '',
  image: null
})

const categories = ref([])
const message = ref('')
const success = ref(false)

onMounted(async () => {
  try {
    const res = await axios.get('http://localhost:8000/api/categories')
    categories.value = res.data
  } catch (error) {
    console.error('Hiba a kategóriák lekérésekor:', error)
  }
})

function handleFileUpload(event) {
  form.value.image = event.target.files[0]
}

async function submitItem() {
  try {
    const formData = new FormData()
    formData.append('name', form.value.name)
    formData.append('theme', form.value.theme)
    formData.append('year', form.value.year)
    formData.append('story', form.value.story)
    formData.append('image', form.value.image)

    await axios.post('http://localhost:8000/api/items', formData)
    message.value = 'Sikeres feltöltés!'
    success.value = true

    form.value = {
      name: '',
      theme: '',
      year: '',
      story: '',
      image: null
    }
  } catch (error) {
    console.error('Hiba történt:', error)
    if (error.response) {
      console.log('Részletes hiba:', error.response.data)
    }
    message.value = 'Hiba történt a feltöltés során.'
    success.value = false
  }
}
</script>

<style scoped>
.retro-title {
  font-family: 'Shrikhand', cursive;
  font-size: 2.5rem;
  color: #6c1e1e;
}
</style>
