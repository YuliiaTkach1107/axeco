<script setup>

const contactInfo = [
  {
    icon:`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#0E9727" d="M6.62 10.79c1.44 2.83 3.76 5.15 6.59 6.59l2.2-2.2c.28-.28.67-.36 1.02-.25c1.12.37 2.32.57 3.57.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02z" stroke-width="0.1" stroke="#fff"/></svg>`,
    bgColor: "rgb(163,248,179,0.5)",
    text: "+32 2 897 20 08",
    type: "tel",
    link: "tel:+3228972008",
    multiline: false
  },
  {
    icon:`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#0d4677" d="M4.616 19q-.691 0-1.153-.462T3 17.384V6.616q0-.691.463-1.153T4.615 5h14.77q.69 0 1.152.463T21 6.616v10.769q0 .69-.463 1.153T19.385 19zM12 12.116L4 6.885v10.5q0 .269.173.442t.443.173h14.769q.269 0 .442-.173t.173-.443v-10.5zM12 11l7.692-5H4.308zM4 6.885V6v11.385q0 .269.173.442t.443.173H4z" stroke-width="1" stroke="#0d4677"/></svg>`,
    bgColor: "rgb(32,90,140,0.15)",
    text: "info@axeco.immo",
    type: "email",
    link: "mailto:info@axeco.be",
    multiline: false
  },
   {
    icon:`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#f2522e" d="M11.5 7A2.5 2.5 0 0 1 14 9.5a2.5 2.5 0 0 1-2.5 2.5A2.5 2.5 0 0 1 9 9.5A2.5 2.5 0 0 1 11.5 7m0 1A1.5 1.5 0 0 0 10 9.5a1.5 1.5 0 0 0 1.5 1.5A1.5 1.5 0 0 0 13 9.5A1.5 1.5 0 0 0 11.5 8m-4.7 4.36l4.7 7.73l4.7-7.73c.51-.86.8-1.81.8-2.86A5.5 5.5 0 0 0 11.5 4A5.5 5.5 0 0 0 6 9.5c0 1.05.29 2 .8 2.86m10.25.52L11.5 22l-5.55-9.12C5.35 11.89 5 10.74 5 9.5A6.5 6.5 0 0 1 11.5 3A6.5 6.5 0 0 1 18 9.5c0 1.24-.35 2.39-.95 3.38" stroke-width="1.2" stroke="#f2522e"/></svg>`,
    bgColor: "rgb(249,217,210,0.5)",
    text: "Chaussée de La Hulpe 150 1170 Bruxelles – Belgique",
    type: "map",
    link: "https://maps.app.goo.gl/ciFDMCpNPhs6KVs5A",
    multiline: false
  }
]

</script>

<template>
<footer class="bg-[#f0f6fc] w-full py-8 relative">
  <div class="w-[90%] max-w-[1400px] mx-auto">

    <!-- Main content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-8">

      <!-- Logo + description -->
      <div class="flex flex-col gap-6">
        <div class="w-[160px] h-auto">
          <img
            src="images/logo/AXECO_Logo.png"
            alt="Axeco Logo"
            class="w-full h-full object-cover"
          />
        </div>

        <div class="max-w-[260px]">
          <p class="text-[var(--text-blue-light)] leading-relaxed text-[14px]">
            Votre partenaire de confiance pour une gestion transparente et rigoureuse de votre copropriété.
          </p>
        </div>

        <button
          class="cursor-pointer bg-[#f2522e] text-[#f9f9f9] rounded-full px-8 py-4
                 flex items-center justify-center gap-3 w-fit
                 hover:bg-[#d94827] transition-colors active:scale-[0.97] focus:outline-none touch-manipulation "
        >
          <span class="text-[14px] font-semibold">Demander un devis</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
            <path
              fill="#fff"
              d="M17.073 12.5H5.5q-.213 0-.357-.143T5 12t.143-.357t.357-.143h11.573l-3.735-3.734q-.146-.147-.152-.345t.152-.363q.166-.166.357-.168t.357.162l4.383 4.383q.13.13.183.267t.053.298t-.053.298t-.183.268l-4.383 4.382q-.146.146-.347.153t-.367-.159q-.16-.165-.162-.354t.162-.354z"
              stroke="#fff"
              stroke-width="1.2"
            />
          </svg>
        </button>
      </div>

      <!-- Divider -->
      <div class="flex w-full h-[1px] bg-[#205A8C] lg:hidden"></div>

      <!-- Quick links -->
      <div class="flex flex-col justify-center">
        <ul class="flex flex-col gap-6 text-[16px]">
          <li><a href="#" class="font-semibold cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">À propos</a></li>
          <li><a href="#" class="font-semibold cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Nos services</a></li>
          <li><a href="#" class="font-semibold cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Notre équipe</a></li>
          <li><a href="#" class="font-semibold cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Actualités</a></li>
          <li><a href="#" class="font-semibold cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Contact</a></li>
          <li><a href="#" class="font-semibold cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">FAQ</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="flex flex-col gap-6 max-w-[240px]">
        <h4 class="text-[#0d4677] lg:text-[16px] font-semibold">Contact</h4>

        <div class="flex flex-col gap-5">
          <div
            v-for="(item, index) in contactInfo"
            :key="index"
            class="flex items-start gap-5"
          >
            <div
              class="w-9 h-9 rounded-[10px] shrink-0 flex items-center justify-center"
              :style="{ backgroundColor: item.bgColor }"
              v-html="item.icon"
            ></div>
             <!-- TEXT / LINK -->
            <component
                :is="item.link ? 'a' : 'p'"
                :href="item.link"
                target="_blank"
                rel="noopener"
                class="text-[#205a8c] text-[14px] leading-normal pt-2 hover:underline"
            >
                {{ item.text }}
            </component>
          </div>
        </div>
      </div>
    </div>

    <!-- Divider -->
    <div class="hidden lg:flex w-full h-[1px] bg-[#205A8C] mt-10 mb-10"></div>

    <!-- Bottom section -->
    <div class="flex flex-col md:flex-row items-center justify-between mt-10 gap-3 text-center md:text-left">
      <p class="text-[var(--text-blue-light)] text-[14px]">
        © 2025 Axeco. Tous droits réservés.
      </p>

      <div class="flex flex-wrap items-center justify-center gap-8 md:gap-14">
        <a href="#" class="text-[var(--text-blue-light)] text-[14px] underline hover:text-[#205a8c] transition-colors">Mentions légales</a>
        <a href="#" class="text-[var(--text-blue-light)] text-[14px] underline hover:text-[#205a8c] transition-colors">Politique de confidentialité</a>
      </div>
    </div>

  </div>
</footer>

</template>

<style scoped>
</style>
