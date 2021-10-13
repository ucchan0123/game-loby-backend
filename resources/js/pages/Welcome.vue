<template>
  <div class="text-5xl">
    Welcome to Laravel API :)
  </div>
</template>

<script>
import { onMounted, defineComponent } from "vue"
import { useStore } from 'vuex'

export default defineComponent({
  setup: () => {
    const store = useStore()

    onMounted(() => {
      console.log('mounted!', store.state.test)
      console.log('axios', axios)
    })
  }
})
</script>
