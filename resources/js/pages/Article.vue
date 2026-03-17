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
    <section class='hero relative h-screen pt-40 flex flex-col justify-end w-full'>
        <Link :href="route('Actualites') + '#' + backSection" class="absolute z-20 top-50 cursor-pointer left-10 bg-white/10 rounded-full p-3 backdrop-blur hover:bg-white/20 transition">
            <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l6 6m-6-6l6-6"/></svg>
        </Link>
        <div
        class="absolute inset-0 bg-no-repeat bg-[position:100%_left] bg-[length:120%_120%] z-0"
        :style="{ backgroundImage: `url(/${article.image_url})` }"
        >
        </div>      
        <div class="absolute inset-0 bg-black/40"></div>
            <div class="section-container relative z-10 text-white pb-10 flex flex-col gap-4">
                <p v-if='article.topic' class="text-white font-semibold w-fit px-3 py-2 rounded-full " :style="{background: article.topic.color }" > 
                    {{ article.topic.title }}
                </p>
                <h1 v-if='article.title'>{{ article.title }}</h1>
                <p>{{ article.description }}</p>
                <p v-if="article.date_publication" class='text-base'>{{article.date_publication}}</p>
            </div>
            </section>
            <section class="section-container">
                <p class="py-10">{{ article.content }}</p>
             </section>
        </div>
</MainLayout>
</template>
