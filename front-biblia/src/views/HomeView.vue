<template>
  <div class="overflow-hidden bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
        <div class="lg:pr-8 lg:pt-4">
          <div class="lg:max-w-lg">
            <h2 class="text-base font-semibold leading-7 text-indigo-600">Nova Versão Internacional</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Mateus 5:1</p>
            <p class="mt-6 text-lg leading-8 text-gray-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit.
              Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'VersiculoDoDia',
  data() {
    return {
      versiculoDoDiaaa: Array,
    }
  },
  created() {
    this.getVersiculoDoDia();
  },
  methods: {
    async getVersiculoDoDia() {
      let url = 'http://127.0.0.1:8000/api/site';
      await axios.get(url).then(response => {
        console.log(response);
        this.versiculoDoDiaaa = response.data;
      }).catch(error => {
        console.log(error);
      })
    }
  }
}
</script>
