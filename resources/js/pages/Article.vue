<script setup>
import MainLayout from '@/layouts/MainLayout.vue'
import { Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { ref, onMounted } from 'vue'

defineProps({
        article: Object,
        topics: Array,
    })
const backSection = ref('articles') 
onMounted(() => {
    if (window.location.hash) {
        backSection.value = window.location.hash.replace('#', '')
    }
})
</script>
<template>
   <MainLayout>
<div id="article" role="main">

    <!-- 🔹 HERO -->
    <section class="relative min-h-[70vh] md:h-[80vh] flex items-end pt-28 md:pt-40">

    <!-- Кнопка назад -->
    <Link 
        :href="route('Actualites') + '#' + backSection"
        class="absolute z-20 top-38 md:top-40 lg:top-46 left-4 md:left-6 
               text-white flex items-center gap-2 
               bg-black/40 px-3 py-2 md:px-4 md:py-2 
               text-sm md:text-base
               rounded-full backdrop-blur hover:bg-black/60 transition"
    >
        ← Retour
    </Link>

    <!-- Фон -->
    <div
        class="absolute inset-0 bg-cover bg-center"
        :style="{ backgroundImage: `url(/${article.image_url})` }"
    ></div>

    <!-- Градиент -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>

    <!-- Контент -->
    <div class="section-container relative z-10 text-white pb-8 md:pb-10 flex flex-col gap-3 md:gap-4 max-w-4xl">

        <!-- Breadcrumb -->
        <div class="text-xs md:text-sm opacity-80 leading-snug">
            <Link :href="route('Actualites')" class="hover:underline">
                Actualités
            </Link>
            <span class="mx-1 md:mx-2">/</span>
            <span class="font-semibold line-clamp-1">
                {{ article.title }}
            </span>
        </div>

        <!-- Тема + дата -->
        <div class="flex flex-wrap items-center gap-2 md:gap-4 text-xs md:text-sm opacity-90">
            <span v-if="article.date_publication">
                {{ article.date_publication }}
            </span>

            <span 
                v-if="article.topic"
                class="px-2 py-1 md:px-3 md:py-1 rounded-full text-white text-xs md:text-sm"
                :style="{ background: article.topic.color }"
            >
                {{ article.topic.title }}
            </span>
        </div>

        <!-- Заголовок -->
        <h1 class="text-2xl md:text-4xl lg:text-5xl font-bold leading-tight">
            {{ article.title }}
        </h1>

        <!-- Описание -->
        <p class="text-sm md:text-lg opacity-90 leading-relaxed line-clamp-3 md:line-clamp-none">
            {{ article.description }}
        </p>

    </div>
</section>
   <section class="relative z-20 px-6 py-16 lg:py-20 bg-[#F8FBFF]">
  <div class="max-w-4xl mx-auto">

    <article class="bg-white rounded-[24px] shadow-md px-6 py-8 lg:px-10 lg:py-12">

      <!-- акцент -->
      <div class="w-12 h-[3px] bg-[#f2522e] rounded-full mb-6"></div>

      <!-- текст -->
      <p class="text-[#205A8C] text-base lg:text-lg leading-relaxed whitespace-pre-line">
        {{ article.content }}
      </p>

    </article>

  </div>
</section>

</div>
</MainLayout>
</template>