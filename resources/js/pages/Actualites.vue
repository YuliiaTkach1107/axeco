<script setup>
   import MainLayout from '@/layouts/MainLayout.vue'
   import { ref, computed, watch, onMounted, onUnmounted } from 'vue';
   import ArrowRight from '@/components/icons/ArrowRightIcon.vue'
   import { Link,useForm, usePage, Head } from '@inertiajs/vue3'
   import { route } from 'ziggy-js'

   const query = ref('');
   const activeSujet = ref(null)
   const sortOrder = ref('desc')

   watch([query, activeSujet, sortOrder], () => {
      visibleCount.value = 6
   })
   const props = defineProps({
        articles: {
            type: Array,
            default: () => [] 
        },
        topics: Array})
        
   const visibleCount = ref(6)
   const step = ref(6)

   onMounted(() => {
      const mobile = window.matchMedia('(max-width: 767px)')
      const tablet = window.matchMedia('(min-width: 768px) and (max-width: 1023px)')

      const update = () =>{
         if(mobile.matches){
               step.value = 3
               visibleCount.value = 3
         }
         else if(tablet.matches){
               step.value = 4
               visibleCount.value = 4
         }
         else {
               step.value = 6
               visibleCount.value = 6
         }
      }
      update()
         mobile.addEventListener('change', update)
         tablet.addEventListener('change', update)
   })

   const filtredArticles = computed(() => {
   let result = [...props.articles]

      if(query.value) {
         result = result.filter(article =>
            article.title.toLowerCase().includes(query.value.toLowerCase())
         )
      }
      if(activeSujet.value !== null) {
         result = result.filter(article => article.topic_id === activeSujet.value)
      }
      result.sort((a, b) => {
         const dateA = new Date(a.date_publication)
         const dateB = new Date(b.date_publication)
         return sortOrder.value === 'desc' ? dateB - dateA : dateA - dateB
      })
      return result

   })
   const latestArticle = computed(()=>{
         return filtredArticles.value[0]
   })
   const suggestions = computed(() => {
         if (!query.value) return []
         return filtredArticles.value.slice(0, 5)
         });
   const form = useForm({
         email:'',
   })
   function submit(){
         form.post(route('newsletter.subscribe'), {
            preserveScroll: true,
            onSuccess: () => {
               form.reset()
            }
         })
   }
   const page = usePage()
   const flash = computed(() => page.props.flash)

   const show = ref(false)

   watch(
      flash,
      (newFlash) => {
         if (newFlash?.success || newFlash?.error) {
               show.value = true

               setTimeout(() => {
                  show.value = false
               }, 4000)
         }
      },
      { immediate: true }
   )

</script>

<template>
   <MainLayout>
      <Head>
         <title>Actualités & Conseils Immobiliers | Axeco Syndic Bruxelles</title>
         <meta name="description" content="Suivez l'actualité de la copropriété à Bruxelles : conseils d'experts, tendances du marché et informations pratiques pour les copropriétaires." />
         <link rel="canonical" href="https://axeco.be/actualites" />
         <meta property="og:title" content="Actualités Immobilières - Axeco" />
         <meta property="og:description" content="Découvrez nos derniers articles et conseils pour une meilleure gestion de votre immeuble." />
         <meta property="og:image" content="https://axeco.be/images/page_accueil/bg-1.jpg" />
      </Head>
      <transition name="fade">
         <div v-if="show && flash.success" role="status" aria-live="polite" class="fixed top-24 lg:top-5 right-0 md:right-5 bg-[#0d4677] text-white px-6 py-3 rounded-xl shadow-lg z-50">
            {{ flash.success }}
         </div>
      </transition>
      <transition name="fade">
         <div v-if="show && flash.error" role="alert" aria-live="assertive" class="fixed top-24 lg:top-5 right-0 md:right-5 bg-[#f2522e] text-white px-6 py-3 rounded-xl shadow-lg z-50">
            {{ flash.error }}
         </div>
      </transition>
      <div id="actualites" role="main">
         <section id="main-content" class="hero relative w-full h-full h-screen px-6 lg:px-12" style="background: linear-gradient(rgba(255,255,255) 0%, rgba(240,246,252) 100%)">
            <!-- Hero -->
            <div class="hero-content flex flex-col items-center justify-center gap-4 pt-30 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full">
               <h1 class="hero-h1">Actualités</h1>
               <p class="hero-paragraph text-center max-w-[80%] lg:max-w-xl">Découvrez nos dernières actualités, conseils d'experts et tendances du marché immobilier</p>
               <div class="w-[80%] lg:w-full max-w-2xl mt-6 relative">
                  <label for='search' class='sr-only'>Rechercher un article </label>
                  <input 
                     id='search'
                     v-model="query"
                     type="search"
                     role='combobox'
                     aria-autocomplete='list'
                     :aria-expanded="suggestions.length > 0"
                     aria-haspopup="listbox"
                     aria-controls="search-results"
                     placeholder="Rechercher un article ..."
                     class="w-full h-14 pl-4 pr-12 rounded-full border-2 border-[#0d4677] bg-white placeholder-[#728FB6] text-gray-900 text-sm lg:text-base shadow-sm focus:outline-none focus:ring-4 focus:ring-[#0d4677]/30 transition duration-300 ease-in-out hover:shadow-md"/>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute right-4 top-1/2 -translate-y-1/2 text-[#0d4677] pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden='true'>
                     <circle cx="11" cy="11" r="8" />
                     <line x1="21" y1="21" x2="16.65" y2="16.65" />
                  </svg>
                  <!-- Results  -->
               </div>
               <div v-if="suggestions.length" id='search-results' role='listbox' class="absolute top-full left-0 w-full max-h-[250px] overflow-y-auto z-50 mt-2 mb-4">
                  <div class="grid gap-4 w-[90%] m-auto">
                     <article v-for="article in suggestions" :key="article.id" role='option'>
                        <Link :href="`/article/${article.id}`" class="search-card flex items-center gap-4 p-2 lg:p-4 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 bg-white cursor-pointer h-40">
                        <img :src="article.image_url" alt="" class="w-28 h-28 object-cover rounded-lg flex-shrink-0" />
                        <div class="px-2 lg:px-8 py-0 lg:py-6 flex flex-col justify-center gap-4">
                           <h4 class="clamp-2" v-html="article.title.replace(new RegExp(query, 'gi'), match => `<span class='highlight'>${match}</span>`)"></h4>
                           <p class="description clamp-2">{{ article.description }}</p>
                        </div>
                        </Link>
                     </article>
                  </div>
               </div>
            </div>
         </section>
         <section v-if="latestArticle" id="featured" class='bg-[#F0F6FC] py-16 lg:py-20'>
            <div class="section-container">
               <h2 class='section-h2'>ARTICLE EN VEDETTE</h2>
               <h3 class="section-h3">À la une</h3>
               <div class='line bg-gradient-to-r from-[#F2522E] to-[#205A8C]'></div>
               <Link :href="`actualites/article/${latestArticle.id}#featured`">
               <article class='flex flex-col lg:grid grid-cols-2 h-[80%] bg-white rounded-[30px] overflow-hidden m-auto' >
                  <div class="relative h-[200px] md:h-[300px] lg:h-full">
                     <span class="absolute top-6 left-4 lg:left-10 text-white text-sm bg-[#f2522e] px-3 py-2 rounded-full">NOUVEAU</span>
                     <img v-if='latestArticle.image_url' :src = latestArticle.image_url alt="" class="w-full h-full object-cover"/>
                  </div>
                  <div class='py-6 lg:py-10 px-6 lg:px-14 flex flex-col gap-2 lg:gap-4 justify-center'>
                     <h4 class='section-h4 mb-4'>{{latestArticle.title}}</h4>
                     <p class='text-[16px] lg:text-[18px] text-[#4c6e9a] leading-relaxed clamp-3'>{{latestArticle.description}}</p>
                     <Link :href="`actualites/article/${latestArticle.id}#featured`" class='button text-white bg-[#0d4677] w-fit lg:w-fit mt-2 lg:mt-6 text-sm lg:text-base'>
                        Lire l'article <ArrowRight/>
                     </Link>
                  </div>
               </article>
               </Link>
            </div>
         </section>
         <section id="articles" class="bg-[#F0F6FC] py-16 lg:py-20">
            <div class="section-container flex flex-col items-center">
               <h2 class='section-h2'>DERNIERS ARTICLES</h2>
               <h3 class="section-h3 text-center">Nos publications récentes</h3>
               <div class='line bg-gradient-to-r from-[#F2522E] to-[#205A8C] '></div>
               <div>
                  <div class="relative w-fit left-26 md:left-96">
                     <label for="sort-select" class="sr-only">Trier les articles</label>
                     <select id='sort-select' v-model="sortOrder" class='appearance-none mt-6 mb-6 bg-white border border-[#0d4677] rounded-xl px-6 py-3 cursor-pointer'>
                        <option value="desc">Par date ↓</option>
                        <option value="asc">Par date ↑</option>
                     </select>
                  </div>
                  <div class="flex flex-col md:flex-row gap-4 mb-6">
                     <!-- Articles -->
                     <button
                        @click="activeSujet = null" 
                        :aria-pressed='activeSujet === null'
                        :class="[
                        'px-6 py-3 rounded-full border transition cursor-pointer',
                        activeSujet === null
                        ? 'bg-[#0d4677] text-white border-[#0d4677]'
                        : 'border-[#0d4677] text-[#0d4677] bg-white'
                        ]"
                        >
                     Tous les articles
                     </button>
                     <!-- Sujets-->
                     <button
                        v-for="s in topics"
                        :key="s.id"
                        @click="activeSujet = s.id"
                        :aria-pressed="activeSujet === s.id"
                        :class="[
                        'px-6 py-3 rounded-full border transition cursor-pointer',
                        activeSujet === s.id
                        ? 'bg-[#0d4677] text-white border-[#0d4677]'
                        : 'border-[#0d4677] text-[#0d4677] bg-white'
                        ]"
                        >
                     {{ s.title }}
                     </button>
                  </div>
               </div>
               <div class='line h-[1px] bg-[#2E7EED]/50 w-full'></div>
               <div class="flex flex-col md:grid grid-cols-2 gap-8 lg:grid-cols-3 gap-8">
                  <article v-for="article in filtredArticles.slice(0, visibleCount)" :key="article.id">
                     <Link :href="`actualites/article/${article.id}#articles`" class="block w-full h-full bg-white  rounded-[30px] overflow-hidden m-auto transform transition duration-300 ease-in-out hover:scale-105 hover:-translate-y-2 hover:shadow-lg focus-visible:ring-2 focus-visible:ring-[#F2522E] focus-visible:ring-offset-2 active:scale-[0.97] " >
                     <div v-if='article.topic' class="absolute text-white font-semibold text-sm w-fit px-3 py-2 rounded-full mt-6 ml-6 " :style="{background: article.topic.color }" :aria-label="'Catégorie: ' + article.topic.title" > 
                        {{ article.topic.title }}
                     </div>
                     <div v-if='article.image_url' class='h-50 md:h-60 lg:h-50'>
                        <img :src="article.image_url"  alt="" class='object-cover h-full w-full' />
                     </div>
                     <div class='px-8 py-6 flex flex-col justify-center gap-4'>
                        <h4 v-if='article.title' class='clamp-2'> {{ article.title }}</h4>
                        <p v-if='article.description' class="description clamp-2"> {{article.description}} </p>
                        <p class='text-lg flex items-center gap-2 text-[#f2522e]'> Lire la suite <span class="sr-only"> de l'article {{ article.title }}</span><span aria-hidden="true"><ArrowRight /></span></p>
                     </div>
                     </Link>
                  </article>
               </div>
               <button v-if="visibleCount < filtredArticles.length" @click="visibleCount += step"  class="button mt-10 bg-[#0d4677] text-white font-normal cursor-pointer disabled:hidden" > 
                  Voir plus 
                  <svg aria-hidden="true" class="w-4 h-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
               </button>
               <button v-if='visibleCount >= filtredArticles.length && filtredArticles.length > 6' @click="visibleCount = step " class="button mt-10 bg-[#0d4677] text-white font-normal cursor-pointer disabled:hidden" >
                  Voir moins
                  <svg aria-hidden="true" class="w-4 h-4 transition-transform duration-300 rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
               </button>
            </div>
         </section>
         <section>
            <div class="bg-gradient-to-b from-[rgb(32,90,140)] to-[rgb(32,90,140,0.8)] py-10  max-w-[100%] mx-auto py-10 px-10 text-center text-white flex flex-col items-center gap-8 lg:gap-6 ">
               <h3 class="text-[25px] lg:text-[30px]">Restez informé avec notre newsletter</h3>
               <p class="text-[16px] lg:text-[16px] lg:text-[18px]" >Recevez nos derniers articles et conseils directement dans votre boîte mail.</p>
               <form @submit.prevent='submit' class="w-full lg:w-[50%]">
                  <div class="relative w-full">
                     <label for='newsletter-email' class='sr-only'> Adresse email pour la newsletter  </label>
                     <input
                        id='newsletter-email'
                        v-model="form.email"
                        type="email"
                        :aria-invalid="form.errors.email ? 'true' : 'false'"
                        aria-describedby="email-error"
                        placeholder="Votre adresse email"
                        required
                        class="w-full h-15 pl-6 rounded-full bg-[#728FB6] placeholder-[#F1F1F1] text-sm lg:text-base focus:outline-none focus:ring-4 focus:ring-[#0d4677]/30" />
                     <button type="submit" class="absolute right-0 top-1/2 -translate-y-1/2 cursor-pointer px-4 lg:px-8 h-15 rounded-full bg-[#f2522e] text-white font-semibold shadow-md hover:bg-[#d84322] transition">
                        S'abonner
                     </button>
                  </div>
                  <p v-if="form.errors.email" id='email-error' role='alert' class="text-red-500 mt-2 text-base bg-white rounded-full">{{ form.errors.email }}</p>
               </form>
            </div>
         </section>
      </div>
   </MainLayout>
</template>

<style scoped>
   input[type="search"]::-webkit-search-cancel-button {
      -webkit-appearance: none; 
      height: 20px;
      width: 20px;
      background: url('data:image/svg+xml;utf8,<svg fill="%230d4677" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18" stroke="%230d4677" stroke-width="2"/><line x1="6" y1="6" x2="18" y2="18" stroke="%230d4677" stroke-width="2"/></svg>') no-repeat center;
      cursor: pointer;
   }
   .fade-enter-active,
   .fade-leave-active {
      transition: opacity 0.4s ease, transform 0.4s ease;
   }

   .fade-enter-from,
   .fade-leave-to {
      opacity: 0;
      transform: translateY(-10px);
   }
</style>