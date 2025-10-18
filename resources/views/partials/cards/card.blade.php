 <div class="bg-gray-100 rounded-xl hover:border-blue-600  border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
     <div class="relative">
         <img src="{{ asset('images/products/car1.png') }}" alt="Volvo XC90 Sport 4WD" class="w-full h-48 object-cover">

         <!-- Badges -->
         <div class="absolute top-3 left-3 flex gap-2">
             <span class="bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded flex items-center gap-1">
                 <i data-lucide="check" class="fas fa-check w-3"></i>
                 Kiểm duyệt
             </span>
             <span class="bg-orange-500 text-white text-xs font-semibold px-2 py-1 rounded flex items-center gap-1">
                 <i data-lucide="clock" class="fas fa-clock w-3"></i>
                 Mới
             </span>
         </div>

         <!-- Action buttons -->
         <div class="absolute top-3 right-3 flex gap-2">
             <button class="bg-white/80 hover:bg-blue-400 backdrop-blur-sm p-1 w-7 h-7 cursor-pointer flex items-center justify-center rounded-full hover:bg-white transition-colors">
                 <i data-lucide="bookmark"  class="text-gray-600 w-4 "></i>
             </button>
         </div>
     </div>

     <div class="p-4">
         <div class="text-sm text-gray-500 mb-2">27/05/2024</div>

         <h3 class="font-semibold text-lg text-gray-900 mb-1">
             Volvo XC90 Sport 4WD
             <span class="text-gray-500 font-normal">(2019)</span>
         </h3>
         <div class="text-2xl font-bold text-gray-900 mb-4">$43,500</div>
         <div class="h-[1px] bg-gray-200 my-5"></div>

         <div class="grid grid-cols-2 gap-3 text-sm text-gray-600">
             <div class="flex items-center gap-2">
                 <i data-lucide="map-pin" class="fas fa-map-marker-alt text-gray-400"></i>
                 <span>Houston</span>
             </div>
             <div class="flex items-center gap-2">
                 <i data-lucide="gauge" class="fas fa-tachometer-alt text-gray-400"></i>
                 <span>78K mi</span>
             </div>
             <div class="flex items-center gap-2">
                 <i data-lucide="fuel" class="fas fa-gas-pump text-gray-400"></i>
                 <span>Diesel</span>
             </div>
             <div class="flex items-center gap-2">
                 <i data-lucide="cog" class="fas fa-cog text-gray-400"></i>
                 <span>Automatic</span>
             </div>
         </div>
     </div>
 </div>
