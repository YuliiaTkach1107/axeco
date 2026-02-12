<script setup>
import { ref } from 'vue'

const mobileMenuOpen = ref(false)

</script>

<template>
<header class='fixed top-0 left-0 w-full z-50 bg-[#ffffff] shadow-md'>
    <!-- Topbar -->
      <div class="topbar bg-[rgb(198,224,250,0.3)] ">
        <!-- Desktop -->
        <ul class='hidden lg:flex items-center justify-end gap-4 mr-15 h-15 '>
            <li><a href='#' class="cursor-pointer hover:[color:var(--text-orange) cursor:pointer] active:[color:var(--text-orange)]">FR</a></li>
            <li><a href='#' class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">NL</a></li>
            <li><a href='#' class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">EN</a></li>
        </ul>
      </div>
      <!-- Main Header -->
    <div class="main-header flex items-center justify-between">
    <!-- Logo -->
    <a href="#" class="logo cursor-pointer">
        <img src="images/logo/AXECO_Logo.png" alt="Logo AXECO" class="w-[180px] h-auto">
    </a>

    <!-- Navigation -->
    <nav>
        <ul class="hidden lg:flex gap-10 text-[16px]" style="font-family: var(--font-open-sans); font-weight: var(--font-weight-nirmal)">
            <li><a href="#" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">À propos</a></li>
            <li><a href="#" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Nos services</a></li>
            <li><a href="#" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Notre équipe</a></li>
            <li><a href="#" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Actualités</a></li>
            <li><a href="#" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Contact</a></li>
        </ul>
    </nav>

    <!-- Burger Menu -->
    <button @click="mobileMenuOpen = !mobileMenuOpen" class="cursor-pointer lg:hidden focus:outline-none mr-8 flex flex-col justify-between w-6 h-6 relative">
    <span
        :class="[
        'block h-0.5 w-full bg-foreground transform transition-all duration-300 ease-in-out origin-center',
        mobileMenuOpen ? 'rotate-45 translate-y-2' : ''
        ]"
    ></span>
    <span
        :class="[
        'block h-0.5 w-full bg-foreground transform transition-all duration-300 ease-in-out',
        mobileMenuOpen ? 'opacity-0' : ''
        ]"
    ></span>
    <span
        :class="[
        'block h-0.5 w-full bg-foreground transform transition-all duration-300 ease-in-out origin-center',
        mobileMenuOpen ? '-rotate-45 -translate-y-3.5' : ''
        ]"
    ></span>
    </button>

    <!-- Bouton -->
    <a href="#" class="hidden flex items-center gap-2 cursor-pointer lg:flex text-white bg-foreground text-[16px] py-[11px] px-[18px] rounded-[33px] mr-10 shadow-[4px_4px_6px_rgba(0,0,0,0.2)] hover:[background:var(--accent)] active:[background:var(--accent)] active:scale-[0.97] focus:outline-none touch-manipulation">
            MyAXECO
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"><path fill="#fff" d="M12 11.385q-1.237 0-2.119-.882T9 8.385t.881-2.12T12 5.386t2.119.88t.881 2.12t-.881 2.118t-2.119.882m-7 7.23V16.97q0-.619.36-1.158q.361-.54.97-.838q1.416-.679 2.834-1.018q1.417-.34 2.836-.34t2.837.34t2.832 1.018q.61.298.97.838q.361.539.361 1.158v1.646zm1-1h12v-.646q0-.332-.215-.625q-.214-.292-.593-.494q-1.234-.598-2.546-.916T12 14.616t-2.646.318t-2.546.916q-.38.202-.593.494Q6 16.637 6 16.97zm6-7.23q.825 0 1.413-.588T14 8.384t-.587-1.412T12 6.384t-1.412.588T10 8.384t.588 1.413t1.412.587m0 7.232" stroke-width="0.3" stroke="#fff"/></svg>        
        </a>
    </div>
    <!-- Mobile Menu -->
    <transition name="slide-fade">
        <div v-if="mobileMenuOpen" class="lg:hidden w-full min-h-screen bg-white px-6 py-4 ">
            <ul class="flex flex-col gap-6 text-[18px] text-center" style="font-family: var(--font-open-sans); font-weight: var(--font-weight-normal)">
                <li><a href="#" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">À propos</a></li>
                <li><a href="#" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Nos services</a></li>
                <li><a href="#" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Notre équipe</a></li>
                <li><a href="#" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Actualités</a></li>
                <li><a href="#" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Contact</a></li>
                <li>
                    <!-- Bouton MyAXECO dans le menu mobile -->
                    <a href="#" class="cursor-pointer text-white bg-foreground items-center m-auto w-full text-[18px] py-[11px] px-[18px] gap-2 rounded-[33px] shadow-[4px_4px_6px_rgba(0,0,0,0.2)] mt-4 flex justify-center hover:[background:var(--accent)]  active:[background:var(--accent)] active:scale-[0.97] focus:outline-none touch-manipulation">
                            MyAXECO
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#fff" d="M12 11.385q-1.237 0-2.119-.882T9 8.385t.881-2.12T12 5.386t2.119.88t.881 2.12t-.881 2.118t-2.119.882m-7 7.23V16.97q0-.619.36-1.158q.361-.54.97-.838q1.416-.679 2.834-1.018q1.417-.34 2.836-.34t2.837.34t2.832 1.018q.61.298.97.838q.361.539.361 1.158v1.646zm1-1h12v-.646q0-.332-.215-.625q-.214-.292-.593-.494q-1.234-.598-2.546-.916T12 14.616t-2.646.318t-2.546.916q-.38.202-.593.494Q6 16.637 6 16.97zm6-7.23q.825 0 1.413-.588T14 8.384t-.587-1.412T12 6.384t-1.412.588T10 8.384t.588 1.413t1.412.587m0 7.232" stroke-width="0.3" stroke="#fff"/></svg>     
                        </a>
                </li>
            </ul>
            <a
                href="tel:+3228972008"
                class="phone cursor-pointer flex items-center justify-center gap-2 mt-6
                        bg-[rgb(163,248,179,0.5)] w-70 m-auto py-4 px-6 rounded-[10px]
                        hover:bg-[rgb(163,248,179,0.7)] transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#0E9727" d="M6.62 10.79c1.44 2.83 3.76 5.15 6.59 6.59l2.2-2.2c.28-.28.67-.36 1.02-.25c1.12.37 2.32.57 3.57.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02z" stroke-width="0.1" stroke="#fff"/></svg>
                <span class="text-[#0e9727] text-[18px]">+32 2 897 20 08</span>
            </a>
            <a
                href="mailto:info@axeco.immo"
                class="mail cursor-pointer flex items-center justify-center gap-2 mt-6
                        bg-[rgb(249,217,210,0.5)] w-70 m-auto py-4 px-6 rounded-[10px]
                        hover:bg-[rgb(249,217,210,0.7)] transition"
            >
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#f2522e" d="M4.616 19q-.691 0-1.153-.462T3 17.384V6.616q0-.691.463-1.153T4.615 5h14.77q.69 0 1.152.463T21 6.616v10.769q0 .69-.463 1.153T19.385 19zM12 12.116L4 6.885v10.5q0 .269.173.442t.443.173h14.769q.269 0 .442-.173t.173-.443v-10.5zM12 11l7.692-5H4.308zM4 6.885V6v11.385q0 .269.173.442t.443.173H4z" stroke-width="1" stroke="#f2522e"/></svg>
                <span class="text-[#f2522e] text-[18px]">info@axeco.immo</span>
            </a>
            <ul class="flex items-center justify-center gap-4 mt-6 m-auto">
                <li><a href="#" class="cursor-pointer hover:[color:var(--text-orange)]">FR</a></li>
                <li><a href="#" class="cursor-pointer hover:[color:var(--text-orange)]">NL</a></li>
                <li><a href="#" class="cursor-pointer hover:[color:var(--text-orange)]">EN</a></li>
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