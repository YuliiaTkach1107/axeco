<script setup>
import {ref, computed, watch} from 'vue'
import axios from 'axios';
import MainLayout from '@/layouts/MainLayout.vue'
import { useForm,  usePage} from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
   
const props = defineProps({
  employes: Array
})
const groupedEmployes = computed(() => {
    const groups = {}

    props.employes.forEach(emp => {
        if(!groups[emp.departement]){
            groups[emp.departement] = []
        }
        groups[emp.departement].push(emp)
    })
    return groups

})

const groupedEmployesArray = computed(() => {
    const groups = {}

    props.employes.forEach(emp => {
        if(!groups[emp.departement]) groups[emp.departement] = []
        groups[emp.departement].push(emp)
    })

    const entries = Object.entries(groups)

    const directionIndex = entries.findIndex(([dept]) => dept === 'Direction')
    if(directionIndex > -1){
        const [direction] = entries.splice(directionIndex, 1)
        entries.unshift(direction)
    }

    return entries
})
const data = useForm({
                file:null,
                email:'',
            })

const selectedFile = ref(null)
function handleFileUpload(e) {
    const file = e.target.files[0]
    selectedFile.value = file
    data.file = file 
}
function submit(){
        data.post(route('resume.send'), {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => {
                data.reset()
                selectedFile.value = null
            },
            onError: (errors) => {
                console.log(errors)
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
<div id="notre_equipe">
    <transition name="fade">
         <div
            v-if="show && flash.success"
            role="status"
            aria-live="polite"
            class="fixed top-24 lg:top-5 right-0 md:right-5 bg-[#0d4677] text-white px-6 py-3 rounded-xl shadow-lg z-50">
            {{ flash.success }}
         </div>
      </transition>
      <transition name="fade">
         <div
            v-if="show && flash.error"
            role="alert"
            aria-live="assertive"
            class="fixed top-24 lg:top-5 right-0 md:right-5 bg-[#f2522e] text-white px-6 py-3 rounded-xl shadow-lg z-50">
            {{ flash.error }}
         </div>
      </transition>
<section id="main-content" class="hero relative w-full h-full min-h-screen px-6 lg:px-12" style="background: linear-gradient(rgba(255,255,255) 0%, rgba(240,246,252) 100%)">
        <div aria-hidden='true' class="hidden md:flex absolute left-20 top-50 w-[150px] h-[150px] border-3 border-[#F2522E] rotate-22 rounded-[33px] opacity-20"></div>
        <div aria-hidden='true' class="hidden md:flex absolute right-70 top-140 w-[100px] h-[100px] border-3 border-[#2E7EED] -rotate-54 rounded-[33px] opacity-20"></div>
        <div class="px-6 flex flex-col items-center relative z-20 w-full max-w-7xl mx-auto pt-40 lg:pt-60 pb-6 lg:pb-6 h-[100%]">
            <div class="flex flex-col gap-6 justify-center text-center lg:text-center items-center lg:items-center">
                <h1 class='text-[35px] md:text-[50px] lg:text-[60px] leading-tight mt-6 font-semibold  text-[#0D4677]'>Notre équipe </h1>
                <p class="text-[16px] lg:text-[18px] text-[#627a9a] max-w-[90%]  leading-relaxed mt-1 mb-6">Une équipe de professionnels passionnés, dédiée à l'excellence en gestion immobilière depuis plus de 30 ans</p>
                <picture class="block w-full max-w-xl rounded-xl overflow-hidden border-4 md:border-6 border-[#B9D6FE] shadow-md">
                    <img 
                        src="images/équipe/equipe.jpg" 
                        class="w-full h-auto object-contain" 
                        alt="Notre équipe"
                    />
                </picture>
               </div>
        </div>
</section>
<section class='content py-16 lg:py-20'>
    <div class="section-container m-auto">
               <h2 class='section-h2 text-center'>RENCONTREZ NOTRE ÉQUIPE</h2>
               <h3 class="section-h3 text-center">Les experts derrière AXECO</h3>
               <div class='line bg-gradient-to-r from-[#F2522E] to-[#205A8C] m-auto'></div>
    </div>
   <div v-for="([dept, employees]) in groupedEmployesArray" :key="dept" class="mb-16">
    <!-- Название отдела -->
    <h4 class="text-center text-3xl font-semibold my-12">{{ dept }}</h4>

    <!-- Сетка сотрудников -->
    <div class="flex flex-wrap gap-8 justify-center ">
        <div v-for="emp in employees" :key="emp.id" class="flex flex-col items-center text-center w-[90%] md:w-[40%] lg:w-[30%] h-80 border-2 border-[#B9D6FE] justify-center rounded-3xl shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-[0px_15px_35px_rgba(16,43,64,0.25)]">
        
        <!-- Аватар -->
        <picture v-if="emp.avatar">
            <img :src="emp.avatar" alt="" class="rounded-full w-40 h-40 object-cover mb-4 border-2 border-[#2e7eed]">
        </picture>
        
        <!-- Информация -->
        <div class="space-y-1">
            <p class="font-medium text-lg text-[#0d4677]" v-if="emp.prenom || emp.nom">{{ emp.prenom }} {{ emp.nom }}</p>
            <p class="text-xl text-[#2e7eed]  font-semibold">{{ emp.position }}</p>
            <p class="text-sm text-[#4c6e9a] break-all">{{ emp.email }}</p>
            <p class="text-sm text-[#4c6e9a]">{{ emp.telephone }}</p>
        </div>
        
        </div>
  </div>
</div>
</section>

<section class='resume pb-16 lg:pb-20'>
    <div class='w-[90%] lg:w-[60%] px-10 py-10 flex flex-col gap-4 lg:gap-6 justify-center items-center m-auto border-2 border-[#B9D6FE] rounded-3xl shadow-xl' style="background: linear-gradient(rgba(255,255,255) 0%, rgba(240,246,252) 100%)">
        <div class='bg-[#f2522e] rounded-lg p-3 mb-2' >
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="white" d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2"/></svg>
        </div>
        <h3 class='section-h3 text-center'>Rejoinez notre équipe</h3>
        <p class='description text-center'>Vous êtes passionné par l'immobilier et souhaitez faire partie d'une équipe dynamique ? Découvrez nos opportunités de carrière.</p>
        <form @submit.prevent="submit" class="w-full flex flex-col gap-6">

      <!-- Поле загрузки файла -->
      <label class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-[#4c6e9a] rounded-xl cursor-pointer hover:border-[#0D4677] transition-colors">
        <span v-if="!selectedFile" class="text-[#4c6e9a] text-center">
            Cliquez pour téléverser votre CV ou glissez-le ici
        </span>
        <span v-else class="text-[#0D4677] font-semibold text-center">
            Fichier sélectionné: {{ selectedFile.name }}
        </span>
        <input type="file" class="hidden" @change="handleFileUpload" required />
        <p v-if="data.errors.file" class="text-red-500 mt-2 text-sm">{{ data.errors.file }}</p>
      </label>

      <!-- Поле Email -->
      <div class="flex flex-col gap-2">
        <label for="email" class="text-gray-700 font-medium">Email <span class="text-[#0d4677]">*</span></label>
        <input type="email" id="email" name="email" v-model="data.email" required 
          class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0D4677] focus:border-[#0D4677] outline-none transition-all" 
          placeholder="exemple@domain.com" />
      </div>

      <!-- Кнопка отправки -->
      <button type="submit" 
        class="inline-flex items-center justify-center
         px-10 py-4 rounded-[33px] w-fit m-auto
         text-white font-semibold text-[16px]
         bg-[#0D4677] cursor-pointer
         shadow-[4px_4px_10px_rgba(0,0,0,0.25)]
         hover:bg-[color:var(--accent)]
         transition-all
         active:scale-[0.97]
         focus:outline-none
         touch-manipulation"
         >
        Envoyer sa candidature
      </button>

    </form>
    </div>
</section>
<section>
    <div class="bg-gradient-to-b py-10 from-[rgb(32,90,140)] to-[rgb(32,90,140,0.8)] max-w-[100%] mx-auto py-10 px-10 text-center text-white flex flex-col items-center gap-8 lg:gap-6 ">
               <h3 class="text-[25px] lg:text-[30px]">Étudiants & stages</h3>
               <p class="text-[16px] lg:text-[16px] lg:text-[18px]" >Vous êtes étudiant(e) et à la recherche d'un stage dans le secteur de l'immobilier? <br> N'hésitez pas à nous contacter pour discuter de votre projet de stage. </p>
               <div class="flex justify-center">
                  <div class="flex flex-col items-center mt-2 md:flex-row justify-center lg:flex-row gap-4 w-[280px] md:w-auto lg:w-auto">
                     <a
                        href="tel:+3228972008" aria-label="Appeler +32 2 897 20 08"
                        class="inline-flex items-center gap-3 w-fit lg:w-auto
                        px-10 py-4 rounded-[33px]
                        text-[color:var(--text-dark-blue)] border-2 border-[color:var(--text-dark-blue)] font-semibold text-[16px]
                        shadow-[4px_4px_10px_rgba(0,0,0,0.25)]
                        hover:text-[color:var(--accent)]
                        border-[color:var(--accent)]
                        transition-all
                        active:scale-[0.97]
                        focus-visible:ring-2 
                        focus-visible:ring-[#F2522E]
                        focus-visible:ring-offset-2
                        touch-manipulation"
                        >
                     Appelez-nous
                     </a>
                     <Link :href="route('Contact')"
                        class="inline-flex items-center gap-3 w-fit lg:w-auto
                        px-10 py-4 rounded-[33px]
                        text-white font-semibold text-[16px]
                        bg-[color:var(--accent)]
                        shadow-[4px_4px_10px_rgba(0,0,0,0.25)]
                        hover:bg-[#d94827]
                        transition-all
                        active:scale-[0.97]
                        focus-visible:ring-2 
                        focus-visible:ring-[#F2522E]
                        focus-visible:ring-offset-2
                        touch-manipulation"
                        >
                        Contactez-nous!
                        <ArrowRight/>
                     </Link>
                  </div>
               </div>
            </div>
</section>

</div>
</MainLayout>
</template>
<style>
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