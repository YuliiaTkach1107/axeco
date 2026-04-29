<script setup>
  import Header from '@/components/layout/Header.vue'
  import Footer from '@/components/layout/Footer.vue'
  import CookieBanner from '@/components/CookieBanner.vue'
</script>

<template>
  <div class="min-h-screen flex flex-col">
    <Header />
    <main class="flex-1">
      <slot />
      <CookieBanner />
    </main>
    <Footer />
  </div>
</template>