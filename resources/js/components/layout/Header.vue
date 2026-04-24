<script setup>
   import { ref,onMounted,onUnmounted } from 'vue'
   import { Link,usePage } from '@inertiajs/vue3'
   import { route } from 'ziggy-js'

    const props = defineProps({
        contacts: Array,
    })

   const page = usePage()

   const mobileMenuOpen = ref(false)

   const handleKeydown = (e) => {
   if (e.key === 'Escape' && mobileMenuOpen.value) {
      mobileMenuOpen.value = false
   }
   }

   onMounted(() => {
   window.addEventListener('keydown', handleKeydown)
   })

   onUnmounted(() => {
   window.removeEventListener('keydown', handleKeydown)
   })

</script>

<template>
   <header class='fixed top-0 left-0 w-full z-50 bg-[#ffffff] shadow-md'>
      <!-- Slogan caché pour SEO -->
      <h1 class="sr-only">AXECO – entreprise de construction</h1>
      <!-- Topbar -->
      <div class="hidden lg:flex topbar bg-[rgb(198,224,250,0.3)] justify-end gap-20">
         <div v-for="(item) in $page.props.headerContacts" :key="item.id" class='flex items-center justify-center gap-2'>
            <a :href="item.link" target="_blank" rel="noopener noreferrer" :aria-label="'Appeler ' + item.content" class="phone cursor-pointer px-6 rounded-[10px] hover:[color:var(--text-orange)] active:[color:var(--text-orange)] transition">
               <span class="text-base">{{ item.content }}</span>
            </a>
         </div>
         <!-- Desktop -->
         <ul class='flex items-center justify-end gap-4 mr-15 h-15 '>
            <li><a hreflang='#' class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">FR</a></li>
            <li><a hreflang='#' class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">NL</a></li>
            <li><a hreflang='#' class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">EN</a></li>
         </ul>
      </div>
      <!-- Main Header -->
      <div class="main-header flex items-center justify-between">
         <!-- Logo -->
         <Link :href="route('PageAccueil')" class="logo cursor-pointer"> <img src="/images/logo/AXECO_Logo.png" alt="Logo de l'entreprise AXECO" class="w-[180px] h-auto"></Link>
         <!-- Navigation -->
         <nav aria-label="Menu principal du site">
            <ul class="hidden lg:flex gap-10 text-[16px]" style="font-family: var(--font-open-sans); font-weight: var(--font-weight-nirmal)">
               <li><Link :href="route('A_propos')" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]" :class="{ '[color:var(--text-orange)]': $page.url === '/a-propos' }">À propos</Link></li>
               <li><Link :href="route('Services')" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]" :class="{ '[color:var(--text-orange)]': page.url === '/services' }">Nos services</Link></li>
               <li><Link :href="route('Notre_equipe')" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]" :class="{ '[color:var(--text-orange)]': page.url === '/notre-equipe'}">Notre équipe</Link></li>
               <li><Link :href="route('Actualites')" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]" :class="{ '[color:var(--text-orange)]':  page.url.split('#')[0].startsWith('/actualites') }">Actualités</Link></li>
               <li><Link :href="route('Contact')" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]" :class="{ '[color:var(--text-orange)]': page.url.split('#')[0].startsWith('/contact') }">Contact</Link></li>
            </ul>
         </nav>
         <!-- Burger Menu -->
         <button @click="mobileMenuOpen = !mobileMenuOpen" class="cursor-pointer lg:hidden mr-8 flex flex-col justify-between w-6 h-6 relative" aria-label="Ouvrir le menu mobile" :aria-expanded="mobileMenuOpen.toString()" aria-controls="mobile-menu">
            <span :class="[ 'block h-0.5 w-full bg-foreground transform transition-all duration-300 ease-in-out origin-center', mobileMenuOpen ? 'rotate-45 translate-y-2' : '']"></span>
            <span :class="['block h-0.5 w-full bg-foreground transform transition-all duration-300 ease-in-out', mobileMenuOpen ? 'opacity-0' : '']"></span>
            <span :class="[ 'block h-0.5 w-full bg-foreground transform transition-all duration-300 ease-in-out origin-center', mobileMenuOpen ? '-rotate-45 -translate-y-3.5' : '']"></span>
         </button>
         <!-- Bouton -->
         <Link :href="route('EnterCode')" aria-label="Accéder à MyAXECO" class="hidden flex items-center gap-2 cursor-pointer lg:flex text-white bg-foreground text-[16px] py-[11px] px-[18px] rounded-[33px] mr-10 shadow-[4px_4px_6px_rgba(0,0,0,0.2)] hover:[background:var(--accent)] active:[background:var(--accent)] active:scale-[0.97]  touch-manipulation">
            MyAXECO
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
               <path fill="#fff" d="M12 11.385q-1.237 0-2.119-.882T9 8.385t.881-2.12T12 5.386t2.119.88t.881 2.12t-.881 2.118t-2.119.882m-7 7.23V16.97q0-.619.36-1.158q.361-.54.97-.838q1.416-.679 2.834-1.018q1.417-.34 2.836-.34t2.837.34t2.832 1.018q.61.298.97.838q.361.539.361 1.158v1.646zm1-1h12v-.646q0-.332-.215-.625q-.214-.292-.593-.494q-1.234-.598-2.546-.916T12 14.616t-2.646.318t-2.546.916q-.38.202-.593.494Q6 16.637 6 16.97zm6-7.23q.825 0 1.413-.588T14 8.384t-.587-1.412T12 6.384t-1.412.588T10 8.384t.588 1.413t1.412.587m0 7.232" stroke-width="0.3" stroke="#fff"/>
            </svg>
         </Link>
      </div>
      <!-- Mobile Menu -->
      <transition name="slide-fade">
         <div id="mobile-menu" v-if="mobileMenuOpen" class="lg:hidden w-full min-h-screen bg-white px-6 py-4 ">
            <ul class="flex flex-col gap-6 text-[18px] text-center" style="font-family: var(--font-open-sans); font-weight: var(--font-weight-normal)">
               <li><Link :href="route('A_propos')" @click="mobileMenuOpen = false" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">À propos</Link></li>
               <li><Link :href="route('Services')" @click="mobileMenuOpen = false" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Nos services</Link></li>
               <li><Link :href="route('Notre_equipe')" @click="mobileMenuOpen = false" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Notre équipe</Link></li>
               <li><Link :href="route('Actualites')" @click="mobileMenuOpen = false" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Actualités</Link></li>
               <li><Link :href="route('Contact')" @click="mobileMenuOpen = false" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Contact</Link></li>
               <li>
                  <!-- Bouton MyAXECO dans le menu mobile -->
                  <Link :href="route('EnterCode')" role="button" aria-label="Accéder à MyAXECO" class="cursor-pointer text-white bg-foreground items-center m-auto w-full text-[18px] py-[11px] px-[18px] gap-2 rounded-[33px] shadow-[4px_4px_6px_rgba(0,0,0,0.2)] mt-4 flex justify-center hover:[background:var(--accent)]  active:[background:var(--accent)] active:scale-[0.97] touch-manipulation">
                     MyAXECO
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="#fff" d="M12 11.385q-1.237 0-2.119-.882T9 8.385t.881-2.12T12 5.386t2.119.88t.881 2.12t-.881 2.118t-2.119.882m-7 7.23V16.97q0-.619.36-1.158q.361-.54.97-.838q1.416-.679 2.834-1.018q1.417-.34 2.836-.34t2.837.34t2.832 1.018q.61.298.97.838q.361.539.361 1.158v1.646zm1-1h12v-.646q0-.332-.215-.625q-.214-.292-.593-.494q-1.234-.598-2.546-.916T12 14.616t-2.646.318t-2.546.916q-.38.202-.593.494Q6 16.637 6 16.97zm6-7.23q.825 0 1.413-.588T14 8.384t-.587-1.412T12 6.384t-1.412.588T10 8.384t.588 1.413t1.412.587m0 7.232" stroke-width="0.3" stroke="#fff"/>
                     </svg>
                  </Link>
               </li>
            </ul>
            <div v-for="(item) in $page.props.headerContacts" :key="item.id">
               <a :href="item.link" target="_blank" rel="noopener noreferrer" :aria-label="'Appeler ' + item.content" class="phone cursor-pointer flex items-center justify-center gap-2 mt-6 bg-[rgb(163,248,179,0.5)] w-70 m-auto py-4 px-6 rounded-[10px] hover:bg-[rgb(163,248,179,0.7)] transition">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                     <path fill="#0E9727" d="M6.62 10.79c1.44 2.83 3.76 5.15 6.59 6.59l2.2-2.2c.28-.28.67-.36 1.02-.25c1.12.37 2.32.57 3.57.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02z" stroke-width="0.1" stroke="#fff"/>
                  </svg>
                  <span class="text-[#0e9727] text-[18px]">{{ item.content }}</span>
               </a>
            </div>
            <ul class="flex items-center justify-center gap-4 mt-6 m-auto">
               <li><a hreflang="#" class="cursor-pointer hover:[color:var(--text-orange)]">FR</a></li>
               <li><a hreflang="#" class="cursor-pointer hover:[color:var(--text-orange)]">NL</a></li>
               <li><a hreflang="#" class="cursor-pointer hover:[color:var(--text-orange)]">EN</a></li>
            </ul>
         </div>
      </transition>
   </header>
</template>
<style scoped>
/* Animation d'apparition du menu mobile */
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.4s ease;
}
.slide-fade-enter-from {
  transform: translateY(-20px);
  opacity: 0;
}
.slide-fade-enter-to {
  transform: translateY(0);
  opacity: 1;
}
.slide-fade-leave-from {
  transform: translateY(0);
  opacity: 1;
}
.slide-fade-leave-to {
  transform: translateY(-20px);
  opacity: 0;
}


</style>