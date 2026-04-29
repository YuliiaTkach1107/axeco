<script setup>
    import MainLayout from '@/layouts/MainLayout.vue'
    import { Link, Head } from '@inertiajs/vue3'
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
      <Head>
         <title>{{ article.title }} | Axeco Actualités</title>
         <meta name="description" :content="article.description" />
         <link rel="canonical" :href="'https://axeco.be/actualites/article/' + article.id" />
         <meta property="og:type" content="article" />
         <meta property="og:title" :content="article.title" />
         <meta property="og:description" :content="article.description" />
         <meta property="og:image" :content="'https://axeco.be/' + article.image_url" />
         <meta property="article:published_time" :content="article.date_publication" />
      </Head>
      <div id="article" role="main">
         <!-- HERO -->
         <section class="relative min-h-[70vh] md:h-[80vh] flex items-end pt-28 md:pt-40" aria-label="En-tête de l'article">
            <!-- Retour -->
            <Link :href="route('Actualites') + '#' + backSection" aria-label = "Retour à la liste des articles" class="absolute z-20 top-38 md:top-40 lg:top-46 left-4 md:left-6 text-white flex items-center gap-2 bg-black/40 px-3 py-2 md:px-4 md:py-2 text-sm md:text-base rounded-full backdrop-blur hover:bg-black/60 transition">
                <span aria-hidden="true">←</span> Retour
            </Link>
            <div class="absolute inset-0 bg-cover bg-center" role="img" :aria-label="'Image de couverture: ' + article.title" :style="{ backgroundImage: `url(/${article.image_url})` }"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent" aria-hidden = "true"></div>
            <div class="section-container relative z-10 text-white pb-8 md:pb-10 flex flex-col gap-3 md:gap-4 max-w-4xl">
               <nav aria-label="Fil d'Ariane" class="text-xs md:text-sm opacity-80 leading-snug">
                  <ol class="flex list-none p-0">
                     <li><Link :href="route('Actualites')" class="hover:underline">Actualités</Link></li>
                     <li class="mx-1 md:mx-2">/</li>
                     <li class="font-semibold line-clamp-1" aria-current="page">{{ article.title }}</li>
                  </ol>
               </nav>
               <div class="flex flex-wrap items-center gap-2 md:gap-4 text-xs md:text-sm opacity-90">
                  <time :datetime="article.date_publication" v-if="article.date_publication">{{ article.date_publication }}</time>
                  <span v-if="article.topic" class="px-2 py-1 md:px-3 md:py-1 rounded-full text-white text-xs md:text-sm" :style="{ background: article.topic.color }">{{ article.topic.title }}</span>
               </div>
               <h1 class="text-2xl md:text-4xl lg:text-5xl font-bold leading-tight">{{ article.title }}</h1>
               <p class="text-sm md:text-lg opacity-90 leading-relaxed line-clamp-3 md:line-clamp-none">{{ article.description }}</p>
            </div>
         </section>
         <section class="relative z-20 px-6 py-16 lg:py-20 bg-[#F8FBFF]">
            <div class="max-w-4xl mx-auto">
               <article class="bg-white rounded-[24px] shadow-md px-6 py-8 lg:px-10 lg:py-12">
                  <div class="w-12 h-[3px] bg-[#f2522e] rounded-full mb-6" aria-hidden='true'></div>
                  <p class="text-[#205A8C] text-base lg:text-lg leading-relaxed whitespace-pre-line">{{ article.content }}</p>
               </article>
            </div>
         </section>
      </div>
   </MainLayout>
</template>